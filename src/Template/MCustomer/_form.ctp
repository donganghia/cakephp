<?php
use App\Model\Table\MCustomerTable;
use App\Model\Table\MSystemTable;
use Cake\Routing\Router;
use App\Libs\Crypt;

?>

<style type="text/css">
    .tab-content {
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
    }

    .col-md-12 {
        padding-top: 10px;
    }

    .kaiin, .none-kaiin {
        display: none;
    }
</style>

<?= $this->element('../MCustomer/_form_js', ['type' => $type]) ?>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url(['controller'=> 'MCustomer', 'action'=> 'index'])]); ?>
        <h1 class="title"><?= $title ?></h1>
    </div>
    
    <?= $this->Form->create($mCustomer, ['autocomplete' => 'off', "id" => "frmCustomer"]) ?>
        <div class="form-group row">
            <div class="col-sm-12">
                <?= $this->Flash->render() ?>
                <!-- <?= $this->Flash->render('success') ?> -->
                <?= $this->Flash->render('error') ?>
            </div>
        </div>

        <?php if($type === 'edit') : ?>
            <div class="form-group row">
                <label for="select_id" class="col-sm-2 col-form-label text-right">会員番号</label>
                <div class="col-sm-3 none-kaiin">
                    <?= $this->Form->select('id', $aryKaiinBangou, [
                        'id' => 'select-id',
                        'name' => 'select_id',
                        'value' => $selectedId,
                        'class' => 'form-control'
                    ]); ?>
                </div>
                <div class="col-sm-3 none-kaiin">
                    <button id="create-new-kainin" class="btn btn-secondary btn-sm" type="button">新規会員番号発行</button>
                </div>
                <div class="col-sm-3 kaiin">---</div>
            </div>
            <div class="form-group row">
            <label for="m_system_kaiinshurui_id" class="col-sm-2 col-form-label text-right">会員種類</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_kaiinshurui_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIIN_SHURUI]), [
                    'class' => 'form-control'
                ]); ?>
            </div>
            </div>
        <?php else: ?>
            <div class="form-group row">
                <label for="m_system_kaiinshurui_id" class="col-sm-2 col-form-label text-right">会員種類</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('m_system_kaiinshurui_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIIN_SHURUI]), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="form-group row">
            <label for="m_system_kihonsyubetu_id" class="col-sm-2 col-form-label text-right">基本種別</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_kihonsyubetu_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KIHON_SHUBETSU]), [
                    'class' => 'form-control'
                ]); ?>
            </div>
            <label for="m_system_kaiinenji_id" class="col-sm-2 col-form-label text-right">会員年次</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_kaiinenji_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIIN_NENJI]), [
                    'class' => 'form-control'
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="m_system_tantousha_id" class="col-sm-2 col-form-label text-right">担当者名</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_tantousha_id', $this->VHtml->selectNull(isset($aryMSystem[MSystemTable::SYSTEM_TANTOUSHA]) ? $aryMSystem[MSystemTable::SYSTEM_TANTOUSHA] : []), [
                    'class' => 'form-control'
                ]); ?>
            </div>
            <label for="m_mediation_gensen_id" class="col-sm-2 col-form-label text-right">源泉</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_mediation_gensen_id', $this->VHtml->selectNull($aryMediation), [
                    'class' => 'form-control'
                ]); ?>
            </div>
        </div>
        <?php
        $defaultTab = isset($mCustomer->active_tab) ? $mCustomer->active_tab : MCustomerTable::TAB_MEMO;
        $aryTab = MCustomerTable::TAB;
        if($type === 'add') {
            unset($aryTab[MCustomerTable::TAB_RIREKI_KANRI]);
        }
        ?>
        <input id="active_tab" name="active_tab" type="hidden" value="<?= $defaultTab ?>">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php foreach ($aryTab as $tabKey => $tabItem): ?>
                <?php ($tabKey === $defaultTab) ? ($ariaSelected = 'active') : ($ariaSelected = ''); ?>
                <li class="nav-item">
                    <a id="aria-<?= $tabKey ?>" class="nav-link <?= $ariaSelected ?>" data-toggle="tab" href="#tab-<?= $tabKey ?>" role="tab" aria-controls="#tab-<?= $tabKey ?>" aria-selected="<?= $ariaSelected ?>" data-value="<?= $tabKey ?>"><?= $tabItem ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <?php foreach ($aryTab as $tabKey => $tabItem): ?>
                <?php ($tabKey === $defaultTab) ? ($ariaSelected = 'show active') : ($ariaSelected = ''); ?>
                <div id="tab-<?= $tabKey ?>" class="tab-pane fade <?= $ariaSelected ?>" role="tabpanel" aria-labelledby="aria-<?= $tabKey ?>">
                    <?= $this->element("../MCustomer/_tab$tabKey") ?>
                </div>
            <?php endforeach; ?>
        </div>

        <br>

        <div class="text-center">
            <a href="<?= Router::url(['controller'=> 'MCustomer', 'action'=> 'index']) ?>" class="btn btn-secondary">キャンセル</a>

            <?php if($mCustomer && $mCustomer->id) { 
                $customer_decrypt = Crypt::encrypAES($mCustomer->id);
                ?>
                <a href="<?= Router::url(['controller'=> 'MCustomer', 'action'=> 'add']) ?>" class="btn btn-secondary">マスター登録</a>
                <a href="<?= Router::url(['controller'=> 'Project', 'action'=> 'yoteiTouroku', $customer_decrypt]) ?>" class="btn btn-secondary">予定登録</a>
                <a href="<?= Router::url(['controller'=> 'Project', 'action'=> 'kakuteiTouroku', $customer_decrypt]) ?>" class="btn btn-secondary">受注登録</a>
            <?php } ?>

            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    <?= $this->Form->end() ?>
</div><br>
