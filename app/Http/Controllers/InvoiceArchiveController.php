<?php
namespace App\Http\Controllers;
use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoiceArchiveController extends Controller
{
    public function index()
    {
        $invoices = Invoices::onlyTrashed()->get();
        return view('invoices.Archive_Invoices' , compact('invoices'));
    }



    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invoices::withTrashed()->where('id' , $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }




    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invoices::withTrashed()->where('id' , $id)->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/Archive');
    }
}
