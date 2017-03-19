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
           
            <form id="previous" action="event/index" method="post"><input type='hidden' name="annee" value='<?= $annee ?>'><input type='hidden' name="numSem" value='<?= $numSem ?>'><input type='submit' name="previous" value='<<'></form>
            <p class="head">From <?= $day ?> to <?= $lastDay ?></p>
            <form id="next" action="event/index" method="post"><input type='hidden' name="annee" value='<?= $annee ?>'><input type='hidden' name="numSem" value='<?= $numSem ?>'><input type='submit' name="next" value='>>'></form>

            <?php 
            for ($j=1; $j < 7 ; ++$j):
             $dateCurr=MyTools::dayCurr($annee, $numSem,$j);
            ?>
                <p><?= Tools::dayOfWeek($dateCurr) ?> <?= $dateCurr ?></p>
                <hr>
               <?php for($i=0;$i<sizeof($events);++$i):
                   if($dateCurr == substr($events[$i]->dateStart, 0, 10)):?>
                        <p class="head" style="color:#<?= $colors[$i] ?>">  <?= $events[$i]->description ?></p>
                             
                            <form  id="EditEvent" action="event/edit/<?= $events[$i]->idevent ?>" methode="post">
                                <input type='hidden' name="idevent" value='<?= $events[$i]->idevent ?>'>
                                <input type="submit" value="Edit">
                                
                            </form>
                       
                        <?php if ($events[$i]->whole_day == 1): ?>
                            <p>All day</p>
                            
                        <?php else : ?>
                            <p><?= substr($events[$i]->dateStart, 10) ?> >> </p> 
                             <form class="head" id="EditEvent" action="event/edit/<?= $events[$i]->idevent ?>" methode="post"></form>
                <?php endif;endif;endfor;endfor; ?>
                            
                            
            <form id="newEvent" action="event/create" method="post"><input type="submit" value="Add"></form>
        </div>
    </body>
</html>



