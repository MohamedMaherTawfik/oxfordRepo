<?php

namespace App\Repository;

use App\Events\NewDataEvent;
use App\Interfaces\QuizesInterface;
use App\Models\quizes;
use Illuminate\Support\Facades\Event;

class QuizRepository implements QuizesInterface
{
    public function getQuizes($id)
    {
        return quizes::where('lesson_id', $id)->get();
    }

    public function getQuiz($id)
    {
        return quizes::find($id);
    }

    public function createQuizes($data, $id)
    {
        $quiz = quizes::create([
            'title' => $data['title'],
            'lesson_id' => $id,
            'duration' => $data['duration'],
            'user_id' => auth()->user()->id
        ]);
        // Event::dispatch(new NewDataEvent($quiz) );
        return $quiz;
    }

    public function updateQuizes($data, $id)
    {
        $quiz = quizes::where('id', $id);
        $quiz->update($data);
        return $quiz;
    }

    public function deleteQuizes($id)
    {
        $quiz = quizes::find($id);
        $quiz->delete();
        return $quiz;
    }
}