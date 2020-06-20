<?php use Cake\Routing\Router; ?>
<div class="page register_maintenance" id="maintenance">
    <?= $this->element('_back', ['url' => Router::url(['controller' => 'Menu', 'action' => 'main'])]); ?>
    <div class="content">
        <h1 class="title">マスター保守メニュー</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 menu-list">
                <div class="row">
                    <div class="col-lg-6"><a href="<?= Router::url(['controller' => 'MProduct', 'action' => 'index']); ?>" class="abt">商品マスタ</a></div>
                    <div class="col-lg-6"><a href="<?= Router::url(['controller' => 'MSystem', 'action' => 'index']); ?>" class="abt">案件管理マスタ</a></div>
                </div>
                <div class="row">
                    <div class="col-lg-6"><a href="<?= Router::url(['controller' => 'MSupplier', 'action' => 'index']); ?>" class="abt">仕入先マスタ</a></div>
                    <div class="col-lg-6"><a href="<?= Router::url(['controller' => 'MUser', 'action' => 'index']); ?>" class="abt">利用者マスタ</a></div>
                </div>
                <div class="row">
                    <div class="col-lg-6"><a href="<?= Router::url(['controller' => 'MCustomer', 'action' => 'index']); ?>" class="abt">顧客マスタ</a></div>
                    <div class="col-lg-6"></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 total">マスター件数</div>
        </div>
        <div class="row justify-content-center total-list">
            <div class="col-md-6 col-lg-6">
                <div class="row">
                    <div class="col">商品　<?= number_format($intProduct) ?> 件</div>
                    <div class="col">取引先 <?= number_format($intSupplier) ?> 件</div>
                    <div class="col">顧客 <?= number_format($intCustomer) ?> 件</div>
                </div>
            </div>
        </div>
    </div>
</div>
