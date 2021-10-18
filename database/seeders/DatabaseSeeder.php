<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Services\CsvReader;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->csvToArray();

        for ($i = 1, $length = count($data); $i < $length; $i++) {
            $country = $data[$i];

            DB::table('countries')->insert([
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
                'name' => $country[0],
                'code' => $country[1],
                'yearOfPopulation' => $country[2],
                'population' => $country[3],
            ]);
        }
    }

    public function csvToArray(): array
    {
        $result = [];
        $rowNumber = 1;
        if (($handle = fopen("./population.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $rowNumber++;
                $row = [];
                for ($c=0; $c < $num; $c++) {
                    $row[$c] = $data[$c];
                }
                $result[] = $row;
            }
            fclose($handle);
        }
        return $result;
    }
}
