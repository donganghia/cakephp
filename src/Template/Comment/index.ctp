<?php
    use Cake\Routing\Router;
    use App\Model\Table\MUserTable;
?>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?php if($login_user["type"] == MUserTable::TYPE_E_KURASHI) {
            echo $this->element('_back', ['url' => Router::url('/menu/shisutemuKanri')]);
        }
        else {
            echo $this->element('_back', ['url' => Router::url('/menu/main')]);
        } ?>        
        <h1 class="title">連絡コメント案件一覧</h1>
    </div>

    <div class="form-group row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>連絡コメント案件一覧</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="tableComment" class="table table-striped table-bordered bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">操作</th>
                                <th class="column-title">案件番号</th>
                                <th class="column-title">受注番号</th>
                                <th class="column-title">顧客名</th>
                                <th class="column-title">サプライヤー</th>
                                <th class="column-title">コメント最終更新日</th>
                                <th class="column-title">最終更新者</th>
                                <!-- <th class="column-title">カテゴリー</th> -->
                            </tr>
                            </thead>
                            <tbody id="body-list-products">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var searchTable;
    $(document).ready(function(){
        var tableId = "#tableComment";
        searchTable = initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller' => 'Comment', 'action' => 'searchComment']) ?>',
                "autoWidth": false,
                "order": [[5, "desc"]],
                // "oSearch": {"sSearch": "type=1"},
                "columns": [
                    {
                        "class": "td-action text-center",
                        "name": "action", 
                        "orderable": false,
                        "data": function(row, type, set, meta) {
                            var html = '<a class="btn-action" href="' + row.url_edit + '"><i class="fa fa-search fa-lg"></i></a> '
                            + '<a class="btn-action btn-comment" href="#"> <i class="fa fa-comments-o fa-lg"></i></a>';
                            return html;
                        }
                    },
                    {
                        "name": "OrderComment.anken_koudo", 
                        "orderable": true,
                        "data": "anken_koudo"
                    },
                    {
                        "name": "OrderComment.juchuu_bangou", 
                        "orderable": true,
                        "data": "juchuu_bangou",
                    },
                    {
                        "name": "MCustomer.tokui_saki_kana", 
                        "orderable": true,
                        "data": "customer_name"
                    },
                    {
                        "name": "MSupplier.mei_1", 
                        "orderable": true,
                        "data": "m_supplier_name"
                    },
                    {
                        "class": "text-center",
                        "name": "OrderComment.last_comment_date", 
                        "orderable": true,
                        "data": "last_comment_date",
                    },
                    {
                        "name": "LastUser.name", 
                        "orderable": true,
                        "data": "last_modified_name",
                    },
                ]
            }
        );
    });

    $(document).on("click", ".btn-comment", function(e) {
        e.preventDefault();
        var tr = $(this).parents("tr");
        var data = $("#tableComment").DataTable().row(tr).data();
        if(data && !this.is_show_comment) {
            showPopupComment(data.id, this);
        }
    });

    function showPopupComment(id, btn) {
        btn.is_show_comment = true;
        var params = {
            id: id,
        };

        var url = '<?= Router::url(['controller' => 'Comment', 'action' => 'popup']) ?>';
        var token = '<?= json_encode($this->request->getParam('_csrfToken')) ?>';

        ajaxDataForm(params, url, function(response) {
            $("body").append(response);
            btn.is_show_comment = false;
        }, token)
        .fail(function() {
            btn.is_show_comment = false;
        });
    }

    function saveCommentCallback(response) {
        searchTable.ajax.reload();
    }

</script>