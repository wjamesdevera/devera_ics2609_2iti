<?php

require_once 'TaxRate.php';

class TaxCalculator
{

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
        $this->isBiMonthly = $isBiMonthly;
        $this->monthlySalary = $monthlySalary;
        $this->setAnnualSalary($monthlySalary);
        $this->taxRate = $this->findTaxRate($this->annualSalary);
        $this->setAnnualTax();
        $this->setMonthlyTax();
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

    function setAnnualSalary($monthlySalary)
    {
        $this->annualSalary = ($this->isBiMonthly ? ($monthlySalary * 24) : ($monthlySalary * 12));
    }

    function setAnnualTax()
    {
        $this->annualTax = $this->calculateAnnualTax();
    }

    function setMonthlyTax()
    {
        $this->monthlyTax = $this->calculateMonthlyTax();
    }

    private function initializeTaxRates()
    {
        $this->taxRates = [
            new TaxRate(0, 250000, 0, 0, 0),
            new TaxRate(250000, 400000, 0, .2, 250000),
            new TaxRate(400_000, 800_000, 22_500, .25, 400_000),
            new TaxRate(800_000, 2_000_000, 102_500, .3, 800_000),
            new TaxRate(2_000_000, 8_000_000, 402_500, .32, 2_000_000),
            new TaxRate(8_000_000, 0, 2_202_500, .35, 8_000_000)
        ];
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


    private function calculateExcessOver($salary)
    {
        if ($this->taxRate->hasExcessOver) {
            return $salary - $this->taxRate->getExcessOver();
        }
        return $salary;
    }

    private function calculateAdditionalRateInPercent($salary)
    {
        if ($this->taxRate->hasAdditionalRateInPercent) {
            return $salary * $this->taxRate->getAdditionalRate();
        }
        return $salary;
    }

    private function calculateBasicAmount($salary)
    {
        require_once 'TaxRate.php';
        if ($this->taxRate->hasBasicAmount) {
            return $salary + $this->taxRate->getBasicAmount();
        }
        return $salary;
    }

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
