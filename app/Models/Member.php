<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'member_no','full_name_bn','full_name_en','father_name','mother_name','spouse_name',
        'gender','dob','nid_no','institution_name','religion','nationality','blood_group',
        'nominee_name','nominee_relation','nominee_nid','nominee_religion','nominee_nationality',
        'mobile','email','occupation',
        'present_address','permanent_address','ward','post_office','thana','district','postal_code',
        'join_date','status','photo_path','remarks'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeActive($q) { return $q->where('status','active'); }
}
