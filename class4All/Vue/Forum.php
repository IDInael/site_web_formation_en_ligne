
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Forum de discussion</title>
    <script type="text/javascript" src="style/jquery-3.5.1.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="style/css/home.css">
    <link rel="stylesheet" type="text/css" href="style/css/footer.css">
    <link rel="stylesheet" type="text/css" href="style/css/forum.css">
    <script type="text/javascript" src="../Controller/header.js"></script>

    <script type="text/javascript" src="style/js/page.js"></script>
    <link rel="stylesheet" type="text/css" href="style/css/page.css">
    <script type="text/javascript" src="../Controller/forum.js"></script>
</head>
<body>
    <header>
        <?php
                include 'header.inc.php';
        ?>
    </header>
    <div id="forum">
        <?php

            if(isset($_GET['nom_cours']))
            {
                echo '<h1>Forum de discussion : '.$_GET['nom_cours'].'</h1>';
            }
        ?>

        <div id="body">
            
            <div id="discussion">

            </div>
            <div>
                <form id="publication" method="post" action="../Modele/sauvegarde_forum.php">
                    <div><textarea id="message" name="message" rows="5" cols="80" required="required"></textarea></div>
                    <div><button>Poster</button></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>