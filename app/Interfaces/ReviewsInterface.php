<?php

namespace App\Interfaces;

interface ReviewsInterface
{
    public function allReviewsPerCourse($courseId);
    public function makeReview($rating, $courseId);
}
