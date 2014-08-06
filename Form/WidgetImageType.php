<?php

namespace Victoire\Widget\ImageBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetImage form type
 */
class WidgetImageType extends WidgetType
{
    /**
     * define form fields
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityName = $options['entityName'];

        //no entity name provided in case of static mode for example
        if ($entityName === null) {
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
        }

        $builder->add(
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
        );
        parent::buildForm($builder, $options);
    }

    /**
     * bind form to WidgetRedactor entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'data_class'         => 'Victoire\Widget\ImageBundle\Entity\WidgetImage',
                'widget'             => 'image',
                'translation_domain' => 'victoire'
            )
        );
    }

    /**
     * get form name
     *
     * @return string The name of the form
     */
    public function getName()
    {
        return 'victoire_widget_form_image';
    }
}
