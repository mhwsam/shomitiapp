<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['key'=>'monthly_fee_default'], ['value'=>'200']);
        Setting::updateOrCreate(['key'=>'currency'], ['value'=>'BDT']);
        Setting::updateOrCreate(['key'=>'committee_name'], ['value'=>'Your Shomiti Name']);
    }
}
