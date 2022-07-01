<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Monitor;
use App\Models\Patient;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $patients = Patient::all();
        $bands = Band::all();
        $monitors = Monitor::all();

        return view('AddMonitorPatient', ['patients' => $patients, 'bands' => $bands, 'monitors' => $monitors]);
    }

    public function store() {
        $pID = \request('pID');
        $bID = \request('bID');

        if (is_null($pID) || is_null($bID)) {
            return redirect('/addM')->with('failed', 'Erro - Escolha uma opção válida!');
        }

        if (is_numeric($pID) || is_numeric($bID)) {
            if (!Patient::where('id', '=', $pID)->exists()) {
                return redirect('/addM')->with('failed', 'Erro - Utente não existe!');
            }
            if (!Band::where('id', '=', $bID)->exists()) {
                return redirect('/addM')->with('failed', 'Erro - Banda não existe!');
            }

            if (Monitor::where('patient_id', '=', $pID)->exists()) {
                return redirect('/addM')->with('failed', 'Erro -Utente já está a ser monitorizado!');
            }

            if (Monitor::where('band_id', '=', $bID)->exists()) {
                return redirect('/addM')->with('failed', 'Erro -Banda já está a ser utilizada!');
            }

            $monitor = new Monitor();
            $monitor->patient_id = $pID;
            $monitor->band_id = $bID;

            $monitor->save();
            return redirect('/addM')->with('success', 'Utente começou a ser monitorizado!');

        } else {
            return redirect('/addM')->with('failed', 'Erro - Campos precisam de ser númericos!');
        }
    }

    public function show() {

        $monitorP = \request('inputMNumber');

        $monitors = Monitor::all();
        $patients = Patient::all();
        $bands = Band::all();

        if (is_null($monitors) || is_null($monitorP)) {
            return view('viewPatient', ['show' => 0, 'patients' => $patients, 'bands' => $bands, 'monitors' => $monitors]);
        } else {
            $choice = \request('queryR');
            if ($choice == 1 || is_null($choice)) {
                $monitor = Monitor::where('band_id', '=', $monitorP)->first();
                if ($monitor === null) {
                    return redirect('/getM')->with('failed', 'Banda não existe/está a ser utilizada');
                } else {
                    $patient = Patient::where('id', '=', $monitor->patient_id)->first();
                    $band = Band::where('id', '=', $monitor->band_id)->first();
                    return view('viewPatient', ['show' => 1, 'patient' => $patient, 'band' => $band, 'monitor' => $monitor, 'patients' => $patients, 'bands' => $bands, 'monitors' => $monitors]);
                }
            } elseif ($choice == 2) {
                $monitor = Monitor::where('patient_id', '=', $monitorP)->first();
                if ($monitor === null) {
                    return redirect('/getM')->with('failed', 'Utente não existe/está a ser monitorizado');
                } else {
                    $patient = Patient::where('id', '=', $monitor->patient_id)->first();
                    $band = Band::where('id', '=', $monitor->band_id)->first();
                    return view('viewPatient', ['show' => 1, 'patient' => $patient, 'band' => $band, 'monitor' => $monitor, 'patients' => $patients, 'bands' => $bands, 'monitors' => $monitors]);
                }
            } else {
                return view('viewPatient', ['show' => 0, 'patients' => $patients, 'bands' => $bands, 'monitors' => $monitors]);
            }
        }
    }

    public function destroy() {
        $del = \request('delM');

        $monitor = Monitor::where('id', '=', $del)->first();



        if ($monitor === null) {
            return redirect('/getM')->with('failed', 'Erro - Não foi possível apagar registo!');
        } else {
           Monitor::where('id', '=', $del)->first()->delete();
            return redirect('/getM')->with('success', 'Utente parou de ser monitorizado!');
        }
    }
}
