<?php

namespace App\Http\Controllers;

use App\Models\Lov;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class LovController extends Controller
{
    public function index(Request $request)
    {
        return QueryBuilder::for(Lov::class)
        ->allowedFilters(['label', 'category'])
        ->paginate(1)
        ->appends(request()->query());
    
    }

    public function store(Request $request)
    {
        //
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
