<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice #{{ $proformaInvoice->pi_number }}</title>
    <style>
        @page {
            margin: 50px 40px 80px;
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
            margin-bottom: 20px;
        }

        .header img {
            width: 200px;
            height: auto;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .footer img {
            width: 200px;
            height: auto;
        }

        /* Content */
        .content {
            margin-top: 30px;
        }

        .invoice-info {
            text-align: right;
            margin-bottom: 30px;
        }

        .invoice-info h1 {
            font-size: 30px;
            color: #b89222;
        }

        .invoice-info p {
            margin: 5px 0;
            font-size: 12px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        .table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .table td {
            font-size: 12px;
        }

        .right-align {
            text-align: right;
            font-weight: bold;
        }

        .payment-terms,
        .signature {
            margin-top: 20px;
            font-size: 12px;
        }

        .payment-terms p {
            margin: 5px 0;
        }

        .signature img {
            height: 40px;
            width: auto;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('pdfquo/header.png') }}" alt="Company Logo">
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Proforma Invoice Information -->
        <div class="invoice-info">
            <h1>PROFORMA INVOICE</h1>
            <p>Number: {{ $piNumberFormatted }}</p>
            <p>Date: {{ \Carbon\Carbon::parse($proformaInvoice->pi_date)->format('F d, Y') }}</p>
        </div>

        <!-- Vendor Information -->
        <div>
            <p class="section-title">Billed To:</p>
            <p><strong>{{ $vendorName }}</strong></p>
            <p>{{ $vendorAddress }}</p>
            <p>Phone: {{ $vendorPhone }}</p>
        </div>

        <!-- Introduction -->
        <p>Dear {{ $vendorName }},</p>
        <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Simplay Abyakta Mediatek submits the following proforma invoice:</p>

        <!-- Product Table -->
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 40%;">Description</th>
                    <th style="width: 10%;">QTY</th>
                    <th style="width: 20%;">Satuan</th>
                    <th style="width: 25%;">Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product['description'] }}</td>
                        <td>{{ $product['qty'] }}</td>
                        <td>{{ $product['unit'] }}</td>
                        <td>{{ number_format($product['unit_price'], 2) }}</td>
                    </tr>
                @endforeach
                <!-- Summary Rows -->
                <tr>
                    <td colspan="4" class="right-align">Sub Total</td>
                    <td>{{ number_format($proformaInvoice->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align">PPN</td>
                    <td>{{ number_format($proformaInvoice->ppn, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align">Grand Total Include PPN</td>
                    <td>{{ number_format($proformaInvoice->grand_total_include_ppn, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align"><strong>Down Payment (DP)</strong></td>
                    <td>{{ number_format($dpPercent, 2) }}% - Rp {{ number_format($proformaInvoice->dp, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Terms -->
        <div class="payment-terms">
            <p class="section-title">Term Payment:</p>
            <p>Please make payments to:</p>
            <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
            <p>Phone: (021) 22097542</p>
            <p>Mobile: +62 821-69998-0001</p>
            <p>Address: Rajawali Selatan Raya Blok A No.33, Gunung Sahari Utara, Sawah Besar, Jakarta Pusat, DKI Jakarta 10720</p>
        </div>

        <!-- Signature Section -->
        <div class="signature">
            <p>Should you require further information, please do not hesitate to contact the undersigned.</p>
            <p>Kind Regards,</p>
            <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
            <br><br>
            <img src="signature.png" alt="Signature">
            <p><strong>PT. Simplay Abyakta Mediatek</strong><br>Director</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('pdfquo/footer.png') }}" alt="Footer Image">
    </div>
</body>

</html>
