<?php

declare(strict_types=1);

use App\Application;

require '../vendor/autoload.php';

$output = null;
$input = $_POST['input'] ?? null;
if ($input !== null) {
    $application = new Application((string) $input);
    $output = $application->run();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Jayway Test</title>
</head>
<body>
    <div class="container">
        <h1 class="display-1 text-center">Robot Controller</h1>
        <?php
        if ($output !== null):
            ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($output) ?>
                </div>
            <?php
            endif;
        ?>
        <form method="POST" action="#">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="commandInput">Enter command</label>
                        <textarea name="input" class="form-control" id="commandInput" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-white bg-dark">
                        <div class="card-body">
                            <h5 class="card-title">
                                Example command
                            </h5>
                            <code>
                                5 5<br>
                                1 2 N<br>
                                RFRFFRFRF
                            </code>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Run</button>
        </form>
    </div>
</body>
</html>

<?php
