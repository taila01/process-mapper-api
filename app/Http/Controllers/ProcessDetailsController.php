<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProcessDetailsResource;
use App\Http\Requests\Process\ProcessDetailsStoreRequest;

class ProcessDetailsController extends Controller
{
    /**
     * Cria ou atualiza os detalhes de um processo
     */
    public function store(
        ProcessDetailsStoreRequest $request,
        Process $process
    ): JsonResponse {
        $details = $process->details()->updateOrCreate(
            ['process_id' => $process->id],
            $request->validated()
        );

        return response()->json(
            new ProcessDetailsResource($details),
            200
        );
    }
}
