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
        <link href="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <script src='lib/lib/moment.min.js'></script>

        <script src="lib/lib/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.min.js" type="text/javascript"></script>
        <script src='lib/fullcalendar.min.js'></script>


        <script>
            $(document).ready(function () {
                $('#php').hide();
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'

                    },
                    events: {
                        url: "Event/get_events_json",
                        type: 'POST'
                    },
                    eventClick: function (event, jsEvent, view) {
                        $('#confirmDialog').dialog({
                            resizable: false,
                            height: 800,
                            width: 600,
                            modal: true,
                            autoOpen: true,
                            buttons: {
                                Confirm: function () {
                                    ret = "delete";
                                    deleteEvent(event.id);
                                    $(this).dialog("close");
                                },
                                Cancel: function () {
                                    ret = "cancel";
                                    $(this).dialog("close");
                                },
                                Edit: function(){
                                    ret = "update";
                                   updateEvent(event);
                                }
                            }
                        });
                    }

                });
            });

            function deleteEvent(id) {
                $.post("Event/remove_event_ajax/",
                    {"idevent": id,"confirm":"true"}
                ).done(function(){
                    $('#calendar').fullCalendar( 'refetchEvents' );
                }
                ).fail(function(){
                    alert("<tr><td>Error encountered while retrieving the messages!</td></tr>");
                    
                });
            }
            function updateEvent(event) {
                window.location = "event/edit/"+event.id;
                /*$.post("Event/edit/",
                        {"idevent": event.id,"update":"true"}
                ).done(function(){
                    $('#calendar').fullCalendar( 'refetchEvents' );
                }
                ).fail(function(){
                    alert("<tr><td>Error encountered while retrieving the messages!</td></tr>");
                    
                });*/
            }
            


        </script>
    </head>

    <body>
      
        <div class="title" >My Planning</div>
        <?php include('menu.html'); ?>
        
        <div class="main" id="calendar" ></div>
        <form id="newEvent" action="event/create" method="post"><input  id="edit" type="submit" name="create" value="Add"></form>
        <div class="main" id="php" >
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
                    $debut = substr($events[$i]->dateStart, 0, 10);
                    $fin = substr($events[$i]->dateFinish, 0, 10);
                    $whole_day = $events[$i]->whole_day;
                    if ($dateCurr >= $debut && $dateCurr <= $fin):
                        ?>

                        <div class="alignEvent">
                            <?php if ($whole_day == 1): ?>
                                <p class="viewEvent">All day</p>
                            <?php elseif ($dateCurr == $debut && $dateCurr < $fin): ?>
                                <p class="formEvent"> <?= substr($events[$i]->dateStart, 10) ?> >> </p>
                            <?php elseif ($dateCurr < $fin): ?>
                                <p class="viewEvent">All day</p>
                            <?php elseif ($dateCurr == $debut && $dateCurr == $fin && $whole_day != 1) : ?>
                                <p class="formEvent"> <?= substr($events[$i]->dateStart, 10) ?> - <?= substr($events[$i]->dateFinish, 10) ?></p>
                            <?php elseif ($dateCurr == $fin && $whole_day != 1) : ?>
                                <p class="formEvent"> <?= substr($events[$i]->dateFinish, 10) ?> >> </p>     
                            <?php endif; ?>  
                            <label class="viewEvent" style="color:#<?= $events[$i]->get_color() ?>">  <?= $events[$i]->title ?></label>

                            <form  class="viewEvent"  action="event/edit/<?= $events[$i]->idevent ?>" method="post">
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
        <div id="confirmDialog"  hidden>
            
        </div>
    </body>
</html>



