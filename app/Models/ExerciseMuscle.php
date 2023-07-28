<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseMuscle extends Model
{
    use HasFactory;

    protected $table = 'exercises_muscles';

    function exercise() : BelongsTo {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }

    function muscle() : BelongsTo {
        return $this->belongsTo(Lov::class, 'muscle_id');
    }
}
