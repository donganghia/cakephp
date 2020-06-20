<?php

use App\Model\Table\MSystemTable; ?>

<div class="search-form card content">
    <div class="card-body">
        <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
        <div class="form-group row">
            <label for="koudo" class="col-sm-1 col-form-label text-right">案件番号</label>
            <div class="col-sm-3">
                <?= $this->Form->text('bangou_from', [
                    'value' => isset($params['bangou_from']) ? $params['bangou_from'] : null,
                    'class' => "form-control",
                    'placeholder' => '案件番号'
                ]); ?>
            </div>
            <label for="mei_1" class="col-sm-1 col-form-label text-center">~</label>
            <div class="col-sm-3">
                <?= $this->Form->text('bangou_to', [
                    'value' => isset($params['bangou_to']) ? $params['bangou_to'] : null,
                    'class' => "form-control",
                    'placeholder' => '案件番号'
                ]); ?>
            </div>
            <label for="moushisha_moushimei_kanji" class="col-sm-1 col-form-label text-right">申込者名</label>
            <div class="col-sm-3">
                <?= $this->Form->text('e_moushisha_mei', [
                    'value' => isset($params['e_moushisha_mei']) ? $params['e_moushisha_mei'] : null,
                    'class' => "form-control",
                    'placeholder' => '申込者名'
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="mei_1" class="col-sm-1 col-form-label text-right">データ登録日</label>
            <div class="col-sm-3">
                <?= $this->Form->text('created_from', [
                    'value' => isset($params['created_from']) ? $params['created_from'] : null,
                    'class' => "form-control datepicker"
                ]); ?>
            </div>
            <label for="mei_1" class="col-sm-1 col-form-label text-center">~</label>
            <div class="col-sm-3">
                <?= $this->Form->text('created_to', [
                    'value' => isset($params['created_to']) ? $params['created_to'] : null,
                    'class' => "form-control datepicker"
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="mei_1" class="col-sm-1 col-form-label text-right">受注日</label>
            <div class="col-sm-3">
                <?= $this->Form->text('juchuu_from', [
                    'value' => isset($params['juchuu_from']) ? $params['juchuu_from'] : null,
                    'class' => "form-control datepicker"
                ]); ?>
            </div>
            <label for="mei_1" class="col-sm-1 col-form-label text-center">~</label>
            <div class="col-sm-3">
                <?= $this->Form->text('juchuu_to', [
                    'value' => isset($params['juchuu_to']) ? $params['juchuu_to'] : null,
                    'class' => "form-control datepicker"
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="ryakushou" class="col-sm-1 col-form-label text-right">担当者</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_tantousha_id',
                    isset($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) ?
                        $this->VHtml->selectNull( $mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) : [],
                    [
                        'class' => 'form-control',
                        'default' => isset($params['m_system_tantousha_id']) ? $params['m_system_tantousha_id'] : null,
                    ]); ?>
            </div>
            <label for="shiharai_saki_kubun" class="col-sm-1 col-form-label text-right">部門</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_bumon_id',
                    isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID]) ?
                        $this->VHtml->selectNull( $mstSystem[MSystemTable::SYSTEM_BUMON_ID]) : [],
                    [
                        'class' => 'form-control',
                        'default' => isset($params['m_system_bumon_id']) ? $params['m_system_bumon_id'] : null,
                    ]); ?>
                <?= $this->Form->hidden('type', ['value' => $type]); ?>
            </div>
            <label for="m_supplier_id" class="col-sm-1 col-form-label text-right">仕入先</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_supplier_id', $this->VHtml->selectNull($arySupplier), [
                    'class' => 'form-control',
                    'default' => isset($params['m_supplier_id']) ? $params['m_supplier_id'] : null,
                ]); ?>
            </div>
        </div>
        <div class="text-center">
            <button id="btn-search" class="btn btn-primary" type="button">検索</button>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>
