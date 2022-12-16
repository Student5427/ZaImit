<?php
use yii\bootstrap\Carousel;
/* @var $this yii\web\View */

$this->title = 'ZaimIT';
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <?php
                echo Carousel::widget([
                    'items' => [
                        // the item contains both the image and the caption
                        [
                            'content' => '<img src="png/222222.png"/>',
                            'caption' => '
                            <h1>ZaimIT</h1>
                            <p>Данный сайт представляет собой проект студентов Петрозаводского Государственного университета
                            по дисциплине "Технология производства програмного обеспечения". Данный сайт предостваляет возможность ведения клиентов
                            при выдаче микрозаймов. </p>',
                        ],
                        [
                            'content' => '<img src="png/222222.png"/>',
                            'caption' => '
                            <h1>Участники проекта</h1>
                            <div class="members">
                                <h5>Копосов Андрей</h5>
                                <h5>Кобзев Анатолий</h5>
                                <h5>Хайдарова Алиса</h5>
                                <h5>Розум Елизавета</h5>
                                <h5>Скуртенко Шади</h5>
                            </div>',

                        ],
                    ]
                ]);
            ?>
        </div>
    </div>
</div>
