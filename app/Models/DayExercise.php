<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DayExercise extends Model
{
    use HasFactory;

    protected $table = 'days_exercises';

    function day() : BelongsTo {
        return $this->belongsTo(Day::class);
    }

    function exercise() : BelongsTo {
        return $this->belongsTo(Exercise::class);
    }
}
