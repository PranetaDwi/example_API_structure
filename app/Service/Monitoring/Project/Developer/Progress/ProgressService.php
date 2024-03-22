<?php

namespace App\Service\Monitoring\Project\Developer\Progress;

use Illuminate\Http\Request;

interface ProgressService
{

    public function getMyProgress($projectProgressId);

    public function postProgress($projectProgressId, Request $request);

    public function editProgress($id);

    public function updateProgress($id, Request $request);

    public function deletePicture($id);

    public function deleteProgress($id);

}