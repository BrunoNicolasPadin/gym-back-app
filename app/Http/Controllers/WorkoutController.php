<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\WorkoutStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QueryBuilder::for(Workout::class)
        ->allowedFilters(['name', 'weeks', 'start', 'end'])
        ->orderBy('start', 'DESC')
        ->paginate(10)
        ->appends(request()->query());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkoutStoreRequest $request)
    {
        Workout::create($request->validated());
        return response('', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Workout::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkoutStoreRequest $request, string $id)
    {
        Workout::where('id', $id)->update($request->validated());
        return response('', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Workout::where('id', $id)->delete();
        return response('', Response::HTTP_OK);
    }
}
