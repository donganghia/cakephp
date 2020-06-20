<?php
use App\Model\Table\MCustomerTable;
use App\Model\Table\MSystemTable;
?>
<div class="col-md-12">
    <div class="form-group row">
        <label for="sabisukubun" class="col-sm-2 col-form-label text-right">サービス区分</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_sabisukubun_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_SAABUSU_KUBUN]), [
                'class' => 'form-control'
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="e_touroku_chekku_ran" class="col-sm-2 col-form-label text-right">e-暮らし登録ﾁｪｯｸ欄(1)</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_touroku_chekku_ran', [
                'name' => 'e_touroku_chekku_ran[6]',
                'class' => 'form-control e_touroku_chekku_ran',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="m_system_shonendo_nenkaihi_id" class="col-sm-2 col-form-label text-right">初年度年会費</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_shonendo_nenkaihi_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_SHONENDO_NENKAIHI]), [
                'class' => 'form-control'
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="e_chekku_rankinyuushaid_mei" class="col-sm-2 col-form-label text-right">e-暮らしﾁｪｯｸ欄記入者ID名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_chekku_rankinyuushaid_mei', [
                'name' => 'e_chekku_rankinyuushaid_mei[6]',
                'class' => 'form-control e_chekku_rankinyuushaid_mei',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="shonendo_nenkaihi" class="col-sm-2 col-form-label text-right">会費区分</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_kaihikubun_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIHI_KUBUN]), [
                'class' => 'form-control'
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="e_chekku_kinyou_jikan" class="col-sm-2 col-form-label text-right">e-暮らしﾁｪｯｸ記入時間</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_chekku_kinyou_jikan', [
                'name' => 'e_chekku_kinyou_jikan[6]',
                'class' => 'form-control e_chekku_kinyou_jikan',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="m_system_juotakumeika_id" class="col-sm-2 col-form-label text-right">住宅ﾒｰｶｰ</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_juotakumeika_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_JUUTAKU_MEEKAA]), [
                'class' => 'form-control'
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="kigyou_dantai_koudo" class="col-sm-2 col-form-label text-right">企業・団体コード</label>
        <div class="col-sm-3">
            <?= $this->Form->text('kigyou_dantai_koudo', [
                'name' => 'kigyou_dantai_koudo[6]',
                'class' => 'form-control kigyou_dantai_koudo',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="m_system_manshonmei_id" class="col-sm-2 col-form-label text-right">マンション名</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_manshonmei_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_MANSHON_MEI]), [
                'class' => 'form-control'
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="nikkunemu" class="col-sm-2 col-form-label text-right">ニックネーム</label>
        <div class="col-sm-3">
            <?= $this->Form->text('nikkunemu', [
                'name' => 'nikkunemu[6]',
                'class' => 'form-control nikkunemu',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="m_system_shiten_id" class="col-sm-2 col-form-label text-right">支店</label>
        <div class="col-sm-2">
            <?= $this->Form->select('m_system_shiten_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_SHITEN]), [
                'class' => 'form-control'
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="pasuwado" class="col-sm-2 col-form-label text-right">パスワード</label>
        <div class="col-sm-3">
            <?= $this->Form->password('pasuwado', [
                'name' => 'pasuwado[6]',
                'class' => 'form-control pasuwado',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="eigyou_tantou" class="col-sm-2 col-form-label text-right">営業担当</label>
        <div class="col-sm-2">
            <?= $this->Form->text('eigyou_tantou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="sanyou_houmuzu_seiban" class="col-sm-2 col-form-label text-right">三洋ホームズ製番</label>
        <div class="col-sm-2">
            <?= $this->Form->text('sanyou_houmuzu_seiban', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="hikiwatashi_nengappi" class="col-sm-2 col-form-label text-right">引渡年月日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('hikiwatashi_nengappi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="gensen" class="col-sm-2 col-form-label text-right">源泉</label>
        <div class="col-sm-2">
            <?= $this->Form->text('gensen', [
                'class' => 'form-control datepicker',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kyuujuusho_youbinbangou" class="col-sm-2 col-form-label text-right">旧住所：郵便番号</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kyuujuusho_youbinbangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label for="kyuujuusho_todoufukenmei" class="col-sm-2 col-form-label text-right">旧住所：都道府県名</label>
        <div class="col-sm-4">
            <?= $this->Form->text('kyuujuusho_todoufukenmei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kyuujuusho_shikuchousonbanchi" class="col-sm-2 col-form-label text-right">旧住所：市区町村番地</label>
        <div class="col-sm-4">
            <?= $this->Form->text('kyuujuusho_shikuchousonbanchi', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kyuujuusho_tatemonomeita" class="col-sm-2 col-form-label text-right">旧住所：建物名他</label>
        <div class="col-sm-4">
            <?= $this->Form->text('kyuujuusho_tatemonomeita', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kaiin_shurui_mojigata" class="col-sm-2 col-form-label text-right">会員種類（文字型）</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kaiin_shurui_mojigata', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kouza_furikae_kubun" class="col-sm-2 col-form-label text-right">口座振替区分</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kouza_furikae_kubun', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kinyuukkan_meishou" class="col-sm-2 col-form-label text-right">金融機関名称</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kinyuukkan_meishou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="kinyuukkan_koudo" class="col-sm-2 col-form-label text-right">金融機関コード</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kinyuukkan_koudo', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="honshiten_shutchoujo_meishou" class="col-sm-2 col-form-label text-right">本・支店・出張所名称</label>
        <div class="col-sm-4">
            <?= $this->Form->text('honshiten_shutchoujo_meishou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="honshiten_shutchoujo_koudo" class="col-sm-2 col-form-label text-right">本・支店・出張所ｺｰﾄﾞ</label>
        <div class="col-sm-2">
            <?= $this->Form->text('honshiten_shutchoujo_koudo', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label for="yuucho_ginkou_tsuochou_kigou" class="col-sm-2 col-form-label text-right">ゆうちょ銀行 通帳番号</label>
        <div class="col-sm-2">
            <?= $this->Form->text('yuucho_ginkou_tsuochou_kigou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
</div>