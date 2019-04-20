<?php
/**
 * Created by PhpStorm.
 * User: Alan Hurtarte
 * Date: 2019-04-20
 * Time: 09:29
 */

namespace App\Objects;


class ProductOption
{
    protected $name;
    protected $type;
    protected $assignedtype;
    protected $option_code;
    protected $price;
    protected $preselected;
    protected $postage_free;
    protected $postage_org;
    protected $postage_int_free;
    protected $postage_int_org;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

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
    public function getOptionCode()
    {
        return $this->option_code;
    }

    /**
     * @param mixed $option_code
     */
    public function setOptionCode($option_code)
    {
        $this->option_code = $option_code;
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
    public function getPreselected()
    {
        return $this->preselected;
    }

    /**
     * @param mixed $preselected
     */
    public function setPreselected($preselected)
    {
        $this->preselected = $preselected;
    }

    /**
     * @return mixed
     */
    public function getPostageFree()
    {
        return $this->postage_free;
    }

    /**
     * @param mixed $postage_free
     */
    public function setPostageFree($postage_free)
    {
        $this->postage_free = $postage_free;
    }

    /**
     * @return mixed
     */
    public function getPostageOrg()
    {
        return $this->postage_org;
    }

    /**
     * @param mixed $postage_org
     */
    public function setPostageOrg($postage_org)
    {
        $this->postage_org = $postage_org;
    }

    /**
     * @return mixed
     */
    public function getPostageIntFree()
    {
        return $this->postage_int_free;
    }

    /**
     * @param mixed $postage_int_free
     */
    public function setPostageIntFree($postage_int_free)
    {
        $this->postage_int_free = $postage_int_free;
    }

    /**
     * @return mixed
     */
    public function getPostageIntOrg()
    {
        return $this->postage_int_org;
    }

    /**
     * @param mixed $postage_int_org
     */
    public function setPostageIntOrg($postage_int_org)
    {
        $this->postage_int_org = $postage_int_org;
    }



    public function __construct($data_json, $type)
    {
        $this->setType($type);
        $this->setName($data_json['name']);
        $this->setAssignedtype($data_json['assignedtype']);
        $this->setOptionCode($data_json['option_code']);
        $this->setPrice($data_json['price']);
        $this->setPreselected($data_json['preselected']);
        $this->setPostageFree($data_json['postage_free']);
        $this->setPostageOrg($data_json['postage_org']);
        $this->setPostageIntFree($data_json['postage_int_free']);
        $this->setPostageIntOrg($data_json['postage_int_org']);
    }
}
