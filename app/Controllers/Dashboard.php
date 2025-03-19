<?php

namespace App\Controllers;

class Dashboard extends BaseController {
    public function index() {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }
    
        $model = new \App\Models\OfferModel();
    
        $data = [
            'totalOffers'   => $model->countAllResults(),
            'comprehensive' => $model->where('jenis_pertanggungan', 1)->countAllResults(),
            'tlo'           => $model->where('jenis_pertanggungan', 2)->countAllResults(),
            'banjir'        => $model->where('risiko_banjir', 1)->countAllResults(),
            'gempa'         => $model->where('risiko_gempa', 1)->countAllResults(),
            'title'         => 'Dashboard'
        ];
    
        return view('dashboard', $data);
    }
    

    public function stats() {
        $model = new \App\Models\OfferModel();
    
        $data['comprehensive'] = $model->where('jenis_pertanggungan', 1)->countAllResults();
        $data['tlo'] = $model->where('jenis_pertanggungan', 2)->countAllResults();    
        $data['banjir'] = $model->where('risiko_banjir', 1)->countAllResults();
        $data['gempa'] = $model->where('risiko_gempa', 1)->countAllResults();
    
        return view('dashboard_stats', $data);
    }    
}
