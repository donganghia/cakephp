<?php

use Cake\Routing\Router;

?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'MSupplier', 'action' => 'index']) ?>',
                "autoWidth": false,
                "order": [[10, "desc"]],
                "columnDefs": [
                    {
                        "targets": 10,
                        "visible": false
                    }
                ],
                "columns": [
                    {"name": "action", "orderable": false},
                    {"name": "MSupplier.koudo"},
                    {"name": "MSupplier.mei_1"},
                    {"name": "MSupplier.mei_2"},
                    {"name": "MSupplier.ryakushou"},
                    {"name": "MSupplier.yuubenbangou"},
                    {"name": "MSupplier.juusho_1"},
                    {"name": "MSupplier.juusho_2"},
                    {"name": "MSupplier.m_system_shiiresaki_kategori_id"},
                    {"name": "MSupplier.juusho_3"},
                    {"name": "MSupplier.modified"}
                ]
            }
        );

        $('#btn-search').click(function () {
            $(tableId).DataTable().search($("#form-search").serialize()).draw();
        });

        $('#btn-import-csv').click(function () {
            ajaxDataForm(
                {'type': 1},
                "<?= Router::url(['controller' => 'MSupplier', 'action' => 'form-upload']) ?>",
                function (data) {
                    popupDataForm(
                        '仕入先のCSV入力',
                        data,
                        function () {
                            var fileUpload = $('#file')[0].files[0];
                            ajaxUploadForm(
                                fileUpload,
                                "<?= Router::url(['controller' => 'MSupplier', 'action' => 'csv-import']) ?>",
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
                "<?= Router::url(['controller' => 'MSupplier', 'action' => 'csv-export']) ?>",
                function (response) {
                    downloadCsvData(response);
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });
    });
</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url('/menu/m-hoshu-touroku')]); ?>
        <h1 class="title">仕入先マスタ</h1>
    </div>

    <?php include "_search.ctp" ?>

    <div class="content">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('success') ?>
        <?= $this->Flash->render('error') ?>
        <table id="table-list" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="6%" data-orderable="false">
                    <a href="<?= Router::url(['controller' => 'MSupplier', 'action' => 'add']) ?>"
                       class="btn btn-success btn-sm">追加</a>
                </th>
                <th width="10%"><?= __('仕入先ｺｰﾄﾞ') ?></th>
                <th width="10%"><?= __('仕入先名１') ?></th>
                <th width="10%"><?= __('仕入先名2') ?></th>
                <th width="10%"><?= __('略称') ?></th>
                <th width="11%"><?= __('郵便番号') ?></th>
                <th width="10%"><?= __('都道府県') ?></th>
                <th width="13%"><?= __('市区町村番地') ?></th>
                <th width="11%"><?= __('カテゴリー') ?></th>
                <th width="10%"><?= __('ビル名等') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


