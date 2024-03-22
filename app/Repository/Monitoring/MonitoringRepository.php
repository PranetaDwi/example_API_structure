<?php

namespace App\Repository\Monitoring;

interface MonitoringRepository
{
    public function saveUser($data);

    public function saveDataUser($data);

    // public function searchUnit($unitCode);

    // public function searchProject($projectId);

    // public function searchDeveloper($developerId);

    // // add -- emang iya?
    // public function searchUser($userId);

    // public function searchUserData($userId);

    public function saveProjectProgress($data);
}
