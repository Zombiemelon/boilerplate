<?php

namespace App\Http\Controllers;

use App\Car;
use App\Document;
use App\Driver;
use App\Services\DocumentMatchService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    private $documentMatchService;
    private $drivers;
    private $cars;
    private $document;

    public function __construct(DocumentMatchService $documentMatchService, Driver $drivers, Car $cars, Document $document)
    {
        $this->documentMatchService = $documentMatchService;
        $this->drivers = $drivers;
        $this->cars = $cars;
        $this->document = $document;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function downloadDocument(Request $request) {
        $documentType = $request['document_type'];
        try{
            $invoiceService = $this->documentMatchService->matchDocument($documentType);
            return $invoiceService->download($request);
        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * @return iterable
     */
    public function getAllDrivers() :iterable
    {
        return $this->drivers->getAllDrivers();
    }

    /**
     * @return iterable
     */
    public function getAllCars() :iterable
    {
        return $this->cars->getAllCars();
    }

    public function getLastDocumentNumber(Request $request)
    {
        $documentType = $request['document_type'];
        return $this->document->getDocumentNumber($documentType);
    }
}
