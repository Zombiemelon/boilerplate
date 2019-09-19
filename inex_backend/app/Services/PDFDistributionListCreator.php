<?php


namespace App\Services;

use App\Document;
use App\Interfaces\DocumentInterface;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFDistributionListCreator implements DocumentInterface
{
    private $document;
    private $documentType = 'distribution_list';

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function downloadDocument(Request $request)
    {
        $distributionListData = $this->generateDistributionListData($request);
        $pdf = $this->generateDistributionListView($distributionListData);
        $documentName = $this->generateDocumentName($distributionListData);
        $this->save($distributionListData);
        return $pdf->download($documentName);
    }

    private function generateDocumentName (array $invoiceData) : string
    {
        return "{$this->documentType}_{$invoiceData['number']}.pdf";
    }

    private function generateDistributionListView(array $invoiceData)
    {
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('distributionList', $invoiceData);
        return $pdf;
    }

    private function generateDistributionListData(Request $request) :array
    {
        $documentData = [];
        $documentData['number'] = $request['number'];
        $documentData['dateForLoading'] = $request['dateForLoading'];
        $documentData['truckNumber'] = $request['truckNumber'];
        $documentData['driver'] = $request['driver'];
        $documentData['driverPassport'] = $request['driverPassport'];

        return $documentData;
    }

    private function save(array $distributionList) :void
    {
        $document = $this->document;
        $number = $distributionList['number'];
        $documentType = $this->documentType;

        $document->number = $number;
        $document->document_type = $documentType;
        $document->save();
    }
}
