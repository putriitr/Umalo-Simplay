<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice #{{ $proformaInvoice->pi_number }}</title>
    <style>
        /* Tambahkan CSS yang diperlukan */
        body { font-family: Arial, sans-serif; }
        .header { text-align: right; font-weight: bold; color: #b89222; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; padding: 8px; text-align: center; }
        .footer { margin-top: 50px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PROFORMA INVOICE</h1>
        <p>Number: {{ $proformaInvoice->pi_number }}</p>
        <p>Date: {{ \Carbon\Carbon::parse($proformaInvoice->pi_date)->format('F d, Y') }}</p>
    </div>
    <p><strong>Billed To:</strong></p>
    <p>{{ $vendorName }}</p>
    <p>{{ $vendorAddress }}</p>
    <p>{{ $vendorPhone }}</p>
    <p>Dear Vendor,</p>
    <p>Based on Purchase Order #{{ $purchaseOrder->po_number }}, PT. Arkamaya Guna Saharsa submits the following proforma invoice:</p>
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
            @foreach($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>{{ $product['qty'] }}</td>
                    <td>{{ $product['unit'] }}</td>
                    <td>{{ number_format($product['unit_price'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table" style="margin-top: 20px;">
        <tr>
            <td colspan="4">Sub Total</td>
            <td>{{ number_format($proformaInvoice->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4">PPN</td>
            <td>{{ number_format($proformaInvoice->ppn, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4">Grand Total Include PPN</td>
            <td>{{ number_format($proformaInvoice->grand_total_include_ppn, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4">DP</td>
            <td>{{ number_format($proformaInvoice->dp, 2) }}</td>
        </tr>
    </table>
    <p class="footer">Please make payments to:</p>
    <p>PT. Simplay Abyakta Media Tek</p>
    <p>...</p>
</body>
</html>