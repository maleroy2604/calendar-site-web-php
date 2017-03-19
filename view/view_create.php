                       
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
            <table>
                <form id="createEvent" action="event/add" method="post"> 
                    <tr>
                        <td>Title :</td>
                        <td><input id="title" name="title" type="text"  value=""></td>
                    </tr>
                    <tr>
                        <td>Calendar :</td>
                        <td><select id="calendar" name="calendar" >
                                <?php foreach ($calendars as $calendar): ?>
                                    <option value="<?= $calendar->idcalendar ?>"> <?= $calendar->description ?> </option>
                                <?php endforeach; ?>
                            </select>  
                    </tr>
                    <tr>
                        <td>Description :</td>
                        <td><textarea id="description " name="description"  type="text" value="" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td>Start time :</td>
                        <td><input id="startTime" name="start" type="datetime-local"  value=""></td>
                    </tr>
                    <tr>

                        <td>Finish time :</td>
                        <td><input id="finishTime" name="finish" type="datetime-local"  value=""><td>
                    </tr>
                    <tr>

                        <td><input id="wholeDay" type="checkbox" name="wholeday"></td>
                        <td><label for="wholeDay"> whole day event </label></td>
                    </tr>
                    <tr>
                        <td><input de type="submit" value="Create">
                </form>
                </td>
                <td>
                    <form id="cancelEvent" action="Event/cancel" method="post">
                        <input id="btn" type="submit" value="Cancel">
                    </form></td>
                </tr>
            </table>

        </div>
    </body>
</html>

