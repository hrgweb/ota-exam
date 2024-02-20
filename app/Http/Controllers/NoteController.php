<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function store()
    {
        try {
            $validated = request()->validate([
                'note' => 'required',
                'description' => 'required'
            ]);

            $note = Note::create($validated);

            return response()->json($note, 201);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(Note $note)
    {
        $validated = request()->validate([
            'note' => 'required',
            'description' => 'required'
        ]);

        try {
            $note->note = request()->input('note');
            $note->description = request()->input('description');
            $note->save();
            return response()->json(['success' => true], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json($e->getMessage(), 500);
        }
    }
}
