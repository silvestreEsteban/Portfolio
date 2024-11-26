<?php

namespace App\Controller\Contact;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Your name',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'John Doe'
                ],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Your email',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'john.doe@example.com'
                ],
                'required' => true,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Send a message',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 6,
                    'placeholder' => 'Your message...'
                ],
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Contact::class]);
    }
}