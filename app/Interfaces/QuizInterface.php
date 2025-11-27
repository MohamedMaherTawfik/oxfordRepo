<?php

namespace App\Interfaces;

interface QuizesInterface
{
    public function getQuizes($id);
    public function getQuiz($id);
    public function createQuizes($data,$id);
    public function updateQuizes($data,$id);
    public function deleteQuizes($id);
}
