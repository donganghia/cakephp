<?php

use Cake\Routing\Router;
use App\Model\Table\MSupplierTable;
use App\Model\Table\MSystemTable;
?>
<div class="page page_register product_master" id="product">
    <div class="navi">
        <h1 class="title"><?= $title; ?></h1>
        <div class="clearfix"></div>
    </div>
    <?= $this->element('_back', ['url' => Router::url(['controller'=> 'MSupplier', 'action'=> 'index'])]); ?>
    <?= $this->Form->create($mSupplier, ['type' => 'file']) ?>
    <div class="content">
        <div class="form-group row">
            <div class="col-sm-12">
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('success') ?>
                <?= $this->Flash->render('error') ?>
            </div>
        </div>
        <div class="form-group row" >
            <label class="col-sm-2 col-form-label text-right" for="koudo">
                仕入先コード<span class="required">*</span>
            </label>
            <div class="col-sm-2">
                <?= $this->Form->text('koudo', [
                    'value' => isset($mSupplier->id) ? $mSupplier->koudo : null,
                    'class' => "input",
                    'class' => "form-control",
                    'placeholder' => 'A0000001'
                ]); ?>
            </div>
        </div>
        <div class="form-group row" >
            <label for="mei_1" class="col-sm-2 col-form-label text-right">仕入先名1</label>
            <div class="col-sm-6">
                <?= $this->Form->text('mei_1', [
                    'value' => isset($mSupplier->id) ? $mSupplier->mei_1 : null,
                    'class' => "form-control",
                    'placeholder' => '仕入先名1']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">
                カテゴリー
            </label>
            <div class="col-sm-2">
                <?= $this->Form->select('m_system_shiiresaki_kategori_id',
                    isset($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID]) ? $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID]) : ['' => '-'], [
                    'class' => 'form-control', 'default' => isset($mSupplier->id) ? $mSupplier->m_system_shiiresaki_kategori_id : null
                ]); ?>
            </div>

        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">仕入先名2</label>
            <div class="col-sm-6">
                <?= $this->Form->text('mei_2', [
                    'value' => isset($mSupplier->id) ? $mSupplier->mei_2 : null,
                    'class' => "form-control",
                    'placeholder' => '仕入先名2']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">
                支払先区分
            </label>
            <div class="col-sm-2">
                <?= $this->Form->select('shiharai_saki_kubun',
                    isset($mstSystem[MSystemTable::SYSTEM_SHIHARAI_SAKI_KUBUN]) ? $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_SHIHARAI_SAKI_KUBUN]) : [],
                    [
                        'class' => 'form-control', 'default' => isset($mSupplier->id) ? $mSupplier->shiharai_saki_kubun : ''
                    ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">
                略称
            </label>
            <div class="col-sm-6">
                <?= $this->Form->text('ryakushou', [
                    'value' => isset($mSupplier->ryakushou) ? $mSupplier->ryakushou : false,
                    'class' => "form-control",
                    'placeholder' => '']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">
                担当者名
            </label>
            <div class="col-sm-2">
                <?= $this->Form->select('tantousha_mei', $this->VHtml->selectNull(MSupplierTable::TANTOUSHA_MEI), [
                    'class' => 'form-control', 'default' => isset($mSupplier->id) ? $mSupplier->tantousha_mei : null
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">索引</label>
            <div class="col-sm-6">
                <?= $this->Form->text('sakuin', [
                    'value' => isset($mSupplier->id) ? $mSupplier->sakuin : false,
                    'class' => "form-control",
                    'placeholder' => '']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">単価設定区分</label>
            <div class="col-sm-2">
                <?= $this->Form->select('hiire_tanka_settei_kubun', $this->VHtml->selectNull(MSupplierTable::HIIRE_TANKA_SETTEI_KUBUN), [
                    'class' => 'form-control', 'default' => isset($mSupplier->id) ? $mSupplier->hiire_tanka_settei_kubun : null
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">郵便番号</label>
            <div class="col-sm-2">
                <?= $this->Form->text('yuubenbangou', [
                    'value' => isset($mSupplier->id) ? $mSupplier->yuubenbangou : false,
                    'class' => "form-control text-right",
                    'placeholder' => '165-0027']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">都道府県</label>
            <div class="col-sm-2">
                <?= $this->Form->select('juusho_1', MSupplierTable::PREFECTURE_DATA, [
                    'class' => 'form-control', 'default' => isset($mSupplier->id) ? $mSupplier->juusho_1 : ''
                ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">エリア</label>
            <div class="col-sm-2">
                <?= $this->Form->select('area',
                    isset($mstSystem[MSystemTable::SYSTEM_KYOJUU_ARIA]) ? $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_KYOJUU_ARIA]) : ['' =>'-'], [
                    'class' => 'form-control', 'default' => isset($mSupplier->area) ? $mSupplier->area : ''
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">市区町村番地</label>
            <div class="col-sm-6">
                <?= $this->Form->text('juusho_2', [
                    'value' => isset($mSupplier->id) ? $mSupplier->juusho_2 : false,
                    'class' => "form-control",
                    'placeholder' => '']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">相手先担当者名</label>
            <div class="col-sm-2">
                <?= $this->Form->text('aitesaki_tantousha_mei', [
                    'value' => isset($mSupplier->id) ? $mSupplier->aitesaki_tantousha_mei : false,
                    'class' => "form-control",
                    'placeholder' => '']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">ビル名等</label>
            <div class="col-sm-6">
                <?= $this->Form->text('juusho_3', [
                    'value' => isset($mSupplier->id) ? $mSupplier->juusho_3 : false,
                    'class' => "form-control",
                    'placeholder' => '']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">担当者ﾒｰﾙｱﾄﾞﾚｽ</label>
            <div class="col-sm-2">
                <?= $this->Form->text('email', [
                    'value' => isset($mSupplier->id) ? $mSupplier->email : false,
                    'class' => "form-control",
                    'placeholder' => 'takashi@test.co.jp']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">TEL番号</label>
            <div class="col-sm-2">
                <?= $this->Form->text('denwa', [
                    'value' => isset($mSupplier->id) ? $mSupplier->denwa : null,
                    'class' => "form-control text-right",
                    'placeholder' => '0']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">FAX番号</label>
            <div class="col-sm-2">
                <?= $this->Form->text('fax', [
                    'value' => null,
                    'class' => "form-control text-right",
                    'placeholder' => '0']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">通知送信設定</label>
            <div class="col-sm-2">
                <?= $this->Form->radio('soushin_settei', [
                        0 => "送信しない",
                        1 => "送信する"
                ], [ 'value' => isset($mSupplier->id) ? $mSupplier->soushin_settei : null]) ;?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">特記・備考</label>
            <div class="col-sm-10">
                <?= $this->Form->textArea('bikou', [
                    'value' => isset($mSupplier->id) ? $mSupplier->bikou : false,
                    'class' => "form-control",
                    'cols' => 30,
                    'rows' => 4,
                    'placeholder' => '']); ?>
            </div>
        </div>

        <?php if(isset($mSupplier->id)) { ?>
                <?= $this->element('../MSupplierProduct/index', ['m_supplier_id' => $mSupplier->id]); ?>
        <?php } ?>

        <div class="form-data-footer">
            <div class="pull-left">
                <?= $this->Form->button(__('キャンセル'), [
                        'class' => 'btn btn-secondary', 'type' => 'button',
                        'onclick' => "location.href='" . Router::url(['controller'=> 'MSupplier', 'action'=> 'index']). "'"]) ?>
            </div>
            <div class="pull-right">
                <?= $this->Form->submit(__('保存'), ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

