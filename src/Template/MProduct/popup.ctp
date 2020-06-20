<?php
use Cake\Routing\Router;
use App\Model\Table\MProductTable; ?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'MProduct', 'action' => 'popup']) ?>',
                "autoWidth": false,
                "order": [[11, "desc"]],
                "select": {
                    "style":  'os',
                    "selector": 'td:first-child'
                },
                "columns": [
                    { "name": "action", "orderable": false },
                    { "name": "action"},
                    { "name": "MProduct.koudo" },
                    { "name": "MProduct.mei" },
                    { "name": "MProduct.naiyou" },
                    { "name": "MProduct.tani"},
                    { "class": 'text-right', "name": "MProduct.ekisei_zaiko_suuryou"},
                    { "class": 'text-right', "name": "MProduct.tanka", "data": function (row){return convertNumberToMoney(row[7])}},
                    { "class": 'text-right', "name": "MProduct.tanka_total","data": function (row){return convertNumberToMoney(row[8])}},
                    { "class": 'text-right', "name": "MProduct.hyoujun_uriage_tanka","data": function (row){return convertNumberToMoney(row[9])}},
                    { "class": 'text-right', "name": "MProduct.hyoujun_uriage_tanka_total","data": function (row){return convertNumberToMoney(row[10])}},
                    { "name": "MProduct.modified", "visible": false}
                ]
            }
        );
    });

    $(document).ready(function () {
        $('#btn-search').click(function () {
            var fomSearch = $("#form-search").serialize();
            $(tableId).DataTable().search(fomSearch).draw();
        });

        $('#checkbox-select-all').on('click', function(){
            var rows = $(tableId).DataTable().rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
    });
</script>

<div class="search-form card">
    <div class="card-body">
        <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label" for="koudo">商品コード</div>
            <div class="col-sm-3">
                <?= $this->Form->text('koudo', [
                    'value' => isset($params['koudo']) ? $params['koudo'] : '',
                    'class' => "form-control",
                    'placeholder' => 'A0000001',
                    'id' => 'koudo',
                ]); ?>
            </div>
            <div class="col-sm-2">商品名</div>
            <div class="col-sm-4">
                <?= $this->Form->text('mei', [
                    'value' => isset($params['mei']) ? $params['mei'] : null,
                    'class' => "form-control",
                    'id' => 'mei',
                    'placeholder' => 'キッチン']); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-2">分類名</div>
            <div class="col-sm-3">
                <?= $this->Form->select('bunrui_koudo', $this->VHtml->selectNull(MProductTable::BUNRUI_KOUDO_VALUE), [
                    'class' => 'form-control', 'id' => 'bunrui_koudo',
                    'default' => isset($params['bunrui_koudo']) ? $params['bunrui_koudo'] : null,
                ]); ?>
            </div>
            <div class="col-sm-2">カテゴリー</div>
            <div class="col-sm-3">
                <?= $this->Form->select('m_system_shouhin_kategori_id',
                    $this->VHtml->selectNull($mstSystem['KATEGORI_ID']),
                    [
                    'class' => 'form-control', 'id' => 'm_system_shouhin_kategori_id',
                    'default' => isset($params['m_system_shouhin_kategori_id']) ? $params['m_system_shouhin_kategori_id'] : null,
                ]); ?>
            </div>
            <div class="pull-left">
                <button id="btn-search" class="btn btn-sm btn-primary" type="button">検索</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<div class="">
    <table id="table-list" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th width="3%"><input type="checkbox" name="select_all" value="1" id="checkbox-select-all"></th>
            <th width="9%"><?= __('仕入先') ?></th>
            <th width="10%"><?= __('商品ｺｰﾄﾞ') ?></th>
            <th width="10%"><?= __('商品名') ?></th>
            <th width="10%"><?= __('内容') ?></th>
            <th width="7%"><?= __('単位') ?></th>
            <th width="8%"><?= __('数量') ?></th>
            <th><?= __('発注単価') ?></th>
            <th><?= __('発注金額') ?></th>
            <th><?= __('受注単価') ?></th>
            <th><?= __('受注金額') ?></th>
            <th><?= __('modified') ?></th>
        </tr>
        </thead>
    </table>
</div>
