<?php

/* @var $this yii\web\View */


$this->title = 'Ticket system';
?>

<?php
    if(Yii::$app->user->isGuest){
        ?>
        <div class="site-index">

            <div class="jumbotron">
                <h1>Üdvözöljük a weboldalunkon!</h1>

                <p class="lead">Ticket system rendszerünk megnyitja szolgáltatásait önöknek.</p>
                <p class="lead">Nem vagy még tag? Kattints a regisztrációra!</p>
                <p><a class="btn btn-lg btn-success" href="/user/create" >Regisztráció</a></p>
            </div>
            <div class="body-content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Miről szól az oldalunk?</h2>

                        <p>Az oldalunkra bárki tud regisztrálni, és ezt követően belépni. Ticket rendszer. Felhasználóként újakat hozhat létre, illetve
                            a már meglévőket tudja olvasni.További információért kattintson a Rólunk gombra.</p>

                        <p><a class="btn btn-default" href="/site/about">Rólunk &raquo;</a></p>
                    </div>
                    <div class="col-lg-12">
                        <h2>Szeretne kapcsolatba kerülni velünk?</h2>

                        <p>Ha szeretne üzenetet küldeni nekünk, és kapcsolatba kerülni velünk, akkor kattintson bátran az írjon nekünk
                            gombra, és már meg is teheti, hogy ír nekünk. Igyekszünk önöknek minél hamarabb válaszolni.
                        </p>

                        <p><a class="btn btn-default" href="/site/contact">Írjon nekünk &raquo;</a></p>
                    </div>

                </div>

            </div>
        </div>
        <?php
    }
    else if(!Yii::$app->user->isGuest &&  !Yii::$app->user->identity->isAdmin()){

        ?>
                <div class="site-index">
                    <div class="jumbotron">
                       <h1>Fedezd fel oldalunkat <?php
                            echo Yii::$app->user->identity->username;
                        ?>.</h1>
                        <p class="lead">Több menüpont közül tudsz választani.</p>
                    </div>
                    <div class="body-content" align="left">
                        <div class="col-lg-12">
                            <h2>Milyen funckiók várnak?</h2>

                            <p>Ticketet tudsz feladni, láthatod másokét és kommentelhetsz is. Emellett a saját profilodat
                                tudod szerkeszteni, bizonyos szinten.
                            </p>


                        </div>
                    </div>
                </div>
        <?php
    }


?>



