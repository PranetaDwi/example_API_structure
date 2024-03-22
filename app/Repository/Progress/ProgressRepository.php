<?php
namespace App\Repository\Progress;


interface ProgressRepository
{
    public function findById($id);

    public function findByProjectProgressId($projectProgressId);

    public function save($data);

    public function update($id, $data);

    public function delete($id);
}