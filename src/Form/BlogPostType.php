<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('imageFile', FileType::class, [
                'mapped' => false
            ])

            ->add('content', CKEditorType::class, [
                'config' => [
                    'uiColor' =>'#e2e2e2',
                    'toolBar' => 'full',
                    'required' => true 
                ]
            ])
            ->add('slug', TextType::class,
                    ['required' => false, 'attr' => ['placeholder' => 'www.example.com']])
            ->add('save', SubmitType::class,
                    ['label' => 'Save Article'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
