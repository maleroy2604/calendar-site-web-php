<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $member->pseudo ?></title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Welcome <?= $member->pseudo ?> </div>
            <?php include('menu.html'); ?>
       
    </body>
</html>

