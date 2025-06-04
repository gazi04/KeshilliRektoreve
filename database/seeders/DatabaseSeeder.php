<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Conference;
use App\Models\Members;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->count(30)->create();
        Members::factory()->count(10)->create();
        Conference::factory()->count(4)->withDocuments(3)->create();
        Notification::factory()->count(8)->create();
    }
}
