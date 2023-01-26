<?php
namespace App\Http\Controllers;
use App\Models\Invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350 , 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة' , 'الفواتير المدفوعة' , 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [Invoices::where('Value_Status' , 2)->count()/ Invoices::count() * 100]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [Invoices::where('Value_Status' , 1)->count()/ Invoices::count() * 100]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [Invoices::where('Value_Status' , 3)->count()/ Invoices::count() * 100]
                ],
            ])->options([
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'fontColor' => 'black',
                        'fontFamily' => 'Cairo',
                        'fontStyle' => 'bold',
                        'fontSize' => 14,
                    ]
                ]
            ]);

        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير المدفوعة', 'الفواتير الغير مدفوعة' , 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#81b214', '#ec5858' , '#ff9642'],
                    'data' => [Invoices::where('Value_Status' , 1)->count()/ Invoices::count() * 100,
                                Invoices::where('Value_Status' , 2)->count()/ Invoices::count() * 100,
                                Invoices::where('Value_Status' , 3)->count()/ Invoices::count() * 100]
                ]
            ])->options([
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'fontColor' => 'black',
                        'fontFamily' => 'Cairo',
                        'fontStyle' => 'bold',
                        'fontSize' => 14,
                    ]
                ]
            ]);

        return view('home', compact('chartjs' , 'chartjs_2'));
    }
}
