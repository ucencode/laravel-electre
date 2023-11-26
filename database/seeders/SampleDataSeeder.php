<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alternatives')->truncate();
        DB::table('criterias')->truncate();
        DB::table('scores')->truncate();

        $alternatives = [
            [
                'code' => 'A1',
                'name' => 'Workshop Service',
            ], [
                'code' => 'A2',
                'name' => 'Pick Up Service',
            ], [
                'code' => 'A3',
                'name' => 'Emergency Service',
            ], [
                'code' => 'A4',
                'name' => 'Home Service',
            ], [
                'code' => 'A5',
                'name' => 'Variasi',
            ], [
                'code' => 'A6',
                'name' => 'B2B',
            ]
        ];

        $criterias = [
            [
                'code' => 'C1',
                'name' => 'Jumlah Permintaan',
                'weight' => 3,
            ], [
                'code' => 'C2',
                'name' => 'Rata-rata pendapatan per Pengerjaan',
                'weight' => 2.5,
            ], [
                'code' => 'C3',
                'name' => 'Tools',
                'weight' => 2,
            ], [
                'code' => 'C4',
                'name' => 'Mekanik',
                'weight' => 1,
            ], [
                'code' => 'C5',
                'name' => 'Waktu Pengerjaan',
                'weight' => 1.5,
            ]
        ];

        DB::table('alternatives')->insert($alternatives);
        DB::table('criterias')->insert($criterias);

        foreach ($alternatives as $alternative) {
            foreach ($criterias as $criteria) {
                DB::table('scores')->insert([
                    'alternative_code' => $alternative['code'],
                    'criteria_code' => $criteria['code'],
                    'value' => (rand(1, 50) / 10),
                ]);
            }
        }

    }
}
