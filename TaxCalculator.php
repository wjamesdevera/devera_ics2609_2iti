<?php

require_once 'TaxRate.php';

class TaxCalculator
{
    private const TAX_RATES = array(
        array('min_range' => 0, 'max_range' => 250_000, 'basic_amount' => 0, 'additional_rate_in_percent' => 0, 'excess_over' => 0),
        array('min_range' => 0, 'max_range' => 400_000, 'basic_amount' => 0, 'additional_rate_in_percent' => .2, 'excess_over' => 250_000),
        array('min_range' => 400_000, 'max_range' => 800_000, 'basic_amount' => 22_500, 'additional_rate_in_percent' => .25, 'excess_over' => 400_000),
        array('min_range' => 800_000, 'max_range' => 2_000_000, 'basic_amount' => 102_500, 'additional_rate_in_percent' => .3, 'excess_over' => 800_000),
        array('min_range' => 2_000_000, 'max_range' => 8_000_000, 'basic_amount' => 402_500, 'additional_rate_in_percent' => .32, 'excess_over' => 2_000_000),
        array('min_range' => 8_000_000, 'max_range' => 0, 'basic_amount' => 2_202_500, 'additional_rate_in_percent' => .35, 'excess_over' => 8_000_000),
    );
    private $monthlySalary;
    private $annualSalary;
    private $isBiMonthly;
    private $taxRate;
    private $annualTax;
    private $monthlyTax;
    private $taxRates;


    function __construct($monthlySalary, $isBiMonthly = false)
    {
        $this->initializeTaxRates();
        $this->setIsBiMonthly($isBiMonthly);
        $this->initializeSalary($monthlySalary);
        $this->setTaxRate();
        $this->setAnnualTax();
        $this->setMonthlyTax();
    }

    function initializeSalary($monthlySalary)
    {
        $this->setMonthlySalary($monthlySalary);
        $this->setAnnualSalary($monthlySalary);
    }

    function findTaxRate($annualSalary)
    {
        foreach ($this->taxRates as $taxRate) {
            if ($taxRate->getMinRange() < $annualSalary && $taxRate->getMaxRange() > $annualSalary) {
                return $taxRate;
            }
        }
        return null;
    }


    private function initializeTaxRates()
    {
        foreach(self::TAX_RATES as $taxRate) {
            $this->taxRates[] = new TaxRate($taxRate['min_range'], $taxRate['max_range'], $taxRate['basic_amount'], $taxRate['additional_rate_in_percent'], $taxRate['excess_over']);
        }
    }

    private function calculateAnnualTax()
    {
        $excessOver = $this->calculateExcessOver($this->annualSalary);
        $additionalRate = $this->calculateAdditionalRateInPercent($excessOver);
        $basicAmount = $this->calculateBasicAmount($additionalRate);

        return $basicAmount;
    }
    private function calculateMonthlyTax(): float
    {
        return $this->annualTax / 12;
    }

    private function calculateExcessOver($annualSalary)
    {
        return ($this->taxRate->hasExcessOver()) ? $annualSalary - $this->taxRate->getExcessOver() : $annualSalary;
    }

    private function calculateAdditionalRateInPercent($excessOver)
    {
        return ($this->taxRate->hasAdditionalRate()) ? $excessOver * $this->taxRate->getAdditionalRate() : $excessOver;
    }

    private function calculateBasicAmount($additionalRate)
    {
        return ($this->taxRate->hasBasicAmount()) ? $additionalRate + $this->taxRate->getBasicAmount() : $additionalRate;
    }

    // SETTERS

    public function setMonthlySalary($monthlySalary)
    {
        $this->monthlySalary = $monthlySalary;
    }

    public function setAnnualSalary($monthlySalary)
    {
        $this->annualSalary = ($this->isBiMonthly ? ($monthlySalary * 24) : ($monthlySalary * 12));
    }

    private function setTaxRate()
    {
        $this->taxRate = $this->findTaxRate($this->annualSalary);
    }

    private function setAnnualTax()
    {
        $this->annualTax = $this->calculateAnnualTax();
    }

    public function setMonthlyTax()
    {
        $this->monthlyTax = $this->calculateMonthlyTax();
    }

    public function setIsBiMonthly($isBiMonthly)
    {
        $this->isBiMonthly = $isBiMonthly;
    }


    // GETTERS

    function getAnnualSalary()
    {
        return number_format($this->annualSalary, 2);
    }

    function getMonthlySalary()
    {
        return number_format($this->monthlySalary, 2);
    }

    function getAnnualTax()
    {
        return number_format($this->annualTax, 2);
    }

    function getMonthlyTax()
    {
        return number_format($this->monthlyTax, 2);
    }

    function getTaxRate()
    {
        return $this->taxRate;
    }

    function getTaxRates()
    {
        return $this->taxRates;
    }
}
