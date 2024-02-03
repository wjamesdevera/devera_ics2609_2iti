<?php
class TaxRate
{
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
        $this->basicAmount = ($basicAmount >= PHP_FLOAT_MIN) ? $basicAmount : PHP_FLOAT_MIN;
    }

    public function setAdditionalRate($additionalRateInPercent)
    {
        $this->additionalRateInPercent = ($additionalRateInPercent >= PHP_FLOAT_MIN) ? $additionalRateInPercent : PHP_FLOAT_MIN;
    }

    public function setExcessOver($excessOver): void
    {
        $this->excessOver = ($excessOver > PHP_FLOAT_MIN) ? $excessOver : PHP_FLOAT_MIN;
    }

    // access functions
    public function hasMin(): bool
    {
        return ($this->minRange >= 0);
    }

    public function hasMax(): bool
    {
        return $this->maxRange >= 0;
    }

    public function hasExcessOver(): bool
    {
        return $this->excessOver > PHP_FLOAT_MIN;
    }

    public function hasAdditionalRate(): bool
    {
        return $this->additionalRateInPercent > PHP_FLOAT_MIN;
    }

    public function hasBasicAmount(): bool
    {
        return $this->basicAmount > 0;
    }
}
