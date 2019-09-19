<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function getDocumentNumber(string $documentType) :int
    {
        $number = Document::where('document_type', $documentType)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        return $number[0]['number'];
    }
}
