<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $user->pseudo ?> 's calendar</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <script src="lib/lib/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="lib/lib/jquery-ui-1.12.1.ui-lightness/jquery-ui.min.js" type="text/javascript"></script>
        <script src="lib/lib/jquery-validation-1.16.0/jquery.validate.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                
                var idcalendar=null;
                $(".description").dblclick(function () {
                    var idcalendar=$(this).attr("idcal");
                    $('#confirmDialog').dialog({
                        resizable: false,
                        height: 300,
                        width: 500,
                        modal: true,
                        autoOpen: true,
                        buttons: {
                            Confirm: function () {
                                ret = "delete";
                                 $.post("Calendar/remove_calendar_ajax/",{
                                     "idcalendar": idcalendar,
                                     "confirm": "true"
                                 })
                                $(this).dialog("close");
                                location.reload();
                            },
                            Cancel: function () {
                                ret = "cancel";
                                $(this).dialog("close");
                            },

                        }
                    });
                });
                $('#calendar_id').validate({
                   rules: {
                    
                            description: {
                                required: true,
                                maxlength: 30,
                            },
                        },
                      messages: {
                        description: {
                            maxlength: 'maximum 30 caractères !',
                            required: 'required',
                           
                        },
                    }
                  
                    });
                
            })


        </script>
    </head>


    <body>
        <div class="title">My Calendar</div>
        <?php include('menu.html'); ?>
        <div class="main">

            <p>These are <?= $user->pseudo ?>'s calendar:</p>

            <label class="labelcalendar">Description:</label>
            <label class="labelcalendar">Color:</label>
            <label class="labelcalendar">Action:</label>


            <?php  foreach($calendars as $calendar):?>

                <form class="formcalendar" action="calendar/edit/<?= $calendar->idcalendar ?>" method="post">
                    <input class="description" idcal='<?= $calendar->idcalendar ?>'  type="text" name="description"  value='<?= $calendar->description ?>' style="color:<?= $calendar->color ?>" >
                    <input type="color" value='<?= $calendar->color ?>' name="color">
                    <input class="idcalendar" type='hidden' value='<?= $calendar->idcalendar ?>' name="id">
                    <input type='submit' value='Edit' name="editcalendar">
                </form>
                <form  class="formcalendar" action="calendar/delete/<?= $calendar->idcalendar ?>" method="post">
                    <input id="delbtn" type='submit'name="delcalendar" value='Delete'> 
                </form>
                <form class="formcalendar" action="share/index/" method="post">
                    <input type='hidden' name="idcalendar" value="<?= $calendar->idcalendar ?>">
                    <input type='submit'  name="shareCalendar" value='Share'> 
                </form>
            <?php endforeach; ?>
            <?php foreach ($calendarx as $calendar): ?>
                <div class="formcalendar">
                    <input readonly="readonly"  type="text" name="description"  value='<?= $calendar->description ?>' style="color:<?= $calendar->color ?>" >
                    <input disabled="disabled" type="color" value='<?= $calendar->color ?>' name="color">

                </div>
                <br>

            <?php endforeach; ?>

            <form class="formcalendar" id="calendar_id" action="calendar/add" method="post">
                <input id="description" type="text" name="description" >
                <input  type="color" name="color" >
                <input  type='submit' name="addcalendar" value='Add'>
            </form>


        </div>
        <div id="confirmDialog"  hidden>
            <p id="p"> voulez-vous vraiment supprimer ce calendrier ! </p>
        </div>
    </body>
</html>


