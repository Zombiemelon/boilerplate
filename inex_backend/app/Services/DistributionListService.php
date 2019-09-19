<?php


namespace App\Services;

use App\Document;
use App\Interfaces\DocumentInterface;
use App\Services\Factories\DocumentsFactory;

class DistributionListService extends DocumentsFactory
{
    public function getDocumentCreator(string $documentFormat): DocumentInterface
    {
        return $this->matchCreatorType($documentFormat);
    }

    private function matchCreatorType(string $documentFormat) : DocumentInterface
    {
        switch ($documentFormat)
        {
            case 'pdf':
                $document = new Document();
                return new PDFDistributionListCreator($document);
                break;
            default:
                throw new \Exception("Document type $documentFormat is not supported");
        }
    }
}
