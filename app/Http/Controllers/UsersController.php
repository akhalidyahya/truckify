<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Admin;
use App\Mekanik;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if($request->session()->has('login_status') != true) {
          return redirect('login');
        } else {
         return view('pages/users');
        }
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
        $data = [
          'nama' => $request['nama'],
          'username' => $request['username'],
          'password' => md5($request['password']),
          'role' => $request['role']
        ];

        Admin::create($data);
    }

    public function save(Request $request)
    {
      $data = [
        'nama' => $request['nama2']
      ];

      Mekanik::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $admin = Admin::find($id);
      return $admin;
    }

    public function change($id)
    {
        $mekanik = Mekanik::find($id);
        return $mekanik;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $admin = Admin::find($id);
      $admin->nama = $request['nama'];
      $admin->username = $request['username'];
      $admin->password = md5($request['password']);
      $admin->role = $request['role'];
      $admin->update();
    }

    public function improve(Request $request, $id)
    {
        $mekanik = Mekanik::find($id);
        $mekanik->nama = $request['nama2'];
        $mekanik->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Admin::destroy($id);
    }

    public function delete($id) {
      Mekanik::destroy($id);
    }

    public function apimekanik(){
      $mekanik = Mekanik::all();

      return DataTables::of($mekanik)
        ->addColumn('aksi',function($mekanik) {
          return '<a onclick="editMekanik('.$mekanik->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteMekanik('.$mekanik->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }

    public function apiuser(){
      $user = Admin::all();

      return DataTables::of($user)
        ->addColumn('aksi',function($user) {
          return '<a onclick="editUser('.$user->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteUser('.$user->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }
}
