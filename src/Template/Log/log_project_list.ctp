<?php
use Cake\Routing\Router;
?>
<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        var objTable = initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'Log', 'action' => 'logProjectList']) ?>',
                "autoWidth": false,
                "order": [[4, "desc"]],
                "search": {},
                "columns": [
                    {"name": "LogUpdateProject.m_user_id"},
                    {"name": "LogUpdateProject.order_id"},
                    {"name": "LogUpdateProject.bangou"},
                    {"name": "LogUpdateProject.status"},
                    {"name": "LogUpdateProject.created", class: "nowrap"}
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
                    <?= $this->element('../Log/menu', ['position' => 1]); ?>
                </div>
                <div class="col-sm-9">
                    <table id="table-list" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="18%"><?= __('ユーザーID') ?></th>
                            <th width="18%"><?= __('確定発注No') ?></th>
                            <th width="18%"><?= __('受注番号') ?></th>
                            <th width="18%"><?= __('案件状態') ?></th>
                            <th width="18%"><?= __('最終利用日時') ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
