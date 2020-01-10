<?php

use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(FaqCategory::class, 4)->create();
    }
}
