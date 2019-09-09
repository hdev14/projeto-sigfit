<?php

use yii\bootstrap\Alert;

?>

<?php if ($error = Yii::$app->session->getFlash('success')): ?>
    <?= Alert::widget([
        'options' => ['class' => 'alert-success'],
        'body' => $error[0],
    ]) ?>
<?php elseif ($error = Yii::$app->session->getFlash('error')): ?>
    <<?= Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => $error[0],
    ]) ?>
<?php endif; ?>
