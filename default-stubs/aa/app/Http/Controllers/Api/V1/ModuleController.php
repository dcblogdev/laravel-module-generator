<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\{Module}\Create{Model}Request;
use App\Http\Requests\V1\{Module}\Update{Model}Request;
use App\Http\Resources\V1\{Module}Resource;
use App\Models\{Model};
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class {Module}Controller extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->query('perPage', $this->perPage);

        ${module} = QueryBuilder::for({Model}::class)
            ->allowedFilters(['name', 'email'])
            ->defaultSort('name')
            ->allowedSorts('name')
            ->paginate($perPage);

        return {Module}Resource::collection(${module});
    }

    public function store(Create{Model}Request $request): {Module}Resource
    {
        ${model} = {Model}::create([
            'name' => $request->input('name'),
        ]);

        return new {Module}Resource(${model});
    }

    public function show({Model} ${model}): {Module}Resource
    {
        return new {Module}Resource(${model});
    }

    public function update(Update{Model}Request $request, {Model} ${model}): {Module}Resource
    {
        ${model}->update($request->all());

        return new {Module}Resource(${model});
    }

    public function destroy({Model} ${model}): Response
    {
        ${model}->delete();

        return response(null, 204);
    }
}
