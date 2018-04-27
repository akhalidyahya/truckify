<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Harga;
use App\JenisKendaraan;

class JenishargaController extends Controller
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
          return view('pages/jenisharga');
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
        'jenis_kendaraan' => $request['jenis_kendaraan'],
        'daerah' => $request['daerah'],
        'harga' => $request['harga']
      ];

      JenisKendaraan::create($data);
    }

    public function save(Request $request)
    {
      $data = [
        'daerah' => $request['daerah2'],
        'harga' => $request['harga2']
      ];

      Harga::create($data);
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
       $jenis = JenisKendaraan::find($id);
       return $jenis;
     }

     public function change($id)
     {
         $harga = Harga::find($id);
         return $harga;
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
      $jenis = JenisKendaraan::find($id);
      $jenis->jenis_kendaraan = $request['jenis_kendaraan'];
      $jenis->daerah = $request['daerah'];
      $jenis->harga = $request['harga'];
      $jenis->update();
    }

    public function improve(Request $request, $id)
    {
        $harga = Harga::find($id);
        $harga->daerah = $request['daerah2'];
        $harga->harga = $request['harga2'];
        $harga->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       JenisKendaraan::destroy($id);
     }

     public function delete($id) {
       Harga::destroy($id);
     }

    public function apijenis(){
      $jenis = JenisKendaraan::all();

      return DataTables::of($jenis)
        ->addColumn('aksi',function($jenis) {
          return '<a onclick="editJenis('.$jenis->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteJenis('.$jenis->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }

    public function apiharga(){
      $harga = Harga::all();

      return DataTables::of($harga)
        ->addColumn('aksi',function($harga) {
          return '<a onclick="editHarga('.$harga->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteHarga('.$harga->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }
}
