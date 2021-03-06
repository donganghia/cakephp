<?php
use Cake\Routing\Router;
use App\Model\Table\ProjectTable;
?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'anken-kensaku-ichiran']) ?>',
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
        <h1 class="title">案件検索</h1>
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
                <label for="ryakushou" class="col-sm-1 col-form-label text-right">受付日</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('created', [
                        'value' => isset($params['created']) ? $params['created'] : null,
                        'class' => "form-control datepicker"
                    ]); ?>
                </div>
                <label for="ryakushou" class="col-sm-1 col-form-label text-right">作業予定日</label>
                <div class="col-sm-3">
                    <?= $this->Form->text('modified', [
                        'value' => isset($params['modified']) ? $params['modified'] : null,
                        'class' => "form-control datepicker"
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="joutai_opushon" class="col-sm-2 col-form-label text-right">状態オプション</label>
                <div class="col-sm-9 col-form-label">
                    <?php foreach(ProjectTable::PARTNER_JOUTAI_OPUSHON_VALUE as $key => $text) : ?>
                        <label class="checkbox-inline">
                            <input type="checkbox"  <?php if($key>2) {echo 'disabled="true"' ;} ?>name="joutai_opushon[]" value="<?= $key ?>">&nbsp;<?= $text ?>
                        </label>
                    <?php endforeach; ?>
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
        <h5 class="title">検索結果一覧</h5>
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
    </div>
</div>


