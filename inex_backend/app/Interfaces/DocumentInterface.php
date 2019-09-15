<?php


namespace App\Interfaces;


use Illuminate\Http\Request;

interface DocumentInterface
{
    public function downloadDocument(Request $request);
}
