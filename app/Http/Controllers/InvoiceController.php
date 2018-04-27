<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
        'logistik' => $request['logistik']
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
        ->addColumn('aksi',function($invoice) {
          return '<a onclick="editInvoice('.$invoice->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteInvoice('.$invoice->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })->escapeColumns([])->make(true);
    }
}
