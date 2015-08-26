<?php

namespace Victoire\Widget\ImageBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
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
                ->add('opacity', null, array(
                        'label' => 'widget_image.form.opacity.label',
                        'vic_help_block' => 'widget_image.form.opacity.help_block'
                    ))
                ->add(
                    'cover',
                    null,
                    array(
                        'label'          => 'widget_image.form.cover.label',
                        'required'       => false,
                        'attr' => array(
                            'data-refreshOnChange' => "true",
                        )
                    )
                );

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function(FormEvent $event) {
                    self::manageCoverRelativeFields($event->getForm(), $event->getData()->isCover());
                }
            );

            $builder->get('cover')->addEventListener(
                FormEvents::PRE_SUBMIT,
                function(FormEvent $event) {
                    self::manageCoverRelativeFields($event->getForm()->getParent(), (bool) $event->getData());
                }
            );


        }
        parent::buildForm($builder, $options);
    }

    /*
     * Disable orderBy field if random checkbox is checked
     */
    protected function manageCoverRelativeFields(FormInterface $form, $isCover)
    {
        switch ($isCover) {
            case true:
                $form->remove('alt')
                    ->remove('title')
                    ->remove('legend')
                    ->remove('width')
                    ->add(
                        'height',
                        null,
                        array(
                            'label' => 'widget_image.form.minHeight.label',
                            'vic_help_label' => 'widget_image.form.height.help_label',
                        )
                    )
                    ->remove('link')
                    ->remove('asynchronous')
                    ->remove('lazyLoad');
                break;
            default:
                $form->add(
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
                    )->add('asynchronous', null, array(
                            'label'    => 'victoire.widget.type.asynchronous.label',
                            'required' => false
                        ));
                break;
        }
    }

    /**
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
