<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update event </title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Update event </div>
        <div class="main">

            <br><br>


            <form class="formEvent" id="createEvent" action="event/update/<?= $event->idevent ?>" method="post">

                <label class="labelEvent">Title:</label><input id="title" name="title" type="text"  value="<?= $event->title ?>"><br />



                <label class="labelEvent"> Calendar :</label> <select  name="idcalendar" >
                    <?php foreach ($calendars as $calendar):
                    
                     if ($calendar->idcalendar == $event->idcalendar): 
                         $selected='selected="selected"';
                     else : 
                         $selected='';
                    endif; ?>
                    <option <?= $selected ?> value="<?= $calendar->idcalendar ?>"> <?= $calendar->description ?> </option>
                   
                    <?php endforeach; ?>

                </select><br />



                <label class="labelEvent">Description :</label><textarea  name="description"    rows="3"><?= $event->description ?></textarea><br />


                <label class="labelEvent"> Start time :</label><input id="startTime" name="start" type="datetime-local"  value="<?= tools::dateHtml($event->dateStart) ?>"><br />




                <label class="labelEvent">Finish time :</label><input id="finishTime" name="finish" type="datetime-local"  value="<?= tools::dateHtml($event->dateFinish) ?>"><br />


                <label class="labelEvent" for="wholeDay"> whole day event </label>
                <input id="wholeDay" type="checkbox" name="wholeday"<?= $event->whole_day ? ' cheked ' : '' ?> value="<?= $event->whole_day ?>" ><br />

                <input type="submit" name="update" value="Update">
            </form>



            <form class="formEvent" id="cancelEvent" action="event/index" method="post">
                <input  type="submit" value="Cancel">
            </form>





            <form  class="formEvent" id="deleteEvent" action="event/deletevent/<?= $event->idevent ?>" method="post">
                <input type="submit" value="delete">
            </form>




        </div>
    </body>
</html>

