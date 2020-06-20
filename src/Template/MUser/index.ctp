<?php
use App\Libs\Constant;
use App\Model\Table\MUserTable;
use Cake\Routing\Router;
?>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller'=> 'MUser', 'action'=> 'index']) ?>',
                "autoWidth": false,
                "order": [[8, "desc"]],
                "columns":[
                    { "name": "action", "orderable": false },
                    { "name": "MUser.username" },
                    { "name": "MUser.name" },
                    { "name": "MUser.type" },
                    { "name": "MRole.name"},
                    { "name": "MSupplier.mei_1"},
                    { "name": "MUser.phone"},
                    { "name": "MUser.email"},
                    { "name": "MUser.created", 'class': 'text-center'}
                ]
            }
        );
        
        $('#btn-search').click(function () {
            $(tableId).DataTable().search($("#form-search").serialize()).draw();
        });

        $('#btn-clear').click(function () {
            clearForm('#form-search', function () {
                $(tableId).DataTable().search($("#form-search").serialize()).draw();
            });
        });
    });
</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url('/menu/m-hoshu-touroku')]); ?>
        <h1 class="title">利用者マスタ保守一覧</h1>
    </div>

    <div class="search-form card">
        <div class="card-body">
            <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
                <div class="form-group row">
                    <label for="username" class="col-sm-1 col-form-label text-right">ＩＤ</label>
                    <div class="col-sm-3">
                        <?= $this->Form->text('username', ['class' => 'form-control', 'required' => false]); ?>
                    </div>
                    <label for="name" class="col-sm-1 col-form-label text-right">名前</label>
                    <div class="col-sm-3">
                        <?= $this->Form->text('name', ['class' => 'form-control', 'required' => false]); ?>
                    </div>
                    <label for="m_role_id" class="col-sm-1 col-form-label text-right">役割</label>
                    <div class="col-sm-3">
                        <?php $aryType = Constant::SEARCH_EMPTY + MUserTable::TYPE_VALUE; ?>
                        <?= $this->Form->select('type', $aryType, [
                            'id' => 'type',
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-1 col-form-label text-right">電話番号</label>
                    <div class="col-sm-3">
                        <?= $this->Form->text('phone', ['class' => 'form-control', 'placeholder' => '(例) 08011112222']); ?>
                    </div>

                    <label for="email" class="col-sm-1 col-form-label text-right">メール</label>
                    <div class="col-sm-3">
                        <?= $this->Form->text('email', ['class' => 'form-control', 'placeholder' => '(例) user@xyz.com']); ?>
                    </div>
                </div>
                <div class="text-center">
                    <button id="btn-clear" class="btn btn-secondary" type="button">クリア</button>
                    <button id="btn-search" class="btn btn-primary" type="button">検索</button>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('success') ?>
        <?= $this->Flash->render('error') ?>
        <table id="table-list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="6%">
                        <a href="<?= Router::url(['controller'=> 'MUser', 'action'=> 'add']) ?>" class="btn btn-success btn-sm">追加</a>
                    </th>
                    <th width="11%"><?= __('利用者ＩＤ') ?></th>
                    <th><?= __('名前') ?></th>
                    <th width="8%"><?= __('役割') ?></th>
                    <th width="8%"><?= __('権限') ?></th>
                    <th width="15%"><?= __('仕入先') ?></th>
                    <th width="10%"><?= __('電話番号') ?></th>
                    <th width="9%"><?= __('メール') ?></th>
                    <th width="15%"><?= __('作成日') ?></th>
                </tr>
            </thead>
        </table>
    </div>
</div>