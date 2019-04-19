<?php
/**
 * Created by PhpStorm.
 * User: Alan Hurtarte
 * Date: 2019-04-19
 * Time: 10:20
 */

namespace App\Objects;

class Design
{

    protected $id;
    protected $title;
    protected $thumb_url;
    protected $big_url;
    protected $full_url;
    protected $price;
    protected $price_foldingcard;
    protected $price_group;
    protected $currencyiso;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getThumbUrl()
    {
        return $this->thumb_url;
    }

    /**
     * @param mixed $thumb_url
     */
    public function setThumbUrl($thumb_url)
    {
        $this->thumb_url = $thumb_url;
    }

    /**
     * @return mixed
     */
    public function getBigUrl()
    {
        return $this->big_url;
    }

    /**
     * @param mixed $big_url
     */
    public function setBigUrl($big_url)
    {
        $this->big_url = $big_url;
    }

    /**
     * @return mixed
     */
    public function getFullUrl()
    {
        return $this->full_url;
    }

    /**
     * @param mixed $full_url
     */
    public function setFullUrl($full_url)
    {
        $this->full_url = $full_url;
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
    public function getPriceFoldingcard()
    {
        return $this->price_foldingcard;
    }

    /**
     * @param mixed $price_foldingcard
     */
    public function setPriceFoldingcard($price_foldingcard)
    {
        $this->price_foldingcard = $price_foldingcard;
    }

    /**
     * @return mixed
     */
    public function getPriceGroup()
    {
        return $this->price_group;
    }

    /**
     * @param mixed $price_group
     */
    public function setPriceGroup($price_group)
    {
        $this->price_group = $price_group;
    }

    /**
     * @return mixed
     */
    public function getCurrencyiso()
    {
        return $this->currencyiso;
    }

    /**
     * @param mixed $currencyiso
     */
    public function setCurrencyiso($currencyiso)
    {
        $this->currencyiso = $currencyiso;
    }

    /**
     * Design constructor.
     * @param $data_json
     */
    public function __construct($data_json)
    {
        $this->id = $data_json['id'];
        $this->title = $data_json['title'];
        $this->thumb_url = $data_json['thumb_url'];
        $this->big_url = $data_json['big_url'];
        $this->full_url = $data_json['full_url'];
        $this->price = $data_json['price'];
        $this->price_foldingcard = $data_json['price_foldingcard'];
        $this->price_group = $data_json['price_group'];
        $this->currencyiso = $data_json['currencyiso'];
    }
}
