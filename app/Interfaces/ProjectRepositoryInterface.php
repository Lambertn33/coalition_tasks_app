<?php
  namespace App\Interfaces;

  interface ProjectRepositoryInterface
  {
    public function getAllProjects();
    public function getSingleProject($projectId);
    public function createProject($newProjectData);
  }
?>