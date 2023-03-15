<?php
  namespace App\Repositories;
  use App\Interfaces\ProjectRepositoryInterface;
  use App\Models\Project;

  class ProjectRepository implements ProjectRepositoryInterface
  {
    public function getAllProjects()
    {
      return Project::with('tasks')->get();      
    }

    public function createProject($newProjectData)
    {
      return Project::insert($newProjectData);
    }
  }
?>