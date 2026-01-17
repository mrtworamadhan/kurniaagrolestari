<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $order->invoice_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        .header { width: 100%; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #2d3748; }
        .company-info { text-align: right; font-size: 12px; color: #718096; }
        
        .details-box { width: 100%; margin-bottom: 30px; }
        .client-info { float: left; width: 50%; }
        .invoice-info { float: right; width: 40%; text-align: right; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f7fafc; border-bottom: 1px solid #e2e8f0; padding: 10px; text-align: left; font-weight: bold; }
        td { border-bottom: 1px solid #e2e8f0; padding: 10px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .totals { width: 40%; float: right; margin-top: 20px; }
        .totals-row { padding: 5px 0; border-bottom: 1px solid #eee; }
        .totals-row.final {font-weight: bold; font-size: 16px; margin-top: 10px; }
        
        .badge { padding: 5px 10px; border-radius: 4px; color: white; font-size: 12px; font-weight: bold; }
        .bg-paid { background-color: #48bb78; } /* Hijau */
        .bg-unpaid { background-color: #f56565; } /* Merah */
        .bg-partial { background-color: #ed8936; } /* Orange */

        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #a0aec0; border-top: 1px solid #eee; padding-top: 20px; }
        
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>

    <div class="header clearfix">
        <div style="float: left; width: 55%;">

            <img src="{{ public_path('images/logoKAL.png') }}"
                style="
                    width: 80px;
                    margin-bottom: 6px;
                ">

            <div class="logo">{{ $company['name'] }}</div>

        </div>


        <div class="company-info" style="float: right; width: 45%;">
            {{ $company['address'] }}<br>
            {{ $company['phone'] }}<br>
            {{ $company['email'] }}
        </div>
    </div>


    <div class="details-box clearfix">
        <div class="client-info">
            <strong>Kepada Yth:</strong><br>
            {{ $order->user->name }}<br>
            <span style="color: #718096;">
                {{ $order->user->address ?? 'Alamat belum diisi' }}<br>
                {{ $order->user->phone ?? '-' }}<br>
                ({{ ucfirst($order->user->customer_group) }})
            </span>
        </div>
        <div class="invoice-info">
            <strong>INVOICE</strong><br>
            <span style="font-size: 16px;">{{ $order->invoice_number }}</span><br>
            <br>
            Tanggal: {{ $order->created_at->format('d M Y') }}<br>
            @if($order->payment_method === 'tempo')
                Jatuh Tempo: {{ $order->due_date ? $order->due_date->format('d M Y') : '-' }}<br>
            @endif
            Status: 
            @if($order->payment_status == 'paid') <span class="badge bg-paid">LUNAS</span>
            @elseif($order->payment_status == 'partial') <span class="badge bg-partial">CICILAN</span>
            @else <span class="badge bg-unpaid">BELUM BAYAR</span>
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Produk</th>
                <th class="text-right">Harga</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    {{ $item->product->name }}
                    <br><span style="font-size: 10px; color: #718096;">{{ $item->product->unit }}</span>
                </td>
                <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="clearfix">
        <div class="totals">
            <div class="totals-row clearfix">
                <span style="float: left;">Subtotal</span>
                <span style="float: right;">Rp {{ number_format($order->total_amount + $order->discount_amount, 0, ',', '.') }}</span>
            </div>
            @if($order->discount_amount > 0)
            <div class="totals-row clearfix" style="color: red;">
                <span style="float: left;">Diskon</span>
                <span style="float: right;">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="totals-row final clearfix">
                <span style="float: left;">Total Tagihan</span>
                <span style="float: right;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
            
            <div style="margin-top: 15px; border-top: 1px dashed #ccc; padding-top: 10px;">
                <div class="totals-row clearfix" style="margin-bottom: 5px;">
                    <span style="float: left;">Sudah Dibayar</span>
                    <span style="float: right; color: green;">Rp {{ number_format($order->paid_amount, 0, ',', '.') }}</span>
                </div>
                <div class="totals-row clearfix" style="font-weight: bold; color: {{ ($order->total_amount - $order->paid_amount) > 0 ? '#c53030' : 'green' }}">
                    <span style="float: left;">Sisa Tagihan</span>
                    <span style="float: right;">Rp {{ number_format($order->total_amount - $order->paid_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px; width: 100%;">
        <p style="
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #374151;
        ">
            Pembayaran melalui transfer dapat dilakukan ke nomor rekening berikut:
        </p>
        @forelse($banks as $bank)
            <div style="
                    margin-bottom: 8px;
                    padding: 8px;
                    border: 1px solid #e5e7eb;
                    background: #f9fafb;
                    border-radius: 6px;
                    width: 35%;
                ">
                <div style="display: flex; align-items: center; gap: 8px;">

                    <div>
                        @if($bank->logo)
                            <img src="{{ public_path('storage/' . $bank->logo) }}" style="max-width: 24px; max-height: 22px;">
                        @else
                            <span style="font-size: 8px; font-weight: bold;">
                                {{ strtoupper(substr($bank->bank_name, 0, 3)) }}
                            </span>
                        @endif
                    </div>

                    <div style="flex: 1;">
                        <div style="font-size: 8px; color: #6b7280; font-weight: bold;">
                            {{ strtoupper($bank->bank_name) }}
                        </div>

                        <div style="
                                font-size: 11px;
                                font-weight: bold;
                                letter-spacing: 1px;
                                font-family: monospace;
                                color: #111827;
                            ">
                            {{ $bank->account_number }}
                        </div>

                        <div style="font-size: 8px; color: #6b7280;">
                            a.n {{ $bank->account_holder }}
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <p style="font-size: 9px; color: #9ca3af; font-style: italic;">
                Hubungi admin untuk data rekening.
            </p>
        @endforelse
        <p style="
            margin-top: 6px;
            font-size: 9px;
            color: #6b7280;
        ">
            Konfirmasi dengan menyertakan bukti pembayaran kepada admin setelah melakukan transfer.
        </p>
    </div>


    <div class="footer">
        Dicetak otomatis oleh Sistem {{ now()->format('d M Y H:i') }}
    </div>

</body>
</html>