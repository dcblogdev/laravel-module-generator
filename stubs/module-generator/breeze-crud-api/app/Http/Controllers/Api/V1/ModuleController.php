<?php

namespace Modules\{Module}\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Modules\{Module}\Http\Requests\Api\V1\{Model}Request;
use Modules\{Module}\Http\Resources\Api\V1\{Model}Collection;
use Modules\{Module}\Http\Resources\Api\V1\{Model}Resource;
use Modules\{Module}\Models\{Model};
use Symfony\Component\HttpFoundation\Response;

class {Module}Controller extends Controller
{
    public function index(): {Model}Collection
    {
        ${module} = {Model}::paginate();

        return new {Model}Collection(${module});
    }

    public function store({Model}Request $request): {Model}Resource
    {
        ${model} = {Model}::create($request->validated());

        return new {Model}Resource(${model});
    }

    public function show({Model} ${Model}): {Model}Resource
    {
        return new {Model}Resource(${Model});
    }

    public function update({Model}Request $request, {Model} ${model}): {Model}Resource
    {
        ${model}->update($request->validated());

        return new {Model}Resource(${model});
    }

    public function destroy({Model} ${model}): Response
    {
        ${model}->delete();

        return response()->noContent();
    }
}
