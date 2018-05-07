<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;

use App\Kendaraan;

class KendaraanController extends Controller
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
        return view('pages/kendaraan');
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
        $img="";
        if($request->hasFile('foto')){
          $request->foto->move('upload/foto', $request->foto->getClientOriginalName());
          $img = $request->foto->getClientOriginalName();
        }
        $data = [
          'nopol' => $request['nopol'],
          'stnk' => $request['stnk'],
          'tahun' => $request['tahun'],
          'merk' => $request['merk'],
          'daerah' => $request['daerah'],
          'foto' => $img,
          'kir' => $request['kir'],
          'sipa' => $request['sipa'],
          'ibm' => $request['ibm'],
          'kiu' => $request['kiu']
        ];

        return Kendaraan::create($data);
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
        $kendaraan = Kendaraan::find($id);
        return $kendaraan;
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
        $kendaraan = Kendaraan::find($id);
        $kendaraan->nopol = $request['nopol'];
        $kendaraan->stnk = $request['stnk'];
        $kendaraan->tahun = $request['tahun'];
        $kendaraan->merk = $request['merk'];
        $kendaraan->daerah = $request['daerah'];
        $kendaraan->kir = $request['kir'];
        $kendaraan->sipa = $request['sipa'];
        $kendaraan->ibm = $request['ibm'];
        $kendaraan->kiu = $request['kiu'];

        if($request->hasFile('foto')){
          // if($kendaraan->foto != NULL) {
          //   unlink($kendaraan->foto);
          // }
          $request->foto->move('upload/foto', $request->foto->getClientOriginalName());
          $kendaraan->foto = $request->foto->getClientOriginalName();
        }

        $kendaraan->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kendaraan::destroy($id);
    }

    public function apikendaraan(){
      $kendaraan = Kendaraan::all();

      return DataTables::of($kendaraan)
        ->addColumn('foto', function($kendaraan){
          if($kendaraan->foto == NULL){
            return "no photo";
          } else {
            return ' <a target="blank" href="'.asset('upload/foto/'.$kendaraan->foto).'"><img width="50px" src="'.asset('upload/foto/'.$kendaraan->foto).'"></a> ';
          }
        })
        ->addColumn('aksi',function($kendaraan) {
          return '<a onclick="editKendaraan('.$kendaraan->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteKendaraan('.$kendaraan->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }

    public function export(){
      $kendaraan = Kendaraan::select('nopol','stnk','tahun','merk','daerah','kir','sipa','ibm','kiu')->get();
      return Excel::create('Data Kendaraan',function($excel) use ($kendaraan) {
        $excel->sheet('mySheet',function($sheet)use($kendaraan){
          $sheet->fromArray($kendaraan);
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
                  $kendaraan = new Kendaraan();
                  $kendaraan->nopol = $value->nopol;
                  $kendaraan->stnk = $value->stnk;
                  $kendaraan->tahun = $value->tahun;
                  $kendaraan->merk = $value->merk;
                  $kendaraan->daerah = $value->daerah;
                  // $kendaraan->foto = $value->foto;
                  $kendaraan->kir = $value->kir;
                  $kendaraan->sipa = $value->sipa;
                  $kendaraan->ibm = $value->ibm;
                  $kendaraan->kiu = $value->kiu;
                  $kendaraan->save();
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
}
