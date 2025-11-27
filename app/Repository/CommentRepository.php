<?php

namespace App\Repository;

use App\Models\comments;
use App\Interfaces\CommentInterface;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentInterface
{
    public function getComments($id)
    {
        return comments::with(['user:id,name,photo'])
            ->where('lesson_id', $id)
            ->get();
    }

    public function getComment($id)
    {
        return comments::find($id);
    }

    public function storeComment($data, $id)
    {
        return comments::create([
            'lesson_id' => $id,
            'comment' => $data['comment'],
            'user_id' => Auth::user()->id
        ]);
    }

    public function updateComment($data, $id)
    {
        $comment = comments::find($id);
        $comment->update($data);
        return $comment;
    }

    public function deleteComment($id)
    {
        $data = comments::find($id)->delete();
        // dd($data);
        return $data;
    }
}