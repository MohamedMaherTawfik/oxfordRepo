<?php

namespace App\Interfaces;

interface QuestionInterface
{
    public function allQuestions($id);
    public function getQuestion($id);
    public function storeQuestion(array $data, $id);
    public function updateQuestion(array $data,$id);
    public function deleteQuestion($id);
}
