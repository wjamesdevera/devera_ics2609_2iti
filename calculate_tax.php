<?php
session_start();

require_once(dirname(__FILE__) ."/TaxCalculator.php");

if (isPostRequest()) {
    $monthlySalary = sanitizeInput($_POST["monthly_salary"]);
    $isBiMonthly = isBiMonthly(sanitizeInput($_POST["bi_monthly"]));

    $taxCalculator = new TaxCalculator($monthlySalary, $isBiMonthly);

    $_SESSION['result'] = array(
        'monthly_salary' => $taxCalculator->getMonthlySalary(),
        'annual_salary' => $taxCalculator->getAnnualSalary(),
        'annual_tax' => $taxCalculator->getAnnualTax(),
        'monthly_tax' => $taxCalculator->getMonthlyTax(),
    );
    header("location: index.php");
    die();
} else {
    header("location: index.php");
    die();
}
?>
<?= 'Monthly Salary: ' . $taxCalculator->getMonthlySalary() ?>
<br>
<?= 'Annual Salary: ' . $taxCalculator->getAnnualSalary() ?>
<br>
<?= 'Est. Annual Tax: ' . $taxCalculator->getAnnualTax() ?>
<br>
<?= 'Est. Monthly Tax: ' . $taxCalculator->getMonthlyTax() ?>
<br>

<?php

function isPostRequest(): bool
{
    return isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST";
}

function isBiMonthly($isBiMonthly): bool
{
    return ($isBiMonthly != 'monthly');
}

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}