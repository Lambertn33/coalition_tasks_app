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
    private $response;
    
    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->response = [];
    }
    public function index()
    {
       $allProjects = (new ProjectsService($this->projectRepository))->getAllProjects();
       $this->response['message'] = 'Projects';
       $this->response['projects'] = $allProjects;
       return (new ResponsesService)->renderResponse($this->response, 200);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $name = $request->name;
            $description = $request->description;
            $newProjectData = [
                'id' => Str::uuid()->toString(),
                'name' => $name,
                'description' => $description,
                'created_at' => now(),
                'updated_at' => now()
            ];
            (new ProjectsService($this->projectRepository))->createProject($newProjectData);
            DB::commit();
            $this->response['message'] = 'New project created successfully';
            $this->response['createdProject'] = $newProjectData;
            return (new ResponsesService)->renderResponse($this->response, 200);
       } catch (\Throwable $th) {
            DB::rollBack();
            $this->response['message'] = 'an error occured.. please try again';
            return (new ResponsesService)->renderResponse($this->response, 500);
       }
    }
}
