<?php
namespace App\Models;

use App\Models\TaskResourceModel;
use App\Models\TaskModel;
use App\Config\Database;


class TaskRepository
{
    private $taskResourceModel;

    public function __construct(TaskModel $model){
        $this->taskResourceModel = new TaskResourceModel($model);
    }

    public function add()
    {
        return $this->taskResourceModel->save();
    }

    public function get($id)
    {
        return $this->taskResourceModel->get($id);
    }

    public function showAllTasks()
    {
        return $this->taskResourceModel->showAllTasks();
    }

    public function edit($id)
    {
        return $this->taskResourceModel->edit($id);
    }

    public function delete($id)
    {
        return $this->taskResourceModel->delete($id);
    }
}