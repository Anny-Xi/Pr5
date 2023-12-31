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
        $tags = Tag::all();
        if (request('search')) {
            $cubes = Cube::where('name', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%')
                ->where('is_enable', 1)
                ->get();
        } else {
            $cubes = Cube::all()->where('is_enable', 1);
        }
        return view('cubes.index', ['cubes' => $cubes, 'tags' => $tags]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $tags = Tag::all();
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

                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:1080'],
                'difficulty' => 'required',
                'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:1024'
            ]);


            if (!$tag = Tag::where('name', $request->input('difficulty'))->first()) {
                $message = 'Cube can not be added to gallery, Chose correct tag';
                $status = 'danger';

            } else {

                $imagePath = $request->file('image')->store('public/images');

                $cube = new Cube;
                $user_id = Auth::user()->id;
                $cube->name = $request->input('name');
                $cube->user_id = $user_id;
                $cube->tag_id = $tag->id;
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

    public function showDetail($id)
    {
        $cube = Cube::find($id);
        return view('cubes.showDetails', compact('cube'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            $this->middleware('auth');
            return redirect('cube')->with([
                'message' => 'Only user has right to open this page!',
                'status' => 'danger'
            ]);
        }
        $tags = Tag::all();
        $cube = Cube::find($id);
        if (Auth::user()->id == $cube->user_id || Auth::user()->role === 1) {
            return view('cubes.edit', compact('cube'), ['tags' => $tags]);
        } else {
            return redirect('cubes')->with([
                'message' => 'Only owner has right to edit this cube!',
                'status' => 'danger'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editImage($id)
    {
        if (!Auth::check()) {
            $this->middleware('auth');
            return redirect('cube')->with([
                'message' => 'Only user have right to open this page!',
                'status' => 'failed'
            ]);
        }
        $cube = Cube::find($id);

        if (Auth::user()->id == $cube->user_id || Auth::user()->role === 1) {
            return view('cubes.editImage', compact('cube'));
        } else {
            return redirect('cubes')->with([
                'message' => 'Only owner has right to edit this cube!',
                'status' => 'danger'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1080'],
            'difficulty' => 'required'
        ]);


        if (!$tag = Tag::where('name', $request->input('difficulty'))->first()) {
            $message = 'Cube can not be added to gallery, Chose correct tag';
            $status = 'danger';

        } else {

            $cube = Cube::find($id);
            $cube->name = $request->input('name');
            $cube->tag_id = $tag->id;
            $cube->description = $request->input('description');
            $cube->save();
            $message = 'Cube updated!';
            $status = 'success';

        }

        return redirect()->back()->with([
            'message' => $message,
            'status' => $status
        ]);

    }

    /**
     * Update the image resource in storage.
     */
    public function updateImage(Request $request, $id)
    {

        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:1024'
        ]);
        $cube = Cube::find($id);
        Storage::delete($cube->cube_image);
        $imagePath = $request->file('image')->store('public/images');
        $cube->cube_image = $imagePath;
        $cube->save();
        $message = 'Cube updated!';
        $status = 'success';


        return redirect()->back()->with([
            'message' => $message,
            'status' => $status
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cube)
    {
        $theCube = Cube::where('id', $cube)->first();

        if ($theCube->user_id == Auth::user()->id || Auth::user()->role === 1) {

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
