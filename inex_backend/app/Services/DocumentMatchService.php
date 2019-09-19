<?php


namespace App\Services;

use App\Services\Factories\DocumentsFactory;
use Exception;

class DocumentMatchService
{
    public function matchDocument(string $documentType) :DocumentsFactory
    {
        switch ($documentType) {
            case 'distribution_list':
                return new DistributionListService();
                break;
            default:
                throw new Exception("Document type $documentType doesn't exist");
        }
    }
}
