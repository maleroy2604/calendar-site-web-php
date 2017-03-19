<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $user->pseudo ?> 's calendar</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">My Calendar</div>
        <?php include('menu.html'); ?>
        <div class="main">

            <p>These are <?= $user->pseudo ?>'s calendar:</p>

            <label>Description:</label>
            <label>Color:</label>
            <label class="labelAction">Action:</label>


            <?php foreach ($calendars as $calendar): ?>


                <form  action="calendar/edit/<?= $calendar->idcalendar ?>" method="post">
                    <input type="text" name="description"  value='<?= $calendar->description ?>' style="color:<?= $calendar->color ?>" >
                    <input type="color" value='<?= $calendar->color ?>'name="color"></td>
                    <input type='submit' value='Edit'>
                </form>
                <form  action="calendar/delete/<?= $calendar->idcalendar ?>" method="post"><input type='submit' value='Delete'> </form>
                <form action="share/index/" method="post">
                    <input type='hidden' name="idcalendar" value="<?= $calendar->idcalendar ?>">
                    <input type='submit'  name="shareCalendar" value='share'> 
                </form>
            <?php endforeach; ?>
            <?php foreach ($calendarx as $calendar): ?>
                <form  action="calendar/edit/<?= $calendar->idcalendar ?>" method="post">
                    <input type="text" name="description"  value='<?= $calendar->description ?>' style="color:<?= $calendar->color ?>" >
                    <input type="color" value='<?= $calendar->color ?>'name="color"></td>
                    <br>
                </form>
            <?php endforeach; ?>

            <form id="calendar_id" action="calendar/index" method="post">
                <input id="description" type="text" name="description" >
                <input id="color" type="color" name="color" value="color">
                <input id="post" type='submit' name="addcalendar" value='Add'>
            </form>


        </div>

    </body>
</html>


