<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        @page {
            size: A4;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 0 20px;
        }

        .header img {
            width: 120px;
            height: auto;
        }

        .invoice-info {
            text-align: right;
        }

        .invoice-info h1 {
            font-size: 16px;
            color: #b89222;
            margin: 0;
        }

        .content {
            margin: 0 20px;
        }

        .client-info p {
            margin: 2px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total-row {
            font-weight: bold;
        }

        .payment-info {
            margin-top: 10px;
            font-size: 9px;
        }

        .signature {
            margin-top: 10px;
            font-size: 9px;
        }

        .footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 8px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('pdfquo/header.png') }}" alt="Company Logo">
        </div>
        <div class="invoice-info">
            <h1>INVOICE</h1>
            <p><strong>Number:</strong> {{ $piNumberFormatted }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y') }}</p>
        </div>
    </div>

    <div class="content">
        <div class="client-info">
            <p><strong>Billed To:</strong></p>
            <p><strong>{{ $vendor_name }}</strong></p>
            <p>{{ $vendor_address }}</p>
            <p>Phone: {{ $vendor_phone }}</p>
        </div>

        <p>Dear {{ $vendor_name }},</p>
        <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Simplay Abyakta Mediatek submits the following invoice:</p>

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>Satuan</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->proformaInvoice->purchaseOrder->quotation->quotationProducts as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->equipment_name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->merk_type }}</td>
                        <td>{{ number_format($product->unit_price, 2) }}</td>
                        <td>{{ number_format($product->total_price, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="5">Sub Total</td>
                    <td>{{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="5">PPN</td>
                    <td>{{ number_format($invoice->ppn, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="5"><strong>Grand Total Include PPN</strong></td>
                    <td><strong>{{ number_format($invoice->grand_total_include_ppn, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

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
