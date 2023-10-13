<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use Illuminate\Http\Request;

class CubeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        if (request('search')) {
//            $recipes = Recipe::where('name', 'like', '%' . request('search') . '%')->get();
//        } else {
//            $recipes = Recipe::all();
//        }
//
//
//        return view('recipes.index', ['recipes' => $recipes]);
        return view('cubes.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        dd();
        return view('cubes.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
//            'difficulty' => 'required',
            'year' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $cube = new Cube;
        $cube->name = $request->input('name');
//        $cube->difficulty = $request->input('difficulty');
        $cube->year = $request->input('year');
        $cube->description = $request->input('description');
        $cube->cube_image = $request->input('image');
        $cube->save();

        return redirect()->back()->with([
            'message' => 'Recipe added successfully!',
            'status' => 'success'
        ]);
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
        //
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
    public function destroy(Cube $cube)
    {
        //
    }
}
