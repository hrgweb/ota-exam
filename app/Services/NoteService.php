<?php

namespace App\Services;

use Exception;
use App\Models\Note;
use Illuminate\Support\Facades\Log;

class NoteService
{
    public function __construct(protected array $request = [])
    {
    }

    public static function make(...$params)
    {
        return new static(...$params);
    }

    public function fetch()
    {
        return Note::all();
    }

    public static function find(int $id)
    {
        $note = Note::find($id);

        if (!$note) throw new Exception('No note found.');

        return $note;
    }

    public function save()
    {
        return Note::create($this->request);
    }

    public function update()
    {
        return Note::where('id', $this->request['id'])->update($this->request);
    }

    public function remove()
    {
        Note::destroy($this->request['id']);
    }
}
