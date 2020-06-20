<?php
use App\Model\Table\MSystemTable;
use App\Model\Table\MCustomerTable;
use App\Model\Table\MSupplierTable;
use Cake\Routing\Router;
?>

<style type="text/css">
    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    #btn-shousai-kensaku {
        cursor: pointer;
        color: blue;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>

<?= $this->element('../MCustomer/index_js') ?>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url('/menu/m-hoshu-touroku')]); ?>
        <h1 class="title">顧客マスタ保守一覧</h1>
    </div>

    <div class="search-form card">
        <div class="card-body">
            <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
            <div class="form-group row">
                <label for="kaiin_bangou" class="col-sm-1 col-form-label text-right">会員番号</label>
                <div class="col-sm-2">
                    <?= $this->Form->text('kaiin_bangou', [
                        'class' => 'form-control',
                        'maxLength' => 20]); ?>
                </div>
                <label for="m_system_kihonsyubetu_id" class="col-sm-1 col-form-label text-right">基本種別</label>
                <div class="col-sm-1">
                    <?= $this->Form->select('m_system_kihonsyubetu_id',
                        $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KIHON_SHUBETSU]), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
                <label for="m_system_kaiinenji_id" class="col-sm-1 col-form-label text-right">会員年次</label>
                <div class="col-sm-2">
                    <?= $this->Form->select('m_system_kaiinenji_id',
                        $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIIN_NENJI]), [
                            'class' => 'form-control'
                        ]); ?>
                </div>
                <label for="m_system_kaiinshurui_id" class="col-sm-1 col-form-label text-right">会員種類</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('m_system_kaiinshurui_id',
                        $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIIN_SHURUI]), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="kaiin_tourokubi_start" class="col-sm-1 col-form-label text-right">会員登録日</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('kaiin_tourokubi_start', [
                        'class' => 'form-control datepicker']); ?>
                </div>
                <div class="col-sm-1 text-center">～</div>
                <div class="col-sm-3">
                    <?= $this->Form->text('kaiin_tourokubi_end', [
                        'class' => 'form-control datepicker']); ?>
                </div>
                <label for="m_system_tantousha_id" class="col-sm-1 col-form-label text-right">担当者名</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('m_system_tantousha_id',
                        $this->VHtml->selectNull(isset($aryMSystem[MSystemTable::SYSTEM_TANTOUSHA]) ? $aryMSystem[MSystemTable::SYSTEM_TANTOUSHA] : []), [
                            'class' => 'form-control'
                        ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="kaiin_kaiyaku_start" class="col-sm-1 col-form-label text-right">会員解約日</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('kaiin_kaiyaku_start', [
                        'class' => 'form-control datepicker']); ?>
                </div>
                <div class="col-sm-1 text-center">～</div>
                <div class="col-sm-3">
                    <?= $this->Form->text('kaiin_kaiyaku_end', [
                        'class' => 'form-control datepicker']); ?>
                </div>
                <label for="m_system_tantousha_id" class="col-sm-1 col-form-label text-right">源泉</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('m_mediation_gensen_id', $this->VHtml->selectNull($aryMediation), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-1 col-form-label text-right">検索対象</label>
                <div class="col-sm-9">
                    <?php foreach(MCustomerTable::KENSAKU_TAISHOU as $kendakuValue => $kendakuText) : ?>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="kensaku_taishou[]" checked value="<?= $kendakuValue ?>">&nbsp;<?= $kendakuText ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-1 col-form-label text-right">氏名</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('name', [
                        'maxLength' => 200,
                        'class' => 'form-control']); ?>
                </div>
                <label for="name" class="col-sm-1 col-form-label text-right">カナ</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('kana', [
                        'maxLength' => 200,
                        'class' => 'form-control']); ?>
                </div>
                <label for="seibetsu" class="col-sm-1 col-form-label text-right">性別</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('seibetsu', $this->VHtml->selectNull(MCustomerTable::SEIBETSU), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="yuubenbangou" class="col-sm-1 col-form-label text-right">郵便番号</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('yuubenbangou', [
                        'maxLength' => 10,
                        'class' => 'form-control']); ?>
                </div>
                <label for="todoufuken" class="col-sm-1 col-form-label text-right">都道府県</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('todoufuken',
                        $this->VHtml->selectNull(MSupplierTable::PREFECTURE_DATA), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
                <label for="m_system_kyojuueria_id" class="col-sm-1 col-form-label text-right">居住エリア</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('m_system_kyojuueria_id',
                        $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KYOJUU_ARIA]), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="shiku_chouson_banchi" class="col-sm-1 col-form-label text-right">市区町村番地</label>
                <div class="col-sm-6">
                    <?= $this->Form->text('shiku_chouson_banchi', [
                        'maxLength' => 512,
                        'class' => 'form-control']); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="biru_mei_tou" class="col-sm-1 col-form-label text-right">ビル名等</label>
                <div class="col-sm-6">
                    <?= $this->Form->text('biru_mei_tou', [
                        'maxLength' => 512,
                        'class' => 'form-control']); ?>
                </div>
                <div class="col-sm-1">
                    <label><input type="checkbox" name="chintai">&nbsp;賃貸</label>
                </div>
                <label for="m_system_sabisukubun_id" class="col-sm-1 col-form-label text-right">サービス区分</label>
                <div class="col-sm-3">
                    <?= $this->Form->select('m_system_sabisukubun_id',
                        $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_SAABUSU_KUBUN]), [
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="denwa" class="col-sm-1 col-form-label text-right">電話番号</label>
                <div class="col-sm-2">
                    <?= $this->Form->text('denwa', [
                        'maxLength' => 20,
                        'class' => 'form-control']); ?>
                </div>
                <label for="keitai_bangou" class="col-sm-1 col-form-label text-right">携帯電話</label>
                <div class="col-sm-2">
                    <?= $this->Form->text('keitai_bangou', [
                        'maxLength' => 100,
                        'class' => 'form-control']); ?>
                </div>
                <label for="fakkusu_bangou" class="col-sm-1 col-form-label text-right">FAX番号</label>
                <div class="col-sm-2">
                    <?= $this->Form->text('fakkusu_bangou', [
                        'maxLength' => 100,
                        'class' => 'form-control']); ?>
                </div>
                <label for="mail" class="col-sm-1 col-form-label text-right">ﾒｰﾙｱﾄﾞﾚｽ</label>
                <div class="col-sm-2">
                    <?= $this->Form->text('mail', [
                        'maxLength' => 100,
                        'class' => 'form-control']); ?>
                </div>
            </div>
            <div class="form-group row">
                <a id="btn-shousai-kensaku">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>&nbsp;詳細検索
                </a>
                <input id="is_kensaku" type="hidden" name="is_kensaku" value="0">
            </div>

            <div id="shousai_kensaku" class="form-group row hide">
                <div class="card card-body">
                    <div class="form-group row">
                        <label for="smile_bangou" class="col-sm-1 col-form-label text-right">SMILE No.</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('smile_bangou', [
                                'maxLength' => 20,
                                'class' => 'form-control']); ?>
                        </div>
                        <label for="kanri_bangou" class="col-sm-1 col-form-label text-right">管理番号</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('kanri_bangou', [
                                'maxLength' => 20,
                                'class' => 'form-control']); ?>
                        </div>
                        <label for="shokai_touroku_taimu_sutanpu" class="col-sm-2 col-form-label text-right">初回登録ﾀｲﾑｽﾀﾝﾌﾟ</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('shokai_touroku_taimu_sutanpu', [
                                'class' => 'form-control datetimepicker']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="synergry_id" class="col-sm-1 col-form-label text-right">SynergyID</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('synergry_id', [
                                'maxLength' => 20,
                                'class' => 'form-control']); ?>
                        </div>
                        <label for="okyaku_sama_bangou" class="col-sm-1 col-form-label text-right">お客さま番号</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('okyaku_sama_bangou', [
                                'maxLength' => 20,
                                'class' => 'form-control']); ?>
                        </div>
                        <label for="shuhensaishin_sekou_yoteibi" class="col-sm-2 col-form-label text-right">種変再新_施工予定日</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('shuhensaishin_sekou_yoteibi', [
                                'class' => 'form-control datepicker']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nittei" class="col-sm-1 col-form-label text-right">日程</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('nittei', [
                                'class' => 'form-control']); ?>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="fukakachi_sabisukaishi_yoteibi" class="col-sm-3 col-form-label text-right">付加価値サービス開始予定日</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('fukakachi_sabisukaishi_yoteibi', [
                                'class' => 'form-control datepicker']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="denwa2" class="col-sm-1 col-form-label text-right">電話番号2</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('denwa2', [
                                'maxLength' => 20,
                                'class' => 'form-control']); ?>
                        </div>
                        <label for="moushisha_kinkyou_renrakusen_denwabangou" class="col-sm-1 col-form-label text-right">緊急連絡先</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('moushisha_kinkyou_renrakusen_denwabangou', [
                                'maxLength' => 20,
                                'class' => 'form-control']); ?>
                        </div>
                        <label for="keitai_meiru" class="col-sm-2 col-form-label text-right">携帯メールアドレス</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('keitai_meiru', [
                                'maxLength' => 200,
                                'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="e_moushisha_seinengappi" class="col-sm-1 col-form-label text-right">生年月日</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('e_moushisha_seinengappi', [
                                'class' => 'form-control datepicker']); ?>
                        </div>
                        <label for="doukyo_kazoku1_shimei" class="col-sm-1 col-form-label text-right">同居家族</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('doukyo_kazoku1_shimei', [
                                'maxLength' => 200,
                                'class' => 'form-control']); ?>
                        </div>
                        <label for="shoudakusho_juryou_joukyou" class="col-sm-2 col-form-label text-right">承諾書受領状況</label>
                        <div class="col-sm-4">
                            <?= $this->Form->select('shoudakusho_juryou_joukyou', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_JURYOU_JOUKYOU), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hizukekoumoku" class="col-sm-1 col-form-label text-right">日付項目</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('hizukekoumoku', $this->VHtml->selectNull(MCustomerTable::HIZUKEKOUMOUKU), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <div class="col-sm-1 text-center"></div>
                        <div class="col-sm-2">
                            <?= $this->Form->text('hizukekoumoku_start', [
                                'class' => 'form-control datepicker']); ?>
                        </div>
                        <div class="col-sm-1 text-center">～</div>
                        <div class="col-sm-2">
                            <?= $this->Form->text('hizukekoumoku_end', [
                                'class' => 'form-control datepicker']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="m_system_shonendo_nenkaihi_id" class="col-sm-1 col-form-label text-right">初年度年会費</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('m_system_shonendo_nenkaihi_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_SHONENDO_NENKAIHI]), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="shonendo_nenkaihi" class="col-sm-1 col-form-label text-right">会費区分</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('m_system_kaihikubun_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIHI_KUBUN]), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="m_system_juotakumeika_id" class="col-sm-1 col-form-label text-right">住宅ﾒｰｶｰ</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('m_system_juotakumeika_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_JUUTAKU_MEEKAA]), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="m_system_manshonmei_id" class="col-sm-1 col-form-label text-right">マンション名</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('m_system_manshonmei_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_MANSHON_MEI]), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="m_system_shiten_id" class="col-sm-1 col-form-label text-right">支店</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('m_system_shiten_id', $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_SHITEN]), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="eigyou_tantou" class="col-sm-1 col-form-label text-right">営業担当</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('eigyou_tantou', [
                                'maxLength' => 200,
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="sanyou_houmuzu_seiban" class="col-sm-1 col-form-label text-right">三洋ホームズ製番</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('sanyou_houmuzu_seiban', [
                                'maxLength' => 200,
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="hikiwatashi_nengappi" class="col-sm-1 col-form-label text-right">引渡年月日</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('hikiwatashi_nengappi', [
                                'class' => 'form-control datepicker'
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kouza_furikae_kubun" class="col-sm-1 col-form-label text-right">口座振替区分</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('kouza_furikae_kubun', [
                                'maxLength' => 200,
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="kinyuukkan_meishou" class="col-sm-1 col-form-label text-right">金融機関名称</label>
                        <div class="col-sm-2">
                            <?= $this->Form->text('kinyuukkan_meishou', [
                                'maxLength' => 200,
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="kinyuukkan_koudo" class="col-sm-1 col-form-label text-right">金融機関ｺｰﾄﾞ</label>
                        <div class="col-sm-1">
                            <?= $this->Form->text('kinyuukkan_koudo', [
                                'maxLength' => 20,
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="honshiten_shutchoujo_koudo" class="col-sm-1 col-form-label text-right">本支店ｺｰﾄﾞ</label>
                        <div class="col-sm-1">
                            <?= $this->Form->text('honshiten_shutchoujo_koudo', [
                                'maxLength' => 20,
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="yuucho_ginkou_tsuochou_kigou" class="col-sm-1 col-form-label text-right">ゆうちょ通帳番号</label>
                        <div class="col-sm-1">
                            <?= $this->Form->text('yuucho_ginkou_tsuochou_kigou', [
                                'maxLength' => 20,
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sabisu_manki_tsuki" class="col-sm-1 col-form-label text-right">サービス満期月</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('sabisu_manki_tsuki', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_JURYOU_JOUKYOU), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="shingaisha_shoudakusho_soufu" class="col-sm-1 col-form-label text-right">承諾書返信</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('shoudakusho_henshin', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_HENSHIN), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <label for="shingaisha_shoudakusho_soufu" class="col-sm-1 col-form-label text-right">新会社承諾書送付</label>
                        <div class="col-sm-2">
                            <?= $this->Form->select('shingaisha_shoudakusho_soufu', $this->VHtml->selectNull(MCustomerTable::SHOUDAKUSHO_JURYOU_JOUKYOU), [
                                'class' => 'form-control'
                            ]); ?>
                        </div>
                        <div class="col-sm-3">
                            <label><input type="checkbox" name="kuuringuofu_tsuuchi" value="1">&nbsp;クーリングオフ通知</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button id="btn-clear" class="btn btn-secondary" type="button">クリア</button>
                <button id="btn-search" class="btn btn-primary" type="button">検索</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="">
        <?= $this->Flash->render() ?>

        <?= $this->Flash->render('alert_success') ?>
        <?= $this->Flash->render('error') ?>
        <div class="">
            <table id="table-list" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>
                            <a href="<?= Router::url(['controller'=> 'MCustomer', 'action'=> 'add']) ?>" class="btn btn-success btn-sm">追加</a>
                        </th>
                        <th><?= __('会員種類') ?></th>
                        <th><?= __('氏名') ?></th>
                        <th><?= __('カナ') ?></th>
                        <th><?= __('略称') ?></th>
                        <th><?= __('〒') ?></th>
                        <th><?= __('都道府県') ?></th>
                        <th><?= __('番地') ?></th>
                        <th><?= __('電話') ?></th>
                        <th><?= __('携帯') ?></th>
                        <th><?= __('FAX') ?></th>
                        <th><?= __('ﾒｰﾙ') ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>