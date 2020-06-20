<?php

use Cake\Routing\Router;
use App\Model\Table\MSupplierTable;
use App\Model\Table\MSystemTable; ?>

<div class="search-form card content">
    <div class="card-body">
        <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
        <div class="form-group row">
            <label for="koudo" class="col-sm-2 col-form-label text-right">仕入先コード</label>
            <div class="col-sm-4">
                <?= $this->Form->text('koudo', [
                    'value' => isset($params['koudo']) ? $params['koudo'] : null,
                    'class' => "form-control",
                    'placeholder' => 'A0000001',
                    'id' => 'koudo',
                ]); ?>
            </div>
            <label for="m_system_shiiresaki_kategori_id" class="col-sm-2 col-form-label text-right">カテゴリー</label>
            <div class="col-sm-4">
                <?= $this->Form->select('m_system_shiiresaki_kategori_id',
                    isset($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID]) ?
                        $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID]) : [],
                    [
                        'class' => 'form-control',
                        'default' => isset($params['m_system_shiiresaki_kategori_id']) ? $params['m_system_shiiresaki_kategori_id'] : null,
                    ]); ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="mei_1" class="col-sm-2 col-form-label text-right">仕入先名1</label>
            <div class="col-sm-4">
                <?= $this->Form->text('mei_1', [
                    'value' => isset($params['mei_1']) ? $params['mei_1'] : null,
                    'class' => "form-control",
                    'placeholder' => '仕入先名1']); ?>
            </div>
            <label for="mei_2" class="col-sm-2 col-form-label text-right">仕入先名2</label>
            <div class="col-sm-4">
                <?= $this->Form->text('mei_2', [
                    'value' => isset($params['mei_2']) ? $params['mei_2'] : null,
                    'class' => "form-control",
                    'placeholder' => '仕入先名2']); ?>
            </div>

        </div>
        <div class="form-group row">
            <label for="ryakushou" class="col-sm-2 col-form-label text-right">略称</label>
            <div class="col-sm-4">
                <?= $this->Form->text('ryakushou', [
                    'value' => isset($params['ryakushou']) ? $params['ryakushou'] : null,
                    'class' => "form-control",
                    'placeholder' => '略称']); ?>
            </div>

            <label for="shiharai_saki_kubun" class="col-sm-2 col-form-label text-right">支払先区分</label>
            <div class="col-sm-4">
                <?= $this->Form->select('shiharai_saki_kubun',
                    isset($mstSystem[MSystemTable::SYSTEM_SHIHARAI_SAKI_KUBUN]) ?
                        $this->VHtml->selectNull( $mstSystem[MSystemTable::SYSTEM_SHIHARAI_SAKI_KUBUN]) : [],
                    [
                        'class' => 'form-control',
                        'default' => isset($params['shiharai_saki_kubun']) ? $params['shiharai_saki_kubun'] : null,
                    ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="yuubenbangou" class="col-sm-2 col-form-label text-right">郵便番号</label>
            <div class="col-sm-4">
                <?= $this->Form->text('yuubenbangou', [
                    'value' => isset($params['yuubenbangou']) ? $params['yuubenbangou'] : null,
                    'class' => "form-control",
                    'placeholder' => '郵便番号']); ?>
            </div>

            <label for="juusho_1" class="col-sm-2 col-form-label text-right">都道府県</label>
            <div class="col-sm-4">
                <?= $this->Form->select('juusho_1', MSupplierTable::PREFECTURE_DATA, [
                    'class' => 'form-control',
                    'default' => isset($params['juusho_1']) ? $params['juusho_1'] : null,
                ]); ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="denwa" class="col-sm-2 col-form-label text-right">市区町村番地</label>
            <div class="col-sm-4">
                <?= $this->Form->text('juusho_2', [
                    'value' => isset($params['juusho_2']) ? $params['juusho_2'] : null,
                    'class' => "form-control",
                    'placeholder' => '市区町村番地']); ?>
            </div>

            <label for="fax" class="col-sm-2 col-form-label text-right">ビル名等</label>
            <div class="col-sm-4">
                <?= $this->Form->text('juusho_3', [
                    'value' => isset($params['juusho_3']) ? $params['juusho_3'] : null,
                    'class' => "form-control",
                    'placeholder' => 'ビル名等']); ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="denwa" class="col-sm-2 col-form-label text-right">TEL番号</label>
            <div class="col-sm-4">
                <?= $this->Form->text('denwa', [
                    'value' => isset($params['denwa']) ? $params['denwa'] : null,
                    'class' => "form-control",
                    'placeholder' => 'TEL番号']); ?>
            </div>

            <label for="fax" class="col-sm-2 col-form-label text-right">FAX番号</label>
            <div class="col-sm-4">
                <?= $this->Form->text('fax', [
                    'value' => isset($params['fax']) ? $params['fax'] : null,
                    'class' => "form-control",
                    'placeholder' => 'FAX番号']); ?>
            </div>
        </div>

        <div class="text-center">
            <button id="btn-search" class="btn btn-primary" type="button">検索</button>
            <button id="btn-import-csv" class="btn btn-secondary" type="button">CSV入力</button>
            <button id="btn-export-csv" class="btn btn-dark" type="button">CSV出力</button>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>
