<?php


namespace App\Services\Factories;


use App\Interfaces\DocumentInterface;
use Illuminate\Http\Request;

abstract class DocumentsFactory
{
    abstract public function getDocumentCreator(string $documentType) :DocumentInterface;

    public function download(Request $request)
    {
        $documentType = $request['document_format'];
        $document = $this->getDocumentCreator($documentType);
        return $document->downloadDocument($request);
    }
}
