<?php


namespace App\Services;

use App\Document;
use App\Interfaces\DocumentInterface;
use App\Mail\DocumentMailer;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PDFDistributionListCreator implements DocumentInterface
{
    private $document;
    private $documentType = 'distribution_list';

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function getDocument(Request $request, string $deliveryMethod)
    {
        $distributionListData = $this->generateDistributionListData($request);
        $pdf = $this->generateDistributionListView($distributionListData);
        $documentName = $this->generateDocumentName($distributionListData);
        $this->save($distributionListData);
        return $this->sendDocument($pdf, $documentName, $deliveryMethod);
    }

    private function sendDocument($pdf, string $documentName, string $deliveryMethod)
    {
        if($deliveryMethod == 'download') {
            return $this->download($pdf, $documentName);
        } elseif($deliveryMethod == 'email') {
            return $this->email($pdf, $documentName);
        } else {
            throw new Exception("Can't get document via $deliveryMethod");
        }
    }

    private function download($pdf, string $documentName)
    {
        return $pdf->download($documentName);
    }

    private function email($pdf, string $documentName)
    {
        $pdf->save($documentName);
        $subject = $this->getSubject($documentName);

        $mail = new DocumentMailer($documentName);
        $mail->subject = $subject;
        $mail->attach($documentName);
        $recipient = env('DOCUMENTS_EMAIL');
        Mail::to($recipient)->send($mail);

        $this->deleteDocument($documentName);
        return 'Email has been sent';
    }


    function getSubject(string $documentName)
    {
        $splitName = explode('.', $documentName);
        $splitNameArray = explode('_', $splitName[0]);
        $name = "";
        $lastElement = end($splitNameArray);
        foreach($splitNameArray as $namePart){
            if($lastElement !== $namePart){
                $name .= ucfirst($namePart)." ";
            } else {
                $name .= ucfirst($namePart);
            }

        }

        return $name;
    }

    private function deleteDocument(string $documentName) :void
    {
        unlink($documentName);
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
