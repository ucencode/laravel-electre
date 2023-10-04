<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class, 'criteria_code', 'code');
    }

    public function getGeneratedCode()
    {
        if (!$this->latest()->first()) {
            // jika belum ada data, maka set code menjadi E001
            $code = 'A001';
        } else {
            // ambil latest code, lalu tambahkan 1
            $latestCode = $this->latest()->first()->code;
            $latestCode = substr($latestCode, 1);
            $latestCode = $latestCode + 1;
            $code = 'A' . str_pad($latestCode, 3, '0', STR_PAD_LEFT);
        }
        return $code;
    }
}
