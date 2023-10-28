<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use App\Models\Tag;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todayDate = date("d.m.Y");
        $tags = Tag::all();
        $cubes = \DB::table('cubes')->limit(2)->get();
        return view('welcomePage', compact('todayDate'),['tags'=> $tags, 'cubes'=>$cubes]);
    }

    /**
     * Display the specified resource.
     */
    public function showCubes($tag)
    {
        $todayDate = date("d.m.Y");
        $tags = Tag::all();
        $cubes = Cube::where('tag_id',$tag )->where('is_enable',1)->get();
        return view('welcomePage', compact('todayDate'), ['cubes' => $cubes, 'tags' => $tags]);

    }
}
