<?php

namespace App\Http\Controllers;

use App\Car;
use App\Document;
use App\Driver;
use App\Services\MatchServices\DocumentMatchService;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

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
     * @return ResponseFactory|Response
     */
    public function getDocument(Request $request)
    {
        if (!Gate::allows('getDocument')) {
            return response('You are not authorized', 403);
        }

        $documentType = $request['document_type'];
        $documentFormat = $request['document_format'];
        $deliveryMethod = $request['delivery_method'];
        try{
            $documentCreator = $this->documentMatchService->getDocumentCreator($documentType, $documentFormat);
            $document = $documentCreator->getDocument($request, $deliveryMethod);
            $deliver = $documentCreator->getDeliver($deliveryMethod);
            $name = $documentCreator->getDocumentName();
            return $deliver->deliver($document, $name);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function getAllDrivers()
    {
        if (!Gate::allows('getDataRequiredForDocument')) {
            return response('You are not authorized', 403);
        }

        return $this->drivers->getAllDrivers();
    }

    /**
     * @return iterable
     */
    public function getAllCars()
    {
        if (!Gate::allows('getDataRequiredForDocument')) {
            return response('You are not authorized', 403);
        }

        return $this->cars->getAllCars();

    }

    public function getLastDocumentNumber(Request $request)
    {
        if (!Gate::allows('getDataRequiredForDocument')) {
            return response('You are not authorized', 403);
        }

        $documentType = $request['document_type'];
        return $this->document->getDocumentNumber($documentType);
    }
}
