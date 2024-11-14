<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use App\Models\Kelasprak;
use App\Models\Ketersediaan;
use App\Models\Konfigurasi;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    public function index(Request $request)
    {
        $best_solution = null;
        $best_fitness = null;
        $pertemuan_per_kelas = $request->input('pertemuan_per_kelas');

        if ($request->isMethod('post')) {
            $asisten = Asisten::pluck('id_asisten')->toArray();
            $kelas_praktikum = Kelasprak::all(); // Mengambil semua data kelas
            $konfigurasi = Konfigurasi::first();

            // Mengambil data ketersediaan
            $ketersediaan = Ketersediaan::with(['kelasprak'])
                ->get()
                ->groupBy('id_asisten')
                ->map(function ($items) {
                    return $items->map(function ($item) {
                        return [
                            'kelas' => $item->kelasprak->kelas,
                            'sesi' => $item->kelasprak->sesi,
                        ];
                    })->toArray();
                })->toArray();

            // $pertemuan_per_kelas = 2;
            $total_kelas = count($kelas_praktikum);
            $total_pertemuan = $total_kelas * $pertemuan_per_kelas;

            function generateKromosom($total_pertemuan, $asisten)
            {
                return array_map(function () use ($asisten) {
                    return $asisten[array_rand($asisten)];
                }, range(1, $total_pertemuan));
            }

            function evaluate($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas)
            {
                $violations = 0;
                $assigned = [];

                foreach ($kromosom as $i => $id_asisten) {
                    $kelas_index = (int)($i / $pertemuan_per_kelas);
                    $pertemuan_index = $i % $pertemuan_per_kelas;

                    // Pastikan indeks ada sebelum mengakses
                    if (!isset($kelas_praktikum[$kelas_index])) {
                        continue; //lewati jika kelas tidak ada
                    }

                    $kelas = $kelas_praktikum[$kelas_index];

                    // Cek ketersediaan asisten
                    if (!isset($ketersediaan[$id_asisten]) || !in_array([$kelas, $pertemuan_index + 1], $ketersediaan[$id_asisten])) {
                        $violations++;
                    }

                    // Cek bentrok jadwal
                    if (isset($assigned[$id_asisten])) {
                        if ($assigned[$id_asisten] !== [$kelas, $pertemuan_index + 1]) {
                            $violations++;
                        }
                    } else {
                        $assigned[$id_asisten] = [$kelas, $pertemuan_index + 1];
                    }
                }
                return $violations;
            }

            function fitness($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas)
            {
                $violations = evaluate($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
                return 1 / (1 + $violations);
            }

            function rouletteWheelSelection($population, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas)
            {
                $total_fitness = array_sum(array_map(function ($kromosom) use ($ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) {
                    return fitness($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
                }, $population));

                $probabilities = array_map(function ($kromosom) use ($total_fitness, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) {
                    return fitness($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) / $total_fitness;
                }, $population);

                $cumulative_probs = [];
                foreach ($probabilities as $i => $prob) {
                    $cumulative_probs[$i] = ($cumulative_probs[$i - 1] ?? 0) + $prob;
                }

                $random_value = rand(0, 10000) / 10000;
                foreach ($cumulative_probs as $i => $cum_prob) {
                    if ($random_value < $cum_prob) {
                        return $population[$i];
                    }
                }
            }

            function evolve($population, $asisten, $total_pertemuan, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas)
            {
                $new_population = [];

                foreach ($population as $kromosom) {
                    $parent1 = rouletteWheelSelection($population, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
                    $parent2 = rouletteWheelSelection($population, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);

                    // Pastikan parent1 dan parent2 tidak null
                    if ($parent1 !== null && $parent2 !== null) {
                        $crossover_point = rand(1, count($parent1) - 1); // Gunakan parent1 untuk crossover point
                        $child = array_merge(array_slice($parent1, 0, $crossover_point), array_slice($parent2, $crossover_point));
                    } else {
                        // Jika parent tidak valid, cukup salin kromosom asli
                        $child = $kromosom;
                    }

                    // Mutasi
                    if (rand(0, 100) < 30) {
                        $mutation_index = rand(0, count($child) - 1);
                        $child[$mutation_index] = $asisten[array_rand($asisten)];
                    }

                    $new_population[] = $child;
                }

                return $new_population;
            }

            $population_size = $konfigurasi->popsize;
            $population = array_map(function () use ($total_pertemuan, $asisten) {
                return generateKromosom($total_pertemuan, $asisten);
            }, range(1, $population_size));

            $generations = $konfigurasi->generasi;
            for ($i = 0; $i < $generations; $i++) {
                $population = evolve($population, $asisten, $total_pertemuan, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
            }

            // Hitung fitness untuk setiap kromosom dan simpan dalam array
            $fitness_values = array_map(function ($kromosom) use ($ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) {
                return fitness($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
            }, $population);

            // Mengurutkan populasi berdasarkan nilai fitness
            usort($population, function ($kromosomA, $kromosomB) use ($ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) {
                return evaluate($kromosomA, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) <=> evaluate($kromosomB, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
            });

            $best_solution = $population[0];
            $best_fitness = fitness($best_solution, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas); // Mengambil nilai fitness terbaik

            // Pastikan best_solution adalah string atau format yang benar
            if (is_array($best_solution)) {
                $best_solution = json_encode($best_solution); // Mengubah array menjadi string JSON
            }

            // Kirim best_solution dan best_fitness ke view
            return view('penjadwalan', compact('best_solution', 'best_fitness', 'kelas_praktikum', 'pertemuan_per_kelas', 'fitness_values', 'population'));
        }
        return view('penjadwalan', compact('best_solution', 'best_fitness'));
    }

    // public function index(Request $request)
    // {
    //     $best_solution = null;
    //     $best_fitness = null;
    //     $pertemuan_per_kelas = $request->input('pertemuan_per_kelas');
    //     $details = [];
    //     $population = [];

    //     if ($request->isMethod('post')) {
    //         $asisten = Asisten::pluck('id_asisten')->toArray();
    //         $kelas_praktikum = Kelasprak::all();
    //         $konfigurasi = Konfigurasi::first();
    //         $ketersediaan = Ketersediaan::with(['kelasprak'])
    //             ->get()
    //             ->groupBy('id_asisten')
    //             ->map(function ($items) {
    //                 return $items->map(function ($item) {
    //                     return [
    //                         'kelas' => $item->kelasprak->kelas,
    //                         'sesi' => $item->kelasprak->sesi,
    //                     ];
    //                 })->toArray();
    //             })->toArray();

    //         // Perhitungan total kelas dan pertemuan
    //         $total_kelas = count($kelas_praktikum);
    //         $total_pertemuan = $total_kelas * $pertemuan_per_kelas;

    //         function generateKromosom($total_pertemuan, $asisten)
    //         {
    //             return array_map(function () use ($asisten) {
    //                 return $asisten[array_rand($asisten)];
    //             }, range(1, $total_pertemuan));
    //         }

    //         function evaluate($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas)
    //         {
    //             $violations = 0;
    //             $assigned = [];

    //             foreach ($kromosom as $i => $id_asisten) {
    //                 $kelas_index = (int)($i / $pertemuan_per_kelas);
    //                 $pertemuan_index = $i % $pertemuan_per_kelas;

    //                 // Pastikan indeks ada sebelum mengakses
    //                 if (!isset($kelas_praktikum[$kelas_index])) {
    //                     continue; //lewati jika kelas tidak ada
    //                 }

    //                 $kelas = $kelas_praktikum[$kelas_index];

    //                 // Cek ketersediaan asisten
    //                 if (!isset($ketersediaan[$id_asisten]) || !in_array([$kelas, $pertemuan_index + 1], $ketersediaan[$id_asisten])) {
    //                     $violations++;
    //                 }

    //                 // Cek bentrok jadwal
    //                 if (isset($assigned[$id_asisten])) {
    //                     if ($assigned[$id_asisten] !== [$kelas, $pertemuan_index + 1]) {
    //                         $violations++;
    //                     }
    //                 } else {
    //                     $assigned[$id_asisten] = [$kelas, $pertemuan_index + 1];
    //                 }
    //             }
    //             return $violations;
    //         }

    //         function fitness($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas)
    //         {
    //             $violations = evaluate($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
    //             return 1 / (1 + $violations);
    //         }

    //         function rouletteWheelSelection($population, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas)
    //         {
    //             $total_fitness = array_sum(array_map(function ($kromosom) use ($ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) {
    //                 return fitness($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
    //             }, $population));

    //             $probabilities = array_map(function ($kromosom) use ($total_fitness, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) {
    //                 return fitness($kromosom, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas) / $total_fitness;
    //             }, $population);

    //             $cumulative_probs = [];
    //             foreach ($probabilities as $i => $prob) {
    //                 $cumulative_probs[$i] = ($cumulative_probs[$i - 1] ?? 0) + $prob;
    //             }

    //             $random_value = rand(0, 10000) / 10000;
    //             foreach ($cumulative_probs as $i => $cum_prob) {
    //                 if ($random_value < $cum_prob) {
    //                     return $population[$i];
    //                 }
    //             }
    //         }

    //         function evolve($population, $asisten, $total_pertemuan, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas, &$details)
    //         {
    //             $new_population = [];

    //             foreach ($population as $kromosom) {
    //                 $parent1 = rouletteWheelSelection($population, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);
    //                 $parent2 = rouletteWheelSelection($population, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);

    //                 // Validasi apakah parent1 dan parent2 adalah array
    //                 if (is_array($parent1) && is_array($parent2) && count($parent1) > 1) {
    //                     $crossover_point = rand(1, count($parent1) - 1);
    //                     $child = array_merge(array_slice($parent1, 0, $crossover_point), array_slice($parent2, $crossover_point));
    //                 } else {
    //                     // Jika parent tidak valid, lewati proses crossover
    //                     continue;
    //                 }

    //                 $mutation_index = null;

    //                 // Proses mutasi
    //                 if (rand(0, 100) < 30) {
    //                     $mutation_index = rand(0, count($child) - 1);
    //                     $child[$mutation_index] = $asisten[array_rand($asisten)];
    //                 }

    //                 // Simpan detail crossover dan mutasi untuk tiap kromosom
    //                 $details[] = [
    //                     'kromosom' => $child,
    //                     'fitness' => fitness($child, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas),
    //                     'crossover_point' => $crossover_point,
    //                     'mutation_index' => $mutation_index,
    //                 ];

    //                 $new_population[] = $child;
    //             }

    //             return $new_population;
    //         }


    //         $population_size = $konfigurasi->popsize;
    //         $population = array_map(function () use ($total_pertemuan, $asisten) {
    //             return generateKromosom($total_pertemuan, $asisten);
    //         }, range(1, $population_size));

    //         // Generasi evolusi
    //         $generations = $konfigurasi->generasi;
    //         for ($i = 0; $i < $generations; $i++) {
    //             $population = evolve($population, $asisten, $total_pertemuan, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas, $details);
    //         }

    //         echo "Generasi " . ($i + 1) . ": " . count($population) . " individu\n";

    //         $best_solution = $population[0];
    //         $best_fitness = fitness($best_solution, $ketersediaan, $kelas_praktikum, $pertemuan_per_kelas);

    //         return view('penjadwalan', compact('best_solution', 'best_fitness', 'details', 'population'));
    //     }
    //     return view('penjadwalan', compact('best_solution', 'best_fitness', 'details', 'population'));
    // }
}
