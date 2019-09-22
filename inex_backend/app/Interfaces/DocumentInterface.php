<?php


namespace App\Interfaces;


use Illuminate\Http\Request;

interface DocumentInterface
{
    public function getDocument(Request $request, string $how);

    public function getDeliver(string $deliveryMethod) :DocumentDeliveryInterface;

    public function getDocumentName();
}
