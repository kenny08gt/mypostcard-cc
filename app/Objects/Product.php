<?php
/**
 * Created by PhpStorm.
 * User: Alan Hurtarte
 * Date: 2019-04-20
 * Time: 09:28
 */

namespace App\Objects;


class Product
{
    protected $name;
    protected $assignedtype;
    protected $product_code;
    protected $price;
    protected $product_options;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAssignedtype()
    {
        return $this->assignedtype;
    }

    /**
     * @param mixed $assignedtype
     */
    public function setAssignedtype($assignedtype)
    {
        $this->assignedtype = $assignedtype;
    }

    /**
     * @return mixed
     */
    public function getProductCode()
    {
        return $this->product_code;
    }

    /**
     * @param mixed $product_code
     */
    public function setProductCode($product_code)
    {
        $this->product_code = $product_code;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getProductOptions()
    {
        return $this->product_options;
    }

    /**
     * @param mixed $product_options
     */
    public function setProductOptions($product_options)
    {
        $this->product_options = $product_options;
    }

    public function __construct($data_json)
    {
        $this->setName($data_json['name']);
        $this->setAssignedtype($data_json['assignedtype']);
        $this->setProductCode($data_json['product_code']);
        $this->setPrice($data_json['price']);

        $product_options = [];
        foreach ($data_json['product_options'] as $key => $product_option_raw) {
            $product_options[strtolower($key)] = new ProductOption($product_option_raw, $key);
        }

        $this->setProductOptions($product_options);
    }

}
