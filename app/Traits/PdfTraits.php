<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\Settings;

trait PdfTraits
{
    public function generate_pdf(Order $order)
    {
        $settings = Settings::get()->first();
        $view = view('admin.order.order', compact('order', 'settings'));
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('factura.pdf');
    }
}
