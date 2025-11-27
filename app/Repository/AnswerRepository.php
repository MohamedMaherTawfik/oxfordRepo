<?php

namespace App\Repository;

use App\interfaces\AnsewerInterface;
use App\Models\answers;

class AnswerRepository implements AnsewerInterface
{
    public function createAnsewer($data, $id)
    {
        $answer= answers::create([
            'questions_id' => $id,
            'answer' => $data['answer'],
            'is_correct' => $data['is_correct']
        ]);
        return $answer;
    }

    public function updateAnsewer($data, $id)
    {
        $answer = answers::find($id);
        $answer->update($data);
        return $answer;
    }

    public function deleteAnsewer($id)
    {
        $answer = answers::find($id);
        $answer->delete();
        return $answer;
    }

    public function allAnsewer($id)
    {
        return answers::where('questions_id', $id)->get();
    }

    public function getAnsewer($id)
    {
        return answers::find($id);
    }
}
