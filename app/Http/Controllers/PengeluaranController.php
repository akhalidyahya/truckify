<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Pengeluaran;
use App\Storing;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biaya = Storing::where('tanggal',Date('Y-m-d'))->sum('biaya');
        $biaya_mekanik = Storing::where('tanggal',Date('Y-m-d'))->sum('biaya_mekanik');
        $storing = $biaya + $biaya_mekanik;
        return view('pages/pengeluaran',['storing'=>$storing]);
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
          'ujskamadjaya' => $request['ujskamadjaya'],
          'ujsdatascript' => $request['ujsdatascript'],
          'ujssogood' => $request['ujssogood'],
          'storing' => $request['storing'],
          'lain' => $request['lain'],
          'total' => $request['ujskamadjaya'] + $request['ujsdatascript'] + $request['ujssogood'] + $request['storing'] + $request['lain'],
          'keterangan' => $request['keterangan'],
          'pemasukan' => $request['pemasukan']
        ];

        return Pengeluaran::create($data);
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
      $pengeluaran = Pengeluaran::find($id);
      $storing = Storing::where('tanggal',$pengeluaran->tanggal)->sum('biaya') + Storing::where('tanggal',$pengeluaran->tanggal)->sum('biaya_mekanik');
      return $data = ['pengeluaran'=>$pengeluaran,'storing'=>$storing,'tanggal_storing'=>$pengeluaran->tanggal,'action'=>'edit'];
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
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->tanggal = $request['tanggal'];
        $pengeluaran->ujskamadjaya = $request['ujskamadjaya'];
        $pengeluaran->ujsdatascript = $request['ujsdatascript'];
        $pengeluaran->ujssogood = $request['ujssogood'];
        $pengeluaran->storing = $request['storing'];
        $pengeluaran->lain = $request['lain'];
        $pengeluaran->total = $request['ujskamadjaya'] + $request['ujsdatascript'] + $request['ujssogood'] + $request['storing'] + $request['lain'];
        $pengeluaran->keterangan = $request['keterangan'];
        $pengeluaran->pemasukan = $request['pemasukan'];

        $pengeluaran->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengeluaran::destroy($id);
    }

    public function apipengeluaran(){
      $pengeluaran = Pengeluaran::all();
      return DataTables::of($pengeluaran)
        ->addColumn('aksi',function($pengeluaran) {
          return '<a onclick="editPengeluaran('.$pengeluaran->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deletePengeluaran('.$pengeluaran->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }
}
