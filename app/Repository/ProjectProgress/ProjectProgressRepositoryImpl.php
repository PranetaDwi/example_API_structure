<?php
namespace App\Repository\ProjectProgress;

use App\Models\ProjectProgress;

class ProjectProgressRepositoryImpl implements ProjectProgressRepository
{

    public function findById($id)
    {
        return ProjectProgress::findOrFail($id);
    }
    public function findByUserAccountId($userAccountId)
    {
        return ProjectProgress::where('buyer_id', $userAccountId)->get();
    }

    public function findByDeveloperAccountId($developerAccountId)
    {
        return ProjectProgress::where('developer_id', $developerAccountId)->get();
    }

    public function save($data)
    {
        return ProjectProgress::create($data);
    }

    public function updateById($id, $data)
    {
        ProjectProgress::where('id', $id)->update($data);
        return ProjectProgress::find($id);
    }

    public function deleteById($id)
    {
        return ProjectProgress::destroy($id);
    }
}