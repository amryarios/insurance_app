<?php

namespace App\Controllers;
use App\Models\OfferModel;
use CodeIgniter\Controller;

class Offer extends Controller {
    public function index() {
        return view('offer_form');
    }

    public function submit() {
        $model = new \App\Models\OfferModel();
    
        $periode_awal = $this->request->getPost('periode_awal');
        $lama_tahun = $this->request->getPost('lama_tahun');
        
        $periode_akhir = date('Y-m-d', strtotime("+$lama_tahun years", strtotime($periode_awal)));
    
        $data = [
            'nama_nasabah'       => $this->request->getPost('nama_nasabah'),
            'periode_awal'       => $periode_awal,
            'periode_akhir'      => $periode_akhir,
            'kendaraan'          => $this->request->getPost('kendaraan'),
            'harga_pertanggungan' => $this->request->getPost('harga_pertanggungan'),
            'jenis_pertanggungan' => $this->request->getPost('jenis_pertanggungan'),
            'risiko_banjir'      => $this->request->getPost('risiko_banjir') ? 1 : 0,
            'risiko_gempa'       => $this->request->getPost('risiko_gempa') ? 1 : 0,
            'total_premi'        => $this->hitungPremi()
        ];
    
        if ($model->insert($data)) {
            return redirect()->to('/offer/history')->with('success', 'Penawaran berhasil disimpan!');
        } else {
            return redirect()->to('/offer')->with('error', 'Gagal menyimpan data.');
        }
    }    

    private function hitungPremi() {
        $harga = $this->request->getPost('harga_pertanggungan');
        $jenis = $this->request->getPost('jenis_pertanggungan');
        $banjir = $this->request->getPost('risiko_banjir') ? 0.0005 : 0;
        $gempa = $this->request->getPost('risiko_gempa') ? 0.0002 : 0;

        $rate = ($jenis == 1) ? 0.0015 : 0.005;
        $premiKendaraan = $harga * $rate;
        $premiRisiko = $harga * ($banjir + $gempa);

        return $premiKendaraan + $premiRisiko;
    }

    public function history() {
        $model = new OfferModel();
        $data['offers'] = $model->findAll();
        return view('offer_history', $data);
    }

    public function edit($id) {
        $model = new OfferModel();
        $data['offer'] = $model->find($id);
    
        if (!$data['offer']) {
            return redirect()->to('/offer/history')->with('error', 'Data tidak ditemukan');
        }
    
        return view('offer_edit', $data);
    }
    
    public function update($id) {
        $model = new \App\Models\OfferModel();
        $offer = $model->find($id);
    
        if (!$offer) {
            return redirect()->to('/offer/history')->with('error', 'Data tidak ditemukan');
        }
    
        $periode_awal = $this->request->getPost('periode_awal');
        $lama_tahun = $this->request->getPost('lama_tahun');
        $periode_akhir = date('Y-m-d', strtotime("+$lama_tahun years", strtotime($periode_awal)));
    
        $data = [
            'nama_nasabah'       => $this->request->getPost('nama_nasabah'),
            'periode_awal'       => $periode_awal,
            'periode_akhir'      => $periode_akhir,
            'kendaraan'          => $this->request->getPost('kendaraan'),
            'harga_pertanggungan' => $this->request->getPost('harga_pertanggungan'),
            'jenis_pertanggungan' => $this->request->getPost('jenis_pertanggungan'),
            'risiko_banjir'      => $this->request->getPost('risiko_banjir') ? 1 : 0,
            'risiko_gempa'       => $this->request->getPost('risiko_gempa') ? 1 : 0,
            'total_premi'        => $this->hitungPremi()
        ];
    
        $model->update($id, $data);
        return redirect()->to('/offer/history')->with('success', 'Penawaran berhasil diperbarui');
    }    
    
    public function delete($id) {
        $model = new OfferModel();
        $offer = $model->find($id);
    
        if (!$offer) {
            return redirect()->to('/offer/history')->with('error', 'Data tidak ditemukan');
        }
    
        $model->delete($id);
        return redirect()->to('/offer/history')->with('success', 'Data berhasil dihapus');
    }
    
    public function search() {
        $model = new OfferModel();
        $keyword = $this->request->getGet('keyword');
        $jenis = $this->request->getGet('jenis_pertanggungan');
    
        if ($keyword) {
            $model->like('nama_nasabah', $keyword)
                  ->orLike('kendaraan', $keyword);
        }
    
        if ($jenis) {
            $model->where('jenis_pertanggungan', $jenis);
        }
    
        $data['offers'] = $model->findAll();
        return view('offer_history', $data);
    }
    
    
}
