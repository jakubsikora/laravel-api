<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Transformers\DocumentTransformer;

class DocumentsController extends Controller
{
    /**
     * @var \Transformers\DocumentTransformer
     */
    protected $documentTransformer;

    function __construct(DocumentTransformer $documentTransformer)
    {
        $this->documentTransformer = $documentTransformer;
    }

    public function index()
    {
        $documents = Document::all();

        return Response::json([
            'data' => $this->documentTransformer->transformCollection($documents->all())
        ], 200);
    }

    public function show($id)
    {
        $document = Document::find($id);

        if (! $document) {
            return Response::json([
                'error' => [
                    'message' => 'Document does not exist'
                ]
            ], 404);
        }

        return Response::json([
            'data' => $this->documentTransformer->transform($document)
        ], 200);
    }
}
