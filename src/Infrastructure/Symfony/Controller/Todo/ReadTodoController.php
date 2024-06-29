<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\Todo;

use App\Application\Todo\Query\AllTodoQuery;
use App\Application\Todo\Query\CountDoneTodoQuery;
use App\Application\Todo\Query\CountUndoneTodoQuery;
use App\Application\Todo\TodoViewTransformer;
use App\Domain\Todo\Model\Todo;
use App\Infrastructure\Symfony\Controller\ReadController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/', name: 'todos_')]
class ReadTodoController extends ReadController
{
    #[Route(path: '', name: 'index', methods: [Request::METHOD_GET])]
    public function index(TodoViewTransformer $todoViewTransformer): Response
    {
        $todos = $this->ask(new AllTodoQuery());
        $doneTodos = $this->ask(new CountDoneTodoQuery());
        $undoneTodos = $this->ask(new CountUndoneTodoQuery());

        return $this->render('index.html.twig', [
            'todos' => array_map(static fn (Todo $todo) => $todoViewTransformer->transform($todo), $todos),
            'doneTodos' => $doneTodos,
            'undoneTodos' => $undoneTodos,
        ]);
    }
}
