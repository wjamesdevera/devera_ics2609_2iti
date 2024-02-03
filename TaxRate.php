<?php
class TaxRate
{
    private $hasBasicAmount = false;
    private $hasAdditionalRateInPercent = false;
    private $hasExcessOver = false;
    private $maxRange;
    private $minRange;
    private $basicAmount;
    private $additionalRateInPercent;
    private $excessOver;


    public function __construct($minRange = 0, $maxRange = 0, $basicAmount = 0, $additionalRateInPercent = 0, $excessOver = 0)
    {
        $this->setMinRange($minRange);
        $this->setMaxRange($maxRange);
        $this->setBasicAmount($basicAmount);
        $this->setAdditionalRate($additionalRateInPercent);
        $this->setExcessOver($excessOver);
    }

    public function getMaxRange()
    {
        return $this->maxRange;
    }

    public function getMinRange()
    {
        return $this->minRange;
    }

    public function getBasicAmount()
    {
        return $this->basicAmount;
    }

    public function getAdditionalRate()
    {
        return $this->additionalRateInPercent;
    }

    public function getExcessOver()
    {
        return $this->excessOver;
    }

    public function setMaxRange($maxRange)
    {
        $this->maxRange = ($maxRange >= 0) ? $maxRange : PHP_FLOAT_MAX;
    }

    public function setMinRange($minRange)
    {
        $this->minRange = $minRange;
    }

    public function setBasicAmount($basicAmount)
    {
        if ($basicAmount > 0) {
            $this->hasBasicAmount = true;
            $this->basicAmount = $basicAmount;
        } else {
            $this->basicAmount = PHP_FLOAT_MIN;
        }
    }

    public function setAdditionalRate($additionalRateInPercent)
    {
        if ($additionalRateInPercent > PHP_FLOAT_MIN) {
            $this->hasAdditionalRateInPercent = true;
            $this->additionalRateInPercent = $additionalRateInPercent;
        } else {
            $this->additionalRateInPercent = PHP_FLOAT_MIN;
        }
    }

    public function setExcessOver($excessOver)
    {
        if ($excessOver > PHP_FLOAT_MIN) {
            $this->hasExcessOver = true;
            $this->excessOver = $excessOver;
        } else {
            $this->excessOver = PHP_FLOAT_MIN;
        }
    }

    // access functions
    public function hasMin()
    {
        return ($this->minRange >= 0);
    }

    public function hasMax()
    {
        return $this->maxRange >= 0;
    }
}
