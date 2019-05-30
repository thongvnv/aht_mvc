<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\TaskRepository;
use App\Models\TaskModel;

class TasksController extends Controller
{
    private $taskRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository(new TaskModel());
    }

    function index()
    {
        $d['tasks'] = $this->taskRepository->showAllTasks();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"])) {
            $model = new TaskModel();
            $model->setTitle($_POST["title"]);
            $model->setDescription($_POST["description"]);

            $taskRepository = new TaskRepository($model);
            if ($taskRepository->add()) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        $d["task"] = $this->taskRepository->get($id);

        if (isset($_POST["title"])) {
            $model = new TaskModel();
            $model->setTitle($_POST["title"]);
            $model->setDescription($_POST["description"]);

            $taskRepository = new TaskRepository($model);
            if ($taskRepository->edit($id)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        if ($this->taskRepository->delete($id)) {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}