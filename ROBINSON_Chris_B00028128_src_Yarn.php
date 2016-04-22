<?php
/**
 * Created by PhpStorm.
 * User: Chris Robinson
 * this class is used to get and set the Yarn products
 * for use in the product page and shop page
 */
namespace Itb;

/**
 * Class Yarn
 * @package Itb
 */
class Yarn extends YarnDatabase
{

    /**
     * yarn name
     * @var
     */
    private $YarnName;
    /**
     * yarn type
     * @var
     */
    private $YarnType;
    /**
     * yarn color
     * @var
     */
    private $YarnColor;
    /**
     * yarn price
     * @var
     */
    private $YarnPrice;
    /**
     * yarn description
     * @var
     */
    private $YarnDescription;
    /**
     * yarn stock
     * @var
     */
    private $YarnStock;
    /**
     * yarn id
     * @var
     */
    private $YarnId;

    /**
     * get yarnName
     * @return string
     */
    public function getYarnName()
    {
        return $this->YarnName;
    }

    /**
     * get yarnType
     * @return string
     */
    public function getYarnType()
    {
        return $this->YarnType;
    }

    /**
     * get yarnColor
     * @return string
     */
    public function getYarnColor()
    {
        return $this->YarnColor;
    }

    /**
     * get yarnPrice
     * @return int
     */
    public function getYarnPrice()
    {
        return $this->YarnPrice;
    }

    /**
     * get yarnDescription
     * @return string
     */
    public function getYarnDescription()
    {
        return $this->YarnDescription;
    }

    /**
     * get yarnStock
     * @return int
     */
    public function getYarnStock()
    {
        return $this->YarnStock;
    }

    /**
     * get yarnId
     * @return int
     */
    public function getYarnId()
    {
        return $this->YarnId;
    }

    /**
     * get yarn picture based on yarn id
     * return the picture associated to the id
     * @return string
     */
    public function getYarnPicture()
    {
        if ($this->YarnId == 1) {
            return '<img src="images/babe_blue_1_edit.jpg" alt="Babe Blue">';
        } elseif ($this->YarnId == 2) {
            return  '<img src="images/sirDar_purple_2_edit.jpg" alt="sirDar Purple">';
        } elseif ($this->YarnId == 3) {
            return  '<img src="images/sirDar_red_3_edit.jpg" alt="sirDar Red">';
        } elseif ($this->YarnId == 4) {
            return  '<img src="images/sirDar_white_4_edit.jpg" alt="sirDar White">';
        } elseif ($this->YarnId == 5) {
            return  '<img src="images/dyChoice_cream_5_edit.jpg" alt="dyChoice Cream">';
        } elseif ($this->YarnId == 6) {
            return  '<img src="images/babe_yellow_6_edit.jpg" alt="Babe Yellow">';
        } elseif ($this->YarnId == 7) {
            return  '<img src="images/malabar_blue_7_edit.jpg" alt="Malabar Blue">';
        }
    }
}
