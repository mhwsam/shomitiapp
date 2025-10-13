<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Payment, Member, Setting};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year  = (int)($request->year ?? now()->year);
        $month = (int)($request->month ?? now()->month);

        $months = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec'];
        $years  = range(now()->year-3, now()->year+1);

        $totalCollected   = Payment::sum('amount_paid');

        $lm = now()->copy()->subMonth();
        $lastMonthTotal   = Payment::where('year', $lm->year)->where('month', $lm->month)->sum('amount_paid');

        $membersCount     = Member::count();

        // unpaid count for selected month
        $monthlyFee = (int) Setting::get('monthly_fee_default', 200);
        $paidMemberIds = Payment::where('year',$year)->where('month',$month)->where('amount_paid','>=',$monthlyFee)->pluck('member_id');
        $unpaidCount = Member::whereNotIn('id', $paidMemberIds)->count();

        $recentPayments = Payment::with('member')
            ->orderByDesc('paid_on')->orderByDesc('id')
            ->take(10)->get()
            ->map(function($p){
                return [
                    'member_no'   => $p->member->member_no,
                    'member_name' => $p->member->full_name_bn ?? $p->member->full_name_en,
                    'paid_on'     => optional($p->paid_on)->toDateTimeString(),
                    'amount'      => $p->amount_paid,
                    'method'      => $p->method,
                    'month'       => $p->month,
                    'year'        => $p->year,
                ];
            })->toArray();

        // Unpaid members (quick panel)
        $unpaidMembers = Member::whereNotIn('id', $paidMemberIds)->take(20)->get()
            ->map(fn($m)=>[
                'member_no'=>$m->member_no,
                'member_name'=>$m->full_name_bn ?? $m->full_name_en,
                'mobile'=>$m->mobile,
                'due'=>$monthlyFee,
            ])->toArray();

        return view('dashboard.index', [
            'filters' => ['year'=>$year, 'month'=>$month, 'months'=>$months, 'years'=>$years],
            'stats'   => [
                'total_collected'=>$totalCollected,
                'last_month_total'=>$lastMonthTotal,
                'members_count'=>$membersCount,
                'unpaid_count'=>$unpaidCount,
            ],
            'recentPayments'=>$recentPayments,
            'unpaidMembers'=>$unpaidMembers,
        ]);
    }
}
