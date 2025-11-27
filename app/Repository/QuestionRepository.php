<?php

namespace App\Repository;

use App\Interfaces\QuestionInterface;
use App\Models\questions;

class QuestionRepository implements QuestionInterface
{
    public function allQuestions($id)
    {
        return Questions::where('quizes_id', $id)->get();
    }

    public function getQuestion($id)
    {
        return Questions::find($id);
    }

    public function storeQuestion(array $data, $id)
    {
        $question=questions::create([
            'question'=>$data['question'],
            'type'=>$data['type'],
            'quizes_id'=>$id
        ]);

        return $question;
    }

    public function updateQuestion(array $data, $id)
    {
        $question= Questions::find($id);
        $question->update($data);
        return $question;
    }

    public function deleteQuestion($id)
    {
        $question= Questions::find($id);
        $question->delete();
        return $question;
    }


}
