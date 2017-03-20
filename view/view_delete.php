
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
        <div class="title">Delete ?</div>
        <div class="main">
            <p>Are you certain you want to delete it ?</p>
            <form id="delete_calendar" action="calendar/remove_calendar/<?= $idcalendar ?>" method="post">
                <input type='submit' name='cancel' value='Cancel'>
                <input type='submit' name='confirm' value='Confirm'>
            </form>
        </div>
    </body>
</html>

