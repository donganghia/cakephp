<?php

use Cake\Routing\Router;

?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        var objTable = initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'MSupplierProduct', 'action' => 'index']) ?>',
                "autoWidth": false,
                "order": [[6, "desc"]],
                "columnDefs": [
                    {
                        "targets": 6,
                        "visible": false
                    }
                ],
                "search": {
                    "search": "m_supplier_id=<?= $m_supplier_id;?>"
                },
                "columns": [
                    {"name": "action", "orderable": false},
                    {"name": "MSupplierProduct.shouhin_koudo", "orderable": false},
                    {"name": "MSupplierProduct.shouhin_mei", "orderable": false},
                    // {"name": "MSupplierProduct.bunrui_koudo"},
                    {"name": "MSupplierProduct.bunrui_koudo", "orderable": false},
                    // {"name": "MSupplierProduct.tanka_shubetsu"},
                    {"name": "MSupplierProduct.tanka_shubetsu", "orderable": false},
                    {"name": "MSupplierProduct.tanka", "orderable": false},
                    {"name": "MSupplierProduct.modified"}
                ]
            }
        );
    });

    $(document).ready(function () {

        $('#btn-add-supplier-product').click(function () {
            ajaxAddEditData(0);
        });

        $('#btn-import-csv').click(function () {
            ajaxDataForm(
                {'type': 1},
                "<?= Router::url(['controller' => 'MSupplier', 'action' => 'form-upload']) ?>",
                function (data) {
                    popupDataForm(
                        '仕入商品のCSV入力',
                        data,
                        function () {
                            var fileUpload = $('#file')[0].files[0];
                            return ajaxUploadForm(
                                fileUpload,
                                "<?= Router::url(['controller' => 'MSupplierProduct', 'action' => 'csv-import']) ?>",
                                function (response) {
                                    var result = JSON.parse(response);
                                    if (result.status == 1) {
                                        popupAlert(result.msg);
                                        $(tableId).DataTable().search("m_supplier_id=<?= trim($m_supplier_id);?>").draw();
                                    } else {
                                        popupAlert(result.msg);
                                        return false;
                                    }
                                    return true;
                                },
                                <?= json_encode($this->request->getParam('_csrfToken')) ?>
                            );
                        },
                        function () {}
                    )
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });

        $('#btn-export-csv').click(function () {
            ajaxDataForm(
                {'m_supplier_id': '<?= $m_supplier_id;?>'},
                "<?= Router::url(['controller' => 'MSupplierProduct', 'action' => 'csv-export']) ?>",
                function (response) {
                    downloadCsvData(response);
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });

    });

    function ajaxAddEditData(id) {
        ajaxDataForm(
            {'m_supplier_id':  <?= $m_supplier_id;?>, 'id': id},
            "<?= Router::url(['controller' => 'MSupplierProduct', 'action' => 'add']) ?>",
            function (data) {
                popupDataForm(
                    '仕入単価マスタ',
                    data,
                    function () {
                        return processDataForm(id);
                    },
                    function () {
                    }
                );
            },
            <?= json_encode($this->request->getParam('_csrfToken')) ?>
        );
    }

    function processDataForm(id) {
        var errorMessage = '';

        var shouhin_koudo = $("#shouhin_koudo").val();
        if (shouhin_koudo == '') {
            errorMessage += '商品ｺｰﾄは必須項目です。\n';
        }
        var shouhin_mei = $("#shouhin_mei").val();
        if (shouhin_mei == '') {
            errorMessage += '商品名は必須項目です。';
        }

        if (errorMessage != '') {
            popupAlert(errorMessage);
            return false;
        }

        ajaxDataForm(
            $('#form-supplier-product').serialize() + '&' + $.param({'id': id}),
            "<?= Router::url(['controller' => 'MSupplierProduct', 'action' => 'save']) ?>",
            function (response) {
                var result = JSON.parse(response);
                if (result.status == 1) {
                    popupAlert(result.msg);
                    $(tableId).DataTable().search("m_supplier_id=<?= trim($m_supplier_id);?>").draw();
                    return true;
                } else {
                    popupAlert(result.msg);
                    return false;
                }
            },
            <?= json_encode($this->request->getParam('_csrfToken')) ?>
        );

    }

    function ajaxDeleteData(id) {
        popupConfirm('削除します。宜しいですか？', function () {
            ajaxDataForm(
                $.param({'id': id}),
                "<?= Router::url(['controller' => 'MSupplierProduct', 'action' => 'delete']) ?>",
                function (response) {
                    var result = JSON.parse(response);
                    if (result.status == 1) {
                        popupAlert(result.msg);
                        $(tableId).DataTable().search("m_supplier_id=<?= trim($m_supplier_id);?>").draw();
                    } else {
                        popupAlert(result.msg);
                    }
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });
    }

</script>
<div class="text-center">
    <button id="btn-import-csv" class="btn btn-secondary" type="button">CSV入力</button>
    <button id="btn-export-csv" class="btn btn-dark" type="button">CSV出力</button>
</div>
<div class="form-group row">
    <label class="col-sm-4 col-form-label"><h5>仕入単価一覧</h5></label>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <div class="page page_register register_master" id="master">
            <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
            <?= $this->Form->hidden('m_supplier_id', ['value' => 1]); ?>
            <?= $this->Form->end() ?>

            <div class="content">
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('success') ?>
                <?= $this->Flash->render('error') ?>
                <table id="table-list" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="6%">
                            <a id="btn-add-supplier-product" class="btn btn-success btn-sm">追加</a>
                        </th>
                        <th width="9%"><?= __('商品ｺｰﾄﾞ') ?></th>
                        <th width="9%"><?= __('商品名') ?></th>
                        <th width="9%"><?= __('分類ｺｰﾄﾞ') ?></th>
                        <!-- <th width="10%"><?= __('分類名') ?></th> -->
                        <th width="12%"><?= __('単価種別') ?></th>
                        <!-- <th width="12%"><?= __('単価種別名') ?></th> -->
                        <th width="12%"><?= __('単価') ?></th>
                        <th width="12%"><?= __('') ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>