<?php


namespace App\Services;


use App\Interfaces\DocumentDeliveryInterface;

class PDFDownloadService implements DocumentDeliveryInterface
{
    public function deliver($document, string $name)
    {
        return $document->download($name);
    }
}
