<?php

use Illuminate\Database\Seeder;
use App\Models\Questions;
use App\Models\Answers;

class questions_answers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = new Questions();
        $question->question = "Wie gehts?";
        $question->save();

        $answers = new Answers();
        $answers->answer = "Gut";
        $answers->correct = 1;
        $answers->questions_id = $question->id;
        $answers->save();

        $answers = new Answers();
        $answers->answer = "Schlecht";
        $answers->correct = 0;
        $answers->questions_id = $question->id;
        $answers->save();
    }
}
