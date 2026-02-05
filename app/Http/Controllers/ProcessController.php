<?php

namespace App\Http\Controllers;

use App\Http\Requests\Process\ProcessStoreRequest;
use App\Http\Requests\Process\ProcessUpdateRequest;
use App\Http\Resources\ProcessResource;
use App\Http\Resources\ApiResponseResource;
use App\Models\Process;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $per_page = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $sector_id = $request->input('sector_id');

        $query = Process::with(['sector', 'details'])
            ->where('name', 'like', '%' . $search . '%');

        if ($sector_id) {
            $query->where('sector_id', $sector_id);
        }

        if ($request->has('roots_only')) {
            $query->whereNull('parent_id');
        }

        $processes = $query->paginate($per_page);

        return response()->json(new ApiResponseResource(ProcessResource::collection($processes)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProcessStoreRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();

            $process = Process::create([
                'name'        => $validatedData['name'],
                'description' => $validatedData['description'] ?? null,
                'sector_id'   => $validatedData['sector_id'],
                'parent_id'   => $validatedData['parent_id'] ?? null,
                'type'        => $validatedData['type'],
                'status'      => $validatedData['status'] ?? 'active',
            ]);

            if (isset($validatedData['details'])) {
                $process->details()->create([
                    'tools'         => $validatedData['details']['tools'],
                    'responsibles'  => $validatedData['details']['responsibles'],
                    'documentation' => $validatedData['details']['documentation'],
                ]);
            }

            DB::commit();
            return response()->json(new ProcessResource($process->load('details')), 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar processo: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao criar processo'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Process $process): JsonResponse
    {
        try {
            return response()->json(new ProcessResource($process->load(['details', 'children', 'sector'])), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Processo não encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProcessUpdateRequest $request, Process $process): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $process->update([
                'name'        => $validated['name'] ?? $process->name,
                'description' => $validated['description'] ?? $process->description,
                'sector_id'   => $validated['sector_id'] ?? $process->sector_id,
                'parent_id'   => $validated['parent_id'] ?? $process->parent_id,
                'type'        => $validated['type'] ?? $process->type,
                'status'      => $validated['status'] ?? $process->status,
            ]);

            if (isset($validated['details'])) {
                $process->details()->updateOrCreate(
                    ['process_id' => $process->id],
                    $validated['details']
                );
            }

            DB::commit();
            return response()->json(new ProcessResource($process->load('details')), 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar processo: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao atualizar processo'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Process $process): JsonResponse
    {
        try {
            $process->delete();
            return response()->json(['message' => 'Processo e seus subprocessos excluídos'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Falha ao excluir processo'], 500);
        }
    }
}
