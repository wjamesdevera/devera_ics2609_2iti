<?php
session_start();

require_once(dirname(__FILE__) . "/TaxCalculator.php");

if (isPostRequest()) {
    validateInputs();

    $monthlySalary = sanitizeInput($_POST["monthly_salary"]);
    $isBiMonthly = isBiMonthly(sanitizeInput($_POST["bi_monthly"]));

    $taxCalculator = new TaxCalculator();

    $_SESSION['result'] = $taxCalculator->calculateTax($monthlySalary, $isBiMonthly);
    returnToIndex();
} else {
    returnToIndex();
}

function validateInputs(): void
{
    if (empty($_POST['monthly_salary'])) {
        returnToIndex();
    }

    if (empty($_POST['bi_monthly'])) {
        returnToIndex();
    }

    if ($_POST['monthly_salary'] < 0) {
        returnToIndex();
    }
}

function returnToIndex(): void
{
    header("location: index.php");
    die();
}

function isPostRequest(): bool
{
    return isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST";
}

function isBiMonthly($isBiMonthly): bool
{
    return ($isBiMonthly != 'monthly');
}

function sanitizeInput($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
