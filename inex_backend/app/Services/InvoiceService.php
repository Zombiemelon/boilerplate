<?php


namespace App\Services;


use App\Interfaces\DocumentInterface;
use App\Services\Factories\DocumentsFactory;

class InvoiceService extends DocumentsFactory
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
                return new PDFInvoiceCreator();
                break;
            default:
                throw new \Exception("Document type $documentFormat is not supported");
        }
    }
}
