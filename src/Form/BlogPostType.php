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
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;


class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', TranslationsType::class,[
                'fields' => [
                    'title'           => ['field_type' => TextType::class],
                    'content'         => ['field_type' => CKEditorType::class]
                ]
            ])
          #  ->add('title', TextType::class)
            #->add('description', TextType::class)
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false
            ])
           # ->add('category', TextType::class)

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
