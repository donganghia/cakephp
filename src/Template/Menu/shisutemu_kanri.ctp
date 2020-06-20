<?php
use App\Model\Table\MUserTable;
use Cake\Routing\Router;
?>
<div class="page register_maintenance" id="maintenance">
    <?= $this->element('_back', ['url' => Router::url(['controller' => 'Menu', 'action' => 'main'])]); ?>
    <div class="content">
        <h1 class="title">システム管理</h1>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6"><h4>管理者メニュー</h4></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 menu-list">
                <div class="row">
                    <div class="col-lg-6"><a  href="<?= Router::url(['controller'=> 'Project', 'action'=> 'kizonHenshuuIchiran']); ?>" class="abt">既存データ編集</a></div>
                    <div class="col-lg-6"><a href-2="" class="abt coming-soon">管理向けデータ出力</a></div>
                </div>
                <div class="row">
                    <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Log', 'action'=> 'index']); ?>" class="abt">利用状況管理</a></div>

                </div>
                <div class="row">
                    <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'comment', 'action'=> 'index']); ?>" class="">連絡コメント</a></div>
                </div>
            </div>
        </div>
    </div>
</div>