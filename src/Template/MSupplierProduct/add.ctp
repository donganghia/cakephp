<?php
use App\Model\Table\MSupplierProductTable;
use App\Model\Table\MProductTable;

?>
<div class="page page_register product_master">
<?= $this->Form->create($mSupplierProduct, ['autocomplete' => 'off', 'id' => 'form-supplier-product']) ?>
<div class="content">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-right" for="tanka_masuta_kubun">
            単価ﾏｽﾀｰ区分
        </label>
        <div class="col-sm-3">
            <?= $this->Form->select('tanka_masuta_kubun', $this->VHtml->selectNull(MSupplierProductTable::TANKA_MASUTA_KUBUN), [
                'class' => 'form-control', 'default' => isset($mSupplierProduct->tanka_masuta_kubun) ? $mSupplierProduct->tanka_masuta_kubun : ''
            ]); ?>
        </div>
        <label class="col-sm-2 col-form-label text-right" for="tanka_shurui">
            単価種類
        </label>
        <div class="col-sm-3">
            <?= $this->Form->select('tanka_shurui', $this->VHtml->selectNull(MSupplierProductTable::TANKA_SHURUI), [
                'class' => 'form-control', 'default' => isset($mSupplierProduct->tanka_shurui) ? $mSupplierProduct->tanka_shurui : ''
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-right" for="bunrui_koudo">
            分類ｺｰﾄ
        </label>
        <div class="col-sm-3">
            <?= $this->Form->select('bunrui_koudo', $this->VHtml->selectNull(MProductTable::BUNRUI_KOUDO_VALUE), [
                'class' => 'form-control', 'default' => isset($mSupplierProduct->bunrui_koudo) ? $mSupplierProduct->bunrui_koudo : ''
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-right" for="shouhin_koudo">
            商品ｺｰﾄ<span class="required">*</span>
        </label>
        <div class="col-sm-3">
            <?= $this->Form->text('shouhin_koudo', [
                'value' => isset($mSupplierProduct->shouhin_koudo) ? $mSupplierProduct->shouhin_koudo : null,
                'id'    => 'shouhin_koudo',
                'class' => "form-control",
                'placeholder' => 'A0000001'
            ]); ?>
        </div>
        <label class="col-sm-2 col-form-label text-right" for="shouhin_mei">
            商品名<span class="required">*</span>
        </label>
        <div class="col-sm-3">
            <?= $this->Form->text('shouhin_mei', [
                'value' => isset($mSupplierProduct->shouhin_mei) ? $mSupplierProduct->shouhin_mei : null,
                'id'    => 'shouhin_mei',
                'class' => "form-control",
                'placeholder' => 'A0000001'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-right" for="tanka_shubetsu">
            単価種別
        </label>
        <div class="col-sm-3">
            <?= $this->Form->select('tanka_shubetsu', $this->VHtml->selectNull(MSupplierProductTable::TANKA_SHUBETSU), [
                'class' => 'form-control', 'default' => isset($mSupplierProduct->tanka_shubetsu) ? $mSupplierProduct->tanka_shubetsu : ''
            ]); ?>
        </div>
        <label class="col-sm-2 col-form-label text-right" for="tanka">
            単価
        </label>
        <div class="col-sm-3">
            <?= $this->Form->text('tanka', [
                'value' => isset($mSupplierProduct->tanka) ? $mSupplierProduct->tanka : null,
                'class' => "form-control text-right",
                'placeholder' => '100000'
            ]); ?>
            <?= $this->Form->hidden('m_supplier_id', ['value' => $mSupplierProduct->m_supplier_id]); ?>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
</div>