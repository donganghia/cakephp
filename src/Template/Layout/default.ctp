<?php
use App\Libs\Constant;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Constant::TITLE ?></title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC:200,300,400,500,600,700,900&amp;subset=chinese-simplified,cyrillic,japanese,vietnamese" rel="stylesheet">

    <!-- lib css -->
    <?= $this->Html->css('lib/bootstrap.min.css')?>
    <?= $this->Html->css('lib/jquery-confirm.min.css')?>
    <?= $this->Html->css('lib/font-awesome.min.css')?>
    <?= $this->Html->css('lib/glyphicons.css')?>
    <?= $this->Html->css('lib/datatables.min.css')?>
    <?= $this->Html->css('lib/bootstrap-datetimepicker.min.css')?>
    <?= $this->Html->css('lib/fileinput.min.css'); ?>
    <?= $this->Html->css('lib/theme.min.css'); ?>
    <!-- dev css -->
    <?= $this->Html->css('reset.css') ?>
    <?= $this->Html->css('common.css') ?>
    <?= $this->Html->css('style.css') ?>
    

    <!-- lib js -->
    <?= $this->Html->script('lib/jquery-3.3.1.min.js') ?>
    <?= $this->Html->script('lib/bootstrap.min.js') ?>
    <?= $this->Html->script('lib/datatables.min.js') ?>
    <?= $this->Html->script('lib/jquery-confirm.min.js') ?>
    <?= $this->Html->script('lib/moment-with-locales.js') ?>
    <?= $this->Html->script('lib/bootstrap-datetimepicker.min.js') ?>
    <?= $this->Html->script('lib/fileinput.min.js'); ?>
    <?= $this->Html->script('lib/theme.min.js'); ?>
    <?= $this->Html->script('lib/fileinput.ja.js'); ?>
    <?= $this->Html->script('lib/cleave.min.js'); ?>
    <?= $this->Html->script('lib/cleave-phone.jp.js'); ?>
    <?= $this->Html->script('lib/printThis.js'); ?>

    <!-- const js -->
    <?= $this->element('../Layout/default/_js_config'); ?>
    <!-- dev js -->
    <?= $this->Html->script('common.js') ?>
    <?= $this->Html->script('main.js') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="main" class="container clearfix">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <div id="process-content" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog"></div>
</body>
</html>
