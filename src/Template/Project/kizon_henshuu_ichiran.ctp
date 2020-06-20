<?php
use Cake\Routing\Router;
use App\Model\Table\MSystemTable;
?>

<style type="text/css">
    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    #btn-shousai-kensaku {
        cursor: pointer;
        color: blue;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>

<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'Project', 'action' => 'kizonHenshuuIchiran']) ?>',
                "autoWidth": false,
                "order": [[5, "desc"]],
                "columns": [
                    {"name": "action", "orderable": false},
                    {"name": "Project.bangou"},
                    {"name": "Orders.juchuu_bangou"},
                    {"name": "Project.e_moushisha_mei"},
                    {"name": "Project.m_system_bumon_id"},
                    {"name": "Orders.modified"}
                ]
            }
        );

        $('#btn-search').click(function () {
            $(tableId).DataTable().search($("#form-search").serialize()).draw();
        });

        $('#m_system_joutaikubun_id').change(function () {
            $(tableId).DataTable().search($("#form-search").serialize()).draw();
        });

        $('#btn-reset').click(function () {
            $('#form-search')[0].reset();
        });

        toggleKensaku(0);
        $('#btn-shousai-kensaku').click(function () {
            if($('#shousai_kensaku').hasClass('hide')) {
                toggleKensaku(1);
            } else {
                toggleKensaku(0);
            }
        });
    });


    function toggleKensaku(val) {
        if(val == 1) {
            $('#shousai_kensaku').removeClass('hide').addClass('show');
            $('#btn-shousai-kensaku i').removeClass('fa-plus-square').addClass('fa-minus-square');
            $('#is_kensaku').val(1);
        } else {
            $('#shousai_kensaku').removeClass('show').addClass('hide');
            $('#btn-shousai-kensaku i').removeClass('fa-minus-square').addClass('fa-plus-square');
            $('#is_kensaku').val(0);
        }
    }
</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url(['controller'=> 'Menu', 'action'=> 'shisutemuKanri'])]); ?>
        <h1 class="title">既存データ案件検索</h1>
    </div>

    <div class="search-form card content">
        <div class="card-body">
            <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
            <div class="form-group row">
                <div class="col-sm-2">
                    <h5>登録済リスト</h5>
                    <div class="pull-left">
                        <?= $this->Form->select('m_system_joutaikubun_id',
                            $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN]), [
                                'class' => 'form-control',
                                'id' => 'm_system_joutaikubun_id',
                                'default' => null,
                            ]); ?>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="form-group row">
                        <label for="koudo" class="col-sm-2 col-form-label text-right">案件番号</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('bangou', [
                                'value' => isset($params['bangou']) ? $params['bangou'] : null,
                                'class' => "form-control",
                                'id' => 'koudo',
                            ]); ?>
                        </div>
                        <label for="moushisha_moushimei_kanji" class="col-sm-1 col-form-label text-right">申込者名</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('e_moushisha_mei', [
                                'value' => isset($params['e_moushisha_mei']) ? $params['e_moushisha_mei'] : null,
                                'class' => "form-control"
                            ]); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="created_from" class="col-sm-2 col-form-label text-right">登録日</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('created_from', [
                                'value' => isset($params['created_from']) ? $params['created_from'] : null,
                                'class' => "form-control datepicker"
                            ]); ?>
                        </div>
                        <label for="created_to" class="col-sm-1 col-form-label text-center">~</label>
                        <div class="col-sm-4">
                            <?= $this->Form->text('created_to', [
                                'value' => isset($params['created_to']) ? $params['created_to'] : null,
                                'class' => "form-control datepicker"
                            ]); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_system_tantou_id" class="col-sm-2 col-form-label text-right">担当者</label>
                        <div class="col-sm-4">
                            <?= $this->Form->select('Orders[m_system_tantou_id]', $this->VHtml->selectNull($aryTantousha), [
                                'class' => 'form-control',
                                'default' => isset($params['m_system_tantou_id']) ? $params['m_system_tantou_id'] : null,
                            ]); ?>
                        </div>
                        <label for="shiharai_saki_kubun" class="col-sm-1 col-form-label text-right">部門</label>
                        <div class="col-sm-4">
                            <?= $this->Form->select('m_system_bumon_id', $this->VHtml->selectNull($aryBumon), [
                                'class' => 'form-control',
                                'default' => isset($params['m_system_bumon_id']) ? $params['m_system_bumon_id'] : null,
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <a id="btn-shousai-kensaku">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>&nbsp;詳細検索
                </a>
                <input id="is_kensaku" type="hidden" name="is_kensaku" value="0">
            </div>

            <div id="shousai_kensaku" class="form-group row hide">
                <div class="card card-body">
                    <div class="form-group row">
                        <label for="m_system_shiharaihouhou_id" class="col-sm-1 col-form-label text-right">支払方法</label>
                        <div class="col-sm-3">
                            <?= $this->Form->select('m_system_shiharaihouhou_id', $this->VHtml->selectNull($aryShiharai), [
                                'class' => 'form-control',
                                'default' => isset($params['m_system_shiharaihouhou_id']) ? $params['m_system_shiharaihouhou_id'] : null,
                            ]); ?>
                        </div>
                        <label for="m_mediation_gensen_id" class="col-sm-1 col-form-label text-right">源泉</label>
                        <div class="col-sm-3">
                            <?= $this->Form->select('m_mediation_gensen_id', $this->VHtml->selectNull($aryMediation), [
                                'class' => 'form-control',
                                'default' => isset($params['m_mediation_gensen_id']) ? $params['m_mediation_gensen_id'] : null,
                            ]); ?>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="m_system_kamoku_id" class="col-sm-1 col-form-label text-right">科目</label>
                        <div class="col-sm-3">
                            <?= $this->Form->select('m_system_kamoku_id', $this->VHtml->selectNull($aryKamoku), [
                                'class' => 'form-control',
                                'default' => isset($params['m_system_kamoku_id']) ? $params['m_system_tantousha_id'] : null,
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button id="btn-search" class="btn btn-primary" type="button">検索</button>
                <button id="btn-reset" class="btn btn-secondary" type="button">クリア</button>

            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="content">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('success') ?>
        <?= $this->Flash->render('error') ?>
        <table id="table-list" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="5%"></th>
                <th width="15%"><?= __('案件番号') ?></th>
                <th width="15%"><?= __('受注番号') ?></th>
                <th><?= __('申込者名') ?></th>
                <th width="15%"><?= __('部門') ?></th>
                <th width="15%"><?= __('更新日') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>


