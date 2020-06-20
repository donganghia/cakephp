<?php
use App\Model\Table\MCustomerTable;
?>
<div class="col-md-12">
    <div class="form-group row">
        <label for="e_moushisha_youbinbangou" class="col-sm-2 col-form-label text-right">申込者郵便番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('e_moushisha_youbinbangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label for="e_moushisha_juusho_todoufuken" class="col-sm-2 col-form-label text-right">住所：都道府県名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_moushisha_juusho_todoufuken', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="e_moushisha_juusho_shikuchousonikou" class="col-sm-2 col-form-label text-right">住所：市区町村番地</label>
        <div class="col-sm-4">
            <?= $this->Form->text('e_moushisha_juusho_shikuchousonikou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="e_moushisha_juusho_manshon_mei" class="col-sm-2 col-form-label text-right">住所：建物名他</label>
        <div class="col-sm-4">
            <?= $this->Form->text('e_moushisha_juusho_manshon_mei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="e_sabisu_kibou_juusho_shurui" class="col-sm-2 col-form-label text-right">ｻｰﾋﾞｽ希望住所種類</label>
        <div class="col-sm-4">
            <?= $this->Form->text('e_sabisu_kibou_juusho_shurui', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="e_sabisu_kibou_youbinbangou" class="col-sm-2 col-form-label text-right">ｻｰﾋﾞｽ希望郵便番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('e_sabisu_kibou_youbinbangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label for="e_sabisu_kibou_juusho_todoufuken" class="col-sm-2 col-form-label text-right">ｻｰﾋﾞｽ希望 都道府県名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_sabisu_kibou_juusho_todoufuken', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="e_sabisu_kibou_juusho_shikuchousonikou" class="col-sm-2 col-form-label text-right">ｻｰﾋﾞｽ希望 市区町村番地</label>
        <div class="col-sm-4">
            <?= $this->Form->text('e_sabisu_kibou_juusho_shikuchousonikou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="e_sabisu_kibou_juusho_manshon_mei" class="col-sm-2 col-form-label text-right">ｻｰﾋﾞｽ希望 建物名他</label>
        <div class="col-sm-4">
            <?= $this->Form->text('e_sabisu_kibou_juusho_manshon_mei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="meirumegajin_haishin" class="col-sm-2 col-form-label text-right">ﾒｰﾙﾏｶﾞｼﾞﾝ配信</label>
        <div class="col-sm-4">
            <?= $this->Form->select('meirumegajin_haishin', $this->VHtml->selectNull(MCustomerTable::MEIRUMEGAJIN_HAISHIN), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="meirumegajin_meiru" class="col-sm-2 col-form-label text-right">メールアドレス</label>
        <div class="col-sm-4">
            <?= $this->Form->text('meirumegajin_meiru', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="tokui_saki_mei1" class="col-sm-2 col-form-label text-right">得意先名1</label>
        <div class="col-sm-4">
            <?= $this->Form->text('tokui_saki_mei1', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="tokui_saki_mei2" class="col-sm-2 col-form-label text-right">得意先名2</label>
        <div class="col-sm-4">
            <?= $this->Form->text('tokui_saki_mei2', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="tokui_saki_ryakushou" class="col-sm-2 col-form-label text-right">得意先略称</label>
        <div class="col-sm-4">
            <?= $this->Form->text('tokui_saki_ryakushou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label for="tokui_saki_kana" class="col-sm-2 col-form-label text-right">カナ</label>
        <div class="col-sm-3">
            <?= $this->Form->text('tokui_saki_kana', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="yuubenbangou" class="col-sm-2 col-form-label text-right">郵便番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('yuubenbangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juusho1_todoufuken_mei" class="col-sm-2 col-form-label text-right">住所1 都道府県名</label>
        <div class="col-sm-4">
            <?= $this->Form->text('juusho1_todoufuken_mei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juusho2_shiku_chouson_banchi" class="col-sm-2 col-form-label text-right">住所2 市区町村番地</label>
        <div class="col-sm-4">
            <?= $this->Form->text('juusho2_shiku_chouson_banchi', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juusho3_tatemono_mei" class="col-sm-2 col-form-label text-right">住所3 建物名他</label>
        <div class="col-sm-4">
            <?= $this->Form->text('juusho3_tatemono_mei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="denwa" class="col-sm-2 col-form-label text-right">電話番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('denwa', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label for="keitai_bangou" class="col-sm-2 col-form-label text-right">携帯番号</label>
        <div class="col-sm-3">
            <?= $this->Form->text('keitai_bangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="fakkusu_bangou" class="col-sm-2 col-form-label text-right">FAX番号</label>
        <div class="col-sm-4">
            <?= $this->Form->text('fakkusu_bangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
</div>