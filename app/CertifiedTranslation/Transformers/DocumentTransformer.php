<?php

namespace CertifiedTranslation\Transformers;

use App\CertifiedTranslation\Transformers\Transformer;

class DocumentTransform extends Transformer {

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