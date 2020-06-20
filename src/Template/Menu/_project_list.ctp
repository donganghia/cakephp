<style type="text/css">
    .list-name {
        font-size: 1rem;
        font-weight: bold;
        border-bottom: 1px solid black;
        padding-bottom: 0.01rem;
        margin-bottom: 0.8rem;
    }

    .h5-title {
        text-decoration: underline;
        margin-bottom: 0;
    }
</style>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= $url ?>',
                "autoWidth": false,
                "order": [[4, "desc"]],
                "columns":[
                    {"name": "action", "orderable": false},
                    { "name": "Orders.juchuu_bangou"},
                    { "name": "Project.e_moushisha_mei"},
                    { "name": "Project.bumon"},
                    { "name": "Orders.modified"}
                ]
            }
        );

        $('#btn-search').click(function () {
            $(tableId).DataTable().search($("#form-search").serialize()).draw();
        });
    });
</script>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <h5 class="h5-title"><?= $titleTable ?></h5>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <table id="table-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th width="15%">伝票番号</th>
                    <th width="25%">申込者名</th>
                    <th>部門</th>
                    <th width="25%">最終更新日</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
