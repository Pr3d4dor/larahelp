<?php

use App\Models\FaqQuestion;
use Illuminate\Database\Seeder;

class FaqQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(FaqQuestion::class, 5)->create();
    }
}
