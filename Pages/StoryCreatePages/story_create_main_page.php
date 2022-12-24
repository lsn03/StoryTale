<?php
session_start();
$id = null;
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
} else {

    header('Location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать историю</title>
    <link rel="stylesheet" href="storycreate.css">
    <link rel="stylesheet" href="../footer.css">
</head>

<body>
    <script src="MainPage.js"></script>
    <div class="con">
        <div class="content">
            <div class="title">
                <div class="text">Создать</div>
            </div>
            <div class="form">
                <form action="createMain.php" method="post" id="usrform" class="usrform">
                    <input type="hidden" name="id_user" value="<?php echo $id ?>">
                    <!--<div class="in">
                        <div class="ni2">Обложка<input type="file" class="input" id="image" name="img"></div>
                    </div>
-->
                    <div class="in">
                        <div class="ni2">Назание<input type="text" name="name" class="input" id="name" required></div>
                    </div>
                    <div class="in">
                        <div class="ni2">
                            Жанр
                            <select name="genre" class="input" id="genre">
                                <option value="fantasy">Фентези</option>
                                <option value="science_fiction">Научная фантастика</option>
                                <option value="dramaturg">Драматургия</option>
                                <option value="detective">Детективы</option>
                            </select>
                        </div>
                    </div>
                    <div class="in">
                        <div class="ni2">Описание<input style=" background-color:#EFE8E2;" type="text" name="description" class="input" id="description" required></div>
                    </div>
                </form>
                <div class="commentWrap">
                    <div class="ni2">Содержимое<textarea name="comment" class="comment" form="usrform" required></textarea></div>
                </div>
            </div>

            <input class="button" id="au" form="usrform" type="submit" value="Создать историю" style="border: none;">
        </div>
        <?php 
        include "../footer.php";
        ?>
    </div>
</body>

</html>