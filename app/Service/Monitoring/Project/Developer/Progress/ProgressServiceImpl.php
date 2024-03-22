<?php

namespace App\Service\Monitoring\Project\Developer\Progress;

use App\Repository\ProjectProgress\ProjectProgressRepository;
use App\Repository\Progress\ProgressRepository;
use App\Repository\ProgressPicture\ProgressPictureRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProgressServiceImpl implements ProgressService
{
    protected $projectProgressRepository;
    protected $progressRepository;
    protected $progressPictureRepository;

    public function __construct(ProjectProgressRepository $projectProgressRepository, ProgressRepository $progressRepository, ProgressPictureRepository $progressPictureRepository)
    {
        $this->projectProgressRepository = $projectProgressRepository;
        $this->progressRepository = $progressRepository;
        $this->progressPictureRepository = $progressPictureRepository;
    }

    public function getMyProgress($projectProgressId)
    {
        try {
            $myProgress = $this->projectProgressRepository->findById($projectProgressId);

            return $myProgress;
        }catch (\Exception $exception){
            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
        }
    }

    public function postProgress($projectProgressId, Request $request)
    {
        try {
            $latestProgress = $this->progressRepository->findByProjectProgressId($projectProgressId)->last();

            $request->validate([
                'brief_description' => 'required|max:500',
                'detail_description' => 'required',
                'percentage' =>[
                    'required',
                    'numeric',
                    'between:' . ($latestProgress ? $latestProgress->percentage : 0) . ',100'],
                    'photo_file' => 'required|array|min:1',
                    'photo_file.*' => 'required|image|mimes:jpeg,png|max:2048'
            ]);

            $response = [];
                $dataProgress = [
                    'project_progress_id' => $projectProgressId,
                    'brief_description' => $request->brief_description,
                    'detail_description' => $request->detail_description,
                    'percentage' => $request->percentage,
                ];
                $response['progress'] = $this->progressRepository->save($dataProgress);

                if ($request->hasFile('photo_file')) {
                    $picture_file = [];
                    foreach ($request->file('photo_file') as $file) {
                        try {
                            $filenameWithExt = $file->getClientOriginalName();
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            $extension = $file->getClientOriginalExtension();
                            $filenameOriginal = $filename . '_' . time() . '.' . $extension;
                            $path = $file->storeAs('public/monitoring', $filenameOriginal);
                            
                            $dataPicture = [
                                'progress_id' => $response['progress']['id'],
                                'picture_file' => $filenameOriginal,
                            ];
                            
                            $picture_file[] = $this->progressPictureRepository->save($dataPicture);
        
                        } catch (\Exception $exception) {
                            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
                        }
                    }
                    $response['picture_files'] = $picture_file;
                }
            return $response;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
        }
    }

    public function editProgress($id)
    {
        try {
            $progress = $this->progressRepository->findById($id);
            $progressPictures = $this->progressPictureRepository->findByProgressId($id);
            $response = [
                'progress' => $progress,
                'progress_picture' => $progressPictures
            ];
            return $response;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
        }
    }

    public function updateProgress($id, Request $request)
    {
        try {

            $request->validate([
                'brief_description' => 'required|max:500',
                'detail_description' => 'required',
                    'photo_file' => 'nullable|array|',
                    'photo_file.*' => 'nullable|image|mimes:jpeg,png|max:2048'
            ]);

            $response = [];
            $picture_file = [];
                $dataProgress = [
                    'brief_description' => $request->brief_description,
                    'detail_description' => $request->detail_description,
                ];
                $response['progress'] = $this->progressRepository->update($id, $dataProgress);

                $dataOldPicture = $this->progressPictureRepository->findByProgressId($id);

                // butuh ga sih ini? kalo ga butuh dihapus aja
                if ($dataOldPicture != null) {
                    foreach ($dataOldPicture as $oldPicture) {
                        $picture_file[] = $oldPicture;
                    }
                }

                if ($request->hasFile('photo_file')) {
                    foreach ($request->file('photo_file') as $file) {
                        try {
                            $filenameWithExt = $file->getClientOriginalName();
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            $extension = $file->getClientOriginalExtension();
                            $filenameOriginal = $filename . '_' . time() . '.' . $extension;
                            $path = $file->storeAs('public/monitoring', $filenameOriginal);
                            
                            $dataPicture = [
                                'progress_id' => $id,
                                'picture_file' => $filenameOriginal,
                            ];
                            
                            $picture_file[] = $this->progressPictureRepository->save($dataPicture);
        
                        } catch (\Exception $exception) {
                            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
                        }
                    }
                    
                }
                $response['picture_files'] = $picture_file;
            return $response;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
        }
    }

    public function deletePicture($id)
    {
        try {
            $imagePath = $this->progressPictureRepository->findById($id);
            $picture = $this->progressPictureRepository->delete($id);
            Storage::delete('public/monitoring/' . $imagePath->picture_file);
            return $imagePath;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
        }
    }

    public function deleteProgress($id)
    {
        try {
            $imagePath = $this->progressPictureRepository->findByProgressId($id);
            $dataProgress = $this->progressRepository->findById($id);
            $pictureFile = [];
            if ($imagePath != null) {
                foreach ($imagePath as $image) {
                    $pictureFile[] = $image;
                    Storage::delete('public/monitoring/' . $image->picture_file);
                }
            }
            $this->progressRepository->delete($id);  
            $response = [
                'progress' => $dataProgress,
                'progress_pictures' => $pictureFile
            ];
            return $response;
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Data not found', 404);
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong: ' . $exception->getMessage(), 500);
        }
    }

}