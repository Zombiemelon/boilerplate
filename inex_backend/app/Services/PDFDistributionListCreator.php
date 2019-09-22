<?php


namespace App\Services;

use App\Document;
use App\Interfaces\DocumentDeliveryInterface;
use App\Interfaces\DocumentInterface;
use App\Services\MatchServices\PDFDeliveryMethodMatchService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFDistributionListCreator implements DocumentInterface
{
    private $document;
    private $documentType = 'distribution_list';
    private $distributionListData;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function getDocument(Request $request, string $deliveryMethod)
    {
        $this->distributionListData = $this->generateDistributionListData($request);
        $pdf = $this->generateDistributionListView();
        $this->save($this->distributionListData);
        return $pdf;
    }

    public function getDocumentName () : string
    {
        return "{$this->documentType}_{$this->distributionListData['number']}.pdf";
    }

    private function generateDistributionListView()
    {
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('distributionList', $this->distributionListData);
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

    public function getDeliver(string $deliveryMethod) :DocumentDeliveryInterface
    {
        $matchService = new PDFDeliveryMethodMatchService();
        return $matchService->matchDeliveryMethod($deliveryMethod);
    }
}
