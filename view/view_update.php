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

            <table>
                <form id="createEvent" action="event/update/<?= $event->idevent ?>" method="post">
                    <tr>
                        <td>Title:</td>
                        <td><input id="title" name="title" type="text"  value="<?= $event->title ?>"></td>

                    </tr>
                    <tr>
                        <td>Calendar :</td>
                        <td><select id="calendar" name="idcalendar" >
                                <?php foreach ($calendars as $calendar): ?>
                                    <option value="<?= $calendar->idcalendar ?>"> <?= $calendar->description ?> </option>
                                <?php endforeach; ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Description :</td>
                        <td><textarea id="description " name="description"  type="text"  rows="3"><?= $event->description ?></textarea></td>

                    </tr>
                    <tr>
                        <td>Start time :</td>
                        <td><input id="startTime" name="start" type="datetime-local"  value="<?= tools::dateHtml($event->dateStart ) ?>"></td>
                        <td class="errors" id="errStart"></td>
                    </tr>
                    <tr>

                        <td>Finish time :</td>
                        <td><input id="finishTime" name="finish" type="datetime-local"  value="<?= tools::dateHtml($event->dateFinish ) ?>"></td>

                    </tr>
                    <tr>
                        <td>

                            <input id="wholeDay" type="checkbox" name="wholeday"<?= $event->whole_day ?' cheked ': ''  ?> value="<?= $event->whole_day  ?>" >
                            <label for="wholeDay"> whole day event </label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input de type="submit" name="update" value="Update">
                </form>

                </td>
                <td>

                    <form id="cancelEvent" action="event/index" method="post">
                        <input id="btn" type="submit" value="Cancel">
                    </form>

                </td>


                <td>
                    <form id="deleteEvent" action="event/deletevent/<?= $event->idevent ?>" method="post">
                        <input id="btn" type="submit" value="delete">
                    </form>
                </td>
                </tr>

            </table>
        </div>
    </body>
</html>

