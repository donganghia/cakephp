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
                'ajax': '<?= Router::url(['controller' => 'Log', 'action' => 'log-login-list']) ?>',
                "autoWidth": false,
                "order": [[4, "desc"]],
                "search": {},
                "columns": [
                    {"name": "LogLogin.created", class: "nowrap"},
                    {"name": "LogLogin.m_user_name"},
                    {"name": "LogLogin.m_user_username"},
                    {"name": "LogLogin.m_supplier_name"},
                    {"name": "LogLogin.m_user_created", class: "nowrap"}
                ]
            }
        );
    });
</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url(['controller' => 'Menu', 'action' => 'shisutemuKanri'])]); ?>
        <h1 class="title">利用状況管理</h1>
    </div>

    <div class="search-form card">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                    <?= $this->element('../Log/menu', ['position' => 0]); ?>
                </div>
                <div class="col-sm-9">
                    <table id="table-list" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="18%"><?= __('最終利用日時') ?></th>
                            <th width="18%"><?= __('ユーザー名') ?></th>
                            <th width="18%"><?= __('ユーザーID') ?></th>
                            <th width="18%"><?= __('所属会社名') ?></th>
                            <th width="18%"><?= __('登録年月日') ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
