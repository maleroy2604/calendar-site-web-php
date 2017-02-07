<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include('menu.html'); ?>
        <h1  class="title">Error</h1>
        <div class="main">
            <?php
            foreach ($errors as $err) {
                echo $err;
            }
            ?>
            <form id="cancelEvent" action="Event/cancel" method="post">
                <input id="btn" type="submit" value="Cancel">
            </form>
        </div>
    </body>
</html>

