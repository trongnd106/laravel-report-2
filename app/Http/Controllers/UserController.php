<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function home()
    {
        return view('example.home', ['message' => 'This is Home Page!']);
    }

    public function create()
    {
        return view('user.create');  
    }

    public function getAll()
    {
        $users = DB::table('users')->get(); 
        return view('user.index', data: compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|string|min:6',
        //     'department_id' => 'required|exists:departments,id'
        // ]);

        // $user = User::create([
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        //     'password' => bcrypt($request->input('password')), 
        //     'department_id' => $request->input('department_id')
        // ]);

        $user = User::create($request->all());


        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    public function getDetail($id)
    {
        try {
            $user = User::find($id);
            return view('user.edit', compact('user'));
        } catch(ModelNotFoundException $e){
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, 
            'department_id' => 'required|exists:departments,id', 
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'department_id' => $request->input('department_id')
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    // get first 100 users
    public function getManyUsers(){
        return User::take(100)->get();
    }

    public function getDeparmentUsers($department_id): string|null{
        $countUser = User::where('department_id',$department_id)->count();
        echo $countUser;
        return `There are {$countUser} work in department {$department_id}`;
    }
}
