<?php
use Cake\Routing\Router;
use App\Controller\ProjectController;
$defaultCondition = isset($defaultCondition) ? $defaultCondition : ProjectController::partnerDefaultCondition();
?>

<script type="application/javascript">
    var tableId2 = "#table-list2";
    $(function () {
        initDatatable(tableId2,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'miKaitouIchiran']) ?>',
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
        $(tableId2).DataTable().search("<?= $this->VHtml->convertToSearchString($defaultCondition);?>").draw();

        $('#btn-search').click(function () {
            $(tableId2).DataTable().search($("#form-search").serialize() +
                "&<?= $this->VHtml->convertToSearchString($defaultCondition);?>").draw();
        });
    });

</script>
<h5 class="title mt-3"><?= $titleTable ?></h5>
<table id="table-list2" class="table table-striped table-bordered" style="font-size: 1rem !important;">
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