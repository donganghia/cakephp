<?php

use Cake\Routing\Router;

?>
<div class="page confirm">
    <div class="alert">
        <div class="notice">更新データを再度委託先に送信しますか？</div>
        <div class="subcontractor">
            <p>委託先：株式会社〇〇◯</p>
<!--            <p>委託先：株式会社〇〇◯</p>-->
        </div>
        <div class="btn_confirm">
            <a href="<?= Router::url('/pages/confirm1'); ?>" class="abt yes">確定</a>
            <a href="" class="abt cancel">キャンセル</a>
        </div>
    </div>
</div>
