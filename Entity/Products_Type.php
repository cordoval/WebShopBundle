<?php

namespace CSF\CartBundle\Entity;

/**
 * CSF\CartBundle\Entity\Products_Type
 *
 * @orm:Table()
 * @orm:Entity
 */
class Products_Type
{
    /**
     * @var integer $id
     *
     * @orm:Column(name="id", type="integer")
     * @orm:Id
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @orm:Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @orm:OneToMany(targetEntity="Products", mappedBy="product_type")
     */
    private $products;
    


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
}