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
}
