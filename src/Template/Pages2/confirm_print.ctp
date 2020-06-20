<?php
use Cake\Routing\Router;
?>
<div class="page confirm confirm_print">
    <div class="alert">
        <div class="notice">プレビュー表示内容選択</div>
        <div class="btn_confirm">
            <a href="<?= Router::url( '/pages2/print_preview'); ?>" class="abt yes">金額表示しない</a>
            <a href="<?= Router::url( '/pages2/print_preview'); ?>" class="abt cancel">金額表示する</a>
        </div>
    </div>
</div>
