<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $user->pseudo ?> 's events</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link href='lib/fullcalendar.min.css' rel='stylesheet' />
        <link href='lib/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <script src='lib/lib/moment.min.js'></script>
        <script src='lib/lib/jquery.min.js'></script>
        <script src='lib/fullcalendar.min.js'></script>
        <script>
            $(document).ready(function () {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'

                    },
                    events: []
                });
            });


        </script>
    </head>

    <body>
        <div class="title">My Planning</div>
        <?php include('menu.html'); ?>
        <div class="main" id="calendar">
            <div class="alignEvent" name="header">
                <form class="formcalendar" id="previous" action="event/index" method="post">
                    <input type='hidden' name="annee" value='<?= $annee ?>'>
                    <input type='hidden' name="numSem" value='<?= $numSem ?>'>
                    <input type='submit' name="previous" value='<<'></form>
                <p class="formcalendar">From <?= $day ?> to <?= $lastDay ?></p>
                <form class="formcalendar" id="next" action="event/index" method="post">
                    <input type='hidden' name="annee" value='<?= $annee ?>'>
                    <input type='hidden' name="numSem" value='<?= $numSem ?>'>
                    <input type='submit' name="next" value='>>'></form>
            </div>
            <?php
            for ($j = 1; $j < 8; ++$j):
                $dateCurr = MyTools::dayCurr($annee, $numSem, $j);
                
                ?>
                <p><?= Tools::dayOfWeek($dateCurr) ?> <?= $dateCurr ?></p>
                <hr>
                <?php
                for ($i = 0; $i < sizeof($events); ++$i):
                    $debut=substr($events[$i]->dateStart, 0, 10);
                    $fin=substr($events[$i]->dateFinish, 0, 10);
                    $whole_day=$events[$i]->whole_day;
                    if ($dateCurr >= $debut && $dateCurr<=$fin):?>
                <p style="color:red"> <?php print_r($dateCurr);?></p>
                        <div class="alignEvent">
                            <?php if ($whole_day == 1 ): ?>
                             <p class="viewEvent">All day</p>
                            <?php elseif ($dateCurr == $debut && $dateCurr<$fin ): ?>
                             <p class="formEvent"> <?= substr($events[$i]->dateStart, 10) ?> >> </p>
                            <?php elseif ($dateCurr<$fin): ?>
                              <p class="viewEvent">All day</p>
                               <?php elseif($dateCurr == $debut && $dateCurr == $fin && $whole_day != 1 ) : ?>
                              <p class="formEvent"> <?= substr($events[$i]->dateStart, 10) ?> - <?= substr($events[$i]->dateFinish, 10) ?></p>
                            <?php elseif($dateCurr == $fin && $whole_day != 1 ) : ?>
                              <p class="formEvent"> <?= substr($events[$i]->dateFinish, 10) ?> >> </p>     
                            <?php endif;?>  
                                <label class="viewEvent" style="color:#<?= $events[$i]->get_color() ?>">  <?= $events[$i]->title ?></label>

                            <form  class="viewEvent"  action="event/edit" method="post">
                                <input type='hidden' name="idevent" value='<?= $events[$i]->idevent ?>'><input  id="edit" type="submit" name="update" value="Edit">
                            </form><br>

                        </div>

                        <?php
                    endif;
                endfor;
            endfor;
            ?>


            <form id="newEvent" action="event/create" method="post"><input  id="edit" type="submit" name="create" value="Add"></form>
        </div>
    </body>
</html>



