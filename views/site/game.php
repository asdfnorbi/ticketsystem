<?php

/* @var $this yii\web\View */


$this->title = 'Ticket system';
?>

<?php
if(!Yii::$app->user->isGuest &&  !Yii::$app->user->identity->isAdmin()){

    ?>
    <div class="site-index">
        <div class="jumbotron">
            <h1>Amíg az adminokra vársz, játsz!</h1>
        </div>
        <div class="body-content" align="left">
            <div class="col-lg-12">
                <center>
                <canvas id="game" width="480px" height="480px" style="border:1px solid #000000;" ></canvas>
                </canvas>
                    <script>
                        var c = document.getElementById("game");
                        var ctx = c.getContext("2d");


                        var gokuX = 200;
                        var gokuY = 300;

                        ctx.beginPath();
                        ctx.rect(0, 0, 480, 480);
                        ctx.fillStyle = "#b3ffff";
                        ctx.fill();

                        ctx.beginPath();
                        ctx.rect(0, 370, 480, 480);
                        ctx.fillStyle = "#66ff33";
                        ctx.fill();

                        goku = new Image();
                        goku.src = "/picture/songoku.png";
                        ctx.drawImage(goku, gokuX, gokuY, 100, 100);



                    </script>
                </center>
            </div>
        </div>
    </div>
    <?php
}


?>

