<?php
session_start();
?>
<!doctype html>
<html lang="en" data-bs-theme="light">

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
        <div class="d-flex justify-content-center align-items-center mb-5">
            <?php if (isset($_SESSION['result'])) : ?>
                <?php
                require_once 'TaxCalculator.php';
                $result = $_SESSION["result"];
                ?>
                    <div class="border rounded p-4">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="">
                                    <th class="col" colspan="3">Income Tax Calculation</th>
                                </tr>
                                <tr>
                                    <th class="col"></th>
                                    <th class="col">Monthly</th>
                                    <th class="col">Annually</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <th class="col">Salary</th>
                                    <td class="col"><?= '&#8369; ' . $result['monthly_salary'] ?></td>
                                    <td class="col"><?= '&#8369; ' . $result['annual_salary'] ?></td>
                                </tr>
                                <tr class="table-success">
                                    <th class="col">Estimated Tax</th>
                                    <td class="col"><?= '&#8369; ' . $result['monthly_tax'] ?></td>
                                    <td class="col"><?= '&#8369; ' . $result['annual_tax'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- <?php // unset($_SESSION["result"]) ?> -->
            <?php else : ?>
                <form action="calculate_tax.php" method="POST" class="tax-calculator-form border border-light-subtle p-4 rounded">
                    <div class="">
                        <h2>Tax Calculator</h2>
                        <p>Enter monthly salary to calculate taxes instantly!</p>
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
                <tbody class="table-group-divider">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>