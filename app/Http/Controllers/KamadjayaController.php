<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Kamadjaya;
use App\Kendaraan;
use App\JenisKendaraan;

class KamadjayaController extends Controller
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
          return view('pages/kamadjaya',['kendaraan'=>$kendaraan,'jenis'=>$jenis]);
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
          'destinasi' => $request['destinasi'],
          'wilayah' => $request['wilayah'],
          'daerah' => $request['daerah'],
          'qty' => $request['jumlah'],
          'total_do' => $request['m3do'],
          'desc' => $request['desc'],
          'cost' => $request['cost']
        ];
        return Kamadjaya::create($data);
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
      return $kamadjaya = Kamadjaya::find($id);
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
        $kamadjaya = Kamadjaya::find($id);

        $kamadjaya->tanggal = $request['tanggal'];
        $kamadjaya->no_truck = $request['kendaraan'];
        $kamadjaya->no_do = $request['no_do'];
        $kamadjaya->tipe = $request['jenis'];
        $kamadjaya->customer = $request['customer'];
        $kamadjaya->destinasi = $request['destinasi'];
        $kamadjaya->wilayah = $request['wilayah'];
        $kamadjaya->daerah = $request['daerah'];
        $kamadjaya->qty = $request['jumlah'];
        $kamadjaya->total_do = $request['m3do'];
        $kamadjaya->desc = $request['desc'];
        $kamadjaya->cost = $request['cost'];

        $kamadjaya->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kamadjaya::destroy($id);
    }

    public function apikamadjaya(){
      // $Kamadjaya = Kamadjaya::all();
      $Kamadjaya = DB::table('kamadjayas')
                ->leftjoin('kendaraans','kamadjayas.no_truck','=','kendaraans.id')
                ->leftjoin('jenis_kendaraans','kamadjayas.tipe','=','jenis_kendaraans.id')
                ->select('kamadjayas.*','kendaraans.nopol','jenis_kendaraans.jenis_kendaraan')
                ->get();
      return DataTables::of($Kamadjaya)
        ->addColumn('aksi',function($Kamadjaya) {
          return '<a onclick="editKamadjaya('.$Kamadjaya->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteKamadjaya('.$Kamadjaya->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }
}
