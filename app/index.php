<?php
session_start();
?>
<html>

<head>
    <title>Покер на костях</title>
    <meta charset="UTF-8">
</head>

<body>
    <form method="POST" action="roll-the-dice.php">
        <input type="submit" value="Бросить кубики" />
        <?php
            if (isset($_SESSION['result'])) {
                echo $_SESSION['result'];
                unset($_SESSION['result']);
            }
        ?>
    </form>
</body>

</html>