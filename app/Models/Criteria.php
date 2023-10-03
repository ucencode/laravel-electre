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

    public function getGeneratedCode()
    {
        if (!$this->latest()->first()) {
            // jika belum ada data, maka set code menjadi C001
            $code = 'C001';
        } else {
            // ambil latest code, lalu tambahkan 1
            $latestCode = $this->latest()->first()->code;
            $latestCode = substr($latestCode, 1);
            $latestCode = $latestCode + 1;
            $code = 'C' . str_pad($latestCode, 3, '0', STR_PAD_LEFT);
        }
        return $code;
    }
}