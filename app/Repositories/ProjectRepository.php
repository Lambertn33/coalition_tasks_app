<?php
  namespace App\Repositories;
  use App\Interfaces\ProjectRepositoryInterface;
  use App\Models\Project;

  class ProjectRepository implements ProjectRepositoryInterface
  {
    public function getAllProjects()
    {
      return Project::select(['id', 'name', 'description'])->get();      
    }

    public function getSingleProject($projectId)
    {
      return Project::with('tasks')->find($projectId);
    }

    public function createProject($newProjectData)
    {
      return Project::insert($newProjectData);
    }
  }
?>