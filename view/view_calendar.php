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
        <?php include('menu.html'); ?>
        <div class="main">


            <p>These are <?= $user->pseudo ?>'s calendar:</p>



            <table id="message_list" class="message_list">
                <tr>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Action</th>

                </tr>
                <?php foreach ($calendars as $calendar): ?>

                    <tr>
                     <form id="message_id" action="calendar/edit/<?= $calendar->idcalendar ?>" method="post">
                        <td><input type="text" name="description"  value='<?= $calendar->description ?>' style="color:<?= $calendar->color ?>" ></td>
                        <td><input type="color" value='<?= $calendar->color ?>'name="color"></td>
                        <td>
                        <table>
                            <tr>
                                <td><input type='submit' value='edite'></td>
                                </form>
                                <td><form id="message_id" action="calendar/delete/<?= $calendar->idcalendar ?>" method="post"><input type='submit' value='delete'></form></td>

                            </tr>
                        </table>
                            </td>
                     </tr>


                        <?php endforeach; ?>

                        <tr>
                        <form id="calendar_id" action="calendar/index" method="post">
                            <td><input id="description" type="text" name="description"  value=""></td>
                            <td><input id="color" type="color" name="color" value="color"></td>
                            <td> <input id="post" type='submit' value='add calendar'></td>
                        </form>
                        </tr>
                    </table>
                    </div>

                    </body>
                    </html>


