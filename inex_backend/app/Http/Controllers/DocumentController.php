<?php

namespace App\Http\Controllers;

use App\Car;
use App\Driver;
use App\Services\DocumentMatchService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    private $documentMatchService;
    private $drivers;
    private $cars;

    public function __construct(DocumentMatchService $documentMatchService, Driver $drivers, Car $cars)
    {
        $this->documentMatchService = $documentMatchService;
        $this->drivers = $drivers;
        $this->cars = $cars;
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
}
