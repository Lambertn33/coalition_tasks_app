<?php
  namespace App\Services;
  use App\Interfaces\TaskRepositoryInterface;

  class TasksService {
    
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
      $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
      return $this->taskRepository->getAllTasks();
    }

    public function createTask($newTask)
    {
      return $this->taskRepository->createTask($newTask);
    }

    public function showTask($taskId)
    {
      return $this->taskRepository->showTask($taskId);
    }

    public function getHighTaskPriority()
    {
      $highPriority = 1;
      if ($this->taskRepository->getHighTaskPriority()) {
        $taskWithHighPriority = $this->taskRepository->getHighTaskPriority();
        $highPriority = $taskWithHighPriority + 1;
      }
      return $highPriority;
    }

    public function updateTaskByField($taskId, $updatedTask)
    {
      return $this->taskRepository->updateTaskByField($taskId, $updatedTask);
    }

    public function updateTaskPriorityByDragAndDrop($taskId, $oldPriority, $newPriority)
    {
      return $this->taskRepository->updateTaskByDragAndDrop($taskId, $oldPriority, $newPriority);
    }

    public function deleteTask($taskId)
    {
      return $this->taskRepository->deleteTask($taskId);
    }
  }
?>