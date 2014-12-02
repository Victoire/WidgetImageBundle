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
                        'label' => 'widget_image.form.alt.label',
                        'vic_help_label' => 'widget_image.form.alt.help_label',
                        'vic_help_block' => 'widget_image.form.alt.vic_help_block',
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
                    'width',
                    null,
                    array(
                        'label' => 'widget_image.form.width.label',
                        'vic_help_label' => 'widget_image.form.width.help_label',
                    )
                )
                ->add(
                    'height',
                    null,
                    array(
                        'label' => 'widget_image.form.height.label',
                        'vic_help_label' => 'widget_image.form.width.help_label',
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
                'widget'             => 'Image',
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
