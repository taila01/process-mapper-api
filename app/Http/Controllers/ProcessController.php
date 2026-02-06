<?php

namespace App\Http\Controllers;

use App\Http\Requests\Process\ProcessStoreRequest;
use App\Http\Requests\Process\ProcessUpdateRequest;
use App\Http\Resources\ProcessResource;
use App\Models\Process;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $per_page = $request->input('per_page', 10);
        $search = $request->input('search', '');
        $sector_id = $request->input('sector_id');

        $query = Process::with(['sector', 'details', 'children'])
            ->where('name', 'like', '%' . $search . '%');

        if ($sector_id) {
            $query->where('sector_id', $sector_id);
        }

        if ($request->boolean('roots_only')) {
            $query->whereNull('parent_id');
        }

        $processes = $query->latest()->paginate($per_page);

        return response()->json([
            'data' => ProcessResource::collection($processes),
            'meta' => [
                'current_page' => $processes->currentPage(),
                'last_page' => $processes->lastPage(),
                'total' => $processes->total(),
                'per_page' => $processes->perPage(),
            ]
        ]);
    }

    public function store(ProcessStoreRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $process = Process::create([
                'name'        => $validated['name'],
                'description' => $validated['description'] ?? null,
                'sector_id'   => $validated['sector_id'],
                'parent_id'   => $validated['parent_id'] ?? null,
                'type'        => $validated['type'],
                'status'      => $validated['status'] ?? 'active',
            ]);

            if (isset($validated['details'])) {
                $process->details()->create($validated['details']);
            }

            DB::commit();

            return response()->json(new ProcessResource($process->load(['details', 'children', 'sector'])), 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => 'Erro ao criar processo'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
        $process = Process::with(['details', 'sector', 'children.children.children'])->findOrFail($id);
        
        return response()->json(new ProcessResource($process), 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Processo não encontrado'], 404);
    }
    }

    public function update(ProcessUpdateRequest $request, Process $process): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $process->update($validated);

            if (isset($validated['details'])) {
                $process->details()->updateOrCreate(
                    ['process_id' => $process->id],
                    $validated['details']
                );
            }

            DB::commit();
            return response()->json(new ProcessResource($process->load(['details', 'children'])), 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => 'Erro ao atualizar processo'], 500);
        }
    }

    public function destroy(Process $process): JsonResponse
    {
        try {
            $process->delete();
            return response()->json(['message' => 'Removido com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao remover'], 500);
        }
    }
}