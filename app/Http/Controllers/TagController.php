<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            return view('tags.create');
        } else{
            $this->middleware('auth');
            return redirect()->back()->with([
                'message' => 'Only users can add new tags!',
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
                'message' => 'Only users can add new tags!',
                'status' => 'danger'
            ]);
        }

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
        if (!Auth::check()) {
            $this->middleware('auth');
            return redirect()->back()->with([
                'message' => 'Only users can delete tag!',
                'status' => 'danger'
            ]);
        }
        $theTag = Tag::where('id',$tag)->first();
        $theTag->delete();

        return redirect('tags')->back()->with([
            'message' => 'Tag delete succes!',
            'status' => 'success'
        ]);
    }
}
