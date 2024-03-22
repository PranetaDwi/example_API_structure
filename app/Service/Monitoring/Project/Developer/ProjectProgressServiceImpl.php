<?php

namespace App\Service\Monitoring\Project\Developer;

use App\Http\Requests\Monitoring\Project\Developer\ProjectProgressRequest;
use App\Repository\ProjectProgress\ProjectProgressRepository;
use App\Repository\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\UserData;
use App\Models\User;

class ProjectProgressServiceImpl implements ProjectProgressService
{

    protected $projectProgressRepository;
    protected $userRepository;

    public function __construct(ProjectProgressRepository $projectProgressRepository, UserRepository $userRepository)
    {
        $this->projectProgressRepository = $projectProgressRepository;
        $this->userRepository = $userRepository;

    }

    public function getProjectProgressLists()
    {
        try {
            $myProjectProgresses = $this->projectProgressRepository->findByDeveloperAccountId(Auth::user()->account_id);
            return $myProjectProgresses;
        }catch (\Exception $exception){
            throw new Exception('Something went wrong', 500);
        }
    }

    public function getBuyer()
    {
        try {
            $buyers = User::where('role', 'user')->get();
            return $buyers;
        }catch (\Exception $exception){
            throw new Exception('Something went wrong', 500);
        }
    }

    public function editSelectedProjectProgress($id)
    {
        try {
            $projectProgress= $this->projectProgressRepository->findById($id);
            return $projectProgress;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong', 500);
        }
    }

    public function postProjectProgress($userId, ProjectProgressRequest $request)
    {
        $buyerAccountId = $this->userRepository->findById($userId);
        $dataDeveloper = UserData::where("user_id", Auth::user()->id)->first();

        try {
            $data = [
            'buyer_id' => $buyerAccountId->account_id,
            'developer_id' => Auth::user()->account_id,
            'title' => $request->title,
            'buyer_name' => $request->buyer_name,
            'developer_name' => $dataDeveloper->full_name,
            'buyer_phone' => $request->buyer_phone,
            'developer_phone' => $dataDeveloper->phone,
            'address' => $request->address,
            'province' => $request->province,
            'district' => $request->district,
            'city' => $request->city,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price' => $request->price
            ];
            
            $response= $this->projectProgressRepository->save($data);

            return $response;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong', 500);
        }
    }

    public function updateProjectProgress($id, ProjectProgressRequest $request)
    {
        try {
            $data = [
            'title' => $request->title,
            'buyer_name' => $request->buyer_name,
            'buyer_phone' => $request->buyer_phone,
            'address' => $request->address,
            'province' => $request->province,
            'district' => $request->district,
            'city' => $request->city,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price' => $request->price
            ];
            $response = $this->projectProgressRepository->updateById($id, $data);
            return $response;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong', 500);
        }
    }

    public function deleteProjectProgress($id)
    {
        try {
            
            $response= $this->projectProgressRepository->findById($id);
            $this->projectProgressRepository->deleteById($id);
            return $response;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong', 500);
        }
    }

}