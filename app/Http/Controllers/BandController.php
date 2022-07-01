<?php

namespace App\Http\Controllers;

use App\Models\Band;

class BandController extends Controller
{
    public function index() {

        $bands = Band::all();
        return view('AddBand', ['bands' => $bands]);
    }

    public function indexP() {

        $bands = Band::where('activated', '0')->get();

        return view('AddBandPublic', ['bands' => $bands]);

    }

    public function store() {
        $serial = \request('serial');

        if (Band::where('serial', '=', $serial)->exists()) {
            return redirect('/addB')->with('failed', 'Erro - Banda já está registada!');
        } else {
            $band = new Band();
            $band->serial = $serial;

            $band->save();
            return redirect('/addB')->with('success', 'Banda adicionada com sucesso');
        }
    }
}
