<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/2/17
 * Time: 11:05 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php
$data = $this->context->accessData();
$post_archives = $data['get_post_archives'];
if (!empty($post_archives)): ?>
    <div class="widget">
        <h2 class="widgettitle"><?php echo Yii::t('app', 'Archives') ?></h2>
        <ul class="menu">
            <?php foreach ($post_archives as $post):
                $date = \DateTime::createFromFormat('!m', $post['month']);
                $month_name = $date->format('M'); ?>
                <li>
                    <a href="<?php echo Url::to(['/archives', 'month' => $post['month'], 'year' => $post['year']]) ?>">
                        <?php echo $month_name ?> <?php echo $post['year'] ?>
                        <strong class="pull-right"><?php echo $post['number'] ?></strong>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
