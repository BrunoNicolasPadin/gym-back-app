<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Set extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'repetitions',
        'rir',
        'weight',
    ];

    function dayExercise() : BelongsTo {
        return $this->belongsTo(DayExercise::class);
    }
}
