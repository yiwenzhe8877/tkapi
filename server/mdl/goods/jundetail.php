<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/12/24
 * Time: 11:21
 */

namespace app\mdl\goods;


class jundetail
{
    public $auctionTitle;
    public $auctionid;
    public $originprice;
    public $couponAmount;
    public $afterprice;
    public $pictUrl;
    public $volume;
    public $tkRate;
    public $auctionUrl;
    public $taoToken;
    public $myfee;
    public $cusfee;

    /**
     * @return mixed
     */
    public function getAuctionTitle()
    {
        return $this->auctionTitle;
    }

    /**
     * @param mixed $auctionTitle
     */
    public function setAuctionTitle($auctionTitle)
    {
        $this->auctionTitle = $auctionTitle;
    }

    /**
     * @return mixed
     */
    public function getAuctionid()
    {
        return $this->auctionid;
    }

    /**
     * @param mixed $auctionid
     */
    public function setAuctionid($auctionid)
    {
        $this->auctionid = $auctionid;
    }

    /**
     * @return mixed
     */
    public function getOriginprice()
    {
        return $this->originprice;
    }

    /**
     * @param mixed $originprice
     */
    public function setOriginprice($originprice)
    {
        $this->originprice = $originprice;
    }

    /**
     * @return mixed
     */
    public function getCouponAmount()
    {
        return $this->couponAmount;
    }

    /**
     * @param mixed $couponAmount
     */
    public function setCouponAmount($couponAmount)
    {
        $this->couponAmount = $couponAmount;
    }

    /**
     * @return mixed
     */
    public function getAfterprice()
    {
        return $this->afterprice;
    }

    /**
     * @param mixed $afterprice
     */
    public function setAfterprice($afterprice)
    {
        $this->afterprice = $afterprice;
    }

    /**
     * @return mixed
     */
    public function getPictUrl()
    {
        return $this->pictUrl;
    }

    /**
     * @param mixed $pictUrl
     */
    public function setPictUrl($pictUrl)
    {
        $this->pictUrl = $pictUrl;
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return mixed
     */
    public function getTkRate()
    {
        return $this->tkRate;
    }

    /**
     * @param mixed $tkRate
     */
    public function setTkRate($tkRate)
    {
        $this->tkRate = $tkRate;
    }

    /**
     * @return mixed
     */
    public function getAuctionUrl()
    {
        return $this->auctionUrl;
    }

    /**
     * @param mixed $auctionUrl
     */
    public function setAuctionUrl($auctionUrl)
    {
        $this->auctionUrl = $auctionUrl;
    }

    /**
     * @return mixed
     */
    public function getTaoToken()
    {
        return $this->taoToken;
    }

    /**
     * @param mixed $taoToken
     */
    public function setTaoToken($taoToken)
    {
        $this->taoToken = $taoToken;
    }

    /**
     * @return mixed
     */
    public function getMyfee()
    {
        return $this->myfee;
    }

    /**
     * @param mixed $myfee
     */
    public function setMyfee($myfee)
    {
        $this->myfee = $myfee;
    }

    /**
     * @return mixed
     */
    public function getCusfee()
    {
        return $this->cusfee;
    }

    /**
     * @param mixed $cusfee
     */
    public function setCusfee($cusfee)
    {
        $this->cusfee = $cusfee;
    }

}
