<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Pengeluaran;
use App\Kendaraan;
use App\Admin;
use App\Kamadjaya;
use App\Datascript;
use App\Sogood;
use App\Storing;

class DashboardController extends Controller
{
    public function index(request $request){
       if($request->session()->has('login_status') != true) {
         return redirect('login');
       } else {
         $pengeluaranToday = Pengeluaran::where('tanggal',Carbon::today()->toDateString())->sum('total');
         $pengeluaranMonth = Pengeluaran::where( DB::raw('MONTH(tanggal)'), '=', date('n') )->sum('total');
         $kendaraan = Kendaraan::all()->count();
         $user = Admin::all()->count();
         $kamadjaya = Kamadjaya::where( DB::raw('MONTH(tanggal)'), '=', date('n') )->sum('cost');
         $datascript = Datascript::where( DB::raw('MONTH(tanggal)'), '=', date('n') )->sum('cost');
         $sogood = Sogood::where( DB::raw('MONTH(tanggal)'), '=', date('n') )->sum('cost');
         $storing = DB::table('storings')
                   ->leftjoin('kendaraans','storings.kendaraan','=','kendaraans.id')
                   ->leftjoin('mekaniks','storings.mekanik','=','mekaniks.id')
                   ->select('storings.*','kendaraans.nopol','mekaniks.nama')
                   ->limit(5)
                   ->orderBy('id','desc')
                   ->get();
        $pengeluaran_data = DB::table('pengeluarans')
                            ->select('tanggal','total')
                            ->limit(5)
                            ->orderBy('tanggal','desc')
                            ->get();

         return view('pages/dashboard',[
             'pengeluaranToday'=>$pengeluaranToday,
             'pengeluaranMonth'=>$pengeluaranMonth,
             'kendaraan'=>$kendaraan,
             'user'=>$user,
             'kamadjaya'=>$kamadjaya,
             'datascript'=>$datascript,
             'sogood'=>$sogood,
             'storing'=>$storing,
             'pengeluaran_data'=>$pengeluaran_data
         ]);
       }
    }
}
