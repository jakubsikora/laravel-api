<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return Response::json([
            'data' => $documents->toArray()
        ], 200);
    }

    public function show($id)
    {
        $document = Document::find($id);

        if (! $document)
        {
            return Response::json([
                'error' => [
                    'message' => 'Document does not exist'
                ]
            ], 404);
        }

        return Response::json([
            'data' => $document->toArray()
        ], 200);
    }
}
