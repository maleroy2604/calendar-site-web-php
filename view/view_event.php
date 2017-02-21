<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $user->pseudo ?> 's events</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include('menu.html'); ?>

        <table id="message_list" class="message_list">
            <tr>
                <th><form id="previous" action="event/index" method="post"><input type='hidden' name="annee" value='<?= $annee ?>'><input type='hidden' name="numSem"value='<?= $numSem ?>'><input type='submit' name="previous" value='<<Previous week'></form></th>
                <th><h1>My planning</h1><br>From &nbsp;&nbsp; <?= $day ?>&nbsp;&nbsp;to&nbsp;&nbsp;<?= $lastDay ?></th>
                <th><form id="next" action="event/index" method="post"><input type='hidden' name="annee" value='<?= $annee ?>'><input type='hidden' name="numSem"value='<?= $numSem ?>'><input type='submit' name="next" value='Next week>>'></form></th>

            </tr>
            <?php
            for ($i = 0; $i < sizeof($events); ++$i):
                ?>
                <tr>
                    <td><?= Tools::dayOfWeek($events[$i]->dateStart) ?> <?= substr($events[$i]->dateStart, 0, 10) ?>  </td>
                </tr>
                <tr>
                    <td>
                        <?php if ($events[$i]->whole_day == 1): ?>
                            <p>All day</p>

                        <?php else : ?>
                            <p><?= substr($events[$i]->dateStart, 10) ?> >> </p>
                        <?php endif; ?>
                    </td>
                    <td>
                       <?= print_r($colors[$i]); ?>
                        <p style="color:#<?= $colors[$i] ?>"> <?= $events[$i]->title ?> </p>

                    </td>
                    <td>
                        <form id="EditEvent" action="event/edit/<?= $events[$i]->idevent ?>" methode="post"><input type="submit" value="Edite event"></form>
                    </td>
                </tr>


            <?php endfor; ?>
            <tr>
                <td></td>
                <td> <form id="newEvent" action="event/create" methode="post"><input type="submit" value="New event"></form></td>
                <td></td>
            </tr>



        </table>


    </body>
</html>



