<?php
use App\Model\Table\MSystemTable;
use App\Model\Table\MCustomerTable;
use App\Model\Table\MSupplierTable;
use Cake\Routing\Router;
?>

<style type="text/css">
    table#table-list td {
        word-wrap: break-word;
    }
</style>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'MCustomer', 'action' => 'popup']) ?>',
                "autoWidth": false,
                "order": [[12, "desc"]],
                "columns": [
                    { "name": "action", "orderable": false, 'width': '5%' },
                    { "name": "MMaster.name", 'width': '10%' },
                    { "name": "MCustomer.moushisha_moushimei_kanji", "class": "moushisha_moushimei_kanji", 'width': '10%' },
                    { "name": "MCustomer.moushisha_moushimei_kana", 'width': '10%' },
                    { "name": "MCustomer.tokui_saki_ryakushou", 'width': '10%' },
                    { "name": "MCustomer.e_moushisha_youbinbangou", "class": "e_moushisha_youbinbangou", 'width': '10%' },
                    { "name": "MCustomer.e_moushisha_juusho_todoufuken", "class": "e_moushisha_juusho_todoufuken", 'width': '10%' },
                    { "name": "MCustomer.e_moushisha_juusho_shikuchousonikou", "class": "e_moushisha_juusho_shikuchousonikou"},
                    { "name": "MCustomer.denwa", 'width': '10%' },
                    { "name": "MCustomer.keitai_bangou", 'width': '10%' },
                    { "name": "MCustomer.fakkusu_bangou", 'width': '10%' },
                    { "name": "MCustomer.meirumegajin_meiru", 'width': '10%' },
                    { "name": "MCustomer.created", "visible": false }
                ]
            }
        );

        $('#btn-search').click(function () {
            var fomSearch = $("#form-search").serialize();
            $(tableId).DataTable().search(fomSearch).draw();
        });
    });

</script>

<div class="search-form card">
    <div class="card-body">
        <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
        <div class="form-group row">
            <label for="kanri_bangou" class="col-sm-1 col-form-label text-right">管理番号</label>
            <div class="col-sm-3">
                <?= $this->Form->text('kanri_bangou', [
                    'class' => 'form-control',
                    'maxLength' => 20]); ?>
            </div>
            <label for="m_system_kaiinshurui_id" class="col-sm-1 col-form-label text-right">会員種類</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_kaiinshurui_id',
                    $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_KAIIN_SHURUI]), [
                        'class' => 'form-control'
                    ]); ?>
            </div>
            <label for="m_system_sabisukubun_id" class="col-sm-1 col-form-label text-right">ｻｰﾋﾞｽ区分</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_sabisukubun_id',
                    $this->VHtml->selectNull($aryMSystem[MSystemTable::SYSTEM_SAABUSU_KUBUN]), [
                        'class' => 'form-control'
                    ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="m_system_tantousha_id" class="col-sm-1 col-form-label text-right">担当者名</label>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_tantousha_id',
                    $this->VHtml->selectNull(isset($aryMSystem[MSystemTable::SYSTEM_TANTOUSHA]) ? $aryMSystem[MSystemTable::SYSTEM_TANTOUSHA] : []), [
                        'class' => 'form-control'
                    ]); ?>
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
            <div class="col-sm-5">
                <?= $this->Form->text('name', [
                    'maxLength' => 200,
                    'class' => 'form-control']); ?>
            </div>
            <label for="name" class="col-sm-1 col-form-label text-right">カナ</label>
            <div class="col-sm-5">
                <?= $this->Form->text('kana', [
                    'maxLength' => 200,
                    'class' => 'form-control']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="yuubenbangou" class="col-sm-1 col-form-label text-right">郵便番号</label>
            <div class="col-sm-2">
                <?= $this->Form->text('yuubenbangou', [
                    'maxLength' => 10,
                    'class' => 'form-control']); ?>
            </div>
            <label for="todoufuken" class="col-sm-1 col-form-label text-right">都道府県</label>
            <div class="col-sm-2">
                <?= $this->Form->select('todoufuken',
                    $this->VHtml->selectNull(MSupplierTable::PREFECTURE_DATA), [
                        'class' => 'form-control'
                    ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="shiku_chouson_banchi" class="col-sm-1 col-form-label text-right">番地</label>
            <div class="col-sm-5">
                <?= $this->Form->text('shiku_chouson_banchi', [
                    'maxLength' => 512,
                    'placeholder' => '○○市○○区○○町○丁目○‐○',
                    'class' => 'form-control']); ?>
            </div>
            <label for="biru_mei_tou" class="col-sm-1 col-form-label text-right">ビル名等</label>
            <div class="col-sm-5">
                <?= $this->Form->text('biru_mei_tou', [
                    'maxLength' => 512,
                    'class' => 'form-control']); ?>
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
            <label for="mail" class="col-sm-1 col-form-label text-right">メール</label>
            <div class="col-sm-2">
                <?= $this->Form->text('mail', [
                    'maxLength' => 100,
                    'class' => 'form-control']); ?>
            </div>
        </div>
        <div class="text-center">
            <button id="btn-search" class="btn btn-primary" type="button">検索</button>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<table id="table-list" class="table table-striped table-bordered display nowrap">
    <thead>
        <tr>
            <th></th>
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
            <th></th>
        </tr>
    </thead>
</table>
