<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    User::factory()->create([
      'name' => 'admin',
      'email' => 'admin@admin.com',
      'password' => bcrypt('password'),
      'user_type' => 'seeker',
    ]);

    User::factory()->create([
      'name' => 'asrofilnadib',
      'email' => 'asrofil@asrofil.com',
      'password' => bcrypt('password'),
      'user_type' => 'employer',
      'billing_ends' => Carbon::parse('2025-04-12'),
      'user_trials' => Carbon::parse('2026-01-31')
    ]);

    User::factory(8)->create();
  }
}
