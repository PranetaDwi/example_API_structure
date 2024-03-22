<?php

namespace App\Service\Monitoring\Project\Developer;

use App\Http\Requests\Monitoring\Project\Developer\ProjectProgressRequest;


interface ProjectProgressService
{
    public function getProjectProgressLists();

    public function getBuyer();

    public function editSelectedProjectProgress($id);

    public function postProjectProgress($userId, ProjectProgressRequest $request);

    public function updateProjectProgress($id, ProjectProgressRequest $request);

    public function deleteProjectProgress($id);

}