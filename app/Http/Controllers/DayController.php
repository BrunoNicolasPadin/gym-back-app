<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\DayStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $workout_id)
    {
        return QueryBuilder::for(Day::class)
        ->where('workout_id', $workout_id)
        ->allowedFilters(['name'])
        ->orderBy('name', 'ASC')
        ->paginate(10)
        ->appends(request()->query());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DayStoreRequest $request, string $workout_id)
    {
        $day = new Day();
        $day->workout_id = $workout_id;
        $day->name = $request->name;
        $day->save();

        return response('', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $workout_id, string $id)
    {
        return Day::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DayStoreRequest $request, string $workout_id, string $id)
    {
        $day = Day::findOrFail($id);
        $day->name = $request->name;
        $day->save();

        return response('', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $workout_id, string $id)
    {
        Day::destroy($id);

        return response('', Response::HTTP_OK);
    }
}
