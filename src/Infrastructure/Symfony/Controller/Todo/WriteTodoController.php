<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\Todo;

use App\Application\Todo\Command\CreateTodoCommand;
use App\Application\Todo\Command\RemoveTodoCommand;
use App\Application\Todo\Command\UpdateTodoCommand;
use App\Infrastructure\Symfony\Controller\WriteController;
use App\Infrastructure\Symfony\Form\WriteTodoForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/', name: 'todos_')]
class WriteTodoController extends WriteController
{
    #[Route(path: '/create', name: 'create', methods: [Request::METHOD_POST])]
    public function post(Request $request): Response
    {
        $form = $this->createForm(WriteTodoForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->execute(new CreateTodoCommand($data['title'], $data['description']));

            $this->addFlash('success', 'Todo created successfully.');
        }

        return $this->redirectToRoute('todos_index');
    }

    #[Route(path: '/{id}/update', name: 'update', methods: [Request::METHOD_PUT])]
    public function put(int $id, Request $request): Response
    {
        $form = $this->createForm(WriteTodoForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->execute(new UpdateTodoCommand($id, $data['title'], $data['description']));

            $this->addFlash('success', 'Todo updated successfully.');
        }

        return $this->redirectToRoute('todos_index');
    }

    #[Route(path: '/{id}/remove', name: 'remove', methods: [Request::METHOD_DELETE])]
    public function remove(int $id): Response
    {
        $this->execute(new RemoveTodoCommand($id));

        $this->addFlash('success', 'Todo removed successfully.');

        return $this->redirectToRoute('todos_index');
    }
}
