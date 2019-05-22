<?php


namespace App\Form;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;


/**
 * Class ArticleSearchType
 * @package App\Form
 */

class ArticleSearchType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('searchField');
    }


}