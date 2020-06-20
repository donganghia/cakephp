<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\mCustomer $mCustomer
 */

use App\Model\Table\mCustomerTable;
use Cake\Routing\Router;
?>

<div class="col-md-12">
    <div class="form-group">
        <label style="float: left;" for="" class="col-sm-1 col-form-label">種別</label>
        <div style="float: left;" class="col-sm-11">
            <?php foreach (MCustomerTable::SHUBETSU as $shubestuKey => $shubestuItem): ?>
                <div class="form-check form-check-inline col-form-label text-right">
                    <?php $checkedShubestu = '' ?>
                    <?php if(MCustomerTable::SHUBETSU_SONOTA === $shubestuKey): ?>
                        <?php $checkedShubestu = 'checked' ?>
                    <?php endif; ?>
                    <input id="shubestu_<?= $shubestuKey ?>" type="radio" class="form-check-input" name="shubestu" value="<?= $shubestuKey ?>" <?= $checkedShubestu ?>>
                    <label class="form-check-label" for="shubestu_<?= $shubestuKey ?>"><?= $shubestuItem ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div><label>履歴一覧<label></div>
    <div>
        <table id="tableHistory" class="table table-striped table-bordered display nowrap">
            <thead>
                <tr>
                    <th class="actions" style="width: 1px;"><a href="#" id="create-customer-history" class="btn btn-success btn-sm">追加</a></th>
                    <th><?= __('履歴連番') ?></th>
                    <th><?= __('SMILENo.(案件管理No)') ?></th>
                    <th style="width: 1px; min-width: 90px;"><?= __('日付') ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div id="history1" class="history-block hide">
            <?= $this->element("../MCustomer/_form_customer_history_1") ?>
        </div>

        <div id="history2" class="history-block hide">
            <?= $this->element("../MCustomer/_form_customer_history_2") ?>
        </div>
    </div>
</div>

<script>
    $(".form-check-input[name=shubestu]").on("change", function() {
       $("input[name=m_customer_history\\[shubetsu\\]]").val(this.value);
        // reload table
        hideHistory();
        tableHistory.ajax.reload();
    });

    $('#create-customer-history').click(function (e) {
        e.preventDefault();
        showHistory();
    });

    function showHistory2(data) {
        var other = $("#history1");
        other.hide();
        other.find("input, select, textarea").attr("disabled", "disabled");

        var ele = $("#history2");

        var names = {
            id: "",
            rireki_renban: "",
            smile_no: "",
            hanbai_juchuu_bangou: "",
            sabisu_jisshibi: "",
            kureemu: "",
            kureemu_naiyou_taiou: "",
            ankeeto_haifu: "",
            ankeeto_kaitoo: "",
            manzokudo: "",
            manzokudo_riyuu: "",
            kakaku_manzokudo: "",
            kakaku_manzokudo_riyuu: "",
            sutaffu_nitsuite: "",
            sonota_iken: "",
            taiou_joukyou: "",
            yobi: "",
            history_id: "",
            synergy_id: "",
            uketsukebi: "",
            uketsuke_bangou: "",
            kanri_bangou: "",
            shimei: "",
            taitoru: "",
            irai_naiyou: "",
            taiou_naiyou: "",
            hanbai_kingaku: "",
            hatchuu_kingaku: "",
            rireki_tesuuryou: "",
            taiou_gyousha: "",
            tantoushamei: "",
            bikou: "",
        };

        if(data) {
            for(var k in names) {
                names[k] = data[k];
            }
        }

        for(var k in names) {
           var input = ele.find("input[name=m_customer_history\\[" + k + "\\]], textarea[name=m_customer_history\\[" + k + "\\]], select[name=m_customer_history\\[" + k + "\\]]");
           if(input.length) {
               if(input.attr("type") == "checkbox") {
                    input.prop("checked", names[k] == 1);
               }
               else {
                    input.val(names[k]);
               }
           }
        }

        ele.show(500, function(){
            ele.find("input, select, textarea").removeAttr("disabled");
            ele.find("input[name=m_customer_history\\[rireki_renban\\]]").focus();
        });
    }

    function showHistory1(data) {
        var other = $("#history2");
        other.hide();
        other.find("input, select, textarea").attr("disabled", "disabled");

        var ele = $("#history1");

        var names = {
            id: "",
            rireki_renban: "",
            smile_no: "",
            history_id: "",
            synergy_id: "",
            hidzuke: "",
            uketsuke_bangou: "",
            kanri_bangou: "",
            shimei: "",
            taitoru: "",
            irai_naiyou: "",
            taiou_naiyou: "",
            kureemu: "",
            taiou_gyousha: "",
            tantoushamei: "",
            bikou: "",
        };

        if(data) {
            for(var k in names) {
                names[k] = data[k];
            }
        }        
        
        for(var k in names) {
           var input = ele.find("input[name=m_customer_history\\[" + k + "\\]], textarea[name=m_customer_history\\[" + k + "\\]], select[name=m_customer_history\\[" + k + "\\]]");
           if(input.length) {
               if(input.attr("type") == "checkbox") {
                    input.prop("checked", names[k] == 1);
               }
               else {
                    input.val(names[k]);
               }
           }
        }

        ele.show(500, function(){
            ele.find("input, select, textarea").removeAttr("disabled");
            ele.find("input[name=m_customer_history\\[rireki_renban\\]]").focus();
        });        
    }

    function showHistory(data) {
        $("#history2, #history1").hide();
        var type = (data && data.shubetsu) ||  $(".form-check-input[name=shubestu]:checked").val();
        if(type == 3) {
            showHistory2(data);
        }
        else {
            showHistory1(data);
        }
    }

    $(document).on("click", ".btn-edit-history", function(e) {
        e.preventDefault();
        var tr = $(this).parents(tr);
        var data = tableHistory.row(tr).data();

        showHistory(data);
    });

    // disabled all
    function hideHistory() {
        $("#history2, #history1").hide().find("input, select, textarea").attr("disabled", "disabled");
    }

    var tableHistory = initDatatable("#tableHistory",
        {
            'ajax': {
                url: '<?= Router::url(['controller' => 'MCustomer', 'action' => 'searchHistory', $mCustomer->id]) ?>',
                data: function(a, b,c) {
                    a.history_type = $(".form-check-input[name=shubestu]:checked").val();
                    return a;
                }
            },
            "deferLoading": 0,
            "autoWidth": false,
            // "order": [[0, "desc"]],
            "columns": [
                {
                    "class": "td-action text-center",
                    "name": "action", 
                    "orderable": false,
                    "data": function(row, type, set, meta) {
                        var html = '<a class="btn-action btn-edit-history" href="#"> <i class="fa fa-edit fa-lg"></i></a>';
                        return html;
                    }
                },
                {
                    "name": "MCustomerHistory.rireki_renban", 
                    "orderable": true,
                    "data": "rireki_renban"
                },
                {
                    "name": "MCustomerHistory.smile_no", 
                    "orderable": true,
                    "data": "smile_no",
                },
                {
                    "name": "MCustomerHistory.hidzuke", 
                    "orderable": true,
                    "data": "hidzuke"
                },
            ]
        }
    );

    $(".form-check-input[name=shubestu]:checked").trigger("change");
    

</script>