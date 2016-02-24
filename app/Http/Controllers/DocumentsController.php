<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Transformers\DocumentTransformer;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Input;

class DocumentsController extends ApiController
{
    /**
     * @var \Transformers\DocumentTransformer
     */
    protected $documentTransformer;

    public function __construct(DocumentTransformer $documentTransformer)
    {
        $this->documentTransformer = $documentTransformer;
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $documents = Document::all();

        return $this->respond([
            'data' => $this->documentTransformer
                           ->transformCollection($documents->all())
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
            'data' => $this->documentTransformer
                           ->transform($document)
        ]);
    }

    /**
     * [store description]
     * @return [type] [description]
     */
    public function store()
    {
        if (! Input::get('name') or ! Input::get('type')) {
            return $this->respondUnprocessableEntity('Parameters failed validation for a document');
        }

        Document::create(Input::all());
        return $this->respondCreated('Document successfully created.');
    }
}
