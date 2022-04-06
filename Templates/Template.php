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
    <link rel="stylesheet" href="<?php echo ($GLOBALS['CSS']."style.css?=v1")?>" >
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