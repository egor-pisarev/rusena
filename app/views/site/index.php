<?php
use yii\widgets\ListView;
?>
<section>
    <h2>Производство и оптовая продажа стильной женской одежды из Польских и Турецких тканей.</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
    </p>
</section>
<section>
    <h1>Хиты продаж</h1>
    <div class="catalog-list items">
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $productsDataProvider,
                'itemView' => '@app/modules/shop/views/catalog/_product',
                'itemOptions'=>[
                    'class'=>'item',
                ],
                'summary'=>'',
            ]) ?>
        </div>
    </div>
</section>
<section>
    <h1>В ДВУХ СЛОВАХ О НАС</h1>
    <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
    </p>
    <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
    </p>
    <p>
        <a href="#" class="content-btn more">Подробнее</a>
    </p>
</section>
