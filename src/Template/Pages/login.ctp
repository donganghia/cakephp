<?php

use Cake\Routing\Router;

?>
<div class="login-form">
    <div class="main-div">
        <div class="panel">
            ログイン
        </div>
        <form id="login" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="user_id" placeholder="ユーザーID">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="パスワード">
            </div>
            <div class="recapcha">
                <?= $this->Html->image('recapchre1.jpg') ?>
            </div>
            <!--            <button type="submit" class="btn-login">ログイン</button>-->
            <a href="<?= Router::url('/pages/menu'); ?> " class="btn-blue btn-login">ログイン</a>
        </form>
    </div>
    <div class="logo"><?= $this->Html->image('e-kurasilogo.png') ?></div>
</div>
