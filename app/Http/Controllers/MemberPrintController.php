namespace App\Http\Controllers;

use App\Models\Member;

class MemberPrintController extends Controller
{
    public function show(Member $member)
    {
        // This view wraps YOUR provided HTML print form and fills member fields.
        return view('print.member_form', compact('member'));
    }
}
