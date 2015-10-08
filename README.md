#Victoire Image Bundle
============

This bundle installs the Image Widget in your Victoire project.
With this widget, you can add any type of image from your [Media Library](https://github.com/Victoire/victoire/tree/master/Bundle/MediaBundle)

Then, you can set up :

* its alternative text
* its legend
* define any kind of link among :
    ** Internal pages
    ** URL
    ** A routing setting
    ** An anchor - i.e a widget within a page
* define the mouseover effect among :
    ** PopOver
    ** ToolTip

##Set Up Victoire

If you haven't already, you can follow the steps to set up Victoire *[here](https://github.com/Victoire/victoire/blob/master/setup.md)*

##Install the Image Bundle :

Run the following composer command :

    php composer.phar require friendsofvictoire/image-widget

##Reminder

Do not forget to add the bundle in your AppKernel !

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Victoire\Widget\ImageBundle\VictoireWidgetImageBundle(),
            );

            return $bundles;
        }
    }
