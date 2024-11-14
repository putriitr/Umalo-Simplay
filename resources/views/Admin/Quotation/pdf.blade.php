<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quotation #{{ $quotation->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1, h2, h3 {
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Quotation #{{ $quotation->id }}</h1>
    <!-- Distributor and Contact Information -->
    <p><strong>Distributor:</strong> {{ $quotation->user->name ?? 'N/A' }}</p>
    <p><strong>Company Name:</strong> {{ $quotation->user->nama_perusahaan ?? 'N/A' }}</p>
    <p><strong>Contact Person:</strong> {{ $quotation->recipient_contact_person ?? 'N/A' }}</p>
    <p><strong>Quotation Number:</strong> {{ $quotation->quotation_number ?? 'N/A' }}</p>
    <p><strong>Quotation Date:</strong> {{ \Carbon\Carbon::parse($quotation->quotation_date)->format('d M Y') }}</p>
    <!-- Product Details -->
    <h3>Equipment Details</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name of Equipment</th>
                <th>Merk Type</th>
                <th>QTY</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotation->quotationProducts as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->equipment_name ?? 'N/A' }}</td>
                    <td>{{ $product->merk_type ?? 'N/A' }}</td>
                    <td>{{ $product->quantity ?? 0 }}</td>
                    <td>{{ number_format($product->unit_price, 2) }}</td>
                    <td>{{ number_format($product->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Price Calculations -->
    <div class="total-section">
        <p><strong>Sub Total Price:</strong> {{ number_format($quotation->subtotal_price, 2) }}</p>
        <p><strong>Discount (%):</strong> {{ $quotation->discount ?? 0 }}%</p>
        <p><strong>Sub Total II (After Discount):</strong> {{ number_format($quotation->total_after_discount, 2) }}</p>
        <p><strong>PPN (%):</strong> {{ $quotation->ppn ?? 10 }}%</p>
        <p><strong>Grand Total:</strong> {{ number_format($quotation->grand_total, 2) }}</p>
    </div>
    <!-- Notes and Terms -->
    <div>
        <h3>Notes</h3>
        <p>{{ $quotation->notes ?? 'No additional notes.' }}</p>
        
        <h3>Terms and Conditions</h3>
        <p>{{ $quotation->terms_conditions ?? 'No specific terms and conditions.' }}</p>
    </div>
    <!-- Signature Information -->
    <div>
        <h3>Signature Information</h3>
        <p><strong>Signer Name:</strong> {{ $quotation->authorized_person_name ?? 'N/A' }}</p>
        <p><strong>Signer Position:</strong> {{ $quotation->authorized_person_position ?? 'N/A' }}</p>
    </div>
</body>
</html>