<?php
use Cake\Routing\Router;
use App\Model\Table\ProjectTable;
?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'yotei_ichiran']) ?>',
                "autoWidth": false,
                "order": [[7, "desc"]],
                "oSearch": {"sSearch": "type=<?= $type;?>"},
                "columns": [
                    {"name": "action", "orderable": false},
                    {"name": "Orders.juchuu_bangou"},
                    {"name": "Project.e_moushisha_mei"},
                    {"name": "Project.m_system_bumon_id"},
                    {"name": "Project.e_moushisha_yuubenbangou","visible": false},
                    {"name": "Project.e_moushisha_juushotodoufuken"},
                    {"name": "Project.e_moushisha_juushoshichou"},
                    {"name": "Orders.modified"}
                ]
            }
        );

        $('#btn-search').click(function () {
            $(tableId).DataTable().search($("#form-search").serialize()).draw();
        });
    });

</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url('/menu/juchuu-touroku')]); ?>
        <h1 class="title"><?= $title;?></h1>
    </div>

    <?php include "_search.ctp" ?>
    <?php if($type == ProjectTable::YOTEI_TYPE): ?>
        <h5>登録済み予定データ一覧</h5>
    <?php else: ?>
        <h5>受注登録済データ一覧</h5>
    <?php endif; ?>

    <div class="content">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('success') ?>
        <?= $this->Flash->render('error') ?>
        <table id="table-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th width="10%"><?= __('伝票番号') ?></th>
                    <th width="15%"><?= __('申込者名') ?></th>
                    <th width="15%"><?= __('部門') ?></th>
                    <th width="10%"><?= __('〒') ?></th>
                    <th width="15%"><?= __('都道府県') ?></th>
                    <th><?= __('住所') ?></th>
                    <th><?= __('最終更新日') ?></th>
                </tr>
            </thead>
        </table>
    </div>
</div>


