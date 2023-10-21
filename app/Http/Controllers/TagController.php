<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request('search')) {
            $tags = Tag::where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $tags = Tag::all();
        }
        return view('tags.index',['tags'=>$tags]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $tag = new Tag;
        $tag->name = $request->input('name');
        $tag->description = $request->input('description');
        $tag->save();

        return redirect()->back()->with([
            'message' => 'Tag added successfully!',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tag)
    {
        $theTag = Tag::where('id',$tag)->first();
        $theTag->delete();

        return redirect('tags')->with('success','Tag deleted');
    }
}
