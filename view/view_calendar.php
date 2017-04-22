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

            <label class="labelcalendar">Description:</label>
            <label class="labelcalendar">Color:</label>
            <label class="labelcalendar">Action:</label>


            <?php foreach ($calendars as $calendar): ?>


                <form class="formcalendar" action="calendar/edit/<?= $calendar->idcalendar ?>" method="post">
                    <input type="text" name="description"  value='<?= $calendar->description ?>' style="color:<?= $calendar->color ?>" >
                    <input type="color" value='<?= $calendar->color ?>' name="color">
                    <input type='submit' value='Edit' name="editcalendar">
                </form>
                <form  class="formcalendar" action="calendar/delete/<?= $calendar->idcalendar ?>" method="post"><input type='submit'name="delcalendar" value='Delete'> </form>
                <form class="formcalendar" action="share/index/" method="post">
                    <input type='hidden' name="idcalendar" value="<?= $calendar->idcalendar ?>">
                    <input type='submit'  name="shareCalendar" value='Share'> 
                </form>
            <?php endforeach; ?>
            <?php foreach ($calendarx as $calendar): ?>
                <div class="formcalendar">
                    <input readonly="readonly"  type="text" name="description"  value='<?= $calendar->description ?>' style="color:<?= $calendar->color ?>" >
                    <input disabled="disabled" type="color" value='<?= $calendar->color ?>' name="color">
                   
                </div>
                <br>

            <?php endforeach; ?>

            <form class="formcalendar" id="calendar_id" action="calendar/add" method="post">
                <input id="description" type="text" name="description" >
                <input id="color" type="color" name="color" >
                <input id="post" type='submit' name="addcalendar" value='Add'>
            </form>


        </div>

    </body>
</html>


