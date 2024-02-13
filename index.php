<?php

session_start();

?>
<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taxxy: Tax Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://api.iconify.design/solar:calculator-bold.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Taxxy: Tax Calculator
                </a>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="d-flex justify-content-center align-items-center mb-4">

            <?php if (isset($_SESSION['result'])) : ?>
                <?php
                require_once 'TaxCalculator.php';
                $result = $_SESSION["result"];
                ?>

                <div class="result-card">
                    <h2>Tax Computation:</h2>
                    <div class="">
                        <p>Monthly Salary:
                            <?= '&#8369; ' . $result['monthly_salary'] ?>
                        </p>
                        <p>
                            Annual Salary:
                            <?= '&#8369; ' . $result['annual_salary'] ?>
                        </p>
                        <p>
                            Estimated Annual Tax:
                            <?= '&#8369; ' . $result['annual_tax'] ?>
                        </p>
                        </p>
                        <p>
                            Estimated Monthly Tax:
                            <?= '&#8369; ' . $result['monthly_tax'] ?>
                        </p>
                    </div>
                </div>
                <?php unset($_SESSION["result"]) ?>
            <?php else : ?>
                <form action="calculate_tax.php" method="POST" class="">
                    <div class="">
                        <h2>Taxxy: Tax Calculator</h2>
                        <p>Enter salary to calculate taxes instantly!</p>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">&#8369;</span>
                        <input class="form-control" type="number" name="monthly_salary" placeholder="Monthly Salary" autocomplete="off" autocapitalize="off" required>
                    </div>
                    <fieldset class="mb-3">
                        <legend>
                            Type
                        </legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bi_monthly" id="monthly" value="monthly" checked>
                            <label class="form-check-label" for="monthly">Monthly</label>
                        </div>
                        <div class="form-ech">
                            <input class="form-check-input" type="radio" name="bi_monthly" id="bi-monthly" value="bi-monthly">
                            <label class="form-check-label" for="bi-monthly">Bi-Monthly</label>
                        </div>
                    </fieldset>
                    <div class="">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            <?php endif ?>
        </div>
        <div class="">
            <h3>Tax Computation</h3>
        </div>
    </main>
    <footer class="container mt-auto p-2 text-center">
        <small>Copyright &copy; <?= date('Y') ?> De Vera</small>
    </footer>
</body>

</html>