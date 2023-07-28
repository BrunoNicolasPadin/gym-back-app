<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExerciseStoreRequest;
use App\Models\ExerciseMuscle;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        return QueryBuilder::for(Exercise::class)
        ->allowedFilters(['name'])
        ->paginate(10)
        ->appends(request()->query());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseStoreRequest $request) : HttpResponse
    {
        $exercise = new Exercise();
        $exercise->name = $request->name;
        $exercise->description = $request->description;
        $exercise->youtube = $request->youtube;

        if ($request->hasFile('image')) {
            $fileName = microtime().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('exercises', $fileName, 'public');

            $path = 'exercises/' . $fileName;
            $exercise->image = $path;
        }
        $exercise->save();
        
        $muscles = explode(',', $request->muscles);
        for ($i=0; $i < count($muscles); $i++) { 
            $exerciseMuscle = new ExerciseMuscle();
            $exerciseMuscle->exercise_id = $exercise->id;
            $exerciseMuscle->muscle_id = $muscles[$i];
            $exerciseMuscle->save();
        }
        return response('', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : Exercise
    {
        return Exercise::with('exerciseMuscle')->findOrFail($id);
    }

    public function update(ExerciseStoreRequest $request, string $id) : HttpResponse
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->name = $request->name;
        $exercise->description = $request->description == 'null' ? null: $request->description;
        $exercise->youtube = $request->youtube == 'null' ? null: $request->youtube;

        if ($request->hasFile('image')) {
            if ($exercise->image) {
                Storage::disk('public')->delete($exercise->image);
            }
            $fileName = microtime().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('exercises', $fileName, 'public');

            $path = 'exercises/' . $fileName;
            $exercise->image = $path;
        }
        $exercise->save();

        $muscles = explode(',', $request->muscles);

        //Eliminar las que no están
        ExerciseMuscle::where('exercise_id', $exercise->id)
            ->whereNotIn('muscle_id', $muscles)
            ->delete();

        for ($i=0; $i < count($muscles); $i++) {
            //Agregar las nuevas
            if (!ExerciseMuscle::where('muscle_id', $muscles[$i])->exists()) {
                $exerciseMuscle = new ExerciseMuscle();
                $exerciseMuscle->exercise_id = $exercise->id;
                $exerciseMuscle->muscle_id = $muscles[$i];
                $exerciseMuscle->save();
            }
        }

        return response('', Response::HTTP_OK);
    }

    public function destroy(string $id) : HttpResponse
    {
        $exercise = Exercise::findOrFail($id);
        if ($exercise->image) {
            Storage::disk('public')->delete($exercise->image);
        }
        $exercise->delete();

        return response('', Response::HTTP_OK);
    }
}
