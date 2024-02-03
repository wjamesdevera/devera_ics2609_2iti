<?php
class TaxRate
{
    private $hasMax = false;
    private $hasBasicAmount = false;
    private $hasAdditionalRateInPercent = false;
    private $hasExcessOver = false;
    private $maxRange;
    private $minRange;
    private $basicAmount;
    private $additionalRateInPercent;
    private $excessOver;


    function __construct($minRange = 0, $maxRange = 0, $basicAmount = 0, $additionalRateInPercent = 0, $excessOver = 0)
    {
        $this->setMinRange($minRange);
        $this->setMaxRange($maxRange);
        $this->setBasicAmount($basicAmount);
        $this->setAdditionalRate($additionalRateInPercent);
        $this->setExcessOver($excessOver);
    }

    function getMaxRange()
    {
        return $this->maxRange;
    }

    function getMinRange()
    {
        return $this->minRange;
    }

    function getBasicAmount()
    {
        return $this->basicAmount;
    }

    function getAdditionalRate()
    {
        return $this->additionalRateInPercent;
    }

    function getExcessOver()
    {
        return $this->excessOver;
    }

    function setMaxRange($maxRange)
    {
        if ($maxRange >= 0) {
            $this->maxRange = $maxRange;
        } else {
            $this->hasMax = PHP_INT_MAX;
        }
    }

    function setMinRange($minRange)
    {
        $this->minRange = $minRange;
    }

    function setBasicAmount($basicAmount)
    {
        if ($basicAmount > 0) {
            $this->hasBasicAmount = true;
            $this->basicAmount = $basicAmount;
        } else {
            $this->basicAmount = PHP_FLOAT_MIN;
        }
    }

    function setAdditionalRate($additionalRateInPercent)
    {
        if ($additionalRateInPercent > PHP_FLOAT_MIN) {
            $this->hasAdditionalRateInPercent = true;
            $this->additionalRateInPercent = $additionalRateInPercent;
        } else {
            $this->additionalRateInPercent = PHP_FLOAT_MIN;
        }
    }

    function setExcessOver($excessOver)
    {
        if ($excessOver > PHP_FLOAT_MIN) {
            $this->hasExcessOver = true;
            $this->excessOver = $excessOver;
        } else {
            $this->excessOver = PHP_FLOAT_MIN;
        }
    }

    // access functions
    function hasMin()
    {
        return ($this->minRange >= 0);
    }

    function hasMax()
    {
        return $this->maxRange >= 0;
    }
}
