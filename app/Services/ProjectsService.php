<?php
  namespace App\Services;

use App\Interfaces\ProjectRepositoryInterface;

  class ProjectsService {

    private $projectRepository;
    
    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
      $this->projectRepository = $projectRepository;
    }

    public function getAllProjects()
    {
      return $this->projectRepository->getAllProjects();
    }

    public function getSingleProject($id)
    {
      return $this->projectRepository->getSingleProject($id);
    }

    public function createProject($data)
    {
      return $this->projectRepository->createProject($data);
    }
  }
?>