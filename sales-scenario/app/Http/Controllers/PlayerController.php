<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    public function Index() {
        //<img src="/expert_photo/{{ $expert->photo }}" alt="Profile picture of {{ $expert->first_name }} {{ $expert->last_name }}"/>
        // src="/temp_before_db_implem/david_stein.png" alt="Profile image of Dave Stein"

        $player = [
            'imgSrc' => '/temp_before_db_implem/david_stein.png',
            'imgAlt' => 'Profile image of Dave Stein',
        ] ;


        return view('player')->with(compact('player'));
    }

}
