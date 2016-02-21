<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Transformers\DocumentTransformer;
use App\Http\Controllers\ApiController;

class DocumentsController extends ApiController
{
    /**
     * @var \Transformers\DocumentTransformer
     */
    protected $documentTransformer;

    public function __construct(DocumentTransformer $documentTransformer)
    {
        $this->documentTransformer = $documentTransformer;
        $this->middleware('jwt.auth', ['except' => ['index']]);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $documents = Document::all();

        return $this->respond([
            'data' => $this->documentTransformer->transformCollection($documents->all())
        ]);
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $document = Document::find($id);

        if (! $document) {
            return $this->respondNotFound('Document does not exist');
        }

        return $this->respond([
            'data' => $this->documentTransformer->transform($document)
        ]);
    }

    public function store()
    {
        dd('store');
    }
}
