                       
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Create event </title>
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
                          minlength: 3,   
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
                            regex:'doit commencé par une majuscule, des lettre et des chiffres !',
                            
                        },
                        description: {
                            required: 'required',
                            maxlength: 'maximun 100 caractères',
                        }
                      },
                  
                    });
            });
           



        </script>
    </head>
    <body>
        <div class="title">Create event </div>
        <div class="main">
            <br><br>

            <form class="formEvent" id="createEvent" action="event/add" method="post"> 

                <label class="labelEvent" >Title :</label><input  id="title" name="title" type="text"  ><br />
                <label class="labelEvent" >Calendar :</label><select  id="calendar" name="calendar" >
                    <?php foreach ($calendars as $calendar): ?>
                        <option name="calendar" value="<?= $calendar->idcalendar ?>"> <?= $calendar->description == '' ? 'calendar sans nom' : $calendar->description ?> </option>
                    <?php endforeach; ?>
                </select><br />
                <label class="labelEvent" >Description :</label><textarea  id="description" name="description"   rows="3"></textarea><br />
                <label class="labelEvent" >Start time :</label> <input  id="startDate" name="start" type="date"  ><input id="startTime" name="startTime" Type="time"><br />
                <label class="labelEvent" >Finish time :</label><input  id="finishDate" name="finish" type="date"  ><input id="finishTime" Type="time" name="finishTime"><br />
                <label  for="wholeDay" class="labelEvent"> whole day event </label><input id="wd" id="wholeDay" type="checkbox" name="wholeday"><br />
                <input  type="submit" value="Create">


            </form> 
            <form  class="formEvent" id="cancelEvent" action="Event/cancel" method="post">
                <input id="btn" type="submit" value="Cancel">
            </form>  



        </div>
    </body>
</html>

