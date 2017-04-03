<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/2/17
 * Time: 10:39 PM
 */
/* @var $upcoming_events backend\models\Event */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php $data = $this->context->accessData();
$upcoming_events = $data['get_upcoming_events'];
if (!empty($upcoming_events)): ?>
    <div class="widget">
        <h2 class="widgettitle"><?php echo Yii::t('app', 'Upcoming Events') ?></h2>
        <?php foreach ($upcoming_events as $upcoming_event): ?>
            <div class="cards-small div">
                <div class="card-small">
                    <div class="card-small-image">
                        <a target="_blank" href="<?php echo $upcoming_event->getEventUrl() ?>">
                            <img class="img-responsive img-alt-thumbnail_tn"
                                 src="<?php echo $upcoming_event->getBanner(); ?>"
                                 alt="<?php echo $upcoming_event->name; ?>">
                        </a>
                    </div>

                    <div class="card-small-content">
                        <h3>
                            <a target="_blank"
                               href="<?php echo $upcoming_event->getEventUrl() ?>"> <?php echo $upcoming_event->name; ?></a>
                        </h3>
                        <h4>
                            <a target="_blank"
                               href="<?php echo $upcoming_event->getEventUrl() ?>"><?php echo $upcoming_event->address; ?></a>
                        </h4>
                        <div class="card-small-price"><?php echo $upcoming_event->getDate(); ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>