<?php

namespace Templates;

class Template
{
    public static function render ($code){?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo ($GLOBALS['CSS']."style.css?v=1")?>" >
    <link rel="stylesheet" href="<?php echo($GLOBALS['CSS']."style-statics.css?v=1") ?>" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <title>PRIIIIIMO VICTORIA</title>
</head>
    <body>
        <?php include $GLOBALS['TEMPLATE']."header.php"; ?>
        <div id="body-page">
            <?php echo $code?>
        </div>
        <?php include $GLOBALS['TEMPLATE']."footer.php"; ?>
    </body>
</html>
<?php }
} ?>