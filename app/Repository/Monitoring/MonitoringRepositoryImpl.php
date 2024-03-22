<?php

namespace App\Repository\Monitoring;

use App\Models\ProjectProgress;
use App\Models\User;
use App\Models\UserData;

class MonitoringRepositoryImpl implements MonitoringRepository
{
    public function saveUser($data)
    {
        return User::create($data);
    }

    public function saveDataUser($data)
    {
        return UserData::create($data);
    }

    public function saveProjectProgress($data)
    {
        return ProjectProgress::create($data);
    }
}
