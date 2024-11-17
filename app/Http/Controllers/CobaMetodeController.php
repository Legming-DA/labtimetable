<?php

namespace App\Http\Controllers;

use App\Models\Asisten;
use App\Models\Kelasprak;
use App\Models\Ketersediaan;
use App\Models\Konfigurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CobaMetodeController extends Controller
{
    // private $populationSize = 5; //Ukuran populasi
    // private $generations = 2; //Jumlah generasi
    // private $mutationRate = 0.001; //Tingkat mutasi
    private $populationSize;
    private $generations;
    private $crossoverRate;
    private $mutationRate;

    // public function scheduleAssistants()
    // {
    //     //Ambil semua asisten dan kelas
    //     $assistants = Asisten::all();
    //     $classSchedules = Kelasprak::all();
    //     $availabilities = Ketersediaan::with('asisten', 'kelasprak')->get();

    //     //Inisialisasi populasi
    //     // $population = $this->initializePopulation($assistants, $classSchedules);
    //     $population = $this->initializePopulation($assistants, $classSchedules);
    //     $initialPopulation = $population; // Simpan hasil inisialisasi




    //     //Jalankan algoritma genetika
    //     for ($i = 0; $i < $this->generations; $i++) {
    //         $fitness = $this->calculateFitness($population, $availabilities);
    //         $population = $this->selection($population, $fitness);
    //         $population = $this->crossover($population);
    //         $population = $this->mutation($population);
    //     }

    //     $fitness = $this->calculateFitness($population, $availabilities);
    //     $fitnessValues = $fitness; // Simpan fitness
    //     $totalFitness = array_sum($fitness);
    //     $selectionProbabilities = $this->calculateSelectionProbabilities($fitness, $totalFitness);
    //     $cumulativeProbabilities = $this->calculateCumulativeProbabilities($selectionProbabilities);

    //     $selection = $this->selection($population, $fitness);
    //     $individuSelect = $selection['selected'];
    //     $randomSelect = $selection['randomSel'];
    //     // $populationBeforeCrossover = $population;
    //     // $populationAfterCrossover = $this->crossover($population);

    //     // $populationBeforeMutation = $populationAfterCrossover;
    //     // $populationAfterMutation = $this->mutation($populationAfterCrossover);
    //     $randSelection = rand(0, 100) / 100;  // Nilai acak untuk seleksi
    //     $randCrossover = rand(1, 8); // Titik crossover
    //     $randMutation = rand(0, 100) / 100;  // Nilai acak untuk mutasi

    //     // Ambil individu terbaik
    //     $bestSchedule = $this->getBestIndividual($population, $availabilities);
    //     // Fitness Terbaik
    //     $bestFitness = $this->calculateFitness([$bestSchedule], $availabilities)[0];

    //     // dd([
    //     //     'schedule' => $bestSchedule,
    //     //     'fitness' => $bestFitness,
    //     //     'initialPopulation' => $initialPopulation,
    //     //     'fitnessValues' => $fitnessValues,
    //     //     'selectionProbabilities' => $selectionProbabilities,
    //     //     'cumulativeProbabilities' => $cumulativeProbabilities,
    //     //     'randomSelection'=>$randomSelect,
    //     //     'individuSelection'=>$individuSelect,
    //     // ]);

    //     // Tampilkan hasil di view
    //     return view('coba', [
    //         'schedule' => $bestSchedule,
    //         'assistants' => $assistants,
    //         'classSchedules' => $classSchedules,
    //         'fitness' => $bestFitness,
    //         'initialPopulation' => $initialPopulation,
    //         'fitnessValues' => $fitnessValues,
    //         'selectionProbabilities' => $selectionProbabilities,
    //         'cumulativeProbabilities' => $cumulativeProbabilities,
    //         'randomSelection' => $randomSelect,
    //         'individuSelection' => $individuSelect,
    //         'randSelection' => $randSelection,
    //         'randCrossover' => $randCrossover,
    //         'randMutation' => $randMutation,
    //         // 'populationBeforeCrossover' => $populationBeforeCrossover,
    //         // 'populationAfterCrossover' => $populationAfterCrossover,
    //         // 'populationBeforeMutation' => $populationBeforeMutation,
    //         // 'populationAfterMutation' => $populationAfterMutation,
    //     ]);
    // }
    public function jadwalAsisten()
    {
        // Ambil semua asisten dan kelas
        $assistants = Asisten::all();
        $classSchedules = Kelasprak::all();
        $availabilities = Ketersediaan::with('asisten', 'kelasprak')->get();

        // Inisialisasi populasi
        $population = $this->initializePopulation($assistants, $classSchedules);
        $initialPopulation = $population; // Simpan hasil inisialisasi

        // Array untuk menyimpan data setiap generasi
        $generationsData = [];

        // Jalankan algoritma genetika
        for ($i = 0; $i < $this->generations; $i++) {
            // Fitness
            $fitness = $this->calculateFitness($population, $availabilities);

            // Seleksi
            $selection = $this->selection($population, $fitness);

            // Crossover
            $crossoverPopulation = $this->crossover($selection['selected']);

            // Mutasi
            $mutatedPopulation = $this->mutation($crossoverPopulation);

            // Simpan data proses generasi saat ini
            $generationsData[] = [
                'generation' => $i + 1,
                'fitness' => $fitness,
                'selected_population' => $selection['selected'],
                'random_selection' => $selection['randomSel'],
                'selection_probabilities' => $selection['selectionProbabilities'],
                'cumulative_probabilities' => $selection['cumulativeProbabilities'],
                'crossover_population' => $crossoverPopulation,
                'mutated_population' => $mutatedPopulation,
            ];

            // Update populasi
            $population = $mutatedPopulation;
        }

        // Ambil individu terbaik setelah seluruh generasi
        $bestSchedule = $this->getBestIndividual($population, $availabilities);
        $bestFitness = $this->calculateFitness([$bestSchedule], $availabilities)[0];

        // dd([
        //     'schedule' => $bestSchedule,
        //     'assistants' => $assistants,
        //     'classSchedules' => $classSchedules,
        //     'fitness' => $bestFitness,
        //     'initialPopulation' => $initialPopulation,
        //     'generationsData' => $generationsData,
        // ]);

        // Tampilkan hasil di view
        return view('jadwal', [
            'schedule' => $bestSchedule,
            'assistants' => $assistants,
            'classSchedules' => $classSchedules,
            'fitness' => $bestFitness,
            'initialPopulation' => $initialPopulation,
            'generationsData' => $generationsData, // Data semua generasi
        ]);
    }

    public function __construct()
    {
        // Ambil data konfigurasi pertama (pastikan hanya satu baris di tabel konfigurasi)
        $config = Konfigurasi::first();

        // Inisialisasi nilai properti dari data tabel
        $this->populationSize = $config->popsize;
        $this->generations = $config->generasi;
        $this->crossoverRate = $config->crossrate;
        $this->mutationRate = $config->mutrate;
    }

    public function scheduleAssistants()
    {
        // Ambil semua asisten dan kelas
        $assistants = Asisten::all();
        $classSchedules = Kelasprak::all();
        $availabilities = Ketersediaan::with('asisten', 'kelasprak')->get();

        // Inisialisasi populasi
        $population = $this->initializePopulation($assistants, $classSchedules);
        $initialPopulation = $population; // Simpan hasil inisialisasi

        // Array untuk menyimpan data iterasi
        $iterations = [];

        // Jalankan algoritma genetika
        for ($i = 0; $i < $this->generations; $i++) {
            // Fitness
            $fitness = $this->calculateFitness($population, $availabilities);

            // Seleksi
            $selectPopulation = $this->selection($population, $fitness);

            // Crossover
            $crossPopulation = $this->crossover($selectPopulation);

            // Mutasi
            $mutPopulation = $this->mutation($crossPopulation);

            // dd($population);
            $population = $mutPopulation;

            // Simpan data iterasi
            $iterations[] = [
                'generation' => $i + 1,
                'initialPopulation' => $population, // Tetap sebagai array
                'fitness' => $fitness,              // Tetap sebagai array
                'selectPopulation' => $selectPopulation, // Tetap sebagai array
                'crossPopulation' => $crossPopulation,   // Tetap sebagai array
                'mutPopulation' => $mutPopulation,       // Tetap sebagai array
            ];
        }

        // Ambil individu terbaik
        $bestSchedule = $this->getBestIndividual($population, $availabilities);
        // Fitness Terbaik
        $bestFitness = $this->calculateFitness([$bestSchedule], $availabilities)[0];

        Log::debug("Best Schedule: ", $bestSchedule);

        dd($iterations);

        // Tampilkan hasil di view
        return view('coba', [
            'schedule' => $bestSchedule,
            'assistants' => $assistants,
            'classSchedules' => $classSchedules,
            'fitness' => $bestFitness,
            'initialPopulation' => $initialPopulation,
            'iterations' => $iterations
        ]);
    }

    private function initializePopulation($assistants, $classSchedules)
    {
        $population = [];
        $assistantIds = $assistants->pluck('id_asisten')->toArray();
        $totalMeetings = 9; // Total pertemuan yang diinginkan
        $totalClasses = count($classSchedules); // Total kelas yang tersedia
        $meetingsPerClass = ceil($totalMeetings / $totalClasses); // Menghitung berapa banyak pertemuan per kelas

        // Buat individu pertama secara normal
        $individual = [];

        for ($classIndex = 0; $classIndex < $totalClasses; $classIndex++) {
            for ($meetingIndex = 0; $meetingIndex < $meetingsPerClass; $meetingIndex++) {
                // Tentukan indeks pertemuan
                $meetingNumber = $classIndex * $meetingsPerClass + $meetingIndex;

                // Pastikan tidak melampaui total pertemuan
                if ($meetingNumber >= $totalMeetings) break;

                // Ambil kelas dari classSchedules
                $class = $classSchedules[$classIndex];

                // Tentukan pengajar dan pendamping
                $pengajar = $assistantIds[array_rand($assistantIds)];
                do {
                    $pendamping = $assistantIds[array_rand($assistantIds)];
                } while ($pendamping === $pengajar);

                // Menyimpan pengajar dan pendamping untuk pertemuan ini dalam struktur array
                $individual[$meetingNumber] = [
                    'pengajar' => $pengajar,
                    'pendamping' => $pendamping,
                    'hari' => $class->hari, // Mengambil dari data kelasprak
                    'sesi' => $class->sesi  // Mengambil dari data kelasprak
                ];
            }
        }

        // Tambahkan individu pertama ke populasi
        $population[] = $individual;


        for ($i = 1; $i < $this->populationSize; $i++) {
            // Buat salinan dari individu pertama
            $shuffledIndividual = $individual;

            // Ambil seluruh pasangan pengajar dan pendamping sebagai array
            $pairs = [];
            foreach ($shuffledIndividual as $meetingNumber => $roles) {
                $pairs[$meetingNumber] = [
                    'pengajar' => $roles['pengajar'],
                    'pendamping' => $roles['pendamping']
                ];
            }

            // Acak urutan pasangan pengajar dan pendamping
            $keys = array_keys($pairs);
            shuffle($keys);  // Mengacak urutan indeks untuk pasangan

            // Buat individu baru dengan pasangan yang diacak, tetapi `hari` dan `sesi` tetap
            $newIndividual = [];
            foreach ($keys as $index => $key) {
                $meetingNumber = array_keys($shuffledIndividual)[$index];
                $newIndividual[$meetingNumber] = [
                    'pengajar' => $pairs[$key]['pengajar'],
                    'pendamping' => $pairs[$key]['pendamping'],
                    'hari' => $shuffledIndividual[$meetingNumber]['hari'], // tetap hari asli
                    'sesi' => $shuffledIndividual[$meetingNumber]['sesi']  // tetap sesi asli
                ];
            }

            // Tambahkan individu yang telah diacak ke populasi
            $population[] = $newIndividual;
        }

        // dd([$population]);
        return $population;
    }

    private function calculateFitness($population, $availabilities)
    {
        $fitness = [];
        foreach ($population as $individual) {
            $fit = 0;
            foreach ($individual as $meetingId => $roles) {
                $pengajar = $roles['pengajar'];
                $pendamping = $roles['pendamping'];
                $hari = $roles['hari'];
                $sesi = $roles['sesi'];

                // Dapatkan id_kelasprak berdasarkan hari dan sesi
                // $classId = $this=>$classSchedules->firstWhere(['hari' => $hari, 'sesi' => $sesi])->id_kelasprak;

                // Mengecek ketersediaan pengajar
                if (!$availabilities->contains(function ($availability) use ($pengajar, $meetingId) {
                    return $availability->id_asisten === $pengajar &&
                        $availability->id_kelasprak === $meetingId;
                })) {
                    $fit++;
                }

                // Mengecek ketersediaan pendamping
                // if (!$availabilities->contains(function ($availability) use ($pendamping, $meetingId) {
                //     return $availability->id_asisten === $pendamping && 
                //            $availability->id_kelasprak === $meetingId;
                // })) {
                //     $fit++;
                // }
            }

            $fitnessValue = 1 / (1 + $fit);
            // dd(['fit' => $fit, 'fitnessValue' => $fitnessValue]);
            $fitness[] = $fitnessValue;
        }
        // dd([$fitness]);
        return $fitness;
    }

    private function calculateSelectionProbabilities($fitness, $totalFitness)
    {
        $totalFitness = array_sum($fitness);
        $selectionProbabilities = array_map(function ($fitnessValue) use ($totalFitness) {
            return $fitnessValue / $totalFitness;
        }, $fitness);

        // dd($selectionProbabilities); // Menampilkan hasil perhitungan probabilitas dan menghentikan eksekusi

        return $selectionProbabilities;
    }

    private function calculateCumulativeProbabilities($selectionProbabilities)
    {
        $cumulativeProbabilities = [];
        $cumulativeSum = 0;
        foreach ($selectionProbabilities as $prob) {
            $cumulativeSum += $prob;
            $cumulativeProbabilities[] = $cumulativeSum;
        }
        // dd([$cumulativeProbabilities]);
        return $cumulativeProbabilities;
    }

    private function selection($population, $fitness)
    {
        $totalFitness = array_sum($fitness);

        // Tangani kasus totalFitness = 0
        if ($totalFitness === 0) {
            return $population; // Kembalikan populasi tanpa perubahan
        }

        // Menghitung probabilitas seleksi masing-masing individu
        $selectionProbabilities = $this->calculateSelectionProbabilities($fitness, $totalFitness);

        // Menghitung probabilitas kumulatif
        $cumulativeProbabilities = $this->calculateCumulativeProbabilities($selectionProbabilities);

        $selected = [];
        $randValues = [];
        for ($i = 0; $i < $this->populationSize; $i++) {

            $rand = rand(0, 100) / 100; // Menghasilkan angka acak antara 0 dan 1
            $randValues[] = $rand;

            // Memilih individu berdasarkan interval kumulatif
            foreach ($cumulativeProbabilities as $index => $cumulativeProb) {
                if ($rand <= $cumulativeProb) {
                    $selected[] = $population[$index];
                    break; // Pilih individu yang sesuai dengan angka acak
                }
            }
        }

        // dd([
        //     'selected' => $selected,
        //     'randomSel' => $randValues,
        //     'selectionProbabilities' => $selectionProbabilities,
        //     'cumulativeProbabilities' => $cumulativeProbabilities,
        // ]);
        return [
            'selected' => $selected,
            'randomSel' => $randValues,
            'selectionProbabilities' => $selectionProbabilities,
            'cumulativeProbabilities' => $cumulativeProbabilities,
        ];
    }

    //     private function crossover($population)
    // {
    //     $newPopulation = [];
    //     for ($i = 0; $i < count($population); $i += 2) {
    //         if (isset($population[$i + 1])) {
    //             $crossPoint = rand(1, count($population[$i]) - 1); 
    //             Log::info("Crossover Point", ['crossPoint' => $crossPoint]);

    //             $child1 = [];
    //             $child2 = [];

    //             foreach ($population[$i] as $meetingId => $roles) {
    //                 Log::info("Processing Meeting", ['meetingId' => $meetingId, 'roles' => $roles]);

    //                 if ($meetingId <= $crossPoint) {
    //                     $child1[$meetingId] = $population[$i][$meetingId];
    //                     $child2[$meetingId] = $population[$i + 1][$meetingId];
    //                 } else {
    //                     $child1[$meetingId] = $population[$i + 1][$meetingId];
    //                     $child2[$meetingId] = $population[$i][$meetingId];
    //                 }

    //                 $child1[$meetingId]['hari'] = $population[$i][$meetingId]['hari'];
    //                 $child1[$meetingId]['sesi'] = $population[$i][$meetingId]['sesi'];
    //                 $child2[$meetingId]['hari'] = $population[$i + 1][$meetingId]['hari'];
    //                 $child2[$meetingId]['sesi'] = $population[$i + 1][$meetingId]['sesi'];
    //             }

    //             Log::info("Generated Child1", ['child1' => $child1]);
    //             Log::info("Generated Child2", ['child2' => $child2]);

    //             $newPopulation[] = $child1;
    //             $newPopulation[] = $child2;
    //         } else {
    //             Log::info("Adding Single Parent", ['parent' => $population[$i]]);
    //             $newPopulation[] = $population[$i];
    //         }
    //     }

    //     Log::info("New Population", ['new_population' => $newPopulation]);

    //     return $newPopulation;
    // }

    // private $crossoverRate = 0.5;
    public function crossover($population)
    {
        $newPopulation = [];
        $selectedForCrossover = $population['selected']; // Mendapatkan individu terpilih dari population

        // Loop untuk setiap pasangan individu
        for ($i = 0; $i < count($selectedForCrossover); $i += 2) {
            // Cek jika pasangan individu ada (jika ganjil, individu terakhir tidak memiliki pasangan)
            if (isset($selectedForCrossover[$i + 1])) {
                $parent1Index = $i;   // Indeks individu pertama
                $parent2Index = $i + 1; // Indeks individu kedua

                // Pastikan parent1 dan parent2 adalah array yang valid
                $parent1 = $selectedForCrossover[$parent1Index];
                $parent2 = $selectedForCrossover[$parent2Index];

                // Tentukan titik crossover dan lakukan crossover
                $crossPoint = rand(1, 8); // Tentukan titik crossover (misalnya 1-8)

                $child1 = [];
                $child2 = [];

                foreach ($parent1 as $meetingId => $roles) {
                    if ($meetingId <= $crossPoint) {
                        $child1[$meetingId] = $parent1[$meetingId];
                        $child2[$meetingId] = $parent2[$meetingId];
                    } else {
                        $child1[$meetingId] = $parent2[$meetingId];
                        $child2[$meetingId] = $parent1[$meetingId];
                    }

                    // Salin hari dan sesi dari parent
                    $child1[$meetingId]['hari'] = $parent1[$meetingId]['hari'];
                    $child1[$meetingId]['sesi'] = $parent1[$meetingId]['sesi'];
                    $child2[$meetingId]['hari'] = $parent2[$meetingId]['hari'];
                    $child2[$meetingId]['sesi'] = $parent2[$meetingId]['sesi'];
                }

                // Simpan hasil crossover
                $newPopulation[] = $child1;
                $newPopulation[] = $child2;
            } else {
                // Jika hanya ada satu parent yang tersisa, salin individu tersebut
                if (isset($selectedForCrossover[$i])) {
                    $newPopulation[] = $selectedForCrossover[$i];
                }
            }
        }

        // Debugging untuk memastikan newPopulation terisi dengan benar
        // dd($newPopulation);

        return $newPopulation;
    }


    // public function crossover($selectedPopulation)
    // {
    //     $newPopulation = [];

    //     // Loop untuk setiap pasangan individu
    //     for ($i = 0; $i < count($selectedPopulation); $i += 2) {
    //         // Cek jika pasangan individu ada (jika ganjil, individu terakhir tidak memiliki pasangan)
    //         if (isset($selectedPopulation[$i + 1])) {
    //             $parent1 = $selectedPopulation[$i];
    //             $parent2 = $selectedPopulation[$i + 1];

    //             // Tentukan titik crossover
    //             $crossPoint = rand(1, count($parent1) - 1);

    //             $child1 = [];
    //             $child2 = [];

    //             foreach ($parent1 as $meetingId => $roles) {
    //                 if ($meetingId <= $crossPoint) {
    //                     $child1[$meetingId] = $parent1[$meetingId];
    //                     $child2[$meetingId] = $parent2[$meetingId];
    //                 } else {
    //                     $child1[$meetingId] = $parent2[$meetingId];
    //                     $child2[$meetingId] = $parent1[$meetingId];
    //                 }

    //                 // Pastikan setiap `child` tetap mempertahankan hari dan sesi
    //                 $child1[$meetingId]['hari'] = $parent1[$meetingId]['hari'];
    //                 $child1[$meetingId]['sesi'] = $parent1[$meetingId]['sesi'];
    //                 $child2[$meetingId]['hari'] = $parent2[$meetingId]['hari'];
    //                 $child2[$meetingId]['sesi'] = $parent2[$meetingId]['sesi'];
    //             }

    //             // Simpan hasil crossover
    //             $newPopulation[] = $child1;
    //             $newPopulation[] = $child2;
    //         } else {
    //             // Jika hanya ada satu individu yang tersisa, tambahkan ke populasi baru tanpa perubahan
    //             $newPopulation[] = $selectedPopulation[$i];
    //         }
    //     }

    //     return $newPopulation;
    // }


    private function mutation($population)
    {
        foreach ($population as &$individual) {
            // Loop untuk setiap individu
            foreach ($individual as $meetingId => &$roles) {
                // Generate angka acak dan cek dengan mutation rate
                if (rand(0, 100) / 100 < $this->mutationRate) {
                    // Jika mutation terjadi, pilih dua index acak untuk di swap
                    $meetingIds = array_keys($individual);  // Daftar meetingId dalam individu
                    $randomIndices = array_rand($meetingIds, 2);  // Pilih 2 index acak

                    // Swap pengajar dan pendamping dari dua index tersebut
                    $tempPengajar = $individual[$meetingIds[$randomIndices[0]]]['pengajar'];
                    $tempPendamping = $individual[$meetingIds[$randomIndices[0]]]['pendamping'];

                    $individual[$meetingIds[$randomIndices[0]]]['pengajar'] = $individual[$meetingIds[$randomIndices[1]]]['pengajar'];
                    $individual[$meetingIds[$randomIndices[0]]]['pendamping'] = $individual[$meetingIds[$randomIndices[1]]]['pendamping'];

                    $individual[$meetingIds[$randomIndices[1]]]['pengajar'] = $tempPengajar;
                    $individual[$meetingIds[$randomIndices[1]]]['pendamping'] = $tempPendamping;
                }
            }
        }
        return $population;
    }

    private function getBestIndividual($population, $availabilities)
    {
        $bestFitness = 0;
        $bestIndividual = null;
        foreach ($population as $individual) {

            $fitness = $this->calculateFitness([$individual], $availabilities)[0];
            Log::info('Fitness:', ['individual' => $individual, 'fitness' => $fitness]);

            if ($fitness > $bestFitness) {
                $bestFitness = $fitness;
                $bestIndividual = $individual;
            }
        }
        return $bestIndividual;
    }
}
