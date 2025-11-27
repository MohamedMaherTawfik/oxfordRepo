<?php

namespace App\Repository;

use App\Events\NewDataEvent;
use App\Interfaces\AssignmentInterface;
use App\Models\assignments;
use Illuminate\Support\Facades\Event;

class AssignmentRepository implements AssignmentInterface
{
    public function allAssignment($id)
    {
        return assignments::where('lesson_id', $id)->get();
    }

    public function getAssignment($id)
    {
        return assignments::find($id);
    }

    public function createAssignment($data, $id)
    {
        $assignment = assignments::create([
            'lesson_id' => $id,
            'title' => $data['title'],
            'description' => $data['description']
        ]);
        return $assignment;
    }

    public function updateAssignment($data, $id)
    {
        $assignment = assignments::find($id);
        $assignment->update($data);
        return $assignment;
    }

    public function deleteAssignment($id)
    {
        $data = assignments::find($id);
        $data->delete();
        return $data;
    }
}
