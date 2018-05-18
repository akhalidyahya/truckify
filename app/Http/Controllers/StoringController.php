<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;

use App\Storing;
use App\Kendaraan;
use App\Mekanik;

class StoringController extends Controller
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
          return view('pages/storing',['kendaraan'=>$kendaraan]);
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
          $request->foto->move('upload/storing', $request->foto->getClientOriginalName());
          $img = $request->foto->getClientOriginalName();
        }
        $img2="";
        if($request->hasFile('foto_bon')){
          $request->foto_bon->move('upload/storing', $request->foto_bon->getClientOriginalName());
          $img2 = $request->foto_bon->getClientOriginalName();
        }
        $data = [
          'kendaraan' => $request['kendaraan'],
          'tanggal' => $request['tanggal'],
          'jenis' => $request['jenis'],
          'biaya' => $request['biaya'],
          'mekanik' =>$request['mekanik'],
          'biaya_mekanik' => $request['biaya_mekanik'],
          'foto' => $img,
          'foto_bon' => $img2
        ];

        return Storing::create($data);
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
      $storing = Storing::find($id);
      return $storing;
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
      $storing = Storing::find($id);
      $storing->kendaraan = $request['kendaraan'];
      $storing->tanggal = $request['tanggal'];
      $storing->jenis = $request['jenis'];
      $storing->biaya = $request['biaya'];
      $storing->biaya_mekanik = $request['biaya_mekanik'];
      $storing->mekanik = $request['mekanik'];

      if($request->hasFile('foto')){
        $request->foto->move('upload/storing', $request->foto->getClientOriginalName());
        $storing->foto = $request->foto->getClientOriginalName();
      }

      if($request->hasFile('foto_bon')){
        $request->foto_bon->move('upload/storing', $request->foto_bon->getClientOriginalName());
        $storing->foto_bon = $request->foto_bon->getClientOriginalName();
      }

      $storing->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storing::destroy($id);
    }

    public function apistoring(){
      // $storing = Storing::all();
      $storing = DB::table('storings')
                ->leftjoin('kendaraans','storings.kendaraan','=','kendaraans.id')
                ->leftjoin('mekaniks','storings.mekanik','=','mekaniks.id')
                ->select('storings.*','kendaraans.nopol','mekaniks.nama')
                ->get();

      return DataTables::of($storing)
        ->addColumn('foto', function($storing){
          if($storing->foto == NULL){
            return "no photo";
          } else {
            return ' <a target="blank" href="'.asset('upload/storing/'.$storing->foto).'"><img width="50px" src="'.asset('upload/storing/'.$storing->foto).'"></a> ';
          }
        })
        ->addColumn('foto_bon', function($storing){
          if($storing->foto_bon == NULL){
            return "no photo";
          } else {
            return ' <a target="blank" href="'.asset('upload/storing/'.$storing->foto_bon).'"><img width="50px" src="'.asset('upload/storing/'.$storing->foto_bon).'"></a> ';
          }
        })
        ->addColumn('aksi',function($storing) {
          return '<a onclick="editStoring('.$storing->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteStoring('.$storing->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }

    public function export(){
      $data = DB::table('storings')
                ->leftjoin('kendaraans','storings.kendaraan','=','kendaraans.id')
                ->leftjoin('mekaniks','storings.mekanik','=','mekaniks.id')
                ->select('storings.tanggal','storings.jenis','storings.biaya','storings.biaya_mekanik','kendaraans.nopol','mekaniks.nama')
                ->get();
      $table = array_map( function($data){
          return (array) $data;
      },$data->toArray());
      return Excel::create('Data Storing',function($excel) use ($table){
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
                  $storing = new Storing();
                  $storing->kendaraan = $value->kendaraan;
                  $storing->tanggal = $value->tanggal;
                  $storing->jenis = $value->jenis;
                  $storing->biaya = $value->biaya;
                  $storing->biaya_mekanik = $value->biaya_mekanik;
                  $storing->mekanik = $value->mekanik;
                  $storing->save();
                }
            } else {
              $request->session()->flash('status', 'Something wrong with your file. Go back!');
              return redirect('storing');
            }
        } else {
          $request->session()->flash('status', 'Something wrong with your file. Go back!');
          return redirect('storing');
        }

        return back();
    }
}
