<?php
namespace App\Models;

use App\Core\ResourceModel;
use App\Models\TaskModel;

class TaskResourceModel extends ResourceModel
{
    public function __construct(TaskModel $taskModel)
    {
        $this->_init("tasks", "id", $taskModel);
    }
}

?>