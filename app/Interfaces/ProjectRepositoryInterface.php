<?php
  namespace App\Interfaces;

  interface ProjectRepositoryInterface
  {
    public function getAllProjects();
    public function createProject($newProjectData);
  }
?>