namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id','year','month','amount_due','amount_paid','paid_on','method','reference_no','collected_by'
    ];

    protected $casts = [
        'paid_on' => 'datetime',
    ];

    public function member() { return $this->belongsTo(Member::class); }
    public function collector() { return $this->belongsTo(User::class, 'collected_by'); }

    public function getStatusAttribute(): string
    {
        if ($this->amount_paid >= $this->amount_due && $this->amount_due > 0) return 'PAID';
        if ($this->amount_paid > 0 && $this->amount_paid < $this->amount_due) return 'PARTIAL';
        return 'UNPAID';
    }

    public static function ym(int $y, int $m)
    {
        return static::where('year',$y)->where('month',$m);
    }
}
