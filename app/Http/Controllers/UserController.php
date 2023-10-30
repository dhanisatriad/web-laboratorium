<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.dashboard.page.dashboardDaftarUser', [
            "show" => 'user',
            "label" => '',
            "users" => User::latest()->paginate(50)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(user $daftar_user)
    {
        // dd($daftar_user);
        return view('layout.dashboard.page.dashboardUser', [
            "show" => 'user',
            "label" => '',
            "user" => $daftar_user,
            "jAdmin" => user::where('level', 'Admin')->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $daftar_user)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required',
            'level' => 'required',
        ];
        $validatedData = $request->validate($rules);
// dd($validatedData);
        user::where('id', $daftar_user->id)->update($validatedData);
        return redirect('/dashboard/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $daftar_user)
    {
        user::destroy($daftar_user->id);
        return Redirect('/dashboard/daftar-user/')->with('success', 'User Berhasil dihapus');
    }
}
