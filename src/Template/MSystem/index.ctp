<?php
use Cake\Routing\Router;
use App\Model\Table\MSystemTable;
?>
<script type="application/javascript">
    var tableId = '#table-list';
    var categoryId = $("#category_id").val();
    $(function () {
        var objTable = initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'MSystem', 'action' => 'index']) ?>',
                "autoWidth": false,
                "order": [[3, "desc"]],
                "search": {
                    "search": "type_name="+categoryId
                },
                "columns": [
                    {"name": "action", "orderable": false},
                    {"name": "MSystem.id"},
                    {"name": "MSystem.name"},
                    {"name": "MSystem.modified"}
                ]
            }
        );
    });

    $(document).ready(function () {
        $('#btn-search').click(function () {
            categoryId = $("#category_id").val();
            $(tableId).DataTable().search("type_name=" + categoryId).draw();
        });

        $('#btn-add-supplier-product').click(function () {
            ajaxAddEditData(0);
        });

    });

    function ajaxAddEditData(id) {
        categoryId = $("#category_id").val();
        ajaxDataForm(
            {'id': id, 'type_name': categoryId},
            "<?= Router::url(['controller' => 'MSystem', 'action' => 'add']) ?>",
            function (data) {
                popupDataForm('案件管理マスタ',
                    data,
                    function () {
                        return processDataForm(id);
                    }
                );
            },
            <?= json_encode($this->request->getParam('_csrfToken')) ?>
        );
    }

    function processDataForm(id) {
        var errorMessage = '';
        var name = $("#name").val();
        if (name == '') {
            errorMessage += '内容は必須項目です。\n';
        }

        if (errorMessage != '') {
            popupAlert(errorMessage);
            return false;
        }

        ajaxDataForm(
            $('#form-add-edit-data').serialize() + '&' + $.param({'id': id}),
            "<?= Router::url(['controller' => 'MSystem', 'action' => 'save']) ?>",
            function (response) {
                var result = JSON.parse(response);
                if (result.status == 1) {
                    popupAlert(result.msg);
                    $(tableId).DataTable().search("type_name=" + categoryId).draw();
                } else {
                    popupAlert(result.msg);
                }
            },
            <?= json_encode($this->request->getParam('_csrfToken')) ?>
        );

        return true;
    }

    function ajaxDeleteData(id) {
        popupConfirm('削除します。宜しいですか？', function () {
            ajaxDataForm(
                $.param({'id': id}),
                "<?= Router::url(['controller' => 'MSystem', 'action' => 'delete']) ?>",
                function (response) {
                    var result = JSON.parse(response);
                    if (result.status == 1) {
                        popupAlert(result.msg);
                        $(tableId).DataTable().search("type_name=" + categoryId).draw();
                    } else {
                        popupAlert(result.msg);
                    }
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });
    }
</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url('/menu/m-hoshu-touroku')]); ?>
        <h1 class="title">案件管理マスタ保守</h1>
    </div>

    <div class="search-form card">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-4">
                    <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
                    <h4>1.管理項目</h4>
                    <div class="">
                        <div class="col-sm-9 pull-left">
                            <?= $this->Form->select('category_id',
                                array_diff_key(MSystemTable::SYSTEM_CATEGORY, MSystemTable::HIDDEN_SYSTEM_CATEGORY),
                                [
                                    'id' => 'category_id',
                                    'class' => 'form-control col-sm-11',
                                    'default' => 0,
                                ]); ?>
                        </div>
                        <div class="pull-left">
                            <button id="btn-search" class="btn btn-primary btn-sm" type="button">選択</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h4>2.マスタ内容</h4>
                    <div>
                        <table id="table-list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10%" data-orderable="false">
                                        <a id="btn-add-supplier-product" class="btn btn-success btn-sm">追加</a>
                                    </th>
                                    <th width="15%"><?= __('項番') ?></th>
                                    <th><?= __('内容') ?></th>
                                    <th width="25%"><?= __('更新日') ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
