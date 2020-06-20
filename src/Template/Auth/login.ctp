<?php $this->layout = false; ?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $this->fetch('title') ?></title>
        <?= $this->Html->meta('icon') ?>

        <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC:200,300,400,500,600,700,900&amp;subset=chinese-simplified,cyrillic,japanese,vietnamese" rel="stylesheet">
        
        <!-- css -->
        <?= $this->Html->css('lib/bootstrap.min.css')?>
        <?= $this->Html->css('common.css') ?>
        <?= $this->Html->css('auth/login.css') ?>
        <!-- js -->
        <?= $this->Html->script('lib/jquery-3.3.1.min.js') ?>
        <?= $this->Html->script('lib/bootstrap.min.js') ?>
        <?= $this->Html->script('common.js') ?>
        <?= $this->Html->script('auth/login.js') ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <div id="main" class="container clearfix">
            <div class="login-form">
                <div class="main-div">
                    <div class="panel">ログイン</div>
                    <?= $this->Form->create(null, ['id' => 'login']) ?>
                        <?= $this->Flash->render() ?>
                        <?= $this->Flash->render('success') ?>
                        <?= $this->Flash->render('error') ?>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="ユーザーID" value="<?= isset($objEntity->username) ? $objEntity->username : '' ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="パスワード">
                        </div>
                        <div class="form-group text-center">
                          <?= $this->Recaptcha->display() ?>
                        </div>
                        <div class="text-right">
                            <button class="btn-blue btn-login" type="submit">ログイン</button>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
                <div class="logo"><?= $this->Html->image('e-kurasilogo.png') ?></div>
            </div>
        </div>
    </body>
</html>