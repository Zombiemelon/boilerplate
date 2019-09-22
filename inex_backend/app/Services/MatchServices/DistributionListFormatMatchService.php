<?php


namespace App\Services\MatchServices;

use App\Document;
use App\Interfaces\DocumentInterface;
use App\Services\PDFDistributionListCreator;

class DistributionListFormatMatchService
{
    public function matchDocumentFormat(string $documentFormat) :DocumentInterface
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
