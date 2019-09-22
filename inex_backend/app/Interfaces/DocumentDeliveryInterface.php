<?php


namespace App\Interfaces;


interface DocumentDeliveryInterface
{
    public function deliver($document, string $name);
}
