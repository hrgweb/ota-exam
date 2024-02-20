<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function index()
    {
        try {
            $notes = NoteService::make()->fetch();
            return response()->json($notes, 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show(int $id)
    {
        try {
            $note = NoteService::find($id);
            return response()->json($note, 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store()
    {
        try {
            $validated = request()->validate([
                'note' => 'required',
                'description' => 'required'
            ]);

            $note = NoteService::make($validated)->save();
            return response()->json($note, 201);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(int $id)
    {
        $validated = request()->validate([
            'note' => 'required',
            'description' => 'required'
        ]);

        try {
            NoteService::make(array_merge($validated, ['id' => $id]))->update();
            return response()->json(['success' => true], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            NoteService::make(['id' => $id])->remove();
            return response()->json(null, 204);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
