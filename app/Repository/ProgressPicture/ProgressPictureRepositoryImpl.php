<?php
namespace App\Repository\ProgressPicture;

use App\Models\ProgressPicture;

class ProgressPictureRepositoryImpl implements ProgressPictureRepository
{

    public function findById($id){
        return ProgressPicture::findOrFail($id);
    }

    public function findByProgressId($progressId){
        return ProgressPicture::where('progress_id', $progressId)->get();
    }

    public function save($data){
        return ProgressPicture::create($data);
    }

    public function update($data, $id){
        ProgressPicture::findOrFail($id)->update($data);
        return ProgressPicture::find($id);
    }

    public function delete($id){
        return ProgressPicture::findOrFail($id)->delete();
    }

}