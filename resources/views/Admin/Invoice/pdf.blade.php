<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        /* Style your PDF as per the template you provided */
    </style>
</head>
<body>
    <h1>INVOICE</h1>
    <p><strong>Number:</strong> {{ $invoice->invoice_number }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y') }}</p>
    <p>Billed To:</p>
    <p><strong>{{ $vendor_name }}</strong><br>
       {{ $vendor_address }}<br>
       {{ $vendor_phone }}</p>
    <p>Dear Vendor,</p>
    <p>Based on Purchase Order #{{ $invoice->purchaseOrder->po_number }}, PT. Arkamaya Guna Saharsa submit the invoice:</p>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>No.</th>
            <th>Description</th>
            <th>QTY</th>
            <th>Satuan</th>
            <th>Unit Price</th>
        </tr>
        @foreach ($invoice->proformaInvoice->purchaseOrder->quotation->quotationProducts as $index => $product)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $product->equipment_name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->merk_type }}</td>
            <td>{{ number_format($product->unit_price, 2) }}</td>
        </tr>
        @endforeach
    </table>
    <p><strong>Subtotal:</strong> {{ number_format($invoice->subtotal, 2) }}</p>
    <p><strong>PPN:</strong> {{ number_format($invoice->ppn, 2) }}</p>
    <p><strong>Grand Total Include PPN:</strong> {{ number_format($invoice->grand_total_include_ppn, 2) }}</p>
    <p>Please make payments to:<br>
       PT. Arkamaya Guna Saharsa<br>
       121-00-0022881-1<br>
       Bank Mandiri Kebon Sirih<br>
       Jl. Tanah Abang Timur No. I, RT.2/RW.3,<br>
       Gambir, Central Jakarta City, Jakarta 10110</p>
    <p>Kind Regards,<br>
       PT. Arkamaya Guna Saharsa<br>
       Agustina Panjaitan<br>
       Director</p>
</body>
</html>