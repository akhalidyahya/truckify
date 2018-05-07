<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;

use App\Pengeluaran;
use App\Storing;

class PengeluaranController extends Controller
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
          $biaya = Storing::where('tanggal',Date('Y-m-d'))->sum('biaya');
          $biaya_mekanik = Storing::where('tanggal',Date('Y-m-d'))->sum('biaya_mekanik');
          $storing = $biaya + $biaya_mekanik;

          $chart = DB::table('pengeluarans')
                    ->select(DB::raw('sum(total) as jumlah'))
                    ->groupBy(DB::raw('month(tanggal)'))
                    ->get()->toArray();
          $chart = array_column($chart,'jumlah');

          return view('pages/pengeluaran',['storing'=>$storing,'chart'=>json_encode($chart,JSON_NUMERIC_CHECK)]);
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
      return $data = ['pengeluaran'=>$pengeluaran,'storing'=>$storing,'tanggal_'=>$pengeluaran->tanggal,'action'=>'edit'];
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

    public function export(){
      $pengeluaran = Pengeluaran::select('tanggal','ujskamadjaya','ujssogood','ujsdatascript','storing','lain','total','keterangan','pemasukan')->get();
      return Excel::create('Data Pengeluaran',function($excel) use ($pengeluaran) {
        $excel->sheet('mySheet',function($sheet)use($pengeluaran){
          $sheet->fromArray($pengeluaran);
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
                  $pengeluaran = new Pengeluaran();
                  $pengeluaran->tanggal = $value->tanggal;
                  $pengeluaran->ujskamadjaya = $value->ujskamadjaya;
                  $pengeluaran->ujsdatascript = $value->ujsdatascript;
                  $pengeluaran->ujssogood = $value->ujssogood;
                  $pengeluaran->storing = $value->storing;
                  $pengeluaran->lain = $value->lain;
                  $pengeluaran->total = $value->total;
                  $pengeluaran->keterangan = $value->keterangan;
                  $pengeluaran->pemasukan = $value->pemasukan;
                  $pengeluaran->save();
                }
            } else {
              $request->session()->flash('status', 'Something wrong with your file. Go back!');
              return redirect('kendaraan');
            }
        } else {
          $request->session()->flash('status', 'Something wrong with your file. Go back!');
          return redirect('kendaraan');
        }

        return back();
    }

    public function chart(){
        $chart = DB::table('pengeluarans')
                  ->select(DB::raw('sum(total) as jumlah'))
                  ->groupBy(DB::raw('month(tanggal)'))
                  ->get();
        return response()->json($chart);

    }
}
