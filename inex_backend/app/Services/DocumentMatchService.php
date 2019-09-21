<?php


namespace App\Services;

use App\Interfaces\DocumentInterface;
use Exception;

class DocumentMatchService
{
    public function getDocumentCreator(string $documentType, string $documentFormat) :DocumentInterface
    {
        switch ($documentType) {
            case 'distribution_list':
                $service = new DistributionListFormatMatchService();
                return $service->matchDocumentFormat($documentFormat);
                break;
            default:
                throw new Exception("Document type $documentType doesn't exist");
        }
    }
}
