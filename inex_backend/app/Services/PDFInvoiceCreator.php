<?php


namespace App\Services;

use App\Interfaces\DocumentInterface;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PDFInvoiceCreator implements DocumentInterface
{
    public function downloadDocument(Request $request){
        $invoiceData = $this->generateInvoiceData($request);
        $pdf = $this->generateInvoiceView($invoiceData);
        return $pdf->download('invoice.pdf');
    }

    private function generateInvoiceView(array $invoiceData)
    {
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('invoice', $invoiceData);
        return $pdf;
    }

    private function generateInvoiceData(Request $request) :array
    {
        $documentData = [];
        $documentData['number'] = $request['number'];
        $documentData['date'] = $request['date'];
        $documentData['dateForLoading'] = $request['date_of_loading'];
        $documentData['truckNumber'] = $request['truck_number'];
        $documentData['driver'] = $request['driver_name'];
        $documentData['driverPassport'] = $request['driver_passport'];

        return $documentData;
    }
}
