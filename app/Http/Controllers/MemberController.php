<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $members = $q->orderBy('member_no')->paginate(10)->withQueryString();
        return view('members.index', compact('members'));
    }

    public function create() { return view('members.create'); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'full_name_bn'      => 'required|string|max:255',
            'full_name_en'      => 'nullable|string|max:255',
            'father_name'       => 'nullable|string|max:255',
            'mother_name'       => 'nullable|string|max:255',
            'spouse_name'       => 'nullable|string|max:255',
            'gender'            => 'nullable|in:male,female,other',
            'dob'               => 'nullable|date',
            'nid_no'            => 'nullable|string|max:255',
            'institution_name'  => 'nullable|string|max:255',
            'religion'          => 'nullable|string|max:255',
            'nationality'       => 'nullable|string|max:255',
            'blood_group'       => 'nullable|string|max:50',
            'nominee_name'      => 'nullable|string|max:255',
            'nominee_relation'  => 'nullable|string|max:255',
            'nominee_nid'       => 'nullable|string|max:255',
            'nominee_religion'  => 'nullable|string|max:255',
            'nominee_nationality'=> 'nullable|string|max:255',
            'mobile'            => 'required|string|max:30',
            'email'             => 'nullable|email|max:255',
            'occupation'        => 'nullable|string|max:255',
            'present_address'   => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'join_date'         => 'nullable|date',
            'status'            => 'nullable|in:active,inactive',
            'remarks'           => 'nullable|string',
            'photo'             => 'nullable|image|max:2048',
            'nominee_photo'     => 'nullable|image|max:2048',
        ]);
        // auto member no
        $lastId = (Member::max('id') ?? 0) + 1;
        $data['member_no'] = 'M-'.str_pad($lastId,4,'0',STR_PAD_LEFT);

        if ($r->hasFile('photo')) {
            $data['photo_path'] = $r->file('photo')->store('members','public');
        }
        if ($r->hasFile('nominee_photo')) {
            $data['nominee_photo_path'] = $r->file('nominee_photo')->store('members/nominees','public');
        }
        if (empty($data['status'])) {
            $data['status'] = 'active';
        }

        $member = Member::create($data);
        return redirect()->route('members.show', $member)->with('ok','Member created');
    }

    public function show(Request $request, Member $member)
    {
        $viewMode = $request->get('view', 'monthly');
        $yearFilter = $request->integer('year');
        $monthFilter = $request->integer('month');

        $availableYears = $member->payments()
            ->select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $monthOptions = collect(range(1, 12))->mapWithKeys(function ($month) {
            return [$month => Carbon::createFromDate(null, $month, 1)->format('F')];
        });

        if ($viewMode === 'yearly') {
            $paymentsQuery = $member->payments()
                ->selectRaw('year, SUM(amount_due) as total_due, SUM(amount_paid) as total_paid, COUNT(*) as payments_count')
                ->groupBy('year')
                ->orderByDesc('year');

            if ($yearFilter) {
                $paymentsQuery->where('year', $yearFilter);
            }

            $payments = $paymentsQuery->paginate(12)->withQueryString();
        } else {
            $paymentsQuery = $member->payments()
                ->with('collector')
                ->when($yearFilter, fn ($q) => $q->where('year', $yearFilter))
                ->when($monthFilter, fn ($q) => $q->where('month', $monthFilter))
                ->orderByDesc('paid_on')
                ->orderByDesc('year')
                ->orderByDesc('month')
                ->orderByDesc('id');

            $payments = $paymentsQuery->paginate(12)->withQueryString();
        }

        return view('members.show', compact(
            'member',
            'payments',
            'availableYears',
            'monthOptions',
            'viewMode',
            'yearFilter',
            'monthFilter'
        ));
    }

    public function details(Member $member)
    {
        return view('members.details', compact('member'));
    }

    public function edit(Member $member) { return view('members.edit', compact('member')); }

    public function update(Request $r, Member $member)
    {
        $data = $r->validate([
            'full_name_bn'      => 'required|string|max:255',
            'full_name_en'      => 'nullable|string|max:255',
            'father_name'       => 'nullable|string|max:255',
            'mother_name'       => 'nullable|string|max:255',
            'spouse_name'       => 'nullable|string|max:255',
            'gender'            => 'nullable|in:male,female,other',
            'dob'               => 'nullable|date',
            'nid_no'            => 'nullable|string|max:255',
            'institution_name'  => 'nullable|string|max:255',
            'religion'          => 'nullable|string|max:255',
            'nationality'       => 'nullable|string|max:255',
            'blood_group'       => 'nullable|string|max:50',
            'nominee_name'      => 'nullable|string|max:255',
            'nominee_relation'  => 'nullable|string|max:255',
            'nominee_nid'       => 'nullable|string|max:255',
            'nominee_religion'  => 'nullable|string|max:255',
            'nominee_nationality'=> 'nullable|string|max:255',
            'mobile'            => 'required|string|max:30',
            'email'             => 'nullable|email|max:255',
            'occupation'        => 'nullable|string|max:255',
            'present_address'   => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'join_date'         => 'nullable|date',
            'status'            => 'nullable|in:active,inactive',
            'remarks'           => 'nullable|string',
            'photo'             => 'nullable|image|max:2048',
            'nominee_photo'     => 'nullable|image|max:2048',
        ]);
        if ($r->hasFile('photo')) {
            if (!empty($member->photo_path)) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $data['photo_path'] = $r->file('photo')->store('members','public');
        }
        if ($r->hasFile('nominee_photo')) {
            if (!empty($member->nominee_photo_path)) {
                Storage::disk('public')->delete($member->nominee_photo_path);
            }
            $data['nominee_photo_path'] = $r->file('nominee_photo')->store('members/nominees','public');
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
