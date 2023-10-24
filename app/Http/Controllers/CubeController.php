<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CubeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request('search')) {
            $cubes = Cube::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $cubes = Cube::all();
        }
        return view('cubes.index',['cubes'=>$cubes]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $tags = Tag::all();
//            print_r($tags);
            return view('cubes.create',['tags'=>$tags]);
        } else{
            $this->middleware('auth');
            return redirect()->back()->with([
                'message' => 'Only user can add new cubes!',
                'status' => 'danger'
            ]);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            $this->middleware('auth');
            return redirect()->back()->with([
                'message' => 'Only user can add new cubes!',
                'status' => 'failed'
            ]);
        } else {

            $request->validate([
                'name' => 'required',
                'difficulty' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes|max:1080'
            ]);
            $imagePath = $request->file('image')->store('public/images');
            $tagId = Tag::where('name', $request->input('difficulty'))->first();

            $cube = new Cube;
            $cube->name = $request->input('name');
            $cube->tag_id = $tagId->id;
            $cube->description = $request->input('description');
            $cube->cube_image = $imagePath;
            dd($cube);

            $cube->save();

            return redirect()->back()->with([
                'message' => 'Cube added to gallery!',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cube $cube)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cube $cube)
    {
        return view('cubes.edit',compact('cube'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cube $cube)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cube)
    {
        $theCube = Cube::where('id',$cube)->first();
        $theCube->delete();

        return redirect('cubes')->with('success','Cube deleted');
    }
}
