<?php


namespace App\Repository;

use App\Interfaces\ReviewsInterface;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;


class ReviewRepository implements ReviewsInterface
{
    public function allReviewsPerCourse($id)
    {

    }

    public function makeReview($rating, $id)
    {
        return Reviews::create([
            'rating' => $rating,
            'courses_id' => $id,
            'user_id' => Auth::user()->id
        ]);
    }
}
