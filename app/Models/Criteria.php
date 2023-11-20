<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'weight',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class, 'criteria_code', 'code');
    }

    public function getGeneratedCode()
    {
        if (!$this->latest()->first()) {
            // jika belum ada data, maka set code menjadi C1
            $code = 'C1';
        } else {
            // ambil latest code, lalu tambahkan 1
            $latestCode = Criteria::orderBy('code', 'desc')->first()->code;
            $latestCode = substr($latestCode, 1);
            $latestCode = $latestCode + 1;
            $code = 'C' . $latestCode;
        }
        return $code;
    }
}
