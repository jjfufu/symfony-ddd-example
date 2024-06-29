<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Infrastructure\Messenger\QueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class ReadController extends AbstractController implements ConsumableControllerInterface
{
    use ConsumableControllerTrait;

    public function __construct(
        private readonly MessageBusInterface $queryBus
    ) {
    }

    public function getMessageBus(): MessageBusInterface
    {
        return $this->queryBus;
    }

    protected function ask(QueryInterface $query): mixed
    {
        return $this->handle($query);
    }
}
