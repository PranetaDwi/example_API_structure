<?php

namespace App\Service\Monitoring\Project\User;


interface UserMonitoringService
{
    public function getProjectProgressLists();

    public function getProgressPage($projectProgressId);

    public function getDetailProgress($progressId);
}