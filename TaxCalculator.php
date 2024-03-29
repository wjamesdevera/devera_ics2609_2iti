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

    function __construct()
    {
        $this->initializeTaxRates();
        $this->setTaxRate();
    }

    // TODO: Function for sorting TaxRates
    function calculateTax($monthlySalary, $isBiMonthly = false): array
    {
        $this->setIsBiMonthly($isBiMonthly);
        $this->initializeSalary($monthlySalary);
        $this->setTaxRate();
        $this->setAnnualTax();
        $this->setMonthlyTax();

        return array(
            "monthly_salary" => $this->getMonthlySalary(),
            "annual_salary" => $this->getAnnualSalary(),
            "annual_tax" => $this->getAnnualTax(),
            "monthly_tax" => $this->getMonthlyTax(),
        );
    }

    function initializeSalary($monthlySalary): void
    {
        $this->setMonthlySalary($monthlySalary);
        $this->setAnnualSalary($monthlySalary);
    }

    function findTaxRate($annualSalary): ?TaxRate
    {
        foreach ($this->taxRates as $taxRate) {
            if ($taxRate->getMinRange() < $annualSalary && $taxRate->getMaxRange() > $annualSalary) {
                return $taxRate;
            }
        }
        return null;
    }


    private function initializeTaxRates(): void
    {
        foreach (self::TAX_RATES as $taxRate) {
            $this->taxRates[] = new TaxRate($taxRate['min_range'], $taxRate['max_range'], $taxRate['basic_amount'], $taxRate['additional_rate_in_percent'], $taxRate['excess_over']);
        }
    }

    // Calculator Functions
    private function calculateAnnualTax(): float
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

    private function calculateExcessOver($annualSalary): float
    {
        return ($this->taxRate->hasExcessOver()) ? $annualSalary - $this->taxRate->getExcessOver() : 0;
    }

    private function calculateAdditionalRateInPercent($excessOver): float
    {
        return ($this->taxRate->hasAdditionalRate()) ? $excessOver * $this->taxRate->getAdditionalRate() : $excessOver;
    }

    private function calculateBasicAmount($additionalRate): float
    {
        return ($this->taxRate->hasBasicAmount()) ? $additionalRate + $this->taxRate->getBasicAmount() : $additionalRate;
    }

    // SETTERS

    public function setMonthlySalary($monthlySalary): void
    {
        $this->monthlySalary = ($this->isBiMonthly ? $monthlySalary * 2 : $monthlySalary);
    }

    private function setAnnualSalary($monthlySalary): void
    {
        $this->annualSalary = ($this->isBiMonthly ? ($monthlySalary * 24) : ($monthlySalary * 12));
    }

    private function setTaxRate(): void
    {
        $this->taxRate = $this->findTaxRate($this->annualSalary);
    }

    private function setAnnualTax(): void
    {
        $this->annualTax = $this->calculateAnnualTax();
    }

    private function setMonthlyTax(): void
    {
        $this->monthlyTax = $this->calculateMonthlyTax();
    }

    public function setIsBiMonthly($isBiMonthly): void
    {
        $this->isBiMonthly = $isBiMonthly;
    }


    // GETTERS

    public function getAnnualSalary(): string
    {
        return number_format($this->annualSalary, 2);
    }

    public function getMonthlySalary(): string
    {
        return number_format($this->monthlySalary, 2);
    }

    public function getAnnualTax(): string
    {
        return number_format($this->annualTax, 2);
    }

    public function getMonthlyTax(): string
    {
        return number_format($this->monthlyTax, 2);
    }

    protected function getTaxRate(): TaxRate
    {
        return $this->taxRate;
    }

    protected function getTaxRates(): array
    {
        return $this->taxRates;
    }
}
