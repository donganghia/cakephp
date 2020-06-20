<?php
use Cake\Routing\Router;
?>
<div class="page confirm ">
    <div class="alert">
        <div class="notice2">以下の案件確認データを送信します。<br>
            よろしいですか？</div>
        <div class="subcontractor2">
            <p>案件番号：EK20181036</p>
            <p>お客様名：山本商店</p>
            <p>確認状態：確認済み</p>
        </div>
        <div class="btn_confirm">
            <a href="<?= Router::url( '/pages2/confirm1'); ?>" class="abt yes">OK</a>
            <a href="" class="abt cancel">キャンセル</a>
        </div>
    </div>
</div>
