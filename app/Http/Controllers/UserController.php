<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id',Auth::user()->id);

        return view('users.index', ['cubes' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            $this->middleware('auth');
            return redirect('cube')->with([
                'message' => 'Only user have right to open this page!',
                'status' => 'failed'
            ]);
        }
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            ''
        ]);


            $cube = Cube::find($id);
            $cube->name = $request->input('name');
            $cube->description = $request->input('description');
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
}
