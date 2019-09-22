<?php


namespace App\Services;


use App\Interfaces\DocumentDeliveryInterface;
use App\Mail\DocumentMailer;
use Illuminate\Support\Facades\Mail;

class PDFEmailService implements DocumentDeliveryInterface
{
    public function deliver($document, string $name)
    {
        $document->save($name);
        $subject = $this->getSubject($name);

        $mail = new DocumentMailer($name);
        $mail->subject = $subject;
        $mail->attach($name);
        $recipient = env('DOCUMENTS_EMAIL');
        Mail::to($recipient)->send($mail);

        $this->deleteDocument($name);
        return 'Email has been sent';
    }

    private function deleteDocument(string $name) :void
    {
        unlink($name);
    }

    private function getSubject(string $documentName)
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
}
