<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Member, Payment, Setting};
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CollectionController extends Controller
{
    public function create(Request $r)
    {
        $members = Member::active()
            ->orderBy('member_no')
            ->get(['id', 'member_no', 'full_name_bn', 'full_name_en']);
        $year  = (int)($r->year ?? now()->year);
        $month = (int)($r->month ?? now()->month);
        $defaultDue = (int) Setting::get('monthly_fee_default', 200);

        return view('collections.create', compact('members','year','month','defaultDue'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'member_id' => ['required','exists:members,id'],
            'year'      => ['required','integer','min:2000','max:2100'],
            'month'     => ['required','integer','min:1','max:12'],
            'amount_due'=> ['required','integer','min:0'],
            'amount_paid'=>['required','integer','min:0'],
            'method'    => ['nullable', Rule::in(['Cash','bKash','Nagad','Bank'])],
            'reference_no' => ['nullable','string','max:100']
        ]);

        $payment = Payment::updateOrCreate(
            ['member_id'=>$data['member_id'], 'year'=>$data['year'], 'month'=>$data['month']],
            [
                'amount_due'=>$data['amount_due'],
                'amount_paid'=>$data['amount_paid'],
                'method'=>$data['method'] ?? null,
                'reference_no'=>$data['reference_no'] ?? null,
                'paid_on'=> now(),
                'collected_by'=>auth()->id(),
            ]
        );

        return redirect()
            ->route('collections.create')
            ->with('ok', 'Payment recorded successfully. Download the receipt below.')
            ->with('receipt_url', route('collections.receipt.download', $payment));
    }

    public function showReceipt(Payment $payment)
    {
        return view('collections.receipt', $this->receiptContext($payment));
    }

    public function downloadReceipt(Payment $payment)
    {
        $context = $this->receiptContext($payment);

        $pdf = Pdf::loadView('collections.receipt-pdf', $context)
            ->setPaper('a5', 'portrait');

        $fileName = sprintf('receipt-%s.pdf', str_pad((string) $payment->id, 5, '0', STR_PAD_LEFT));

        return $pdf->download($fileName);
    }

    protected function receiptContext(Payment $payment): array
    {
        $payment->loadMissing(['member', 'collector']);

        return [
            'payment' => $payment,
            'period' => Carbon::createFromDate($payment->year, $payment->month, 1)->format('F Y'),
            'committeeName' => Setting::get('committee_name', 'Shomiti Admin'),
            'currency' => Setting::get('currency', 'BDT'),
            'generatedAt' => now(),
        ];
    }
}
