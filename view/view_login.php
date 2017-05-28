

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <script src="lib/lib/jquery-3.1.1.min.js" type="text/javascript"></script>
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
                $('#signupForm').validate({
                    rules: {
                        pseudo: {
                            remote: {
                                url: 'main/pseudo_Exist_service',
                                type: 'post',
                                data: {
                                    pseudo: function () {
                                        return $("#pseudo").val();
                                    }
                                }
                            },
                        },
                     
                    },
                    messages: {
                        pseudo: {
                            remote: 'this pseudo doesn t exist !',
                            required: 'required',
                           
                        },
                    }
                });
                $("input:text:first").focus();
            }
            );
        </script>
        
    </head>
    <body>
        <div class="title">Log In</div>
        <div class="menu">
            <a href="main/index">Index</a>
            <a href="main/signup">Sign Up</a>
        </div>
        <div class="main">
            <form id="signupForm" action="main/login" method="post">
                <table>
                    <tr>
                        <td>Pseudo:</td>
                        <td><input id="pseudo" name="pseudo" type="text" value="<?= $pseudo ?>"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value="<?= $password ?>"></td>
                    </tr>
                </table>
                
                    <input   type="submit" value="Log In"  >
               
            </form>
            <?php if ($error): ?>
                <div class='errors'><br><br><?= $error ?></div>
                <?php endif; ?>
        </div>
    </body>
</html>

