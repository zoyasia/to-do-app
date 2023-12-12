<?php

namespace App\Service;

use App\Entity\Task;
use App\Factory\TaskFactory;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TaskService
{
    private TaskRepository $taskRepository;
    private EntityManagerInterface $entityManager;
    private TaskFactory $taskFactory;

    public function __construct(TaskRepository $taskRepository, EntityManagerInterface $entityManager, TaskFactory $taskFactory)
    {
        $this->taskRepository = $taskRepository;
        $this->entityManager = $entityManager;
        $this->taskFactory = $taskFactory;
    }

    public function getAll(): array
    {
        $tasks = $this->taskRepository->findAll();

        $tasksArray = [];
        foreach ($tasks as $task) {
            $tasksArray[] = $task;
        }

        return $tasksArray;
    }

    public function create(string $title, string $description, string $deadline, bool $isCompleted, string $status): Task
    {

        $task = $this->taskFactory->createTask($title, $description, $deadline, $isCompleted, $status);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }

    public function update(Task $task, array $data): void
    {
        if (!empty($data['title']) && $data['title'] !== $task->getTitle()) {
            $task->setTitle($data['title']);
        }

        if (!empty($data['description']) && $data['description'] !== $task->getDescription()) {
            $task->setDescription($data['description']);
        }

        if (!empty($data['deadline']) && $data['deadline'] !== $task->getDeadline()) {
            $task->setDeadline($data['deadline']);
        }

        if (!empty($data['status']) && $data['status'] !== $task->getStatus()) {
            $task->setStatus($data['status']);
        }

        if ($data['status'] !== $task->isIsCompleted()) {
            $task->setIsCompleted($data['isCompleted']);
        }

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function delete($taskId): Task
    {

        $task = $this->taskRepository->find($taskId);

        if (!$task) {
            throw new \Doctrine\ORM\EntityNotFoundException('Tâche non trouvée');
        }

        $this->entityManager->remove($task);
        $this->entityManager->flush();

        return $task;
    }
}
