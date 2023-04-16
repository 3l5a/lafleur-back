<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LineCustomer
 *
 * @ORM\Table(name="line_customer", indexes={@ORM\Index(name="fk_customer_order_has_product_customer_order1_idx", columns={"customer_order_id"}), @ORM\Index(name="fk_line_customer_prize1_idx", columns={"prize_id"}), @ORM\Index(name="fk_customer_order_has_product_product1_idx", columns={"product_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\LineCustomerRepository") 
 */
class LineCustomer
{
    /**
     * @var int
     *
     * @ORM\Column(name="quantity_line_customer", type="integer", nullable=false)
     */
    private $quantityLineCustomer;

    /**
     * @var \Prize
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Prize")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prize_id", referencedColumnName="id")
     * })
     */
    private $prize;

    /**
     * @var \CustomerOrder
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="CustomerOrder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_order_id", referencedColumnName="id")
     * })
     */
    private $customerOrder;

    /**
     * @var \Product
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    public function getQuantityLineCustomer(): ?int
    {
        return $this->quantityLineCustomer;
    }

    public function setQuantityLineCustomer(int $quantityLineCustomer): self
    {
        $this->quantityLineCustomer = $quantityLineCustomer;

        return $this;
    }

    public function getPrize(): ?Prize
    {
        return $this->prize;
    }

    public function setPrize(?Prize $prize): self
    {
        $this->prize = $prize;

        return $this;
    }

    public function getCustomerOrder(): ?CustomerOrder
    {
        return $this->customerOrder;
    }

    public function setCustomerOrder(?CustomerOrder $customerOrder): self
    {
        $this->customerOrder = $customerOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }


}
