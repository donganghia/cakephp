<?php
use App\Model\Table\MSystemTable;
use App\Model\Table\MCustomerTable;
use Cake\Routing\Router;
?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'popup']) ?>',
                "autoWidth": false,
                "order": [[7, "desc"]],
                "select": {
                    "style": 'os',
                    "selector": 'td:first-child'
                },
                "oSearch": {"sSearch": "project_type=<?= $projectType ?>"},
                "columns": [
                    { "name": "action", "orderable": false, 'width': '20px' },
                    { "name": "Orders.juchuu_bangou", 'width': '150px' },
                    { "name": "Project.e_moushisha_mei", 'width': '150px' },
                    { "name": "Project.m_system_bumon_id", 'width': '150px' },
                    { "name": "Project.e_moushisha_yuubenbangou", 'width': '150px' },
                    { "name": "Project.e_moushisha_juushotodoufuken", 'width': '120px' },
                    { "name": "Project.e_moushisha_juushoshichou", 'width': '180px' },
                    { "name": "Project.created", "visible": false }
                ]
            }
        );
    });

</script>

<table id="table-list" class="table table-striped table-bordered display nowrap">
    <thead>
        <tr>
            <th width="5%"></th>
            <th><?= __('見積No.') ?></th>
            <th><?= __('申込者名') ?></th>
            <th><?= __('部門') ?></th>
            <th><?= __('郵便番号') ?></th>
            <th><?= __('都道府県') ?></th>
            <th><?= __('住所') ?></th>
        </tr>
    </thead>
</table>
