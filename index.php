<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./static/css/main.css">
    <title>Taxxy: Tax Calculator</title>
</head>
<body>
    <header>
    </header>
    <main class="">
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
            <form action="calculate_tax.php" method="POST">
                <div class="form-title">
                    <h2>Taxxy: Tax Calculator</h2>
                    <p>Enter salary to calculate taxes instantly!</p>
                </div>
                <div class="form-input">
                    <input type="number" name="monthly_salary" placeholder="Monthly Salary" autocomplete="off" autocapitalize="off" required>
                </div>
                <fieldset>
                    <legend>
                        <p>Type</p>
                    </legend>
                    <div class="input-radio form-input">
                        <label for="monthly" class="radio">
                            <input type="radio" name="bi_monthly" id="monthly" value="monthly" checked>
                            <div class="radio__radio"></div>
                            Monthly
                        </label>
                        <label for="bi-monthly" class="radio">
                            <input type="radio" name="bi_monthly" id="bi-monthly" value="bi-monthly">
                            <div class="radio__radio"></div>
                            Bi-Monthly
                        </label>
                    </div>
                </fieldset>
                <div class="form-submit">
                    <input type="submit" value="Submit">
                </div>
            </form>
        <?php endif ?>
    </main>
    <footer>
        <small>Copyright &copy; <?= date('Y') ?> De Vera</small>
    </footer>
</body>

</html>