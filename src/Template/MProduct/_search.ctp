<?php
use Cake\Routing\Router;
use App\Model\Table\MProductTable;
use App\Model\Table\MSystemTable;?>

<div class="search-form card content">
    <div class="card-body">
        <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label text-right" for="koudo">商品コード</div>
            <div class="col-sm-2">
                <?= $this->Form->text('koudo', [
                    'value' => isset($params['koudo']) ? $params['koudo'] : '',
                    'class' => "form-control",
                    'placeholder' => 'A0000001',
                    'id' => 'koudo',
                ]); ?>
            </div>
            <div class="col-sm-2  col-form-label text-right">枝番コード</div>
            <div class="col-sm-2">
                <?= $this->Form->text('edaban', [
                    'value' => isset($params['edaban']) ? $params['edaban'] : null,
                    'class' => "form-control",
                    'placeholder' => '']); ?>
            </div>
            <div class="col-sm-2  col-form-label text-right">単位</div>
            <div class="col-sm-2">
                <?= $this->Form->select('tani', $this->VHtml->selectNull(MProductTable::TANI_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($params['tani']) ? $params['tani'] : null,
                ]); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label text-right">商品名</div>
            <div class="col-sm-6">
                <?= $this->Form->text('mei', [
                    'value' => isset($params['mei']) ? $params['mei'] : null,
                    'class' => "form-control",
                    'placeholder' => 'キッチン']); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">標準売上単価</div>
            <div class="col-sm-2">
                <?= $this->Form->text('hyoujun_uriage_tanka', [
                    'value' => isset($params['hyoujun_uriage_tanka']) ? $params['hyoujun_uriage_tanka'] : null,
                    'class' => "form-control text-right",
                    'placeholder' => '20300']); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label text-right">商品名索引</div>
            <div class="col-sm-6">
                <?= $this->Form->text('mei_sakuin', [
                    'value' => isset($params['mei_sakuin']) ? $params['mei_sakuin'] : null,
                    'class' => "form-control",
                    'placeholder' => 'ｷｯﾁﾝ']); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">非課税区分</div>
            <div class="col-sm-2">
                <?= $this->Form->select('hikazei_kubun', $this->VHtml->selectNull(MProductTable::HIKAZEI_KUBUN_VALUE)   , [
                    'class' => 'form-control',
                    'default' => isset($params['hikazei_kubun']) ? $params['hikazei_kubun'] : null,
                ]); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label text-right">セット区分</div>
            <div class="col-sm-2">
                <?= $this->Form->select('setto_hinkubun', $this->VHtml->selectNull(MProductTable::SETTO_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($params['setto_hinkubun']) ? $params['setto_hinkubun'] : null,
                ]); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">分類名</div>
            <div class="col-sm-2">
                <?= $this->Form->select('bunrui_koudo', $this->VHtml->selectNull(MProductTable::BUNRUI_KOUDO_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($params['bunrui_koudo']) ? $params['bunrui_koudo'] : null,
                ]); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">売上単価設定</div>
            <div class="col-sm-2">
                <?= $this->Form->select('uriage_tanka_settei_kubun', $this->VHtml->selectNull(MProductTable::URIAGE_TANKA_SETTEI_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($params['uriage_tanka_settei_kubun']) ? $params['uriage_tanka_settei_kubun'] : null,
                ]); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label text-right">カテゴリー</div>
            <div class="col-sm-2">
                <?= $this->Form->select('m_system_shouhin_kategori_id',
                    $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID]),
                    [
                    'class' => 'form-control',
                    'default' => isset($params['m_system_shouhin_kategori_id']) ? $params['m_system_shouhin_kategori_id'] : null,
                ]); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">仕入単価設定</div>
            <div class="col-sm-2">
                <?= $this->Form->select('shiiretanka_settei_kubun',
                    $this->VHtml->selectNull(MProductTable::URIAGE_TANKA_SETTEI_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($params['shiiretanka_settei_kubun']) ? $params['shiiretanka_settei_kubun'] : null,
                ]); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">在庫管理区分</div>
            <div class="col-sm-2">
                <?= $this->Form->select('zaiko_kanri_kubun',
                    $this->VHtml->selectNull(MProductTable::ZAIKO_KANRI_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($params['zaiko_kanri_kubun']) ? $params['zaiko_kanri_kubun'] : null,
                ]); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label text-right">期首在庫数量</div>
            <div class="col-sm-2">
                <?= $this->Form->text('kishu_zan_suuryou', [
                    'value' => isset($params['kishu_zan_suuryou']) ? $params['kishu_zan_suuryou'] : null,
                    'class' => "form-control text-right",
                    'placeholder' => '0']); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">仕入先数</div>
            <div class="col-sm-2">
                <?= $this->Form->select('shiiresaki_kazu',
                    $this->VHtml->selectNull(MProductTable::SHU_SHIIRESAKI_KOUDO_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($params['shiiresaki_kazu']) ? $params['shiiresaki_kazu'] : null,
                ]); ?>
            </div>
            <div class="col-sm-2 col-form-label text-right">税率適用日</div>
            <div class="col-sm-2">
                <?= $this->Form->text('keika_sochi_shiteibi', [
                    'value' => isset($params['keika_sochi_shiteibi']) ? $params['keika_sochi_shiteibi'] : null,
                    'class' => "form-control datepicker",
                    'id' => "zeiritsu_jisshi_nengappi"]); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label text-right">現在庫数量</div>
            <div class="col-sm-2">
                <?= $this->Form->text('ekisei_zaiko_suuryou', [
                    'value' => isset($params['ekisei_zaiko_suuryou']) ? $params['ekisei_zaiko_suuryou'] : null,
                    'class' => "form-control text-right",
                    'placeholder' => '0']); ?>
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
