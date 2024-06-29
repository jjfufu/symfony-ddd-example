<?php

declare(strict_types=1);

namespace Unit\Todo\Form;

use App\Infrastructure\Symfony\Form\WriteTodoForm;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

class WriteTodoFormTest extends TypeTestCase
{
    protected function getExtensions(): array
    {
        return [
            new ValidatorExtension(Validation::createValidator()),
        ];
    }

    public function testWriteTodoValidData(): void
    {
        $formData = [
            'title' => 'Test title',
            'description' => 'Test description',
        ];

        $form = $this->factory->create(WriteTodoForm::class);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($formData, $form->getData());
    }

    public function testWriteTodoInvalidData(): void
    {
        $formData = [
            'title' => '',
            'description' => 'Test description',
        ];

        $form = $this->factory->create(WriteTodoForm::class);

        $form->submit($formData);

        $errors = $form->getErrors(true);

        $this->assertContainsOnlyInstancesOf(FormError::class, $errors);
    }
}
