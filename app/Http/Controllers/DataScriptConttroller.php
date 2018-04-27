<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Datascript;
use App\Kendaraan;
use App\JenisKendaraan;

class DataScriptConttroller extends Controller
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
            $kendaraan = Kendaraan::all();
            $jenis = JenisKendaraan::all();
            return view('pages/datascript',['kendaraan'=>$kendaraan,'jenis'=>$jenis]);
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
        'tanggal' => $request['tanggal'],
        'no_truck' => $request['kendaraan'],
        'no_do' => $request['no_do'],
        'tipe' => $request['jenis'],
        'customer' => $request['customer'],
        'barang' => $request['barang'],
        'daerah' => $request['daerah'],
        'lain' => $request['lain'],
        'cost' => $request['cost']
      ];
      return Datascript::create($data);
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
        return $datascript = Datascript::find($id);
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
      $datascript = Datascript::find($id);

      $datascript->tanggal = $request['tanggal'];
      $datascript->no_truck = $request['kendaraan'];
      $datascript->no_do = $request['no_do'];
      $datascript->tipe = $request['jenis'];
      $datascript->customer = $request['customer'];
      $datascript->barang = $request['barang'];
      $datascript->lain = $request['lain'];
      $datascript->daerah = $request['daerah'];
      $datascript->cost = $request['cost'];

      $datascript->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Datascript::destroy($id);
    }

    public function apidatascript(){
      $datascript = DB::table('datascripts')
                ->leftjoin('kendaraans','datascripts.no_truck','=','kendaraans.id')
                ->leftjoin('jenis_kendaraans','datascripts.tipe','=','jenis_kendaraans.id')
                ->select('datascripts.*','kendaraans.nopol','jenis_kendaraans.jenis_kendaraan')
                ->get();
      return DataTables::of($datascript)
        ->addColumn('aksi',function($datascript) {
          return '<a onclick="editDatascript('.$datascript->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteDatascript('.$datascript->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }
}
