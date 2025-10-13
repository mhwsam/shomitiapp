namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index(Request $req)
    {
        $q = Member::query();
        if ($search = $req->get('q')) {
            $q->where(function($x) use ($search) {
                $x->where('full_name_bn','like',"%$search%")
                  ->orWhere('full_name_en','like',"%$search%")
                  ->orWhere('mobile','like',"%$search%")
                  ->orWhere('member_no','like',"%$search%");
            });
        }
        $members = $q->orderBy('member_no')->paginate(20)->withQueryString();
        return view('members.index', compact('members'));
    }

    public function create() { return view('members.create'); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'full_name_bn'=>'required|string|max:255',
            'mobile'=>'required|string|max:30',
            // add other fields as needed with validation rules…
        ]);
        // auto member no
        $lastId = (Member::max('id') ?? 0) + 1;
        $data['member_no'] = 'M-'.str_pad($lastId,4,'0',STR_PAD_LEFT);

        if ($r->hasFile('photo')) {
            $data['photo_path'] = $r->file('photo')->store('members','public');
        }

        $member = Member::create($data);
        return redirect()->route('members.show', $member)->with('ok','Member created');
    }

    public function show(Member $member) { return view('members.show', compact('member')); }

    public function edit(Member $member) { return view('members.edit', compact('member')); }

    public function update(Request $r, Member $member)
    {
        $data = $r->validate([
            'full_name_bn'=>'required|string|max:255',
            'mobile'=>'required|string|max:30',
            // …
        ]);
        if ($r->hasFile('photo')) {
            $data['photo_path'] = $r->file('photo')->store('members','public');
        }
        $member->update($data);
        return back()->with('ok','Member updated');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('ok','Member deleted');
    }
}
