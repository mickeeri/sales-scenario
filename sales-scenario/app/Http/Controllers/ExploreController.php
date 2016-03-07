<?php

namespace App\Http\Controllers;

use App\Podcast;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ExploreController extends Controller
{
    public function index($tag = null)
    {
        if ($tag == null) {
            $tag = 0;
        } else {
            $tag = Tag::findBySlugOrIdOrFail($tag);
            $tag = $tag->id;
        }

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

        $tags = \App\Tag::all();

        return view('explore')->with(compact('list', 'tag', 'tags'));
    }

    public function expert($id)
    {
        try {
            $expert = \App\Expert::findBySlugOrFail($id);

            $expert->podcasts = $expert->podcasts->sortByDesc('id');

            return view('expert')->with(compact('expert'));

        } catch (\Exception $e) {
            return redirect('explore')->with('status', "The sales expert you are looking for can't be found.");
        }
    }
}
