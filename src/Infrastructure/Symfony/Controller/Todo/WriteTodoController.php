<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\Todo;

use App\Application\Todo\Command\CreateTodoCommand;
use App\Application\Todo\Command\DoneTodoCommand;
use App\Application\Todo\Command\RemoveTodoCommand;
use App\Application\Todo\Command\UndoneTodoCommand;
use App\Application\Todo\Command\UpdateTodoCommand;
use App\Domain\Todo\Model\Todo;
use App\Infrastructure\Symfony\Controller\WriteController;
use App\Infrastructure\Symfony\Form\WriteTodoForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/', name: 'todos_')]
class WriteTodoController extends WriteController
{
    #[Route(path: '/create', name: 'create', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function post(Request $request): Response
    {
        $form = $this->createForm(WriteTodoForm::class, null, [
            'action' => $this->generateUrl('todos_create'),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->execute(new CreateTodoCommand($data['title'], $data['description']));

            $this->addFlash('success', 'Todo created successfully.');

            return $this->redirectToRoute('todos_index');
        }

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}/update', name: 'update', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function put(Todo $todo, Request $request): Response
    {
        $form = $this->createForm(WriteTodoForm::class, [
            'title' => $todo->getTitle(),
            'description' => $todo->getDescription(),
        ], [
            'action' => $this->generateUrl('todos_update', ['id' => $todo->getId()]),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->execute(new UpdateTodoCommand($todo->getId(), $data['title'], $data['description']));

            $this->addFlash('success', 'Todo updated successfully.');

            return $this->redirectToRoute('todos_index');
        }

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}/done', name: 'done', methods: [Request::METHOD_POST])]
    public function done(int $id): Response
    {
        $this->execute(new DoneTodoCommand($id));

        $this->addFlash('success', 'Todo marked as done successfully.');

        return $this->redirectToRoute('todos_index');
    }

    #[Route(path: '/{id}/undone', name: 'undone', methods: [Request::METHOD_POST])]
    public function undone(int $id): Response
    {
        $this->execute(new UndoneTodoCommand($id));

        $this->addFlash('success', 'Todo marked as undone successfully.');

        return $this->redirectToRoute('todos_index');
    }

    #[Route(path: '/{id}/remove', name: 'remove', methods: [Request::METHOD_POST])]
    public function remove(int $id): Response
    {
        $this->execute(new RemoveTodoCommand($id));

        $this->addFlash('success', 'Todo removed successfully.');

        return $this->redirectToRoute('todos_index');
    }
}
