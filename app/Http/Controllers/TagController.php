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
        return view('tags.index', ['tags' => $tags]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Cube::where('user_id', Auth::user()->id)->get()->count() >= 3 || Auth::user()->role === 1) {
            return view('tags.create');
        } else {
            $this->middleware('auth');
            return redirect()->back()->with([
                'message' => 'Only users who has create 3 cubes can add new tags!',
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1080'],
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
        $theTag = Tag::where('id', $tag)->first();
        $theTag->delete();

        return redirect('tags')->back()->with([
            'message' => 'Tag delete succes!',
            'status' => 'success'
        ]);
    }
}
