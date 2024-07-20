<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AcknowledgeModel;
use Dompdf\Dompdf;

class PDFController extends Controller
{
    public function generatePDF($letter_id)
    {

        $ack_exist =AcknowledgeModel::get_acknowledge_letter_details($letter_id);

        if ($ack_exist) {
            $data = [
                'ack_letter_text' => $ack_exist -> ack_letter_text,
            ];
        }
        else{
            $result =AcknowledgeModel::insertAcknowledgeLetters($letter_id);
        }
        $ack_letter_text = $ack_exist -> ack_letter_text;
        // return view('pdf_view',compact('ack_letter_text'));
        $html='<!DOCTYPE html>
                <html>
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                        <title>PDF</title>
                    </head>
                    <body>';
        $html .= $ack_letter_text;
        $html .= '</body>
                    </html>';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream();
        // $dompdf->download('itsolutionstuff.pdf');
        // $pdf = PDF::loadView('pdf_view', $data);
    
        // return $pdf->download('itsolutionstuff.pdf');
    }
}
