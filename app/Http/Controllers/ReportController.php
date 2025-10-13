namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Member, Payment, Setting};

class ReportController extends Controller
{
    public function unpaid(Request $r)
    {
        $year  = (int)($r->year ?? now()->year);
        $month = (int)($r->month ?? now()->month);
        $fee   = (int) Setting::get('monthly_fee_default', 200);

        $paidMemberIds = Payment::where('year',$year)->where('month',$month)
            ->where('amount_paid','>=',$fee)
            ->pluck('member_id');

        $members = Member::whereNotIn('id', $paidMemberIds)->orderBy('member_no')->paginate(50)->withQueryString();

        return view('reports.unpaid', compact('members','year','month','fee'));
    }

    public function monthly(Request $r)
    {
        $year  = (int)($r->year ?? now()->year);
        $month = (int)($r->month ?? now()->month);

        $payments = Payment::with('member')->where('year',$year)->where('month',$month)->orderBy('id','desc')->paginate(50)->withQueryString();
        $summary = [
            'total_due' => Payment::where('year',$year)->where('month',$month)->sum('amount_due'),
            'total_paid'=> Payment::where('year',$year)->where('month',$month)->sum('amount_paid'),
            'count'     => Payment::where('year',$year)->where('month',$month)->count(),
        ];

        return view('reports.monthly', compact('payments','summary','year','month'));
    }
}
