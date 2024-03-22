<?php

namespace App\Service\Monitoring\Project\User;

use App\Repository\ProjectProgress\ProjectProgressRepository;
use App\Repository\Progress\ProgressRepository;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserMonitoringServiceImpl implements UserMonitoringService
{

    protected $projectProgressRepository;
    protected $progressRepository;

    public function __construct(ProjectProgressRepository $projectProgressRepository, ProgressRepository $progressRepository)
    {
        $this->projectProgressRepository = $projectProgressRepository;
        $this->progressRepository = $progressRepository;

    }

    public function getProjectProgressLists()
    {
        try {
            $myProjectProgresses = $this->projectProgressRepository->findByUserAccountId(Auth::user()->account_id);
            return $myProjectProgresses;
        }catch (\Exception $exception){
            throw new Exception('Something went wrong', 500);
        }
    }

    public function getProgressPage($projectProgressId)
    {
        
        try {
            $myProgressPage = $this->projectProgressRepository->findById($projectProgressId);
            return $myProgressPage;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        }catch (\Exception $exception){
            throw new Exception('Something went wrong', 500);
        }
    }

    public function getDetailProgress($progressId)
    {
        try {
            $detailProgress = $this->progressRepository->findById($progressId);
            return $detailProgress;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong', 500);
        }

    }

}