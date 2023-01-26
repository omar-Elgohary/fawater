<?php
namespace App\Notifications;
use App\Models\Invoices;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoices;

    public function __construct(Invoices $invoices)
    {
        $this->invoices = $invoices;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->invoices->id,
            'title' =>'تم اضافة فاتورة جديد بواسطة :',
            'user' => Auth::user()->name,
        ];
    }
}
