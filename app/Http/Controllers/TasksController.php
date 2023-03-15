<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\TaskRepositoryInterface;
use App\Services\TasksService;
use App\Services\ResponsesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Task;

class TasksController extends Controller
{
    private TaskRepositoryInterface $taskRepository;
    private $response;
    
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->response = [];
    }

    public function index()
    {
        $allTasks = (new TasksService($this->taskRepository))->getAllTasks();
        $this->response['message'] = 'Tasks';
        $this->response['tasks'] = $allTasks;
        return (new ResponsesService)->renderResponse($this->response, 200);
    }

    public function store(Request $request)
    {
        try {
            $name = $request->name;
            $projectId = $request->project;
            $priority = (new TasksService($this->taskRepository))->getHighTaskPriority();
            $newTaskData = [
                'id' => Str::uuid()->toString(),
                'name' => $name,
                'project_id' => $projectId,
                'priority' => $priority,
                'created_at' => now(),
                'updated_at' => now()
            ];
            (new TasksService($this->taskRepository))->createTask($newTaskData);
            $this->response['message'] = 'New Task created successfully';
            $this->response['createdTask'] = $newTaskData;
            return (new ResponsesService)->renderResponse($this->response, 200);
        } catch (\Throwable $th) {
            $this->response['message'] = 'an error occured.. please try again';
            return (new ResponsesService)->renderResponse($this->response, 500);
        }
    }

    public function show($taskId)
    {
        $taskToView = (new TasksService($this->taskRepository))->showTask($taskId);
        if (!$taskToView) {
            $this->response['message'] = 'Task not found';
            return (new ResponsesService)->renderResponse($this->response, 404);
        }
        $this->response['message'] = 'Single Task';
        $this->response['task'] = $taskToView;
        return (new ResponsesService)->renderResponse($this->response, 200);
    }

    public function updateByFields(Request $request, $taskId)
    {
        try {
            $data = $request->all();
            (new TasksService($this->taskRepository))->updateTaskByField($taskId, $data);
            $this->response['message'] = 'Task updated successfully';
            $this->response['task'] = (new TasksService($this->taskRepository))->showTask($taskId);
            return (new ResponsesService)->renderResponse($this->response, 200);
        } catch (\Throwable $th) {
            $this->response['message'] = 'an error occured.. please try again';
            return (new ResponsesService)->renderResponse($this->response, 500);
        }
    }

    public function updatePrioritiesByDragAndDrop(Request $request, $taskId)
    {
        try {
            $data = $request->all();
            $oldPriority = $data['oldPriority'];
            $newPriority = $data['newPriority'];
            (new TasksService($this->taskRepository))->updateTaskPriorityByDragAndDrop($taskId, $oldPriority, $newPriority);
            $this->response['message'] = 'Tasks priority updated successfully';
            return (new ResponsesService)->renderResponse($this->response, 200);
        } catch (\Throwable $th) {
            $this->response['message'] = 'an error occured.. please try again';
            return (new ResponsesService)->renderResponse($this->response, 500);
        }
    }

    public function destroy($taskId)
    {
        try {
            (new TasksService($this->taskRepository))->deleteTask($taskId);
            $this->response['message'] = 'Task deleted successfully';
            return (new ResponsesService)->renderResponse($this->response, 200);
        } catch (\Throwable $th) {
            throw $th;
            $this->response['message'] = 'an error occured.. please try again';
            return (new ResponsesService)->renderResponse($this->response, 500);
        }
    }
}
