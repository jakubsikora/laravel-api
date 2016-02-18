<?php

namespace App\Transformers;

class DocumentTransformer extends Transformer {

    /**
     * Transform a document
     *
     * @param  [type] $document [description]
     * @return [type]           [description]
     */
    public function transform($document)
    {
        return [
            'id' => $document['id'],
            'name' => $document['name'],
            'type' => $document['type'],
        ];
    }
}