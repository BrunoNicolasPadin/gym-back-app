<?php

namespace App\Http\Controllers;

use App\Http\Requests\LovStoreRequest;
use App\Models\Lov;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
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

    public function store(LovStoreRequest $request) : HttpResponse
    {
        Lov::create($request->validated());

        return response('', Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        return Lov::findOrFail($id);
    }

    public function update(LovStoreRequest $request, string $id) : HttpResponse
    {
        Lov::where('id', $id)->update($request->validated());

        return response('', Response::HTTP_OK);
    }

    public function destroy(string $id) : HttpResponse
    {
        Lov::destroy($id);

        return response('', Response::HTTP_OK);
    }
}
