<?php

namespace tests;

use App\Http\Controllers\Controller;
use Modules\Weby\App\Http\Requests\Api\V1\WebyRequest;
use Modules\Weby\App\Http\Resources\Api\V1\WebyCollection;
use Modules\Weby\App\Http\Resources\Api\V1\WebyResource;
use Modules\Weby\App\Models\Weby;
use Symfony\Component\HttpFoundation\Response;

class WebyController extends Controller
{
    public function index(): WebyCollection
    {
        $weby = Weby::paginate();

        return new WebyCollection($weby);
    }

    public function store(WebyRequest $request): WebyResource
    {
        $weby = Weby::create($request->validated());

        return new WebyResource($book);
    }

    public function show(Weby $Weby): WebyResource
    {
        return new WebyResource($Weby);
    }

    public function update(WebyRequest $request, Weby $weby): WebyResource
    {
        $weby->update($request->validated());

        return new WebyResource($weby);
    }

    public function destroy(Weby $weby): Response
    {
        $weby->delete();

        return response()->noContent();
    }
}
