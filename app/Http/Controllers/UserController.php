<?php

namespace App\Http\Controllers;

use App\Models\Cube;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->get();
        $userCubes = Cube::where('user_id', Auth::user()->id)->get();
        $allCubes = Cube::all();
        if(Auth::user()->role==1){
            $cubes = $allCubes;
        }else{
            $cubes = $userCubes;
        }

        return view('users.index', ['user' => $user, 'cubes' => $cubes, 'allCubes' =>$allCubes]);

    }

    public function showUsers()
    {
        $user = User::where('role','0')->get();

        if (!Auth::check() || !Auth::user()->role) {
            $this->middleware('auth');
            return redirect('/home')->with([
                'message' => 'You dont have right to open this page!',
                'status' => 'danger'
            ]);
        }

        return view('users.usersList', ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            $this->middleware('auth');
            return redirect('/')->with([
                'message' => 'Only user have right to open this page!',
                'status' => 'failed'
            ]);
        }
        $user = User::where('id', $id)->first();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);


        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        $message = 'User updated!';
        $status = 'success';


        return redirect()->back()->with([
            'message' => $message,
            'status' => $status
        ]);

    }

    public function enableCube($id){
        $cube = Cube::find($id);
        $cube->is_enable= $cube->is_enable === 1 ? 0 : 1;
        $cube->save();
        return redirect()->back()->with([
            'message' => 'Cube updated',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $theUser = User::where('id', $id)->first();

        $theUser->delete();
        $message = 'User deleted!';
        $status = 'success';


        return redirect('cubes')->with(
            [
                'message' => $message,
                'status' => $status
            ]);
    }

}
