<?php


namespace App\Services\MatchServices;

use App\Interfaces\DocumentDeliveryInterface;
use App\Services\PDFDownloadService;
use App\Services\PDFEmailService;

class PDFDeliveryMethodMatchService
{
    public function matchDeliveryMethod(string $deliveryMethod) :DocumentDeliveryInterface
    {
        switch ($deliveryMethod)
        {
            case 'download':
                return new PDFDownloadService();
                break;
            case 'email':
                return new PDFEmailService();
                break;
            default:
                throw new \Exception("Delivery format $deliveryMethod is not supported");
        }
    }
}
