                       
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Create event </title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Create event </div>
        <div class="main">
            <br><br>

            <form class="formEvent" id="createEvent" action="event/add" method="post"> 

                <label class="labelEvent" >Title :</label><input  id="title" name="title" type="text"  ><br />
                <label class="labelEvent" >Calendar :</label><select  id="calendar" name="calendar" >
                    <?php foreach ($calendars as $calendar): ?>
                        <option name="calendar" value="<?= $calendar->idcalendar ?>"> <?= $calendar->description == '' ? 'calendar sans nom' : $calendar->description ?> </option>
                    <?php endforeach; ?>
                </select><br />
                <label class="labelEvent" >Description :</label><textarea   name="description"   rows="3"></textarea><br />
                <label class="labelEvent" >Start time :</label> <input  id="startTime" name="start" type="datetime-local"  ><br />
                <label class="labelEvent" >Finish time :</label><input  id="finishTime" name="finish" type="datetime-local"  ><br />
                <label for="wholeDay" class="labelEvent"> whole day event </label><input  id="wholeDay" type="checkbox" name="wholeday"><br />
                <input  type="submit" value="Create">
                

            </form> 
            <form  class="formEvent" id="cancelEvent" action="Event/cancel" method="post">
                    <input id="btn" type="submit" value="Cancel">
            </form>  



        </div>
    </body>
</html>

