<?php

use App\Document;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DocumentsTest extends ApiTester
{
    /** @test */
    public function it_fetches_documents()
    {
        $this->makeDocument();

        $this->getJson('api/v1/documents');

        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_single_document()
    {
        $this->makeDocument();

        $document = $this->getJson('api/v1/documents/1')->data;

        $this->assertResponseOk();
        $this->assertObjectHasAttributes($document, 'name', 'type');
    }

    /** @test */
    public function it_404s_if_a_document_is_not_found()
    {
        $this->getJson('api/v1/documents/x');

        $this->assertResponseStatus(404);
    }

    private function makeDocument($documentFields = [])
    {
        $document = array_merge([
            'name' => $this->fake->word(),
            'type' => $this->fake->randomElement($array = array ('A','B','C')),
        ], $documentFields);

        while($this->times--) Document::create($document);
    }
}
