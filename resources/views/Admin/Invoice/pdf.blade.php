<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        @page {
            margin: 50px 40px 80px; /* Adjusted for better content space */
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 100%;
            max-width: 250px;
            height: auto;
        }

        /* Footer */
        .footer {
            text-align: center;
            position: absolute;
            bottom: 50px;
            width: 100%;
        }
        .footer img {
            width: 100%;
            max-width: 250px;
            height: auto;
        }

        /* Content */
        .content {
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .invoice-info {
            text-align: right;
            margin-bottom: 20px;
        }
        .invoice-info h1 {
            font-size: 30px;
            margin: 0;
            color: #b89222;
        }
        .invoice-info p {
            margin: 2px 0;
            font-size: 12px;
        }

        .client-info {
            margin-bottom: 20px;
            font-size: 12px;
        }

        .client-info p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table td {
            font-size: 12px;
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

        .payment-info p {
            margin: 5px 0;
        }

        .signature {
            margin-top: 20px;
            font-size: 12px;
            text-align: left;
        }
        .signature img {
            height: 50px;
            width: auto;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('pdfquo/header.png') }}" alt="Company Logo">
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
            <p><strong>Number:</strong> {{ $piNumberFormatted }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y') }}</p>
        </div>

        <!-- Client Information -->
        <div class="client-info">
            <p><strong>Billed To:</strong></p>
            <p><strong>{{ $vendor_name }}</strong></p>
            <p>{{ $vendor_address }}</p>
            <p>Phone: {{ $vendor_phone }}</p>
        </div>

        <!-- Invoice Description -->
        <p>Dear {{ $vendor_name }},</p>
        <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Simplay Abyakta Mediatek submits the following invoice:</p>

        <!-- Product Table -->
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

                <!-- Subtotal, PPN, Grand Total -->
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

        <!-- Payment Information -->
        <div class="payment-info">
            <p><strong>Please make payments to:</strong></p>
            <p>PT. Simplay Abyakta Mediatek</p>
            <p>E-mail: info@simplay.co.id</p>
            <p>Phone: 021 - 22097542</p>
            <p>Jalan Raya Pondok Gede nomor 81 B, Kel. Lubang Buaya, Kec. Cipayung, Jakarta Timur, DKI Jakarta - 13810</p>
        </div>

        <!-- Signature Section -->
        <div class="signature">
            <p>Kind Regards,</p>
            <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
            <br>
            <img src="{{ public_path('pdfquo/signature.png') }}" alt="Signature">
        </div>
    </div>
</body>
</html>
