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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./static/css/main.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="mb-5">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="./static/css/android-chrome-512x512.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top mr-5">
                    Taxxy: Tax Calculator
                </a>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="d-flex justify-content-center align-items-center mb-5 ">
            <?php if (isset($_SESSION['result'])) : ?>
                <?php
                require_once 'TaxCalculator.php';
                $result = $_SESSION["result"];
                ?>

                <div class="result-card border border-light-subtle p-4 rounded">
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
                <form action="calculate_tax.php" method="POST" class="tax-calculator-form border border-light-subtle p-4 rounded">
                    <div class="">
                        <h2>Tax Calculator</h2>
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
        <div>
            <h2>Income Tax Rate Table in 2023</h2>
            <p>The new Income Tax Table applicable from 2023 onwards can be seen below:</p>
            <table class="table table-bordered rounded">
                <thead>
                    <tr>
                        <th colspan="2" class="col table-primary text-center">2023 INDIVIDUAL'S GRADUATED INCOME TAX RATES</th>
                    </tr>
                    <tr>
                        <th class="col">RANGE OF ANNUAL TAXABLE INCOME</th>
                        <th class="col">TAX DUE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col">Not over PHP250,000.00</td>
                        <td class="col">Extempted from personal income tax</td>
                    </tr>
                    <tr>
                        <td class="col">Over PHP250,000.00 but not over PHP400,000.00</td>
                        <td class="col">15% of the excess over PHP250,000.00</td>
                    </tr>
                    <tr>
                        <td class="col">Over PHP400,000.00 but not over PHP800,000.00</td>
                        <td class="col">PHP22,500.00 + 20% of the excess over PHP400,000.00</td>
                    </tr>
                    <tr>
                        <td class="col">Over PHP800,000.00 but not over PHP2,000,000.00</td>
                        <td class="col">PHP102,500.00 + 25% of the excess over PHP800,000.00</td>
                    </tr>
                    <tr>
                        <td class="col">Over PHP2,000,000.00 but not over PHP8,000,000.00</td>
                        <td class="col">PHP402,500.00 + 30% of the excess over PHP2,000,000.00</td>
                    </tr>
                    <tr>
                        <td class="col">Over PHP8,000,000.00</td>
                        <td class="col">PHP2,202,500.00 + 35% of the excess over PHP8,000,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer class="container mt-auto p-2 text-center">
        <small>Copyright &copy; <?= date('Y') ?> De Vera</small>
    </footer>
</body>

</html>