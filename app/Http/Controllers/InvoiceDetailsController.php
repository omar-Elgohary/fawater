<?php
namespace App\Http\Controllers;
use App\Models\Invoices;
use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    public function show($id)
    {
        $invoices = Invoices::where('id' , $id)->first();
        $details = invoices_details::where('id_Invoice' , $id)->get();
        $attachments = invoice_attachments::where('invoice_id' , $id)->get();
        return view('invoices.details_invoice' , compact('invoices' , 'details' , 'attachments'));
    }



    public function destroy(Request $request)
    {
        $attachments = invoice_attachments::find($request->id_file)->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete' , 'تم حذف المرفق بنجاح');
        return back();
    }


    public function View_file($invoice_number , $file_name)
    {
        return Storage::disk('public_uploads')->files($invoice_number.'/'.$file_name);
    }


    public function download_file($invoice_number , $file_name)
    {
        return Storage::disk('public_uploads')->download($invoice_number.'/'.$file_name);
    }
}
