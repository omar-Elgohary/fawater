<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
        'file_name' => 'mimes:pdf,jpeg,png,jpg',
        ], [
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);

        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachments =  new invoice_attachments();
        $attachments->file_name = $file_name;
        $attachments->invoice_number = $request->invoice_number;
        $attachments->invoice_id = $request->invoice_id;
        $attachments->Created_by = Auth::user()->name;
        $attachments->save();

        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'. $request->invoice_number), $imageName);

        session()->flash('Add', 'تم اضافة المرفق بنجاح');
        return back();
    }


    public function show(invoice_attachments $invoice_attachments)
    {
        //
    }


    public function edit(invoice_attachments $invoice_attachments)
    {
        //
    }


    public function update(Request $request, invoice_attachments $invoice_attachments)
    {
        //
    }


    public function destroy(invoice_attachments $invoice_attachments)
    {
        //
    }
}
