<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingSeeder extends Seeder
{
    public function run()
    {
        DB::table('app_setting')->insert([
            ['key' => 'site_name', 'value' => 'My Application'],
            ['key' => 'admin_email', 'value' => 'admin@example.com'],
        ]);
    }
}
