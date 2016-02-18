<?php

namespace App\Http\Controllers;

use App\Podcast;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ExploreController extends Controller
{
    public function Index()
    {
        $list = array();
        $letters = range('A', 'Z');

        foreach ($letters as $letter) {
            $experts = \App\Expert::where('last_name', 'LIKE', $letter.'%')->orderBy('last_name')->orderBy('first_name')->get();

            if(count($experts)){
                foreach ($experts as $expert) {
                    if(count($expert->podcasts)){
                        if(!isset($list[$letter])){
                            $list[$letter] = array();
                        }

                        $list[$letter][] = $expert;
                    }
                }
            }
        }

        return view('explore')->with(compact('list'));


    }

    public function Expert($id)
    {
        $expert = \App\Expert::find($id);

        return view('expert')->with(compact('expert'));
    }

}
