<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quotation Letter #{{ $quotation->quotation_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 12px; /* Menyesuaikan ukuran font */
        }

        .container {
            margin: 10px;
            padding: 10px;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header h1 {
            color: #b59123;
            font-size: 20px; /* Ukuran judul lebih kecil */
            font-weight: bold;
            margin: 5px 0;
        }

        .header img {
            width: 80px; /* Mengurangi ukuran logo */
            margin-bottom: 10px;
        }

        .content p {
            margin: 2px 0;
        }

        .highlighted {
            color: #b59123;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10px; /* Menyesuaikan ukuran font dalam tabel */
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 6px; /* Mengurangi padding dalam tabel */
            text-align: center;
        }

        table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .terms {
            font-size: 10px; /* Ukuran font lebih kecil untuk terms */
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .terms p {
            margin: 1px 0;
        }

        .signature {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }

        .footer {
            margin-top: 30px;
        }

        /* Mengatur ukuran halaman untuk PDF */
        @page {
            size: A4;
            margin: 10mm;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Company Logo">
            <h1>QUOTATION LETTER</h1>

            <?php
// Ambil singkatan dari nama perusahaan tanpa "PT" atau "CV"
$namaPerusahaan = $quotation->user->nama_perusahaan ?? 'Perusahaan';
$kataPerusahaan = explode(' ', $namaPerusahaan);

// Abaikan "PT" atau "CV" jika ada di awal nama perusahaan
if (in_array(strtoupper($kataPerusahaan[0]), ['PT', 'CV'])) {
    array_shift($kataPerusahaan);
}

// Ambil singkatan dari kata-kata yang tersisa
$singkatanNamaPerusahaan = strtoupper(implode('', array_map(function ($kata) {
    return $kata[0];
}, $kataPerusahaan)));

// Konversi tanggal ke format Romawi
$tanggal = \Carbon\Carbon::parse($quotation->quotation_date)->format('j');
$romawiMap = [
    'M' => 1000,
    'CM' => 900,
    'D' => 500,
    'CD' => 400,
    'C' => 100,
    'XC' => 90,
    'L' => 50,
    'XL' => 40,
    'X' => 10,
    'IX' => 9,
    'V' => 5,
    'IV' => 4,
    'I' => 1
];
$tanggalRomawi = '';
foreach ($romawiMap as $roman => $value) {
    while ($tanggal >= $value) {
        $tanggalRomawi .= $roman;
        $tanggal -= $value;
    }
}

// Tahun
$tahun = \Carbon\Carbon::parse($quotation->quotation_date)->format('Y');

// Format nomor referensi sesuai permintaan
$formattedNumber = sprintf(
    "%s/SPH-AGS-%s/%s/%s",
    $quotation->quotation_number,
    $singkatanNamaPerusahaan,
    $tanggalRomawi,
    $tahun
);
        ?>

            <p><strong>Number:</strong> {{ $formattedNumber }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($quotation->quotation_date)->format('F d, Y') }}</p>
        </div>

        <div class="content">
            <p><strong>To:</strong> <span class="highlighted">{{ $quotation->user->nama_perusahaan ?? 'Company Name' }}</span></p>
            <p>Dear {{ $quotation->recipient_contact_person }},</p>

            <p>With reference to your letter number <span class="highlighted">{{ $referenceNumber }}</span>, PT.
                Simplay Abyakta MediaTek is pleased to submit our quotation with the following terms & conditions:</p>

            <!-- Equipment Details Table -->
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
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
                <tfoot>
                    <tr>
                        <td colspan="5">Sub Total Price</td>
                        <td>{{ number_format($quotation->subtotal_price, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5">Discount ({{ $quotation->discount ?? 0 }}%)</td>
                        <td>-{{ number_format($quotation->subtotal_price * ($quotation->discount / 100), 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5">Sub Total II (After Discount)</td>
                        <td>{{ number_format($quotation->total_after_discount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5">PPN ({{ $quotation->ppn ?? 10 }}%)</td>
                        <td>{{ number_format($quotation->total_after_discount * ($quotation->ppn / 100), 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5"><strong>Grand Total Price</strong></td>
                        <td><strong>{{ number_format($quotation->grand_total, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
            <!-- Notes and Terms Section -->
            <div class="terms">
                <h3>Notes:</h3>
                <p>{{ $quotation->notes ?? 'No additional notes.' }}</p>

                <h3>Terms and Conditions:</h3>
                <p>{{ $quotation->terms_conditions ?? 'No specific terms and conditions.' }}</p>
            </div>
            <!-- Signature Section -->
            <div class="signature">
                <p>Kind Regards,</p>
                <p><strong>PT. Simplay Abyakta MediaTek</strong></p>
                <br><br>
                <p><img src="signature.png" alt="Signature" width="120"></p> <!-- Ukuran tanda tangan lebih kecil -->
                <p><strong>{{ $quotation->authorized_person_name ?? 'Signer Name' }}</strong></p>
                <p>{{ $quotation->authorized_person_position ?? 'Position' }}</p>
            </div>
        </div>
    </div>
</body>

</html>
