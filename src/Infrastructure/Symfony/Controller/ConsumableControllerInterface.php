<?php

namespace App\Infrastructure\Symfony\Controller;

use Symfony\Component\Messenger\MessageBusInterface;

interface ConsumableControllerInterface
{
    public function getMessageBus(): MessageBusInterface;
}
