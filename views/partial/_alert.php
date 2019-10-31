<?php

use yii\bootstrap\Alert;

?>

<?php if ($error = Yii::$app->session->getFlash('success')): ?>
    <?= Alert::widget([
        'options' => ['class' => 'alert-success alert-dismissible'],
        'body' => $error[0],
    ]) ?>
<?php elseif ($error = Yii::$app->session->getFlash('error')): ?>
    <?= Alert::widget([
        'options' => ['class' => 'alert-danger alert-dismissible'],
        'body' => $error[0],
    ]) ?>
<?php elseif ($error = Yii::$app->session->getFlash('warning')): ?>
    <?= Alert::widget([
        'options' => ['class' => 'alert-warning alert-dismissible'],
        'body' => $error[0],
    ]) ?>
<?php endif; ?>
