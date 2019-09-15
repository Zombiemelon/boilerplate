<?php


namespace App\Services;


use App\Interfaces\DocumentInterface;
use App\Services\Factories\DocumentsFactory;
use Exception;

class DocumentMatchService
{
    public function matchDocument(string $documentType) :DocumentsFactory
    {
        switch ($documentType) {
            case 'invoice':
                return new InvoiceService();
                break;
            default:
                throw new Exception("Document type $documentType doesn't exist");
        }
    }
}
