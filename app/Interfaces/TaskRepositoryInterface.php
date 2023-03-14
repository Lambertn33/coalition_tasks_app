<?php
  namespace App\Interfaces;

  interface TaskRepositoryInterface
  {
    public function getAllTasks();
    public function getHighTaskPriority();
    public function createTask($newTask);
    public function showTask($taskId);
    public function updateTaskByField($taskId, $updatedTask);
    public function deleteTask($taskId);
  }
?>