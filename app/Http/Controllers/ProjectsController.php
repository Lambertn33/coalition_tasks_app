<?php

namespace App\Http\Controllers;

use App\Interfaces\ProjectRepositoryInterface;
use App\Services\ProjectsService;
use App\Services\ResponsesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    private ProjectRepositoryInterface $projectRepository;
    
    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    public function index()
    {
        return (new ProjectsService($this->projectRepository))->getAllProjects();
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $response = [];
            $name = $request->name;
            $newProjectData = [
                'id' => Str::uuid()->toString(),
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now()
            ];
            (new ProjectsService($this->projectRepository))->createProject($newProjectData);
            DB::commit();
            $response['message'] = 'New project created successfully';
            $response['createdProject'] = $newProjectData;
            return (new ResponsesService)->renderResponse($response, 200);
       } catch (\Throwable $th) {
            DB::rollBack();
            $response['message'] = 'an error occured.. please try again';
            return (new ResponsesService)->renderResponse($response, 500);
       }
    }
}
