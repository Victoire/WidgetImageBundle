Victoire CMS Image Bundle
============

Need to add a Image in a victoire cms website ?
Get this image bundle and so on

First you need to have a valid Symfony2 Victoire edition.
Then you just have to run the following composer command :

    php composer.phar require friendsvictoire/image-widget

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
