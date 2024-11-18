<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice #{{ $proformaInvoice->pi_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        .header {
            text-align: right;
            color: #b89222;
            font-weight: bold;
        }
        .header h1 {
            font-size: 24px;
            color: #b89222;
        }
        .header p {
            font-size: 12px;
            margin: 0;
        }
        .section-title {
            margin-top: 20px;
            font-weight: bold;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }
        .table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .right-align {
            text-align: right;
            padding-right: 10px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: left;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <h1>PROFORMA INVOICE</h1>
        <p>Number: {{ $piNumberFormatted }}</p>
        <p>Date: {{ \Carbon\Carbon::parse($proformaInvoice->pi_date)->format('F d, Y') }}</p>
    </div>

    <!-- Vendor Information -->
    <p class="section-title">Billed To:</p>
    <p><strong>{{ $vendorName }}</strong></p>
    <p>{{ $vendorAddress }}</p>
    <p>Phone: {{ $vendorPhone }}</p>

    <p>Dear Vendor,</p>
    <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Simplay Abyakta Mediatek submits the following proforma invoice:</p>

    <!-- Unified Product and Total Table -->
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

    <!-- Footer Section -->
    <p class="section-title">Term Payment:</p>
    <p>Please make payments to:</p>
    <p>PT. Simplay Abyakta Mediatek</p>
    <p>(021) 22097542</p>
    <p>+62 821-69998-0001</p>
    <p>Rajawali Selatan Raya Blok A No.33 Gunung Sahari Utara Sawah Besar Kota Adm. Jakarta Pusat DKI Jakarta 10720</p>

    <!-- Signature Section -->
    <div class="footer">
        <p>Should you require further information please do not hesitate to contact the undersigned.</p>
        <p>Kind Regards,</p>
        <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
        <br><br>
        <img src="signature.png" alt="Signature" style="height: 40px;"><br>
        <p><strong>PT. Simplay Abyakta Mediatek</strong><br>Director</p>
    </div>

</body>
</html>
