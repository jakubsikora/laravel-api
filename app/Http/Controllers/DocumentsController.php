<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreDocumentRequest;
use App\Transformers\DocumentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Validator;

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
        $limit = Input::get('limit') ?: 3;
        $documents = Document::paginate($limit);

        return $this->respondWithPagination($documents,
            $this->documentTransformer
                 ->transformCollection($documents->all())
        );
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

        return $this->respond(
            $this->documentTransformer
                 ->transform($document)
        );
    }

    /**
     * [store description]
     * @return [type] [description]
     */
    public function store(StoreDocumentRequest $request)
    {
        // if ($validator->fails()) {
        //     $messages = $validator->errors();

        //     return $this->respondUnprocessableEntity($messages->all());
        // }

        // Document::create(Input::all());
        return $this->respondCreated('Document successfully created.');
    }
}
