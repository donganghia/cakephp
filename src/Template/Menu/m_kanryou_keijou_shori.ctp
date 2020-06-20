<?php use Cake\Routing\Router; ?>
<div class="page register_maintenance" id="maintenance">
    <?= $this->element('_back', ['url' => Router::url(['controller' => 'Menu', 'action' => 'main'])]); ?>
    <div class="content">
        <h1 class="title">完了計上業務メニュー</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 menu-list">
                <div class="row">
                    <div class="col-lg-6"><a href="<?= Router::url(['controller' => 'Project', 'action' => 'kanryouKeijouShoriIchiran']); ?>" class="abt">完了計上処理</a></div>
                    <div class="col-lg-6"><a href2="<?= Router::url(['controller' => 'MSystem', 'action' => 'index']); ?>" class="abt coming-soon">売上報告書出力</a></div>
                </div>
                <div class="row">
                    <div class="col-lg-6"><a href2="<?= Router::url(['controller' => 'MCustomer', 'action' => 'index']); ?>" class="abt coming-soon">請求書出力</a></div>
                    <div class="col-lg-6"></div>
                </div>
            </div>
        </div>
    </div>
</div>
