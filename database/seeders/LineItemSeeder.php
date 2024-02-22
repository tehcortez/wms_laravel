<?php

namespace Database\Seeders;

use App\Models\LineItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineItem::factory()
            ->count(60)
            ->create();
    }
}