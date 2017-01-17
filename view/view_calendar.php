<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $user->pseudo ?> 's calendar</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
       <?php include('menu.html'); ?>
        <div class="main">
            
            
            <p>These are <?= $user->pseudo ?>'s calendar:</p>

            

            <table id="message_list" class="message_list">
                <tr>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Action</th>
                    
                </tr>
                <?php foreach ($calendars as $calendar): ?>
                    
                        <tr>
                            <form id="message_id" action="calendar/edit" method="post">
                            <td><textarea id="body" name="body" rows='1'value='<?= $calendar->description?>'></textarea></td>
                            <td><input type="color" value='<?= $calendar->color?>'name="textcolor"></td>
                            <td><iput type='submit' value='edite'><form id="message_id" action="calendar/delete" method="post"><input type='submit' value='delete'></form></td>

                            </form>
                        </tr>
                        
                    
                <?php endforeach; ?>
                        
                            <tr>
                                <form id="message_id" action="calendar/add" methode="post">
                                    <td><input type="text" name="description"  value="enter description"></td>
                                    <td><input type="color" name="color" value="color"></td>
                                    <td> <input type='submit' value='add calendar'></td>
                                </form>
                            </tr>
            </table>
        </div>
        
    </body>
</html>


