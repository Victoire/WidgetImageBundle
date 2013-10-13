<?php
namespace Victoire\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\CmsBundle\Entity\Widget;
use Victoire\CmsBundle\Annotations as VIC;

/**
 * WidgetImage
 *
 * @ORM\Table("cms_widget_image")
 * @ORM\Entity
 */
class WidgetImage extends Widget
{
    use \Victoire\CmsBundle\Entity\Traits\WidgetTrait;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\Kunstmaan\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $image;
    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    private $alt;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    private $title;

    /**
     * Set image
     *
     * @param string $image
     * @return WidgetImage
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Set alt
     *
     * @param string $alt
     * @return WidgetImage
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    /**
     * Set title
     *
     * @param string $title
     * @return WidgetImage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

}
