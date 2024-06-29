<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Infrastructure\Messenger\CommandInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class WriteController extends AbstractController implements ConsumableControllerInterface
{
    use ConsumableControllerTrait;

    public function __construct(
        private readonly MessageBusInterface $commandBus
    ) {
    }

    public function getMessageBus(): MessageBusInterface
    {
        return $this->commandBus;
    }

    public function execute(CommandInterface $command): mixed
    {
        return $this->handle($command);
    }
}
