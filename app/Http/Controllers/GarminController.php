<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GarminController extends Controller
{


    public function redirect() {
        $serial = \request('serial');

        $id = Session::getId();

        Session::put('Activation:'.$id, $serial);

        return Socialite::driver('garmin-connect')->redirect();
    }

    public function callback() {

        $user = Socialite::driver('garmin-connect')->user();

        if (Band::where('uat', '=', $user->token)->exists()) {
            return redirect('/addB')->with('failed', 'Erro - Banda já está ativa!');
        }

        $id = Session::getId();
        $serial = Session::get('Activation:'.$id);
        Session::forget('Activation:'.$id);
        $band = Band::where('serial', '=', $serial)->first();

        if (Auth::check()) {

            if (is_null($band)) {
                return redirect('/addB')->with('failed', 'Erro - Banda não existe!');
            } else {
                if ($band->activated) {
                    return redirect('/addB')->with('failed', 'Erro - Banda já está ativa!');
                } else {

                    $band->activated = true;
                    $band->uat = $user->token;
                    $band->uatSecret = $user->tokenSecret;

                    $band->save();
                    return redirect('/addB')->with('success', 'Banda '.$serial.' ativada com sucesso');
                }
            }
        } else {

            if (is_null($band)) {
                return redirect('/addBP')->with('failed', 'Erro - Banda não existe!');
            } else {
                if ($band->activated) {
                    return redirect('/addBP')->with('failed', 'Erro - Banda já está ativa!');
                } else {

                    $band->activated = true;
                    $band->uat = $user->token;
                    $band->uatSecret = $user->tokenSecret;

                    $band->save();
                    return redirect('/addBP')->with('success', 'Banda '.$serial.' ativada com sucesso');
                }
            }
        }
    }

    public function getOx(){
        return redirect('/');
    }
}
