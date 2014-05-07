<?php
namespace Victoire\ImageBundle\Translation;

use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use JMS\TranslationBundle\Model\FileSource;

class DynamicTranslations implements TranslationContainerInterface
{
    /**
     * Get the translations
     */
    public static function getTranslationMessages()
    {
        return array(
            new Message('widget.image.new.action.label', 'victoire'),
            new Message('modal.form.widget.type.image.label', 'victoire'),
            new Message('form.widget.tab.product.label', 'victoire'),
            new Message('entity_proxy.form.product.label', 'victoire')
        );
    }
}
