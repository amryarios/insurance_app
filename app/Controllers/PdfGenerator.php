<?php

namespace App\Controllers;
use App\Models\OfferModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfGenerator extends BaseController {
    public function printOffer($id) {
        $model = new OfferModel();
        $offer = $model->find($id);

        if (!$offer) {
            return redirect()->to('/offer/history')->with('error', 'Data tidak ditemukan');
        }

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $html = view('pdf_offer', ['offer' => $offer]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("Penawaran_{$offer['nama_nasabah']}.pdf", ["Attachment" => false]);
    }
}
