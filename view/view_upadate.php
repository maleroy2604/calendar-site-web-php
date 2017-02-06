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
            <form id="createEvent" action="main/create" method="post">
                <table>
                    <tr>
                        <td>Title:</td>
                        <td><input id="title" name="title" type="text"  value=""></td>
                        <td class="errors" id="errTitle"></td>
                    </tr>
                    <tr>
                        <td>Calendar :</td>
                        <td><select id="calendar" name="calendar"> </td>

                        <td class="errors" id="errCalendar"></td>
                    </tr>
                    <tr>
                        <td>Description :</td>
                        <td><textarea id="description " name="description"  type="text" value="" rows="3"></textarea>></td>
                        <td class="errors" id="errdescription"></td>
                    </tr>
                    <tr>
                        <td>Start time :</td>
                        <td><input id="startTime" name="start" type="datetime"  value=""></td>
                        <td class="errors" id="errStart"></td>
                    </tr>
                    <tr>
                        <td>
                        <td>Finish time :</td>
                        <td><input id="finishTime" name="finish" type="datetime"  value=""></td>
                        <td class="errors" id="errFinish"></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="wholeDay" type="checkbox" name="wholeDay">
                            <label for="wholeDay"> whole day event </label>
                        </td>
                    </tr>

                </table>
                <input type="submit" value="Delete">
                <input id="btn" type="submit" value="Cancel">
                <input de type="submit" value="Create">
                
            </form>
            <?php if (count($errors) != 0): ?>
                <div class='errors'>
                    <br><br><p>Please correct the following error(s) :</p>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>