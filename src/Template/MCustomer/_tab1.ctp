<?php
use App\Model\Table\MCustomerTable;
use App\Model\Table\MSystemTable;
?>
<div class="col-md-12">
    <div class="form-group row">
        <label for="yuutai_sabisupasuwado" class="col-sm-2 col-form-label text-right">優待Sパス</label>
        <div class="col-sm-2">
            <?= $this->Form->text('yuutai_sabisupasuwado', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="synergry_id" class="col-sm-2 col-form-label text-right">SynergyID</label>
        <div class="col-sm-2">
            <?= $this->Form->text('synergry_id', [
                'class' => 'form-control',
                'maxLength' => 20
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="m_system_bukkenkubun_id" class="col-sm-2 col-form-label text-right">物件区分</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_bukkenkubun_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_BUKKEN_KUBUN]), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="memo" class="col-sm-2 col-form-label text-right">メモ</label>
        <div class="col-sm-4">
            <?= $this->Form->textarea('memo', [
                'class' => 'form-control',
                'rows' => 3,
                'maxLength' => 512
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushikomi_shasonota_renraku_jikou" class="col-sm-2 col-form-label text-right">申込者その他連絡事項</label>
        <div class="col-sm-4">
            <?= $this->Form->textarea('moushikomi_shasonota_renraku_jikou', [
                'class' => 'form-control',
                'rows' => 3,
                'maxLength' => 512
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_bushomei_kanji" class="col-sm-2 col-form-label text-right">申込者部署</label>
        <div class="col-sm-4">
            <?= $this->Form->text('moushisha_bushomei_kanji', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_denwabangou_shurui" class="col-sm-2 col-form-label text-right">申込者電話種類</label>
        <div class="col-sm-4">
            <?= $this->Form->text('moushisha_denwabangou_shurui', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_denwabangou" class="col-sm-2 col-form-label text-right">申込者電話番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('moushisha_denwabangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_denwabangou" class="col-sm-2 col-form-label text-right">上記以外の電話番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('joukiigai_denwabangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="genjousho_tenwabangou" class="col-sm-2 col-form-label text-right">現住所電話番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('genjousho_tenwabangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_fakkusu" class="col-sm-2 col-form-label text-right">申込者FAX番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('moushisha_fakkusu', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_kinkyou_renrakusen_denwabangou_shurui" class="col-sm-2 col-form-label text-right">緊急連絡先電話種類</label>
        <div class="col-sm-4">
            <?= $this->Form->text('moushisha_kinkyou_renrakusen_denwabangou_shurui', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_kinkyou_renrakusen_denwabangou" class="col-sm-2 col-form-label text-right">緊急連絡先電話番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('moushisha_kinkyou_renrakusen_denwabangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushisha_meiru" class="col-sm-2 col-form-label text-right">申込者メールアドレス</label>
        <div class="col-sm-4">
            <?= $this->Form->text('moushisha_meiru', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="keitai_meiru" class="col-sm-2 col-form-label text-right">携帯メールアドレス</label>
        <div class="col-sm-4">
            <?= $this->Form->text('keitai_meiru', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="e_moushisha_seinengappi" class="col-sm-2 col-form-label text-right">申込者生年月日</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_moushisha_seinengappi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="seibetsu" class="col-sm-2 col-form-label text-right">性別</label>
        <div class="col-sm-2">
            <?= $this->Form->select('seibetsu', $this->VHtml->selectNull(MCustomerTable::SEIBETSU), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
</div>