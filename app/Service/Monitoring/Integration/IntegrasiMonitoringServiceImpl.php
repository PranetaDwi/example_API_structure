<?php

namespace App\Service\Monitoring\Integration;

use App\Http\Requests\Monitoring\Integration\IntegrasiMonitoringRequest;
use App\Http\Responses\ApiResponse;
use App\Repository\Monitoring\MonitoringRepository;
use App\Repository\Unit\UnitRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailMonitoring;

class IntegrasiMonitoringServiceImpl implements IntegrasiMonitoringService
{
    protected $monitoringRepository;
    protected $unitRepository;

    public function __construct(MonitoringRepository $monitoringRepository, UnitRepository $unitRepository)
    {
        $this->monitoringRepository = $monitoringRepository;
        $this->unitRepository = $unitRepository;
    }

    public function register(IntegrasiMonitoringRequest $request)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();

        try {
            $fullName = $request->input('last_name') == null ? $request->input('first_name') : $request->input('first_name').' '.$request->input('last_name');
            $validatedData['full_name'] = $fullName;
            $user = $this->monitoringRepository->saveUser($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();

            return new ApiResponse('error', 'Something went wrong', null, 500);
        }

        try {
            if ($request->hasFile('picture_profile_file')) {
                $picture_profile_file = handleSaveUserProfilePicture($request->file('picture_profile_file'), $request->input('full_name'));
                $validatedData['picture_profile_file'] = $picture_profile_file;
            } else {
                $validatedData['picture_profile_file'] = asset('data/image/users/default.png');
            }
            $validatedData['user_id'] = $user->id;
            $userData = $this->monitoringRepository->saveDataUser($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();

            return new ApiResponse('error', 'Something went wrong1', null, 500);
        }

        try {
            $unitCode = $request->input('unit_code');
            $unitProject = $this->unitRepository->findByUnitCode($unitCode);
        } catch (\Throwable $th) {
            DB::rollBack();

            return new ApiResponse('error', 'Something went wrong2', null, 500);
        }

        try {
            $dataProject = $this->monitoringRepository->saveProjectProgress(
                get_object_vars((object) [
                    'buyer_id' => $user->account_id, 
                    "developer_id" => $unitProject->project->developer->user->account_id, // tapi ini kan pake account_id, bukan id_user..... bisa ga kalo $project->developer->user->account_id???
                    "title" => $unitProject->title,
                    "buyer_name" => $userData->full_name,
                    "developer_name" => $unitProject->project->developer->userData->full_name, // ngambil dari 
                    "buyer_phone" => $userData->phone,
                    "developer_phone" => $unitProject->project->developer->userData->phone,
                    "address" => $unitProject->project->address,
                    "province" => $unitProject->project->province,
                    "district" => $unitProject->project->district,
                    "city" => $unitProject->project->city,
                    "status" => "Waiting",
                    "picture_file" => $unitProject->unitPhotos()->first()->filename,
                    "price" => $unitProject->price,
                ]
            ));
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return new ApiResponse('error', 'Something went wrong3: ' . $th->getMessage(), null, 500);
        }

        DB::commit();

        $content = [
            'name' => $userData->full_name,
            'email' => $user->email,
            'password' => $request->password,
            'phone' => $userData->phone,
            'subject' => "Berhasil Register",
        ];


        Mail::to($content['email'])->send(new SendEmailMonitoring($content));

        $data = [
            'user' => $user,
            'user_data' => $userData,
            'project_progress' => $dataProject
        ];

        return new ApiResponse('success', 'successfully register', $data);
    }
}
