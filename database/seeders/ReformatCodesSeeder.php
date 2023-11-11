<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReformatCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $alternatives = DB::table('alternatives')->get();

        foreach ($alternatives as $alternative) {
            $code = $alternative->code;
            $code = substr($code, 1);
            $code = (int) $code;
            $code = 'A' . $code;
            DB::table('alternatives')->where('code', $alternative->code)->update(['code' => $code]);
            DB::table('scores')->where('alternative_code', $alternative->code)->update(['alternative_code' => $code]);
        }

        $criterias = DB::table('criterias')->get();

        foreach ($criterias as $criteria) {
            $code = $criteria->code;
            $code = substr($code, 1);
            $code = (int) $code;
            $code = 'C' . $code;
            DB::table('criterias')->where('code', $criteria->code)->update(['code' => $code]);
            DB::table('scores')->where('criteria_code', $criteria->code)->update(['criteria_code' => $code]);
        }

        DB::commit();
    }
}
