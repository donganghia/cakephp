<?php
use App\Model\Table\MCustomerTable;
use App\Model\Table\MSystemTable;
?>

<div class="col-md-12">
    <div class="form-group row">
        <label for="chintai" class="col-sm-2 col-form-label text-right">賃貸</label>
        <div class="col-sm-2">
            <?= $this->Form->checkbox('chintai'); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="chingarinin" class="col-sm-2 col-form-label text-right">賃　借　人</label>
        <div class="col-sm-4">
            <?= $this->Form->textarea('chingarinin', [
                'class' => 'form-control',
                'rows' => 3,
                'maxLength' => 512
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kyojuueria" class="col-sm-2 col-form-label text-right">居住エリア</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_kyojuueria_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KYOJUU_ARIA]), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushibi" class="col-sm-2 col-form-label text-right">お申し込み日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('moushibi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
        <label for="kaiin_tourokubi" class="col-sm-2 col-form-label text-right">会員登録日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kaiin_tourokubi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kaiyaku" class="col-sm-2 col-form-label text-right">解約</label>
        <div class="col-sm-2">
            <?= $this->Form->checkbox('kaiyaku'); ?>
        </div>
        <label for="shoudakusho_juryou_joukyou" class="col-sm-2 col-form-label text-right">承諾書受領状況</label>
        <div class="col-sm-2">
            <?= $this->Form->select('shoudakusho_juryou_joukyou', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_JURYOU_JOUKYOU), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kaiyaku_uketsukebi" class="col-sm-2 col-form-label text-right">解約受付日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kaiyaku_uketsukebi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
        <label for="sabisu_kaishibi" class="col-sm-2 col-form-label text-right">サービス開始日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('sabisu_kaishibi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kaiyaku_shosoufubi" class="col-sm-2 col-form-label text-right">解約書送付日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kaiyaku_shosoufubi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
        <label for="koushin_kakunin_furagu" class="col-sm-2 col-form-label text-right">更新確認フラグ</label>
        <div class="col-sm-2">
            <?= $this->Form->text('koushin_kakunin_furagu', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kaiin_kaiyakubi" class="col-sm-2 col-form-label text-right">会員解約日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kaiin_kaiyakubi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
        <label for="jikaikouzafurikae_yoteibi" class="col-sm-2 col-form-label text-right">次回口座振替予定日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('jikaikouzafurikae_yoteibi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="jbr_kaiyaku_tsuchi" class="col-sm-2 col-form-label text-right">JBR解約通知</label>
        <div class="col-sm-2">
            <?= $this->Form->text('jbr_kaiyaku_tsuchi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
        <label for="gmo_koushin_yoteibi" class="col-sm-2 col-form-label text-right">GMO更新予定日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('gmo_koushin_yoteibi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="shingaisha_shoudakusho_soufu" class="col-sm-2 col-form-label text-right">新会社承諾書送付</label>
        <div class="col-sm-2">
            <?= $this->Form->select('shoudakusho_juryou_joukyou', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_JURYOU_JOUKYOU), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="shingaisha_shoudakusho_soufu" class="col-sm-2 col-form-label text-right">承諾書返信</label>
        <div class="col-sm-2">
            <?= $this->Form->select('shoudakusho_juryou_joukyou', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_HENSHIN), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="sabisu_manki_tsuki" class="col-sm-2 col-form-label text-right">サービス満期月</label>
        <div class="col-sm-2">
            <?= $this->Form->select('sabisu_manki_tsuki', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_JURYOU_JOUKYOU), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kuuringuofu_tsuuchi" class="col-sm-2 col-form-label text-right">クーリングオフ通知</label>
        <div class="col-sm-2">
            <?= $this->Form->checkbox('kuuringuofu_tsuuchi'); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kuuringuofu_tsuuchi" class="col-sm-2 col-form-label text-right">備考</label>
        <div class="col-sm-4">
            <?= $this->Form->textarea('bikou', [
                'class' => 'form-control',
                'rows' => 3,
                'maxLength' => 512
            ]); ?>
        </div>
    </div>
</div>