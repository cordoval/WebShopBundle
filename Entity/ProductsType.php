<?php

namespace CSF\CartBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CSF\CartBundle\Entity\ProductsType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProductsType
{	
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * @Gedmo\Sluggable
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
        
    /**
     * @Gedmo\Slug
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     */
    private $slug;
    
    /**
     * @ORM\OneToMany(targetEntity="Products", mappedBy="product_type")
     */
    private $products;
    
     /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id",onDelete="SET NULL", onUpdate="CASCADE")
     * 
     */
    private $image;

    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

 
    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
    	return $this->slug;
    }
    
    public function setSlug($slug)
    {
    	$this->slug = $slug;
    }
    
    /**
     * Add products
     *
     * @param CSF\CartBundle\Entity\Products $products
     */
    public function addProducts(\CSF\CartBundle\Entity\Products $products)
    {
        $this->products[] = $products;
    }

    /**
     * Get products
     *
     * @return Doctrine\Common\Collections\Collection $products
     */
    public function getProducts()
    {
        return $this->products;
    }
    
	public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image)
    {
        $this->image = $image;
    }

    /**
     * Get ProductsType
     *
     * @return CSF\CartBundle\Entity\ProductsType $productType
     */
    public function getImage()
    {
        return $this->image;
    }
    
    public function __toString()
    {
    	return $this->name;
    }
}