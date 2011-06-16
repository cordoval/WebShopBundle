<?php

namespace CSF\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * CSF\CartBundle\Entity\Products
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSF\CartBundle\Entity\ProductRepository")
 */
class Products
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
     * @var integer $prix
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductsType", inversedBy="products")
     * @ORM\JoinColumn(name="product_type_id", referencedColumnName="id")
     */
    private $productType;


	/**
     * @ORM\OneToMany(targetEntity="CommandeItems", mappedBy="product")
     */
    private $commandeItems;
    
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

	
    
    /**
     * Set prix
     *
     * @param integer $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * Get prix
     *
     * @return integer $prix
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ProductsType
     *
     * @param CSF\CartBundle\Entity\ProductsType $productType
     */
    public function setProductType(\CSF\CartBundle\Entity\ProductsType $productType)
    {
        $this->productType = $productType;
    }

    /**
     * Get ProductsType
     *
     * @return CSF\CartBundle\Entity\ProductsType $productType
     */
    public function getProductType()
    {
        return $this->productType;
    }

    
    public function __construct()
    {
        $this->commandeItems = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add commandeItems
     *
     * @param CSF\CartBundle\Entity\CommandeItems $commandeItems
     */
    public function addCommandeItems(\CSF\CartBundle\Entity\CommandeItems $commandeItems)
    {
        $this->commandeItems[] = $commandeItems;
    }

    /**
     * Get commandeItems
     *
     * @return Doctrine\Common\Collections\Collection $commandeItems
     */
    public function getCommandeItems()
    {
        return $this->commandeItems;
    }
    
    public function __toString()
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
}