<?php

namespace Victoire\ImageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetImage form type
 */
class WidgetImageType extends WidgetType
{

    /**
     * TODO Refactor by splitting in 2 forms type (StaticWidgetImageType + EntityWidgetImageType)
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->entity_name === null) {
            $builder
                ->add(
                    'image',
                    'media',
                    array(
                        'label' => 'widget_image.form.image.label'
                    )
                )
                ->add(
                    'alt',
                    null,
                    array(
                        'label' => 'widget_image.form.alt.label'
                    )
                )
                ->add(
                    'title',
                    null,
                    array(
                        'label' => 'widget_image.form.title.label'
                    )
                )
                ->add(
                    'linkType',
                    'choice',
                    array(
                        'label'   => 'widget_image.form.linkType.label',
                        'choices' => array(
                            'none' => 'widget_image.form.linkType.nolink.choice',
                            'url'  => 'widget_image.form.linkType.url.choice',
                            'page' => 'widget_image.form.linkType.page.choice'
                        ),
                    )
                )
                ->add(
                    'url',
                    null,
                    array(
                        'label' => 'widget_image.form.url.label'
                    )
                )
                ->add(
                    'relatedPage',
                    null,
                    array(
                        'label'       => 'widget_image.form.page.label',
                        'empty_value' => 'widget_image.form.page.empty_value'
                    )
                );
        } else {
            parent::buildForm($builder, $options);
        }
    }


    /**
     * bind form to WidgetRedactor entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'         => 'Victoire\ImageBundle\Entity\WidgetImage',
                'widget'             => 'image',
                'translation_domain' => 'victoire'
            )
        );
    }


    /**
     * get form name
     */
    public function getName()
    {
        return 'appventus_victoirecorebundle_widgetimagetype';
    }
}
