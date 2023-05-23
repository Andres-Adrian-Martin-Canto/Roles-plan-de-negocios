<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(request('search')){
            $users = DB::table('users')
            ->where([['rol','!=','admin'],['name', 'like', '%' . request('search') . '%']])
            ->paginate(5);
            return view('admin.usuarios.index', compact('users'));

        } else if(request('tipo') != 'todos'){
            $users = DB::table('users')
            ->where([['rol','!=','admin'],['rol', 'like', '%' . request('tipo') . '%']])
            ->paginate(5);
            return view('admin.usuarios.index', compact('users'));

        } else {
            $users = DB::table('users')->where('rol','!=','admin')->paginate(5);
            return view('admin.usuarios.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        $users = DB::table('users')->paginate(5);

        return back();
    }
}
