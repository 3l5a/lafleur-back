<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerOrder
 *
 * @ORM\Table(name="customer_order", indexes={@ORM\Index(name="fk_customer_order_order_status1_idx", columns={"order_status_id"}), @ORM\Index(name="fk_customer_order_customer1_idx", columns={"customer_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CustomerOrderRepository") 
 */
class CustomerOrder
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_customer_order", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateCustomerOrder = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivery_date_customer_order", type="date", nullable=false)
     */
    private $deliveryDateCustomerOrder;

    /**
     * @var \OrderStatus
     *
     * @ORM\ManyToOne(targetEntity="OrderStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_status_id", referencedColumnName="id")
     * })
     */
    private $orderStatus;

    /**
     * @var \Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     */
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCustomerOrder(): ?\DateTimeInterface
    {
        return $this->dateCustomerOrder;
    }

    public function setDateCustomerOrder(\DateTimeInterface $dateCustomerOrder): self
    {
        $this->dateCustomerOrder = $dateCustomerOrder;

        return $this;
    }

    public function getDeliveryDateCustomerOrder(): ?\DateTimeInterface
    {
        return $this->deliveryDateCustomerOrder;
    }

    public function setDeliveryDateCustomerOrder(\DateTimeInterface $deliveryDateCustomerOrder): self
    {
        $this->deliveryDateCustomerOrder = $deliveryDateCustomerOrder;

        return $this;
    }

    public function getOrderStatus(): ?OrderStatus
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(?OrderStatus $orderStatus): self
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }

}
