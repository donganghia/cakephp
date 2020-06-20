<?php
use Cake\Routing\Router;
?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller'=> 'MProduct', 'action'=> 'index']) ?>',
                "autoWidth": false,
                "order": [[10, "desc"]],
                "columns":[
                    { "name": "action", "orderable": false },
                    { "name": "MProduct.koudo" },
                    { "name": "MProduct.mei" },
                    { "name": "MProduct.mei_sakuin" },
                    { "name": "MProduct.tani"},
                    { "name": "MProduct.setto_hinkubun_mei"},
                    { "name": "MProduct.hyoujun_uriage_tanka"},
                    { "name": "MProduct.bunrui_koudo"},
                    { "name": "MProduct.m_system_shouhin_kategori_id"},
                    { "name": "MProduct.hikazei_kubun"},
                    { "name": "MProduct.modified", "visible": false}
                ]
            }
        );
        $('#btn-search').click(function () {
            $(tableId).DataTable().search($("#form-search").serialize()).draw();
        });

        $('#btn-import-csv').click(function () {
            ajaxDataForm(
                {'type': 1},
                "<?= Router::url(['controller' => 'MProduct', 'action' => 'form-upload']) ?>",
                function (data) {
                    popupDataForm(
                        '商品マスタのCSV入力',
                        data,
                        function () {
                            var fileUpload = $('#file')[0].files[0];
                            ajaxUploadForm(
                                fileUpload,
                                "<?= Router::url(['controller' => 'MProduct', 'action' => 'csv-import']) ?>",
                                function (response) {
                                    var result = JSON.parse(response);
                                    if(result.status == 1) {
                                        popupAlert(result.msg);
                                        $(tableId).DataTable().search($("#form-search").serialize()).draw();
                                    } else {
                                        popupAlert(result.msg);
                                    }
                                },
                                <?= json_encode($this->request->getParam('_csrfToken')) ?>
                            );
                        },
                        function () {
                        }
                    )
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });

        $('#btn-export-csv').click(function () {
            ajaxDataForm(
                $("#form-search").serialize(),
                "<?= Router::url(['controller' => 'MProduct', 'action' => 'csv-export']) ?>",
                function (response) {
                    downloadCsvData(response);
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });
    });
</script>

<div class="page page_register product_master" id="product">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url('/menu/m-hoshu-touroku')]); ?>
        <h1 class="title">商品マスタ</h1>
    </div>

    <?php include "_search.ctp" ?>

    <div class="content">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('success') ?>
        <?= $this->Flash->render('error') ?>
        <table id="table-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="5%">
                        <a href="<?= Router::url(['controller'=> 'MProduct', 'action'=> 'add']) ?>" class="btn btn-success btn-sm">追加</a>
                    </th>
                    <th width="10%" class="nowrap text-middle"><?= __('商品コード') ?></th>
                    <th width="9%" class="nowrap text-middle"><?= __('商品名') ?></th>
                    <th width="9%" class="nowrap text-middle"><?= __('商品名索引') ?></th>
                    <th width="10%" class="nowrap text-middle"><?= __('単位') ?></th>
                    <th width="10%" class="nowrap text-middle"><?= __('ｾｯﾄ品区分') ?></th>
                    <th width="10%" class="nowrap text-middle"><?= __('標準売上単価') ?></th>
                    <th width="9%" class="nowrap text-middle"><?= __('分類ｺｰﾄﾞ') ?></th>
                    <th width="12%" class="nowrap text-middle"><?= __('カテゴリー') ?></th>
                    <th width="12%" class="nowrap text-middle"><?= __('非課税区分') ?></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

