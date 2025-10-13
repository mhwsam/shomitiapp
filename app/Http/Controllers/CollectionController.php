namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Member, Payment, Setting};
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CollectionController extends Controller
{
    public function create(Request $r)
    {
        $members = Member::orderBy('member_no')->get(['id','member_no','full_name_bn','full_name_en']);
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

        return redirect()->route('dashboard')->with('ok','Payment recorded.');
    }
}
