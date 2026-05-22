<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #1f2937;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #1D4ED8;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            font-size: 28px;
            color: #1D4ED8;
            letter-spacing: 2px;
        }
        .type-badge {
            display: inline-block;
            padding: 5px 20px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 8px;
            color: #fff;
        }
        .type-badge.incoming { background: #059669; }
        .type-badge.outgoing { background: #DC2626; }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .info-table td {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
        }
        .info-table .label {
            font-weight: bold;
            background: #f3f4f6;
            width: 35%;
            color: #374151;
        }
        .info-table .value {
            color: #1f2937;
        }
        .amount {
            font-size: 22px;
            font-weight: bold;
            color: #1D4ED8;
        }
        .signature-section {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        .signature-section h3 {
            font-size: 13px;
            color: #374151;
            margin-bottom: 10px;
        }
        .signature-section img {
            max-height: 60px;
            object-fit: contain;
            border: 1px solid #e5e7eb;
            padding: 5px;
            border-radius: 4px;
        }
        .signature-section .no-sig {
            color: #9ca3af;
            font-style: italic;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 9px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>APS PROJECT</h1>
        <div class="type-badge {{ $invoice->type }}">
            {{ $invoice->type === 'incoming' ? 'INVOICE (UANG MASUK)' : 'INVOICE (UANG KELUAR)' }}
        </div>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Invoice Number</td>
            <td class="value">{{ $invoice->invoice_number }}</td>
        </tr>
        <tr>
            <td class="label">Date</td>
            <td class="value">{{ $invoice->invoice_date->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Type</td>
            <td class="value">{{ ucfirst($invoice->type) }}</td>
        </tr>
        <tr>
            <td class="label">Amount</td>
            <td class="value amount">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
        </tr>
        @if ($invoice->description)
        <tr>
            <td class="label">Description</td>
            <td class="value">{{ $invoice->description }}</td>
        </tr>
        @endif
        <tr>
            <td class="label">Created</td>
            <td class="value">{{ $invoice->created_at->format('d F Y H:i') }}</td>
        </tr>
    </table>

    <div class="signature-section">
        <h3>Signature:</h3>
        @if ($invoice->signature)
            <img src="{{ Storage::disk('public')->path($invoice->signature) }}" alt="Signature">
        @else
            <p class="no-sig">(No signature)</p>
        @endif
    </div>

    <div class="footer">
        APS PROJECT - Official Invoice &bull; Generated on {{ now()->format('d F Y H:i') }}
    </div>
</body>
</html>
