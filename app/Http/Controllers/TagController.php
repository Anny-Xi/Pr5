<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
        return view('tags.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        dd();
        return view('tags.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $tag = new Tag;
        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->back()->with([
            'message' => 'Tag added successfully!',
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
