<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Transformers\DocumentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Validator;

class DocumentsController extends Controller
{
    use ApiResponse;

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
        $limit = Input::get('limit') ?: null;
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
     * @param  StoreDocumentRequest $request [description]
     * @return [type]                        [description]
     */
    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create(Input::all());
        $url = URL::action('DocumentsController@show', [$document->id]);

        return $this->respondCreated('Document successfully created.', $url);
    }

    /**
     * [update description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update(UpdateDocumentRequest $request, $id)
    {
        $document = Document::find($id);

        if (! $document) {
            return $this->respondNotFound('Document does not exist');
        }

        // Call fill on the document and pass in the data
        $document->fill(Input::all());

        $document->save();

        return $this->respondNoContent();
    }
}
