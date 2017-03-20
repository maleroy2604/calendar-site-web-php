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
        <div class="title">My Planning</div>
        <?php include('menu.html'); ?>
        <div class="main">

            <form class="formcalendar" id="previous" action="event/index" method="post"><input type='hidden' name="annee" value='<?= $annee ?>'><input type='hidden' name="numSem" value='<?= $numSem ?>'><input type='submit' name="previous" value='<<'></form>
            <p class="formcalendar">From <?= $day ?> to <?= $lastDay ?></p>
            <form class="formcalendar" id="next" action="event/index" method="post"><input type='hidden' name="annee" value='<?= $annee ?>'><input type='hidden' name="numSem" value='<?= $numSem ?>'><input type='submit' name="next" value='>>'></form>

            <?php
            for ($j = 1; $j < 8; ++$j):
                $dateCurr = MyTools::dayCurr($annee, $numSem, $j);
                ?>
                <p><?= Tools::dayOfWeek($dateCurr) ?> <?= $dateCurr ?></p>
                <hr>
                <?php
                for ($i = 0; $i < sizeof($events); ++$i):
                    if ($dateCurr == substr($events[$i]->dateStart, 0, 10)):
                        ?>
                        <label class="viewEvent" style="color:#<?= $colors[$i] ?>">  <?= $events[$i]->title ?></label>
                        <label class="viewEvent" style="color:#<?= $colors[$i] ?>">  <?= $events[$i]->description ?></label>
                        <form  class="viewEvent"  action="event/edit/<?= $events[$i]->idevent ?>" method="post">
                            <input   type="submit" value="Edit">

                        </form><br />

                        <?php if ($events[$i]->whole_day == 1): ?>
                            <p class="viewEvent">All day</p>

                        <?php else : ?>
                            <p class="formEvent"><?= substr($events[$i]->dateStart, 10) ?> >> </p> 
                            <p class="formEvent"><?= substr($events[$i]->dateFinish, 10) ?>  </p><br />

                        <?php
                        endif;
                    endif;endfor;
            endfor;
            ?>


            <form id="newEvent" action="event/create" method="post"><input type="submit" value="Add"></form>
        </div>
    </body>
</html>



