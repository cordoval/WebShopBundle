<?php

namespace CSF\CartBundle\Entity;

/**
 * CSF\CartBundle\Entity\Products
 *
 * @orm:Table()
 * @orm:Entity
 */
class Products
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
     * @var integer $prix
     *
     * @orm:Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var text $description
     *
     * @orm:Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @orm:ManyToOne(targetEntity="Products_Type", inversedBy="products")
     * @orm:JoinColumn(name="product_type_id", referencedColumnName="id")
     */
    private $product_type;



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
     * Set product_type
     *
     * @param CSF\CartBundle\Entity\Products_Type $productType
     */
    public function setProductType(\CSF\CartBundle\Entity\Products_Type $productType)
    {
        $this->product_type = $productType;
    }

    /**
     * Get product_type
     *
     * @return CSF\CartBundle\Entity\Products_Type $productType
     */
    public function getProductType()
    {
        return $this->product_type;
    }
}