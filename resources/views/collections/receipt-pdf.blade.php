<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Monthly Collection Receipt</title>
  <style>
    * { box-sizing: border-box; }
    body {
      font-family: "DejaVu Sans", Arial, sans-serif;
      font-size: 12px;
      color: #1f2937;
      margin: 0;
      padding: 24px;
      background-color: #f8fafc;
    }
    .receipt {
      max-width: 520px;
      margin: 0 auto;
      padding: 24px;
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
    }
    .header {
      text-align: center;
      margin-bottom: 16px;
    }
    .header h1 {
      font-size: 20px;
      margin: 0;
      color: #1e293b;
    }
    .header p {
      margin: 4px 0 0;
      font-size: 12px;
      color: #475569;
    }
    .meta {
      margin-bottom: 16px;
    }
    .meta table {
      width: 100%;
      border-collapse: collapse;
    }
    .meta td {
      padding: 4px 0;
      vertical-align: top;
    }
    .section-title {
      font-weight: 600;
      margin: 16px 0 8px;
      text-transform: uppercase;
      font-size: 12px;
      color: #0f172a;
    }
    table.info-table {
      width: 100%;
      border-collapse: collapse;
    }
    table.info-table td {
      padding: 6px;
      border: 1px solid #e2e8f0;
    }
    table.info-table td.label {
      width: 40%;
      font-weight: 600;
      background-color: #f1f5f9;
    }
    .amount-row td {
      font-size: 13px;
      font-weight: 600;
    }
    .footer {
      margin-top: 20px;
      padding-top: 12px;
      border-top: 1px dashed #94a3b8;
      text-align: center;
      font-size: 11px;
      color: #64748b;
    }
  </style>
</head>
<body>
  @php
    $member = $payment->member;
    $memberName = $member?->full_name_bn ?: ($member?->full_name_en ?? 'N/A');
    $memberNo = $member?->member_no ?? 'N/A';
    $collectorName = $payment->collector?->name ?? 'System';
    $paidOn = optional($payment->paid_on)->format('d M Y h:i A');
    $receiptNumber = 'RCPT-' . str_pad((string) $payment->id, 5, '0', STR_PAD_LEFT);
  @endphp

  <div class="receipt">
    <div class="header">
      <h1>{{ $committeeName }}</h1>
      <p>Monthly Collection Receipt</p>
    </div>

    <div class="meta">
      <table>
        <tr>
          <td><strong>Receipt #:</strong> {{ $receiptNumber }}</td>
          <td style="text-align: right;"><strong>Date:</strong> {{ $paidOn ?: $generatedAt->format('d M Y h:i A') }}</td>
        </tr>
        <tr>
          <td><strong>Period:</strong> {{ $period }}</td>
          <td style="text-align: right;"><strong>Generated:</strong> {{ $generatedAt->format('d M Y h:i A') }}</td>
        </tr>
      </table>
    </div>

    <div class="section-title">Member</div>
    <table class="info-table">
      <tr>
        <td class="label">Member ID</td>
        <td>{{ $memberNo }}</td>
      </tr>
      <tr>
        <td class="label">Name</td>
        <td>{{ $memberName }}</td>
      </tr>
      <tr>
        <td class="label">Contact</td>
        <td>
          @if ($member)
            {{ $member->mobile ?? 'N/A' }}<br>
            {{ $member->email ?? 'N/A' }}
          @else
            N/A
          @endif
        </td>
      </tr>
    </table>

    <div class="section-title">Payment Summary</div>
    <table class="info-table">
      <tr>
        <td class="label">Amount Due</td>
        <td>{{ $currency }} {{ number_format($payment->amount_due, 2) }}</td>
      </tr>
      <tr>
        <td class="label">Amount Paid</td>
        <td>{{ $currency }} {{ number_format($payment->amount_paid, 2) }}</td>
      </tr>
      <tr>
        <td class="label">Method</td>
        <td>{{ $payment->method ?? 'N/A' }}</td>
      </tr>
      <tr>
        <td class="label">Reference</td>
        <td>{{ $payment->reference_no ?? 'N/A' }}</td>
      </tr>
      <tr class="amount-row">
        <td class="label">Status</td>
        <td>{{ $payment->status }}</td>
      </tr>
      <tr>
        <td class="label">Collected By</td>
        <td>{{ $collectorName }}</td>
      </tr>
    </table>

    <div class="footer">
      {{ $committeeName }} &mdash; Thank you for staying current with your contributions.
    </div>
  </div>
</body>
</html>
