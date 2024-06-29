<?php

namespace App\Infrastructure\Symfony\Controller;

use Symfony\Component\Messenger\Exception\LogicException;
use Symfony\Component\Messenger\Stamp\HandledStamp;

trait ConsumableControllerTrait
{
    private function handle(object $message): mixed
    {
        $envelope = $this->getMessageBus()->dispatch($message);

        $handledStamp = $envelope->last(HandledStamp::class);
        if (null === $handledStamp) {
            throw new LogicException(sprintf('Message of type %s was not handled', get_debug_type($envelope->getMessage())));
        }

        return $handledStamp->getResult();
    }
}
