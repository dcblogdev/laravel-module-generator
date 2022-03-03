<?php

namespace Modules\{Module}\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\{Module}\Models\{Model};

class {Module}Controller extends Controller
{
    public function index()
    {
        ${module} = {Model}::get();

        return view('{module}::index', compact('{module}'));
    }

    public function create()
    {
        return view('{module}::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        {Model}::create([
            'name' => $request->input('name')
        ]);

        return redirect(route('app.{module}.index'));
    }

    public function edit($id)
    {
        ${model} = {Model}::findOrFail($id);

        return view('{module}::edit', compact('{model}'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        {Model}::findOrFail($id)->update([
            'name' => $request->input('name')
        ]);

        return redirect(route('app.{module}.index'));
    }

    public function destroy($id)
    {
        {Model}::findOrFail($id)->delete();

        return redirect(route('app.{module}.index'));
    }
}
