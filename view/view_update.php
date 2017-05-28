<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update event </title>
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
            $.validator.addMethod("regex", function (value, element, pattern) {
                if (pattern instanceof Array) {
                    for (p of pattern) {
                        if (!p.test(value))
                            return false;
                    }
                    return true;
                } else {
                    return pattern.test(value);
                }
            },
                    "Please enter a valid input.");
            $(function () {
                $("#wd").click(function () {
                    var check = $(this).prop("checked");
                    if (check !== "") {
                        $("#startTime").attr("disabled", "disabled");
                        $("#finishTime").attr("disabled", "disabled");

                    } else {
                        if (check === "") {
                            $("#startTime").removeAttr("disabled");
                            $("#finishTime").removeAttr("disabled");
                        }
                    }
                });
                 $('#createEvent').validate({
                   rules: {
                    title: {
                           required: true,
                           regex: /^[A-Z][a-zA-Z0-9]*$/,
                           minlength:3,   
                        },
                       description: {
                           required: true,
                           maxlength: 100,
                        },
                        },
                      messages: {
                        title: {
                            minlength: 'au minimum trois caractère !',
                            required: 'required',
                            regex:'doit commencé par une majuscule, due des lettre et des chiffres !'
                            
                        },
                        description: {
                            required: 'required',
                            maxlength:' au maximum 100 caractères !'
                        }
                      },
                  
                    });
            });
           



        </script>
    </head>
    <body>
        <div class="title">Update event </div>
        <div class="main">

            <br><br>


            <form class="formEvent" id="createEvent" action="event/update/<?= $event->idevent ?>" method="post">

                <label class="labelEvent">Title:</label><input id="title" name="title" type="text"  value="<?= $event->title ?>"><br />



                <label class="labelEvent"> Calendar :</label> <select  name="idcalendar" >
                    <?php foreach ($calendars as $calendar):
                    
                     if ($calendar->idcalendar == $event->idcalendar): 
                         $selected='selected="selected"';
                     else : 
                         $selected='';
                    endif; ?>
                    <option <?= $selected ?> value="<?= $calendar->idcalendar ?>"> <?= $calendar->description ?> </option>
                   
                    <?php endforeach; ?>

                </select><br />



                <label class="labelEvent">Description :</label><textarea  name="description"    rows="3"><?= $event->description ?></textarea><br />


                <label class="labelEvent"> Start time :</label><input id="startDate" name="start" type="date"  value="<?= tools::dateHtml($event->dateStart) ?>"><input id="startTime" name="startTime" Type="time" value="<?= tools::heureHtml($event->dateStart) ?>"><br />




                <label class="labelEvent">Finish time :</label><input id="finishDate" name="finish" type="date"  value="<?= tools::dateHtml($event->dateFinish) ?>"><input id="finishTime" Type="time" name="finishTime" value="<?= tools::heureHtml($event->dateFinish) ?>"><br />


                <label class="labelEvent" for="wholeDay"> whole day event </label>
                <input  id="wd" id="wholeDay" type="checkbox" name="wholeday"  checked="<?= $event->whole_day ? ' checked ' : '' ?> "  ><br />

                <input type="submit" name="update" value="Update">
            </form>



            <form class="formEvent" id="cancelEvent" action="event/index" method="post">
                <input  type="submit" value="Cancel">
            </form>





            <form  class="formEvent" id="deleteEvent" action="event/deletevent/<?= $event->idevent ?>" method="post">
                <input type="submit" value="delete">
            </form>




        </div>
    </body>
</html>

