<?php
use Cake\Routing\Router;
?>

<script type="application/javascript">
    var completedId = '#table-completed-list';
    var processingId = "#table-processing-list";
    $(function () {
        initDatatable(completedId,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'kanryouKeijouShoriIchiran']) ?>',
                "autoWidth": false,
                "order": [[4, "desc"]],
                "oSearch": {"sSearch": "<?= $this->VHtml->convertToSearchString($completed);?>"},
                "columns": [
                    {"name": "action", "orderable": false},
                    { "name": "Orders.juchuu_bangou"},
                    { "name": "Project.e_moushisha_mei"},
                    { "name": "Project.bumon"},
                    { "name": "Orders.nouki_shuuryoubi"}
                ]
            }
        );

        initDatatable(processingId,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'kanryouZumiMiKeijouIchiran']) ?>',
                "autoWidth": false,
                "order": [[4, "desc"]],
                "oSearch": {"sSearch": "<?= $this->VHtml->convertToSearchString($processing);?>"},
                "columns": [
                    {"name": "action", "orderable": false},
                    { "name": "Orders.juchuu_bangou"},
                    { "name": "Project.e_moushisha_mei"},
                    { "name": "Project.bumon"},
                    { "name": "Orders.nouki_shuuryoubi"}
                ]
            }
        );

        $('#btn-search').click(function () {
            $(completedId).DataTable().search($("#form-search").serialize() +
                "&<?= $this->VHtml->convertToSearchString($completed);?>").draw();

            $(processingId).DataTable().search($("#form-search").serialize() +
                "&<?= $this->VHtml->convertToSearchString($processing);?>").draw();
        });
    });

</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url(['controller' => 'Menu', 'action' => 'mKanryouKeijouShori'])]); ?>
        <h1 class="title">完了計上処理</h1>
    </div>

    <div class="search-form card content">
        <div class="card-body">
            <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
            <div class="form-group row">
                <label for="koudo" class="col-sm-1 col-form-label text-right">案件番号</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('bangou', [
                        'value' => isset($params['bangou']) ? $params['bangou'] : null,
                        'class' => "form-control",
                        'id' => 'koudo',
                    ]); ?>
                </div>
                <label for="mei_1" class="col-sm-1 col-form-label text-right">受注番号</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('juchuu_bangou', [
                        'value' => isset($params['juchuu_bangou']) ? $params['juchuu_bangou'] : null,
                        'class' => "form-control"
                    ]); ?>
                </div>
                <label for="moushisha_moushimei_kanji" class="col-sm-1 col-form-label text-right">顧客名</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('e_moushisha_mei', [
                        'value' => isset($params['e_moushisha_mei']) ? $params['e_moushisha_mei'] : null,
                        'class' => "form-control"
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="ryakushou" class="col-sm-1 col-form-label text-right">作業完了日</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('nouki_shuuryoubi', [
                        'value' => isset($params['nouki_shuuryoubi']) ? $params['nouki_shuuryoubi'] : null,
                        'class' => "form-control datepicker"
                    ]); ?>
                </div>
            </div>
            <div class="text-center">
                <button id="btn-search" class="btn btn-primary" type="button">検索</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="content">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('success') ?>
        <?= $this->Flash->render('error') ?>
        <h5 class="title">作業完了案件一覧</h5>
        <table id="table-processing-list" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%"></th>
                <th width="15%"><?= __('伝票番号') ?></th>
                <th width="15%"><?= __('申込者名') ?></th>
                <th width="15%"><?= __('部門') ?></th>
                <th width="15%"><?= __('作業完了日') ?></th>
            </tr>
            </thead>
        </table>

        <h5 class="title mt-3">完了済み未計上一覧</h5>
        <table id="table-completed-list" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%"></th>
                <th width="15%"><?= __('伝票番号') ?></th>
                <th width="15%"><?= __('申込者名') ?></th>
                <th width="15%"><?= __('部門') ?></th>
                <th width="15%"><?= __('作業完了日') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


