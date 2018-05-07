<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;

use App\Sogood;
use App\Kendaraan;
use App\JenisKendaraan;

class SogoodController extends Controller
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
          return view('pages/sogood',['kendaraan'=>$kendaraan,'jenis'=>$jenis]);
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
        return Sogood::create($data);
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
        return $sogood = Sogood::find($id);
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
        $sogood = Sogood::find($id);

        $sogood->tanggal = $request['tanggal'];
        $sogood->no_truck = $request['kendaraan'];
        $sogood->no_do = $request['no_do'];
        $sogood->tipe = $request['jenis'];
        $sogood->customer = $request['customer'];
        $sogood->barang = $request['barang'];
        $sogood->lain = $request['lain'];
        $sogood->daerah = $request['daerah'];
        $sogood->cost = $request['cost'];

        $sogood->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sogood::destroy($id);
    }

    public function apisogood(){
      $sogood = DB::table('sogoods')
                ->leftjoin('kendaraans','sogoods.no_truck','=','kendaraans.id')
                ->leftjoin('jenis_kendaraans','sogoods.tipe','=','jenis_kendaraans.id')
                ->select('sogoods.*','kendaraans.nopol','jenis_kendaraans.jenis_kendaraan')
                ->get();
      return DataTables::of($sogood)
        ->addColumn('aksi',function($sogood) {
          return '<a onclick="editSogood('.$sogood->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteSogood('.$sogood->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }

    public function export(){
      $data = DB::table('sogoods')
                ->leftjoin('kendaraans','sogoods.no_truck','=','kendaraans.id')
                ->leftjoin('jenis_kendaraans','sogoods.tipe','=','jenis_kendaraans.id')
                ->select('sogoods.tanggal','kendaraans.nopol','jenis_kendaraans.jenis_kendaraan','sogoods.no_do','sogoods.barang','sogoods.customer','sogoods.daerah','sogoods.lain','sogoods.cost')
                ->get();
      $table = array_map( function($data){
          return (array) $data;
      },$data->toArray());
      return Excel::create('Data sogood',function($excel) use ($table){
        $excel->sheet('sheet1',function($sheet) use($table){
          $sheet->fromArray($table);
        });
      })->download('xls');
    }

    public function import(Request $request){
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            // echo $path;
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                  $invoice = new Invoice();
                  $invoice->no = $value->no;
                  $invoice->nominal = $value->nominal;
                  $invoice->tgl_invoice = $value->tgl_invoice;
                  $invoice->tgl_tempo = $value->tgl_tempo;
                  $invoice->tgl_do = $value->tgl_do;
                  $invoice->tgl_bayar = $value->tgl_bayar;
                  $invoice->logistik = $value->logistik;
                  $invoice->save();
                }
            } else {
              $request->session()->flash('status', 'Something wrong with your file. Go back!');
              // echo "x";
              return redirect('invoice');
            }
        } else {
          $request->session()->flash('status', 'Something wrong with your file. Go back!');
          return redirect('invoice');
          // echo "x";
        }

        return back();
    }
}
