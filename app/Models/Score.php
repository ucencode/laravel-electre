<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_code',
        'alternative_code',
        'value',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_code', 'code');
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'alternative_code', 'code');
    }
}
