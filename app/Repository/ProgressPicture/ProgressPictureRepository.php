<?php
namespace App\Repository\ProgressPicture;


interface ProgressPictureRepository
{
    public function findById($id);

    public function findByProgressId($progressId);

    public function save($data);

    public function delete($id);
}