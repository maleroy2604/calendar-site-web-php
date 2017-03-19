<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Share </title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">sharing </div>
        <?php include('menu.html'); ?>
        <div class="main">

            <br><br>

            <table>
                <?php foreach ($shares as $share): ?>
                    <form  action="share/editShare/<?= $share["idcalendar"] ?>" method="post">
                        <input  name="pseudoShare" value="<?= $share["pseudo"] ?>" readonly="readonly">
                        <input id="read_only" type="checkbox" name="read_only" <?= $share["checked"] ?> value="" >
                        <input type='hidden' name="idcalendar" value="<?= $idcalendar ?>">
                        <label for="read_only"> write permission </label>
                        <input type='submit' name="editShare" value='Edit'>
                    </form>
                    <form  action="share/deleteShare/<?= $share["idcalendar"] ?>" method="post">
                        <input type='hidden' name="pseudo" value="<?= $share["pseudo"] ?>">
                        <input type='hidden' name="idcalendar" value="<?= $idcalendar ?>">
                        <input type='submit' name="deleteShare" value='Delete'> 
                    </form>
                <?php endforeach; ?>
                <form  action="share/addShare" method="post">
                    <input type='hidden' name="idcalendar" value="<?= $idcalendar ?>">
                    <select id="idShare" name="pseudo" >
                        <?php foreach ($users as $user): ?>
                            <option> <?= $user->pseudo ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <input id="read_only" type="checkbox" name="read_only" value="" >
                    <label for="read_only"> write permission </label>
                    <input id="shar" type="submit" name="share" value="Shar my calendar" >
                </form>
            </table>
        </div>
    </body>
</html>




