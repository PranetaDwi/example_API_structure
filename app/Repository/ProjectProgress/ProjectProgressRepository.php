<?php
namespace App\Repository\ProjectProgress;

interface ProjectProgressRepository
{
    public function findById($id);
    
    public function findByUserAccountId($userAccountId);

    public function findbyDeveloperAccountId($developerAccountId);

    public function save($data);

    public function updateById($id, $data);

    public function deleteById($id);

}