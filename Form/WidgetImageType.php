<?php

namespace Victoire\Widget\ImageBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;
use Victoire\Bundle\WidgetBundle\Model\Widget;

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
        if ($options['mode'] === null || $options['mode'] === Widget::MODE_STATIC) {
            $builder
                ->add(
                    'image',
                    'media',
                    array(
                        'label' => 'widget_image.form.image.label',
                    )
                )
                ->add(
                    'alt',
                    null,
                    array(
                        'label' => 'widget_image.form.alt.label',
                        'vic_help_label' => 'widget_image.form.alt.help_label',
                    )
                )
                ->add(
                    'title',
                    null,
                    array(
                        'label' => 'widget_image.form.title.label',
                    )
                )
                ->add(
                    'legend',
                    null,
                    array(
                        'label' => 'widget_image.form.legend.label',
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
                ->add('link', 'victoire_link')
                ->add(
                    'lazyLoad',
                    null,
                    array(
                        'label'          => 'widget_image.form.lazyLoad.label',
                        'vic_help_label' => 'widget_image.form.lazyLoad.help_label',
                        'required'       => false,
                    )
                );
        }
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
                'translation_domain' => 'victoire',
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
