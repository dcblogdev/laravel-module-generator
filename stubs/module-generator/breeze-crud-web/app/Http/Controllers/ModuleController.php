<?php

namespace Modules\{Module}\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\{Module}\Http\Requests\{Model}Request;
use Modules\{Module}\Models\{Model};

class {Module}Controller extends Controller
{
    public function index(): View
    {
        ${module} = {Model}::paginate();

        return view('{module}::index', compact('{module}'));
    }

    public function create(): View
    {
        return view('{module}::create');
    }

    public function store({Model}Request $request): RedirectResponse
    {
        {Model}::create($request->validated());

        return to_route('{module}.index');
    }

    public function show({Model} ${model}): View
    {
        return view('{module}::show', compact('{model}'));
    }

    public function edit({Model} ${model}): View
    {
        return view('{module}::edit', compact('{model}'));
    }

    public function update({Model}Request $request, {Model} ${model}): RedirectResponse
    {
        ${model}->update($request->validated());

        return to_route('{module}.index');
    }

    public function destroy({Model} ${model}): RedirectResponse
    {
        ${model}->delete();

        return to_route('{module}.index');
    }
}
