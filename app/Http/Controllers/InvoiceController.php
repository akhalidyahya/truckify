<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;

use App\Invoice;

class InvoiceController extends Controller
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
          return view('pages/invoice');
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
        'no' => $request['no'],
        'nominal' => $request['nominal'],
        'tgl_invoice' => $request['tgl_invoice'],
        'tgl_tempo' => $request['tgl_tempo'],
        'tgl_do' => $request['tgl_do'],
        'tgl_bayar' => $request['tgl_bayar'],
        'logistik' => $request['logistik'],
        'status' => $request['status']
      ];

      Invoice::create($data);
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
        return Invoice::find($id);
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
        $invoice = Invoice::find($id);

        $invoice->no = $request['no'];
        $invoice->nominal = $request['nominal'];
        $invoice->tgl_invoice = $request['tgl_invoice'];
        $invoice->tgl_tempo = $request['tgl_tempo'];
        $invoice->tgl_do = $request['tgl_do'];
        $invoice->tgl_bayar = $request['tgl_bayar'];
        $invoice->logistik = $request['logistik'];
        $invoice->status = $request['status'];

        $invoice->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::destroy($id);
    }

    public function apiinvoice(){
      $invoice = Invoice::all();

      return DataTables::of($invoice)
        ->addColumn('status_bayar',function($invoice) {
          if ($invoice->status == 'sudah') {
            $class = 'label-success';
          } else {
            $class = 'label-danger';
          }
          return '<span class="label '.$class.'">'.$invoice->status.'</span>';
        })
        ->addColumn('aksi',function($invoice) {
          return '<a onclick="editInvoice('.$invoice->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteInvoice('.$invoice->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }

    public function export(){
      $data = Invoice::select('no','nominal','tgl_invoice','tgl_tempo','tgl_do','tgl_bayar','logistik')->get();
      return Excel::create('Data Invoice',function($excel) use ($data) {
        $excel->sheet('mySheet',function($sheet)use($data){
          $sheet->fromArray($data);
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
