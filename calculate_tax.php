<?php

if (isPostRequest()) {
    $monthlySalary = sanitizeInput($_POST["monthly_salary"]);
    $isBiMonthly = isBiMonthly(sanitizeInput($_POST["bi_monthly"]));
} else {
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

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}