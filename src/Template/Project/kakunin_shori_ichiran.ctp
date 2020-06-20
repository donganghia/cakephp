<?php
use Cake\Routing\Router;
?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'kakunin-shori-ichiran']) ?>',
                "autoWidth": false,
                "order": [[4, "desc"]],
                "oSearch": {"sSearch": "<?= $this->VHtml->convertToSearchString($defaultCondition);?>"},
                "columns": [
                    {"name": "action", "orderable": false},
                    { "name": "Orders.juchuu_bangou"},
                    { "name": "Project.e_moushisha_mei"},
                    { "name": "Project.bumon"},
                    { "name": "Orders.modified"}
                ]
            }
        );

        $('#btn-search').click(function () {
            $(tableId).DataTable().search($("#form-search").serialize() +
                "&<?= $this->VHtml->convertToSearchString($defaultCondition);?>").draw();
        });
    });

</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url(['controller' => 'Menu', 'action' => 'main'])]); ?>
        <h1 class="title">案件確認処理（案件選択）</h1>
    </div>

    <?php include "_search_kakunin_shori.ctp" ?>

    <div class="content">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('success') ?>
        <?= $this->Flash->render('error') ?>
        <h5 class="title">未確認案件一覧</h5>
        <table id="table-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th width="15%"><?= __('伝票番号') ?></th>
                    <th width="15%"><?= __('申込者名') ?></th>
                    <th width="15%"><?= __('部門') ?></th>
                    <th width="15%"><?= __('最終更新日') ?></th>
                </tr>
            </thead>
        </table>

        <?= $this->element('../Project/mi_kaitou_ichiran', [
            'titleTable' => '作業予定日 未回答一覧'
        ]); ?>
    </div>
</div>


