<?php

namespace App\Factory;

use App\Entity\Task;

class TaskFactory
{
    public function createTask(string $title, string $description, string $deadline, bool $isCompleted, string $status): Task
    {
        $task = new Task();
        $task
            ->setTitle($title)
            ->setDescription($description)
            ->setDeadline($deadline)
            ->setIsCompleted($isCompleted)
            ->setStatus($status);

        return $task;
    }
}
