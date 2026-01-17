<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function print(Order $order)
    {
        $order->load(['user', 'items.product', 'payments']);

        $company = [
            'name' => 'PT. Kurnia Agro Lestari',
            'address' => 'Komp Citra Graha Permai, Jl Rawa Indah, Sidomulyo Timur, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28288',
            'phone' => '+62 812 6491 5088',
            'email' => 'sales@kurniaagrolestari.com',
        ];
        
        $banks = BankAccount::where('is_active', true)->get();

        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $order,
            'company' => $company,
            'banks' => $banks,
        ]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Invoice-' . $order->invoice_number . '.pdf');
    }
}