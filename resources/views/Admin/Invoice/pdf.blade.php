<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        @page {
            margin: 120px 50px 80px;
            /* Top, Right, Bottom, Left */
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header {
            position: fixed;
            top: -120px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
        }

        .header img {
            width: 100%;
            height: auto;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: -100px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
        }

        .footer img {
            width: 100%;
            height: auto;
        }

        /* Content */
        .content {
            margin-top: 20px;
        }

        .invoice-info {
            text-align: right;
            margin-bottom: 20px;
        }

        .invoice-info h1 {
            font-size: 24px;
            margin: 0;
            color: #b89222;
        }

        .invoice-info p {
            margin: 2px 0;
            font-size: 12px;
        }

        .client-info {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
            text-align: right;
        }

        .payment-info {
            margin-top: 20px;
            font-size: 12px;
            line-height: 1.5;
        }

        .signature {
            margin-top: 20px;
            font-size: 12px;
            text-align: left;
        }

        .signature img {
            height: 50px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('pdfquo/header.png') }}" alt="Header Image">
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('pdfquo/footer.png') }}" alt="Footer Image">
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Invoice Information -->
        <div class="invoice-info">
            <h1>INVOICE</h1>
            <p>Number: {{ $piNumberFormatted }}</p>
            <p>Date: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y') }}</p>
        </div>

        <!-- Client Information -->
        <div class="client-info">
            <p><strong>Billed To:</strong></p>
            <p><strong>{{ $vendor_name }}</strong></p>
            <p>{{ $vendor_address }}</p>
            <p>Phone: {{ $vendor_phone }}</p>
        </div>

        <!-- Invoice Description -->
        <p>Dear :{{ $vendor_name }}</p>
        <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Simplay Abyakta Mediatek submits the following invoice:
        </p>

        <!-- Product Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>Satuan</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->proformaInvoice->purchaseOrder->quotation->quotationProducts as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $product->equipment_name }}
                            @if ($invoice->type === 'dp')
                                <br>
                                <small><em>(Uang muka: 
                                    {{ number_format(($invoice->proformaInvoice->dp / $invoice->proformaInvoice->grand_total_include_ppn) * 100, 2) }}%)</em></small>
                            @elseif ($invoice->type === 'next_payment')
                                <br>
                                <small><em>(Pembayaran termin 
                                    {{ $invoice->proformaInvoice->payments_completed }} dari {{ $invoice->proformaInvoice->installments }} termin 
                                    - Persentase: {{ number_format(($invoice->percentage), 2) }}%)</em></small>
                            @endif
                        </td>
                        
                        
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->merk_type }}</td>
                        <td>{{ number_format($product->unit_price, 2) }}</td>
                    </tr>
                @endforeach

                <!-- Row untuk Subtotal, PPN, dan Grand Total -->
                <tr class="total-row">
                    <td colspan="4">Sub Total</td>
                    <td>{{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4">PPN</td>
                    <td>{{ number_format($invoice->ppn, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4"><strong>Grand Total Include PPN</strong></td>
                    <td><strong>{{ number_format($invoice->grand_total_include_ppn, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Information -->
        <div class="payment-info">
            <p><strong>Please make payments to:</strong></p>
            <p>PT. Simplay Abyakta Mediatek</p>
            <p>E-mail: info@simplay.co.id</p>
            <p>Phone: 021 - 22097542</p>
            <p>Jalan Raya Pondok Gede nomor 81 B, Kel. Lubang Buaya, Kec. Cipayung, Jakarta Timur, DKI Jakarta - 13810</p>
        </div>

        <div class="signature">
            <p>Kind Regards,</p>
            <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
        </div>
    </div>

    <div class="footer">
        <p>PT. Simplay Abyakta Mediatek, Rajawali Selatan Raya Blok A No.33, Jakarta 10720</p>
        <p>Email: <a href="mailto:info@simplay.co.id">info@simplay.co.id</a>, Phone: (021) 22097542</p>
    </div>
</body>

</html>
