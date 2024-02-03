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
        <form action="" method="post">
            <div class="form-title">
                <h2>Taxxy: Tax Calculator.</h2>
                <p>Enter salary to calculate taxes instantly!</p>
            </div>
            <div class="form-input">
                <input type="number" name="monthly_salary" placeholder="Monthly Salary" autocomplete="off" autocapitalize="off">
            </div>
            <fieldset>
                <legend>
                    <p>Type</p>
                </legend>
                <div class="input-radio form-input">
                    <label for="monthly" class="radio">
                        <input type="radio" name="bi_monthly" id="monthly" value="monthly">
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
    </main>
    <footer>
        <small>Copyright &copy; <?= date('Y') ?> De Vera</small>
    </footer>
</body>

</html>