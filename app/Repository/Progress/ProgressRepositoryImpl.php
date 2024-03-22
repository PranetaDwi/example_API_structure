<?php
namespace App\Repository\Progress;

use App\Models\Progress;

class ProgressRepositoryImpl implements ProgressRepository
{

    public function findById($id)
    {
        return Progress::findOrFail($id);
    }

    public function findByProjectProgressId($projectProgressId)
    {
        return Progress::where('project_progress_id', $projectProgressId)->get();
    }

    public function save($data)
    {
        return Progress::create($data);
    }

    public function update($id, $data)
    {
        Progress::where('id', $id)->update($data);
        return Progress::find($id);
    }

    public function delete($id){
        return Progress::findOrFail($id)->delete();
    }

}