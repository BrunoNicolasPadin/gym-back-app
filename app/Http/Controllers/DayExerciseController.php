<?php

namespace App\Http\Controllers;

use App\Models\DayExercise;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\DayExerciseStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class DayExerciseController extends Controller
{
    public function index(string $workout_id, string $day_id)
    {
        //Need improve query, call relationship to search inside exercises
        return QueryBuilder::for(DayExercise::class)
        ->where('day_id', $day_id)
        ->orderBy('order', 'ASC')
        ->paginate(30)
        ->appends(request()->query());
    }

    public function store(DayExerciseStoreRequest $request, string $workout_id, string $day_id)
    {
        $dayExercise = new DayExercise();
        $dayExercise->day_id = $day_id;
        $dayExercise->exercise_id = $request->exercise_id;
        $dayExercise->order = $request->order;
        $dayExercise->save();

        //Improve code to order correctly

        return response('', Response::HTTP_CREATED);
    }

    public function show(string $workout_id, string $day_id, string $id)
    {
        //
    }

    public function update(DayExerciseStoreRequest $request, string $workout_id, string $day_id, string $id)
    {
        $dayExercise = DayExercise::findOrFail($id);
        $dayExercise->exercise_id = $request->exercise_id;
        $dayExercise->save();

        return response('', Response::HTTP_OK);
    }

    public function destroy(string $workout_id, string $day_id, string $id)
    {
        DayExercise::destroy($id);
        return response('', Response::HTTP_OK);
    }
}
