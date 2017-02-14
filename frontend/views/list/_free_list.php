<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 15/02/2016
 * Time: 20:56
 */

use yii\widgets\LinkPager;

?>

<div class="posts posts-condensed">

    <?php if (!empty($place_list)): ?>
        <?php foreach ($place_list as $list): ?>
            <div class="post">
                <div class="post-image">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $list['place_slug'] ?>" target="_blank">
                        <img src="<?php echo Yii::$app->params['tn_thumbnails'] . $list['logo'] ?>"
                             alt="<?php echo $list['place_name'] ?>"
                             style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 14px; width: 128px;'>
                    </a>
                </div>

                <div class="post-content">
                    <h2>
                        <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $list['place_slug'] ?>" target="_blank"><?php echo $list['place_name'] ?></a>
                        <small> <?php echo $list['service_name'] ?></small>
                    </h2>
                    <p>
                        <?php $data_by_ids = $this->context->accessDataByIds($list['place_id']);
                        $place = $data_by_ids['get_place_by_id']; ?>

                        <?php if ($place->street != null): ?>
                            <small>Street: <a href="#"><?php echo $place->street ?></a></small> |

                        <?php endif;
                        if ($place->neighborhood != null): ?>

                            <small>Neighborhood: <a href="#"><?php echo $place->neighborhood ?></a></small> |

                        <?php endif;
                        if ($place->province_id != null): ?>

                            <small>Province: <a href="#"><?php echo $place->getProvinceName() ?></a></small> |

                        <?php endif;
                        if ($place->district_id != null): ?>

                            <small>District: <a href="#"><?php echo $place->getDistrictName() ?></a></small>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="post-more">
                    <a title="View profile" class="btn btn-default btn-sm"
                       href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $list['place_slug'] ?>"><i
                            class="fa fa-eye"></i></a>
                </div>
            </div>

        <?php endforeach; ?>
    <?php elseif (!empty($services)): ?>
        <?php foreach ($services as $service): ?>

            <div class="post">
                <div class="post-image">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $service['place_slug'] ?>" target="_blank">
                        <img src="<?php echo Yii::$app->params['tn_thumbnails'] . $service['logo'] ?>"
                             alt="<?php echo $service['place_name'] ?>"
                             style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 14px; width: 128px;'>
                    </a>
                </div>

                <div class="post-content">
                    <h2>
                        <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $service['place_slug'] ?>" target="_blank"><?php echo $service['place_name'] ?></a>
                        <small> <?php echo $service['service_name'] ?>
                    </h2>
                    <p>
                        <?php $place = $this->context->getPlaceById($service['place_id']); ?>

                        <?php if ($place->street != null): ?>
                            Street: <a href="#"><?php echo $place->street ?></a> |

                        <?php endif;
                        if ($place->neighborhood != null): ?>

                            Neighborhood: <a href="#"><?php echo $place->neighborhood ?></a> |

                        <?php endif;
                        if ($place->province_id != null): ?>

                            Province: <a href="#"><?php echo $place->getProvinceName() ?></a> |

                        <?php endif;
                        if ($place->district_id != null): ?>

                            District: <a href="#"><?php echo $place->getDistrictName() ?></a>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="post-more">
                    <a title="View profile" class="btn btn-default btn-sm"
                       href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $service['place_slug'] ?>" target="_blank"><i
                            class="fa fa-eye"></i></a>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="pager">
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Welcome to Rwanda Guide! </strong><?php echo Yii::$app->params['missing_message'] ?>
        </div>
    <?php endif; ?>
</div>