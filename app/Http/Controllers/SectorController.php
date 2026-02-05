<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Http\Resources\SectorResource;
use App\Http\Resources\ApiResponseResource;
use App\Http\Requests\Sector\SectorStoreRequest;
use App\Http\Requests\Sector\SectorUpdateRequest;
use Illuminate\Http\JsonResponse;

class SectorController extends Controller
{
    public function index(): JsonResponse
    {
        $sectors = Sector::all();
        return response()->json(new ApiResponseResource(SectorResource::collection($sectors)));
    }

    public function store(SectorStoreRequest $request): JsonResponse
    {
        $sector = Sector::create($request->validated());

        return response()->json(
            new ApiResponseResource(new SectorResource($sector)),
            201
        );
    }

    public function update(SectorUpdateRequest $request, Sector $sector): JsonResponse
    {
        $sector->update($request->validated());

        return response()->json(
            new ApiResponseResource(new SectorResource($sector)),
            200
        );
    }

    public function destroy(Sector $sector): JsonResponse
    {
        $sector->delete();
        return response()->json(['message' => 'Setor excluído com sucesso'], 200);
    }
}
