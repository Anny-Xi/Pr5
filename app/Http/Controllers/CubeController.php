<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        return view('cubes.index', ['cubes' => $cubes]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $tags = Tag::all();
//            print_r($tags);
            return view('cubes.create', ['tags' => $tags]);
        } else {
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
                'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:1024'
            ]);



            if (!Tag::where('name', $request->input('difficulty'))->first()) {
                $message = 'Cube can not be added to gallery, Chose correct tag';
                $status = 'danger';

            } else {
                $imagePath = $request->file('image')->store('public/images');

                $cube = new Cube;
                $user_id = Auth::user()->id;
                $cube->name = $request->input('name');
                $cube->user_id = $user_id;
                $cube->tag_id = $tagId->id;
                $cube->description = $request->input('description');
                $cube->cube_image = $imagePath;
                $cube->save();
                $message = 'Cube added to gallery!';
                $status = 'success';

            }

            return redirect()->back()->with([
                'message' => $message,
                'status' => $status
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
        return view('cubes.edit', compact('cube'));
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
        $theCube = Cube::where('id', $cube)->first();

        if ($theCube->user_id === auth()->id()) {

            if (Storage::exists($theCube->cube_image)) {
                Storage::delete($theCube->cube_image);
                $theCube->delete();
                $message = 'Cube deleted!';
                $status = 'success';

            } else {
                $message = 'Cube image cannot be defined!';
                $status = 'danger';

            }
        } else {
            $message = 'Only the owner can delete this cube';
            $status = 'danger';
        }


        return redirect('cubes')->with(
            [
                'message' => $message,
                'status' => $status
            ]);
    }
}
