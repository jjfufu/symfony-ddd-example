<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Domain\Todo\Model\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $doneTodo = new Todo(
            id: 1,
            title: 'Check email',
            description: 'Check email and reply to important emails',
        );
        $doneTodo->markDone();

        $undoneTodo = new Todo(
            id: 2,
            title: 'Publish blog post',
            description: 'Publish a new blog post on the company blog',
        );

        $manager->persist($doneTodo);
        $manager->persist($undoneTodo);

        $manager->flush();
    }
}
