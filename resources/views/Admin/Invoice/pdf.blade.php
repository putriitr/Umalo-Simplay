<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: right;
            font-weight: bold;
            color: #b89222;
            margin-bottom: 20px;
        }
        .invoice-title {
            font-size: 24px;
            text-align: center;
            color: #b89222;
        }
        .client-info {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: left;
        }
        .total-row {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="invoice-title">INVOICE</h1>
        <p>Number: {{ $piNumberFormatted }}</p>
        <p>Date: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y') }}</p>
    </div>

    <div class="client-info">
        <p><strong>Billed To:</strong></p>
        <p><strong>{{ $vendor_name }}</strong></p>
    <p>{{ $vendor_address }}</p>
    <p>Phone: {{ $vendor_phone }}</p>
    </div>

    <p>Dear Vendor,</p>
    <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Simplay Abyakta Mediatek submits the following invoice:</p>

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
                <td>{{ $product->equipment_name }}</td>
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

    <div class="footer">
        <p>Please make payments to:</p>
        <p>PT. Simplay Abyakta Mediatek</p>
        <p>(021) 22097542</p>
        <p>+62 821-69998-0001</p>
        <p>Rajawali Selatan Raya Blok A No.33 Gunung Sahari Utara Sawah Besar Kota Adm. Jakarta Pusat DKI Jakarta 10720</p>
        <br>
        <p>Kind Regards,</p>
        <p>PT. Simplay Abyakta Mediatek</p>
        <br>
        <br>
    </div>
</body>
</html>
