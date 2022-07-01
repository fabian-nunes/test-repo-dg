<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $patients = Patient::all();

        return view('AddPatient', ['patients' => $patients]);
    }

    public function store() {

        $name = \request('name');
        $age = \request('age');
        $height = \request('height');
        $weight = \request('weight');

        if (empty($name) || empty($age) || empty($height) || empty($weight)) {
            return redirect('/addU')->with('failed', 'Erro - Campos em Branco!');
        } else {

            if (preg_match('~[0-9]+~', $name)) {
                return redirect('/addU')->with('failed', 'Erro - Campo do Nome possui Números!');
            }

            if (is_numeric($age) || is_numeric($height) || is_numeric($weight)) {
                $age = (int) $age;
                $height = (float) $height;
                $weight = (float) $weight;
            } else {
                return redirect('/addU')->with('failed', 'Erro - Campos precisam de ser numéricos!');
            }



            if (Patient::where('name', '=', $name)->exists()) {
                return redirect('/addU')->with('failed', 'Erro - Utente já está registado!');
            } else {
                $patient = new Patient();

                $patient->name = $name;
                $patient->age = $age;
                $patient->weight = $weight;
                $patient->height = $height;

                $patient->save();

                return redirect('/addU')->with('success', 'Utente adicionado com sucesso');
            }
        }
    }

}
