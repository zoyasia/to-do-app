<?php

namespace App\Controller;

use App\Entity\Task;
use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    #[Route('/tasks', name: 'app_tasks', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAll();
        return $this->json($tasks);
    }

    #[Route('/tasks', name: 'app_new', methods: ['POST'])]
    public function newTask(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $task = $this->taskService->create(
            $data['title'],
            $data['description'],
            $data['deadline'],
            $data['isCompleted'] ?? false,
            $data['status'] ?? 'à faire'
        );

        return $this->json(['task' => $task], Response::HTTP_CREATED);
    }

    #[Route('/task/{id}', name: 'app_update', methods: ['PATCH'])]
    public function updateTask(Task $task, Request $request): JsonResponse
    {
        $this->taskService->update($task, $request->toArray());
        return new JsonResponse($task, Response::HTTP_OK);
    }

    #[Route('/task/{id}', name: 'app_delete', methods: ['DELETE'])]
    public function deleteTask(Task $task): JsonResponse
    {
        $this->taskService->delete($task);
        return new JsonResponse(['message' => 'Tâche supprimée avec succès'], Response::HTTP_NO_CONTENT);
    }
}
