<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Confirm shar deletion ?</h1>
        <div class="main">
           
            <p>The Event your are about to delete is not empty!</p>
            <p>Are you certain you want to delete it ?</p>
            <form id="delete_calendar" action="shar/remove_shar/<?= $idcalendar ?>" method="post">
                <input type='submit' name='cancel' value='Cancel'>
                <input type='submit' name='confirm' value='Confirm'>
            </form>
        </div>
    </body>
</html>