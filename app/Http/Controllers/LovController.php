<?php

namespace App\Http\Controllers;

use App\Http\Requests\LovStoreRequest;
use App\Models\Lov;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class LovController extends Controller
{
    public function index(Request $request)
    {
        return QueryBuilder::for(Lov::class)
        ->allowedFilters(['label', 'category'])
        ->paginate(10)
        ->appends(request()->query());
    
    }

    public function store(LovStoreRequest $request)
    {
        Lov::create($request->validated());

        return response('', Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
