<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser $mUser
 */
use App\Model\Table\MSystemTable;
use App\Model\Table\ProjectTable;
use App\Model\Table\MSupplierTable;
use App\Model\Table\OrderDetailTable;
use App\Model\Table\OrdersTable;
use App\Libs\Crypt;
use Cake\Routing\Router;
use App\Model\Table\MProductTable;

$screen = $this->request->getParam('action');

// 未確認案件一覧
$isConfirm = ( !isset($orderDetails[0]) ||
    (isset($orderDetails[0]) && $orderDetails[0]->status == OrderDetailTable::STATUS_WAIT_CONFIRM) ) ? true : false;

// 完了登録一覧
$isContentConfirm = false;
if(isset($orderDetails[0])
    && $orderDetails[0]->status == OrderDetailTable::STATUS_CONFIRM
    && !is_null($orderDetails[0]->nouki_kaishibi) && $orderDetails[0]->nouki_kaishibi) {
    $isContentConfirm = true;
    $isConfirm = false;
}
$intSupplierId = $aryLoginUser['m_supplier_id'];

$id = [];
$hatchuuKingakuZenuki = 0;
$tokukijikou = '';
$shyuseisumi = false;
foreach ($orderDetails as $v) {
    $id[] = $v->id;
    $hatchuuKingakuZenuki += (int)$v->hatchuu_kingaku;
    // get default
    if(!$tokukijikou) {
        $tokukijikou = $v->tokukijikou;
        if($tokukijikou && !$shyuseisumi) {
            $shyuseisumi = true;
        }
    }

    if($v->henkou_jiyuu && !$shyuseisumi) {
        $shyuseisumi = true;
    }
}
$hatchuuZeikomi = $hatchuuKingakuZenuki*0.08;
$hatchuuKingaku = $hatchuuKingakuZenuki + $hatchuuZeikomi;

?>
<div id="tokukijikou-hide" class="hide">
<?= $this->Form->textArea('NAME', ['value' => $tokukijikou, 'class' => 'form-control', 'rows' => 3]) ?>
</div>

<style type="text/css">
    .shori label {
        margin-top: .5rem;
    }
    #shori_jiyuu_3, #shori_jiyuu_4 {
        margin-top: -.5rem;
    }

    label {
        margin-bottom: 0;
    }

    #total-detail td {
        padding-bottom: 5px;
    }

    .top-border td {
        padding-top: 5px;
        border-top-style: solid;
        border-top-color: #4d564d;
        border-top-width: 1px;
    }

    .none-border {
        border: none !important;
    }

    #moushikomisha_douitsu_label {
        font-size: 0.7rem;
        padding: 0.4rem 0;
    }

    #moushikomisha_douitsu {
        margin: 0;
    }

    #total-detail {
        table-layout:fixed
    }

    #total-detail td, #total-detail th {
        padding: .2rem 0;
        line-height: 2rem;
    }

    #money-show, #money-hide {
        margin-top: 10px;
        width: 120px;
    }

    .form-control[readonly="readonly"] {
        background-color: transparent;
        cursor: not-allowed;
    }

    .fa-comments-o , #edit_detail {
        cursor: pointer;
    }

    .checkbox input[type="checkbox"] {
        display: inline-block;
    }

    .small {
        font-size: 60%;
    }

    #table-edit-detail {
        font-size: .8rem;
    }
</style>

<script type="application/javascript">
    $(document).ready(function () {
        // init
        initNumeral('.numeral');

        $('#btn_confirm_register_status').click(function () {
            var strMsg = validBeforeSubmit();
            if (strMsg) {
                popupAlert(strMsg);
                return false;
            }

            switch ("<?=$screen?>") {
                case 'kakuninShori' :
                    if ($('#shori_jiyuu').is(":hidden")) {
                        <?php if($isConfirm) :
                        $status = OrderDetailTable::STATUS_CONFIRM;?>
                        if ($('input[name="order_detail_status"]:checkbox:checked').length == 4) {
                            $("#order_detail_status").val('<?=$status?>');
                            filterData();
                            $("#frm_add_edit_project").submit();
                        } else {
                            popupAlert("確認してください。");
                        }
                        <?php else : ?>
                        filterData();
                        $("#frm_add_edit_project").submit();
                        <?php endif; ?>
                    } else {
                        $("#order_detail_status").val('<?=OrderDetailTable::STATUS_RETURN?>');
                        filterData();
                        $("#frm_add_edit_project").submit();
                    }
                    break;
                case 'ankenKanryouShori' :
                <?php if($isContentConfirm) {
                $status = OrderDetailTable::STATUS_FINISH;?>
                    if ($('input[name="order_detail_status"]:checkbox:checked').length == 4) {
                        $("#order_detail_status").val('<?=$status?>');
                        filterData();
                        $("#frm_add_edit_project").submit();
                    } else {
                        popupAlert("確認してください。");
                    }
                <?php } ?>
                    break;
                case 'kanryouKeijouShori' :
                    var order_m_system_joutaikubun_id = $('#order_m_system_joutaikubun_id').val();
                    if (order_m_system_joutaikubun_id == '') {
                        popupAlert("計上種別は必須項目です。");
                        return;
                    }

                    var countKengaku = 0;
                    var checked = '0';
                    var uncheck = '0';
                    if (order_m_system_joutaikubun_id == "<?=OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU?>") {
                        $('input[name="order_detail_keijou"]:checkbox').each(function () {
                            if($(this).is(':checked')) {
                                countKengaku += parseInt($(this).parent().next().next().next().next().next().next().next().next().next().children().val());
                                checked = checked + ',' + $(this).next().val();
                            } else {
                                uncheck = uncheck + ',' + $(this).next().val();
                            }
                        });
                    } else {
                        countKengaku = '<?= $project->uriage_yotei_goukei; ?>';
                    }

                    $("#order_uriage_zumi_goukei").val(countKengaku);
                    $("#project_uriage_zumi_goukei").val(countKengaku);
                    $("#order_detail_list_id_is_checked").val(checked);
                    $("#order_detail_list_id_is_uncheck").val(uncheck);

                    var stringCountKengaku = convertNumberToMoney(countKengaku);
                    var strTitle = '';
                    <?php if($order->m_system_joutaikubun_id !== OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU) { ?>
                        strTitle = '以下の内容で'+ $('#order_m_system_joutaikubun_id option:selected').text() +'しますか？';
                    <?php } else { ?>
                        strTitle = order_m_system_joutaikubun_id == '<?= OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU ?>'
                            ? '以下の内容で残分を'+ $('#order_m_system_joutaikubun_id option:selected').text() +'しますか？'
                            : '以下の内容で'+ $('#order_m_system_joutaikubun_id option:selected').text() +'しますか？';
                    <?php } ?>
                    var strContent = '<div class="text-center">処理種別：' + $('#order_m_system_joutaikubun_id option:selected').text() + '</div>';
                    strContent += '<div class="text-center">案件No：<?=$project->bangou?></div>';
                    strContent += '<div class="text-center">顧客氏名：<?=$project->e_moushisha_mei?></div>';
                    strContent += '<div class="text-center">分割計上金額：' + stringCountKengaku + '</div>';
                    strContent += '<div class="text-center">計上日：<?=date('Y年m月d日')?></div>';
                    popupConfirm(
                        strContent,
                        function () {
                            filterData();
                            $("#frm_add_edit_project").submit();
                        },
                        function () {
                        },
                        strTitle
                    );
                    break;
            }

        });

        $("[name='order_detail[shori_joukyou]']").click(function () {
            checkShoriJoukyou($(this).val());
        });
        checkShoriJoukyou("<?= isset($orderDetails[0]->shori_joukyou) ?
            $orderDetails[0]->shori_joukyou : null ?>");

        checkKakuninJoutai($('#kakunin_joutai').val());
        $('#kakunin_joutai').change(function () {
            checkKakuninJoutai($(this).val());
        });

        checkHanbaiKanrihi($('#hanbai_kanrihi_tsuika').val());
        $('#hanbai_kanrihi_tsuika').change(function () {
            checkHanbaiKanrihi($(this).val());
        });

        checkShusseiNebiki($('#shussei_nebiki_tsuika').val());
        $('#shussei_nebiki_tsuika').change(function () {
            checkShusseiNebiki($(this).val());
        });

        checkTaiouUmu($('#henkou_taiou_umu').val());
        $('#henkou_taiou_umu').change(function () {
            checkTaiouUmu($(this).val());
        });

        $('#edit_detail').click(function () {
            var txtArea = $('#tokukijikou-hide').html();
            txtArea = txtArea.replace('NAME', 'order_detail[tokukijikou]');

            var html =
                '<div id="table-edit-detail" class="table-responsive">'
                    +'<table class="table table-bordered table-sm">'
                        +'<thead class="thead-light">'
                            +'<tr class="headings">'
                                +'<th class="column-title" width="3%">#</th>'
                                +'<th class="column-title" width="8%">商品ｺｰﾄﾞ</th>'
                                +'<th class="column-title" width="15%">商品名</th>'
                                +'<th class="column-title" width="15%">内容</th>'
                                +'<th class="column-title" width="4%">単位</th>'
                                +'<th class="column-title" width="6%">数量</th>'
                                +'<th class="column-title" width="10%">単価</th>'
                                +'<th class="column-title" width="8%">金額</th>'
                                +'<th class="column-title" width="10%">変更金額</th>'
                                +'<th class="column-title">変更事由</th>'
                            +'</tr>'
                        +'</thead>'
                    +'<tbody id="body-list-products">'
                    <?php if (isset($orderDetails) && !empty($orderDetails)): ?>
                        <?php foreach ($orderDetails as $key => $orderDetail) : ?>
                            <?php $product = $orderDetail->_matchingData['MProduct']; ?>
                            <?php $supplier = $orderDetail->_matchingData['MSupplier']; ?>
                        // tr
                        +'<tr>'
                            +'<td class="text-right">'
                                + '<?= ($key+1) ?>'
                                +'<input class="form-control" type="hidden" name="order_detail[id][]" value="<?= $orderDetail->id; ?>">'
                            +'</td>'
                            +'<td><?= $product->koudo;?></td>'
                            +'<td><?= $product->mei;?></td>'
                            +'<td><?= $product->naiyou;?></td>'
                            +'<td><?= $orderDetail->tani ? MProductTable::TANI_VALUE[$orderDetail->tani] : '';?></td>'
                            +createTd('suuryou', '<?= $orderDetail->suuryou ?>', {type: 'int', 'maxLength' : 4})
                            +createTd('hatchuu_tanka', '<?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_tanka) ?>', {type: 'money'})
                            +'<td class="text-right"><?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_kingaku) ?></td>'
                            +createTd('hatchuu_kingaku', '<?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_kingaku) ?>', {type: 'money', 'onchange' : true})
                            +createTd('henkou_jiyuu', '<?= $orderDetail->henkou_jiyuu ?>', {type: 'text'})
                        +'</tr>'
                        <?php endforeach; ?>
                    <?php endif; ?>
                        +'<tr>'
                            +'<td colspan="9" class="text-right text-danger none-border">変更後合計金額</td>'
                            +'<td class="none-border">'
                                +'<input style="width:50%" id="henkou_goukei_kingaku" type="text" class="form-control text-right" value="<?= $this->VHtml->convertNumberToMoney($hatchuuKingakuZenuki)?>" readonly="readonly">'
                            +'</td>'
                        +'</tr>'
                        +'<tr>'
                            +'<td colspan="9" class="text-right text-danger none-border">特記事項</td>'
                            +'<td class="none-border">'
                                + txtArea
                            +'</td>'
                        +'</tr>'
                    +'</tbody>'
                    +'</table>'
                +'</div>';

            var title = '<div class="pull-left text-danger">変更金額・事由入力</div><div class="pull-right text-danger small">※変更金額と事由を必ず入力してください。</div><div class="clearfix"></div>';
            popupDataForm(title, html,
                function () {
                    var aryId = [];
                    var arySuuryou = [];
                    var aryhatchuuTanka = [];
                    var aryhatchuuKingaku = [];
                    var aryhenkouJiyuu = [];
                    $("[name='order_detail[id][]']").each(function () {
                        aryId.push($(this).val());
                    });
                    $("[name='order_detail[suuryou][]']").each(function () {
                        arySuuryou.push(parseInt(convertMoneyToNumber($(this).val())));
                    });
                    $("[name='order_detail[hatchuu_tanka][]']").each(function () {
                        aryhatchuuTanka.push(parseInt(convertMoneyToNumber($(this).val())));
                    });
                    $("[name='order_detail[hatchuu_kingaku][]']").each(function () {
                        aryhatchuuKingaku.push(parseInt(convertMoneyToNumber($(this).val())));
                    });
                    $("[name='order_detail[henkou_jiyuu][]']").each(function () {
                        aryhenkouJiyuu.push($(this).val());
                    });

                    showLoader(true);
                    postJSON('<?= Router::url(['controller' => 'Project', 'action' => 'kanryouHenkouShouhin']) ?>',
                        {
                            'ary_id' : aryId,
                            'ary_suuryou' : arySuuryou,
                            'ary_hatchuu_tanka' : aryhatchuuTanka,
                            'ary_hatchuu_kingaku' : aryhatchuuKingaku,
                            'ary_henkou_jiyuu' : aryhenkouJiyuu,
                            'tokukijikou' : $("[name='order_detail[tokukijikou]']").val()
                        }, function (res) {
                            if(res.success) {
                                location.reload();
                            } else {
                                showLoader(false);
                                pr(res);
                            }
                        }
                    );

                }
            );
        });
    });

    function createTd(key, value, objConfig) {
        var strClass = 'form-control',
            maxLength = 200,
            strAttr = '';

        if(objConfig.type === 'text') {
            strClass += ' text-left';
        }

        if(objConfig.type === 'int') {
            strAttr += 'oninput="validInt(this)"';
            strClass += ' text-right';
        }

        if(objConfig.type === 'money') {
            strAttr += 'oninput="validMoney(this)"';
            strClass += ' text-right';
        }

        if(typeof(objConfig.onchange) === 'boolean' ) {
            strAttr += ' onchange="autoTotal(this)"';
        }

        if(typeof(objConfig.maxLength) === 'number') {
            maxLength = objConfig.maxLength;
        } else {
            if(objConfig.type === 'int') maxLength = 12;
            if(objConfig.type === 'money') maxLength = 12;
        }

        strAttr += 'maxLength="'+maxLength+'"';

        return '<td><input type="text" class="'+strClass+'" name="order_detail['+key+'][]" value="'+value+'" '+strAttr+'></td>';
    }

    function checkTaiouUmu(value) {
        if(value == "<?= OrderDetailTable::HENKOU_ARI;?>") {
            $('#edit_detail').show();
        } else {
            $('#edit_detail').hide();
        }
    }

    function checkShoriJoukyou(value) {
        if(value && value == "<?= OrderDetailTable::MODOSHI_JOUKEN;?>") {
            $('#shori_jiyuu').show();
        } else {
            $('#shori_jiyuu').val('');
            $('#shori_jiyuu').hide();
        }
    }

    function filterData() {
        var hatchuu_tanka_goukei = $("#hatchuu_tanka_goukei").val();
        $("#hatchuu_tanka_goukei").val(convertMoneyToNumber(hatchuu_tanka_goukei));
        var hatchuu_kingaku_goukei = $("#hatchuu_kingaku_goukei").val();
        $("#hatchuu_kingaku_goukei").val(convertMoneyToNumber(hatchuu_kingaku_goukei));
        var shouhizei = $("#shouhizei").val();
        $("#shouhizei").val(convertMoneyToNumber(shouhizei));

        var juchuu_tanka_goukei = $("#juchuu_tanka_goukei").val();
        $("#juchuu_tanka_goukei").val(convertMoneyToNumber(juchuu_tanka_goukei));
        var juchuu_kingaku_goukei = $("#juchuu_kingaku_goukei").val();
        $("#juchuu_kingaku_goukei").val(convertMoneyToNumber(juchuu_kingaku_goukei));
        var juchuu_shouhizei = $("#juchuu_shouhizei").val();
        $("#juchuu_shouhizei").val(convertMoneyToNumber(juchuu_shouhizei));

        $("[name='order_detail[hatchuu_kingaku][]']").each(function () {
            $(this).val(convertMoneyToNumber($(this).val()));
        });
        $("[name='order_detail[hatchuu_tanka][]']").each(function () {
            $(this).val(convertMoneyToNumber($(this).val()));
        });
        $("[name='order_detail[juchuu_tanka][]']").each(function () {
            $(this).val(convertMoneyToNumber($(this).val()));
        });
        $("[name='order_detail[juchuu_kingaku][]']").each(function () {
            $(this).val(convertMoneyToNumber($(this).val()));
        });
    }

    function checkKakuninJoutai(val) {
        if(val == '<?= ProjectTable::NITTEI_CHOUSEI_CHUU ?>') {
            $('.nouki_txt').removeClass('text-danger');
        } else {
            $('.nouki_txt').addClass('text-danger');
        }
    }

    // valid and show msg
    function validBeforeSubmit() {
        var aryErrorField = [];
        //処理状況
        <?php if($screen == 'kakuninShori') { ?>
            if(!$("[name='order_detail[shori_joukyou]']").is(':checked')) {
                aryErrorField.push('確認種別');
            }
        //完了種別
        <?php } else if($screen == 'ankenKanryouShori') { ?>
            if(!$("[name='order_detail[shori_joukyou]']").is(':checked')) {
                aryErrorField.push('完了種別');
            }
        <?php } ?>
        var houmonJikanKaishi = $('#houmon_jikan_kaishi').val(),
        houmonJikanShuuryou = $('#houmon_jikan_shuuryou').val(),
        sagyouKikan = $('#sagyou_kikan').val(),
        systemHoumonJikanId = $('#m_system_houmon_jikan_id').val(),
        noukiKaishibi = $('#nouki_kaishibi').val(),
        noukiShuuryoubi = $('#nouki_shuuryoubi').val(),
        kakuninJoutai = $('#kakunin_joutai').val(),
        henkouTaiouUmu = $('#henkou_taiou_umu').val(),
        strMsg = '';

        if(!systemHoumonJikanId) {
            aryErrorField.push('訪問時間帯');
        }
        if(!houmonJikanKaishi) {
            aryErrorField.push('訪問開始時間');
        }
        if(!houmonJikanShuuryou) {
            aryErrorField.push('訪問終了時間');
        }
        if(!sagyouKikan) {
            aryErrorField.push('作業期間');
        }

        if($('#kakunin_joutai').length > 0 && !kakuninJoutai) {
            aryErrorField.push('確認状態');
        }

        if($('#henkou_taiou_umu').length > 0 && !henkouTaiouUmu) {
            aryErrorField.push('変更対応有無');
        }

        if($("[name='order_detail[okyakusama_kakunin][]']").length > 0 && $("[name='order_detail[okyakusama_kakunin][]']:checked").length <= 0) {
            aryErrorField.push('お客様確認項目');
        }

        if(kakuninJoutai != '<?= ProjectTable::NITTEI_CHOUSEI_CHUU ?>') {
            if(!noukiKaishibi) {
                aryErrorField.push('納期日／工事（開始日）');
            }
            if(!noukiShuuryoubi) {
                aryErrorField.push('納期日／工事（終了日）');
            }
        }

        if(aryErrorField.length > 0) {
            strMsg = aryErrorField.join('、') + 'は必須項目です。';
        }

        <?php if($isConfirm || $isContentConfirm) : ?>
            var errorCode = [];
            $('input[name="order_detail_status"]:checkbox:not(:checked)').each(function (i, e) {
                var me = $(e);
                errorCode.push(me.attr('txt'));
            });

            if(errorCode.length > 0) {
                if(strMsg) {
                    strMsg += '<br><br>';
                }
                strMsg += errorCode.join('、') + 'を確認して下さい。';
            }
        <?php endif; ?>

        return strMsg;
    }

    function checkHanbaiKanrihi(val) {
        if(val) {
            $('.hanbai_kanrihi_tsuika').show();
        } else {
            $('.hanbai_kanrihi_tsuika').hide();
            $('#hanbai_kanrihi').val('');
            $('#hanbai_kanrihi_shouhizei').val('');
            $('#hanbai_kanrihi_shoukei').val('');
        }

        checkTsuika();
    }

    function checkShusseiNebiki(val) {
        if(val) {
            $('.shussei_nebiki_tsuika').show();
        } else {
            $('.shussei_nebiki_tsuika').hide();
            $('#shussei_nebiki_zeinu_goukei').val('');
            $('#shussei_nebiki_shouhizei').val('');
            $('#shussei_nebiki_goukei').val('');
            $('#shussei_nebiki_goukei').val('');
        }

        checkTsuika();
    }

    function checkTsuika() {
        if(!$('#hanbai_kanrihi_tsuika').val() && !$('#shussei_nebiki_tsuika').is()){
            $('.tsuika').hide();
            $('#saishuu_goukei').val('');
            $('#souzeinu_rieki').val('');
            $('#sourieki_ritsu').val('');
        } else {
            $('.tsuika').show();
        }
    }

    function showPopupComment(project_id, order_id, m_supplier_id) {
        ajaxDataForm({project_id: project_id, order_id: order_id, m_supplier_id: m_supplier_id},
            '<?= Router::url(['controller' => 'Comment', 'action' => 'popup']) ?>',
            function (res) {
                $('body').append(res);
            });
    }

    function autoTotal(me) {
        /* START 発注 */
        var hatchuuKingaku = 0;
        $("[name='order_detail[hatchuu_kingaku][]']").each(function () {
            hatchuuKingaku += parseInt(convertMoneyToNumber($(this).val()));
        });

        $('#henkou_goukei_kingaku').val(convertNumberToMoney(hatchuuKingaku));
    }

    // popup comment response
    function saveCommentCallback(res) {
        if(res.success) {
            //m_supplier_id
            var m_supplier_id = res.result.m_supplier_id;
            var last_comment_date = res.result.last_comment_date;

            if(m_supplier_id && last_comment_date) {
                $('#last_comment_date').text(res.result.last_comment_date);
            }
        }
    }
</script>
<div class="page page_register product_master" id="product">
    <div class="navi">
        <h1 class="title"><?= $title; ?></h1>
        <div class="clearfix"></div>
    </div>
    <?= $this->element('_back', ['url' => $this->VHtml->getBackAction($screen)]); ?>
    <?= $this->Form->create($project, ['type' => 'file', 'enctype' => 'multipart/form-data'
        , 'id' =>'frm_add_edit_project']) ?>
    <div class="content">
        <div class="form-group row">
            <div class="col-sm-12">
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('success') ?>
                <?= $this->Flash->render('error') ?>
            </div>
        </div>
        <?php if($screen === 'kanryouKeijouShori') { ?>
            <div class="form-group row">
                <div class="col-sm-1 seiyaku-kakudo">
                    <?= $this->Form->select('order[seiyaku_kakudo]',OrdersTable::SEIYAKU_KAKUDO_VALUE,
                        [
                            'id' => 'seiyaku_kakudo',
                            'default' => isset($order->seiyaku_kakudo) ? $order->seiyaku_kakudo : false,
                        ]); ?>
                </div>
                <?php if(isset($project->id)) : ?>
                    <div id="system_joutaikubun">
                        <?= isset($order->m_system_joutaikubun_id) && isset($mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][$order->m_system_joutaikubun_id])
                            ? $this->VHtml->frameStatus($mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][$order->m_system_joutaikubun_id]) : '' ?>
                    </div>
                <?php else: ?>
                    <div class="col-sm-3"></div>
                <?php endif; ?>
            </div>
        <?php } ?>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">案件No</label>
            <label class="col-sm-2 col-form-label">　<b><?= $project->bangou ?></b></label>

            <?php if($screen === 'kanryouKeijouShori') { ?>
                <label class="col-sm-1 col-form-label text-right">計上種別 <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <?= $this->Form->select('order[m_system_joutaikubun_id]',
                        $this->VHtml->selectNull([
                            OrderDetailTable::JOUTAI_KUBUN_IKKATSU_KEIJOU
                            => $mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][OrderDetailTable::JOUTAI_KUBUN_IKKATSU_KEIJOU],
                            OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU
                            => $mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU],
                            OrderDetailTable::JOUTAI_KUBUN_KANRYOU_KAKUNIN_NOMI
                            => $mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][OrderDetailTable::JOUTAI_KUBUN_KANRYOU_KAKUNIN_NOMI]
                        ]),
                        [
                            'class' => 'form-control',
                            'id' => 'order_m_system_joutaikubun_id',
                            'default' => isset($order->m_system_joutaikubun_id) ? $order->m_system_joutaikubun_id : false,
                        ]); ?>
                </div>
                <div class="col-sm-1"></div>
            <?php } else { ?>
                <label class="col-sm-4 col-form-label text-danger">※連絡事項記載有り  ※添付資料有り</label>
            <?php } ?>
            <label class="col-sm-1 col-form-label text-right">オーダーNo</label>
            <label class="col-sm-1 col-form-label">　<b><?= $order->bangou ?></b></label>
            <label class="col-sm-1 col-form-label text-right">発注日</label>
            <div class="col-sm-1 col-form-label">
                <?php $defaultOrderCreated = isset($order->created) ? $this->VHtml->dateToYYYYMMDD($order->created) : ''; ?>
                <b>　<?= $defaultOrderCreated ?></b>
                <?= $this->Form->hidden('project[type]', ['value' => isset($project->type) ? $project->type : $type]); ?>
                <?= $this->Form->hidden('order[id]', ['value' => isset($order->id) ? $order->id : null]); ?>
            </div>
        </div>
        <div class="form-group row">
            <?php if($screen == 'kakuninShori') { ?>
                <label class="col-sm-1 col-form-label text-right">確認種別 <span class="text-danger">*</span></label>
                <div class="col-sm-6 col-form-label">
                    <?= $this->Form->radio('order_detail[shori_joukyou]', OrderDetailTable::KAKUNIN_SHUBETSU, [
                        'value' => isset($orderDetails[0]->shori_joukyou) ? $orderDetails[0]->shori_joukyou : false
                    ]); ?>
                    <label class="col-sm-3">
                        <?= $this->Form->text('order_detail[shori_jiyuu]', [
                            'value' => isset($orderDetails[0]->shori_jiyuu) ? $orderDetails[0]->shori_jiyuu : '',
                            'id' => 'shori_jiyuu',
                            'class' => 'form-control hide'
                        ]); ?>
                    </label>
                </div>
            <?php } elseif($screen == 'ankenKanryouShori') { ?>
                <label class="col-sm-1 col-form-label text-right">完了種別 <span class="text-danger">*</span></label>
                <div class="col-sm-6 col-form-label">
                    <?= $this->Form->radio('order_detail[shori_joukyou]', OrderDetailTable::KANRYOU_SHUBETSU, [
                        'value' => isset($orderDetails[0]->shori_joukyou) ? $orderDetails[0]->shori_joukyou : OrderDetailTable::SAGYOU_KANRYOU
                    ]); ?>
                </div>
            <?php } ?>
            <label for="m_system_tantou_id" class="col-sm-1 col-form-label text-right">暮らし担当</label>
            <div class="col-sm-1">
                <?= $this->Form->select('order[m_system_tantou_id]',
                    isset($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) ?
                        $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) : ["" => "-"],
                    [
                        'class' => 'form-control',
                        'id' => 'm_system_tantou_id',
                        'default' => isset($order->m_system_tantou_id) ? $order->m_system_tantou_id : false,
                    ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">お客様氏名</label>
            <div class="col-sm-2 input-group">
                <?= $this->Form->hidden('project[m_customer_id]', [
                    'value' => isset($project->m_customer_id) ? $project->m_customer_id : '',
                    'id' => 'customer_id'
                ]); ?>
                <?= $this->Form->text('moushisha_moushimei_kanji', [
                    'value' => isset($objCustomer->moushisha_moushimei_kanji) ? $objCustomer->moushisha_moushimei_kanji : '',
                    'id' => 'moushisha_moushimei_kanji',
                    'name' => '',
                    'class' => 'form-control',
                    'readonly' => true]); ?>
                <div class="input-group-append">
                    <div class="input-group-text form-control-sm">様</div>
                </div>
            </div>

            <label class="col-sm-4 col-form-label text-left"></label>

            <label class="col-sm-1 col-form-label text-right text-danger">訪問時間</label>
            <div class="col-sm-4">
                <label style="width: 20%">
                    <?= $this->Form->select('order_detail[m_system_houmon_jikan_id]',
                        isset($mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN]) ? $mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN] : [],
                        [
                            'id' => 'm_system_houmon_jikan_id',
                            'class' => 'form-control',
                            'default' => isset($orderDetails[0]->m_system_houmon_jikan_id) ? $orderDetails[0]->m_system_houmon_jikan_id : ''
                        ]); ?>
                </label>
                <label class="text-right text-danger" style="width: 10%">開始&nbsp;</label>
                <label style="width: 18%">
                    <?= $this->Form->text('order_detail[houmon_jikan_kaishi]', [
                        'value' => isset($orderDetails[0]) ? $orderDetails[0]->houmon_jikan_kaishi : '',
                        'class' => 'form-control timepicker',
                        'id' => 'houmon_jikan_kaishi']); ?>
                </label>
                <label class="text-right text-danger" style="width: 10%">終了&nbsp;</label>
                <label style="width: 18%">
                    <?= $this->Form->text('order_detail[houmon_jikan_shuuryou]', [
                        'value' => isset($orderDetails[0]) ? $orderDetails[0]->houmon_jikan_shuuryou: '',
                        'class' => 'form-control timepicker',
                        'id' => 'houmon_jikan_shuuryou']); ?>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">フリガナ</label>
            <div class="col-sm-2 input-group">
                <?= $this->Form->text('moushisha_moushimei_kana', [
                    'value' => isset($objCustomer->moushisha_moushimei_kana) ? $objCustomer->moushisha_moushimei_kana : null,
                    'name' => '',
                    'class' => 'form-control',
                    'readonly' => true]); ?>
                <div class="input-group-append">
                    <div class="input-group-text form-control-sm">様</div>
                </div>
            </div>
            <label class="col-sm-4 col-form-label text-left"></label>
            <label class="col-sm-1 col-form-label text-right text-danger">作業期間</label>
            <div class="col-sm-1 input-group">
                <?= $this->Form->text('order_detail[sagyou_kikan]', [
                    'value' => isset($orderDetails[0]) ? $orderDetails[0]->sagyou_kikan: null,
                    'id' => 'sagyou_kikan',
                    'class' => 'form-control text-right numeral',
                    'maxLength' => 3]); ?>
                <div class="input-group-append">
                    <div class="input-group-text form-control-sm">日</div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">郵便番号</label>
            <div class="col-sm-2">
                <?= $this->Form->text('e_moushisha_juusho_shikuchousonikou', [
                    'value' => isset($objCustomer->e_moushisha_juusho_shikuchousonikou) ? $objCustomer->e_moushisha_juusho_shikuchousonikou : '',
                    'class' => 'form-control', 'name' => '',
                    'readonly' => true]); ?>
            </div>
            <label class="col-sm-1 col-form-label text-right">都道府県</label>
            <div class="col-sm-2">
                <?= $this->Form->select('e_moushisha_juusho_todoufuken', MSupplierTable::PREFECTURE_DATA, [
                    'class' => 'form-control', 'name' => '', 'disabled' => 'disabled',
                    'default' => isset($objCustomer->e_moushisha_juusho_todoufuken) ? $objCustomer->e_moushisha_juusho_todoufuken : null,
                    'readonly' => true
                ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right text-danger nouki_txt">納期日／工事日</label>
            <div class="col-sm-4 col-form-label">
                <label class="text-right" style="width: 45%">委託先管理&nbsp;</label>
                <label style="width: 35%">
                    <b><?= isset($orderDetails[0]) ? $orderDetails[0]->m_supplier_name: null; ?></b>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">市区町村</label>
            <div class="col-sm-3">
                <?= $this->Form->text('project[e_moushisha_juushoshichou]', [
                    'value' => isset($project->e_moushisha_juushoshichou) ? $project->e_moushisha_juushoshichou : null,
                    'id' => 'e_moushisha_juushoshichou',
                    'class' => "form-control",
                    'readonly' => true]); ?>
            </div>
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-1 col-form-label text-right text-danger nouki_txt">開始</label>
            <div class="col-sm-4">
                <label style="width: 35%">
                <?= $this->Form->text('order_detail[nouki_kaishibi]', [
                    'value' => isset($orderDetails[0]) ? $this->VHtml->dateToYYYYMMDD($orderDetails[0]->nouki_kaishibi) : null,
                    'class' => "form-control datepicker",
                    'id' => 'nouki_kaishibi']); ?>
                </label>
                <label class="text-right text-danger nouki_txt" style="width: 10%">終了&nbsp;</label>
                <label style="width: 35%">
                    <?= $this->Form->text('order_detail[nouki_shuuryoubi]', [
                        'value' => isset($orderDetails[0]) ? $this->VHtml->dateToYYYYMMDD($orderDetails[0]->nouki_shuuryoubi) : null,
                        'class' => "form-control datepicker",
                        'id' => 'nouki_shuuryoubi']); ?>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">ビル名等</label>
            <div class="col-sm-3">
                <?= $this->Form->text('e_moushisha_juusho_manshon_mei', [
                    'value' => isset($objCustomer->e_moushisha_juusho_manshon_mei) ? $objCustomer->e_moushisha_juusho_manshon_mei : '',
                    'class' => "form-control", 'name' => '',
                    'readonly' => true]); ?>
            </div>
            <?php if($screen === 'ankenKanryouShori') : ?>
                <label class="col-sm-4 col-form-label text-right text-danger">連絡ｺﾒﾝﾄ</label>
                <label class="col-sm-3 text-danger">
                    <i class="fa fa-2x fa-comments-o" onclick="showPopupComment('<?= Crypt::encrypAES($project->id) ?>', '<?= Crypt::encrypAES($order->id) ?>', '<?= Crypt::encrypAES($intSupplierId) ?>')"></i>
                    　詳細参照　[<span id="last_comment_date"><?= isset($aryOrderComment[$intSupplierId]) ? $this->VHtml->dateToYMDhi($aryOrderComment[$intSupplierId]) : '...' ?></span>]
                </label>
            <?php elseif($screen === 'kakuninShori') : ?>
                <label class="col-sm-4 col-form-label text-right text-danger">確認状態</label>
                <div class="col-sm-2">
                    <?= $this->Form->select('order_detail[kakunin_joutai]', ProjectTable::KAKUNIN_JOUTAI, [
                        'id' => 'kakunin_joutai',
                        'class' => 'form-control',
                        'default' => isset($orderDetails[0]) ? $orderDetails[0]->kakunin_joutai : null,
                    ]); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group row">
            <label for="m_system_shiharaihouhou_id" class="col-sm-1 col-form-label text-right">TEL番号</label>
            <div class="col-sm-3">
                <?= $this->Form->text('denwa', [
                    'value' => isset($objCustomer->denwa) ? $objCustomer->denwa : '',
                    'class' => 'form-control', 'name' => '',
                    'readonly' => true]); ?>
            </div>
            <label for="m_system_shiharaihouhou_id" class="col-sm-1 col-form-label text-right">携帯TEL番号</label>
            <div class="col-sm-2">
                <?= $this->Form->text('keitai_bangou', [
                    'value' => isset($objCustomer->keitai_bangou) ? $objCustomer->keitai_bangou : '',
                    'class' => 'form-control', 'name' => '',
                    'readonly' => true]); ?>
            </div>

            <?php if($screen === 'ankenKanryouShori') : ?>
                <label class="col-sm-1 col-form-label text-right text-danger">お客様確認項目</label>
                <div class="col-sm-4">
                    <?php $okyakusamaKakunin = isset($orderDetails[0]) ? $orderDetails[0]->okyakusama_kakunin : []; ?>
                    <?= $this->Form->multiCheckbox('order_detail[okyakusama_kakunin]', OrderDetailTable::OKYAKUSAMA_KAKUNIN_VALUE, [
                        'id' => 'okyakusama_kakunin',
                        'value' => $okyakusamaKakunin
                    ]); ?>
                </div>
            <?php elseif($screen === 'kakuninShori') : ?>
                <label class="col-sm-1 col-form-label text-right text-danger">連絡ｺﾒﾝﾄ</label>
                <label class="col-sm-3 text-danger">
                    <i class="fa fa-2x fa-comments-o" onclick="showPopupComment('<?= Crypt::encrypAES($project->id) ?>', '<?= Crypt::encrypAES($order->id) ?>', '<?= Crypt::encrypAES($intSupplierId) ?>')"></i>
                    　詳細参照　[<span id="last_comment_date"><?= isset($aryOrderComment[$intSupplierId]) ? $this->VHtml->dateToYMDhi($aryOrderComment[$intSupplierId]) : '...' ?></span>]
                </label>
            <?php endif; ?>
        </div>
        <div class="form-group row">
            <label for="kanjou_kamoku" class="col-sm-1 col-form-label text-right">作業地</label>
            <div class="col-sm-3">
                <?= $this->Form->text('project[nouhin_juusho]', [
                    'value' => isset($project->nouhin_juusho) ? $project->nouhin_juusho : null,
                    'class' => "form-control",
                    'readonly' => true]); ?>
            </div>
            <label class="col-sm-1 col-form-label text-right">邸名</label>
            <div class="col-sm-2">
                <?= $this->Form->text('project[nouhin_mei]', [
                    'value' => isset($project->nouhin_mei) ? $project->nouhin_mei : null,
                    'class' => "form-control",
                    'readonly' => true]); ?>
            </div>
            <?php if($screen === 'ankenKanryouShori') : ?>
                <label class="col-sm-1 col-form-label text-right text-danger">変更対応有無</label>
                <div class="col-sm-2">
                    <?= $this->Form->select('order_detail[henkou_taiou_umu]', $this->VHtml->selectNull(OrderDetailTable::HENKOU_TAIOU_VALUE), [
                        'class' => 'form-control',
                        'id' => 'henkou_taiou_umu',
                        'default' => isset($orderDetails[0]) ? $orderDetails[0]->henkou_taiou_umu : ''
                    ]); ?>
                </div>
                <div class="col-sm-1">
                    <i id="edit_detail" class="fa fa-2x fa-pencil text-danger hide"></i>　<?= $shyuseisumi ? '<span class="text-danger">修正済</span>' : '' ?>
                </div>
            <?php elseif($screen === 'kakuninShori') : ?>
                <label class="col-sm-1 col-form-label text-right">お支払方法</label>
                <div class="col-sm-2">
                    <?= $this->Form->select('project[m_system_shiharaihouhou_id]',
                        isset($mstSystem[MSystemTable::SYSTEM_SHIHARAI_HOUHOU]) ?
                            $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_SHIHARAI_HOUHOU]) : [],
                        [
                            'class' => 'form-control',
                            'id' => 'm_system_shiharaihouhou_id',
                            'default' => isset($project->m_system_shiharaihouhou_id) ? $project->m_system_shiharaihouhou_id : false,
                        ]); ?>
                </div>
            <?php endif; ?>
        </div>
        <?= $this->element(
            $screen === 'kanryouKeijouShori' ? '../Project/_list_product_keijou' : '../Project/_list_product_shori',
                ['button' => false]
        ) ?>
        <div class="form-group row">
            <div class="text-right" style="width: 4%">備考&nbsp;</div>
            <div style="width: 46%">
                <?= $this->Form->textArea('project[bikou]', [
                    'value' => isset($project->bikou) ? $project->bikou : '',
                    'class' => "form-control",
                    'rows' => 10]) ?>
            </div>
            <div style="width: 5%"></div>

            <?php if($screen === 'kakuninShori') : ?>
                <div style="width: 45%">
                    <table id="total-detail" class="table table-borderless">
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td width="14%" align="right">税率&nbsp;</td>
                            <td width="19%" class="input-group">
                                <?php $defaultZeiritsu = isset($order->zeiritsu) ? $order->zeiritsu : 0; ?>
                                <input id="zeiritsu" class="form-control text-right" readonly="readonly" value="<?= $defaultZeiritsu ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text form-control-sm">%</div>
                                </div>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td width="14%" align="right">発注金額&nbsp;</td>
                            <td width="20%">
                                <input id="hatchuu_kingaku_goukei" class="form-control text-right" readonly="readonly" value="<?= $this->VHtml->convertNumberToMoney($hatchuuKingakuZenuki) ?>">
                            </td>
                            <td width="14%" align="right">消費税&nbsp;</td>
                            <td width="19%">
                                <input id="shouhizei" class="form-control text-right" readonly="readonly" value="<?= $this->VHtml->convertNumberToMoney($hatchuuZeikomi) ?>">
                            </td>
                            <td width="15%" align="right">発注合計&nbsp;</td>
                            <td width="21%">
                                <input id="hatchuu_tanka_goukei" class="form-control text-right" readonly="readonly" value="<?= $this->VHtml->convertNumberToMoney($hatchuuKingaku) ?>">
                            </td>
                        </tr>
                    </table>
                </div>
            <?php elseif($screen === 'ankenKanryouShori') : ?>
                <div style="width: 44%">
                    <?= $this->Form->textArea('order_detail[okyakusama_no_youbou]', [
                        'value' => isset($orderDetails[0]) ? $orderDetails[0]->okyakusama_no_youbou : '',
                        'class' => 'form-control',
                        'placeholder' => 'お客様からのご要望',
                        'rows' => 10]) ?>
                </div>
            <?php endif; ?>
                <div class="form-group row">
                    <div class="col-sm-12"></div>
                </div>
                <div class="form-group row">&nbsp;</div>

                <div class="form-group row">
                    <div class="col-sm-12 text-danger">
                        <?= $this->Form->hidden('order_detail[status]', [
                            'value' => isset($orderDetails[0]) ? $orderDetails[0]->status : 0, 'id' => 'order_detail_status'
                        ]); ?>

                        <?= $this->Form->hidden('order_detail[id]', ['value' => implode(',', $id)]) ?>
                    </div>
                </div>
        </div>

        <div class="form-group row">
            <div class="text-right" style="width: 50%">
                <?php if($isConfirm || $isContentConfirm): ?>
                    <?= $this->Form->checkbox('order_detail_status', [
                        'checked' => false,
                        'id' => 'order_detail_status_0',
                        'txt' => '備考'
                    ]); ?>
                    <label class="text-danger" for="order_detail_status_0"><?= $isConfirm ? '確認しました' : '内容確認済み' ?></label>
                <?php endif; ?>
            </div>
            <div class="text-right" style="width: 48%">
                <?php if($isConfirm || $isContentConfirm): ?>
                    <?= $this->Form->checkbox('order_detail_status', [
                        'checked' => false,
                        'id' => 'order_detail_status_1',
                        'txt' => $isConfirm ? '発注合計' : 'お客様からのご要望'
                    ]); ?>
                    <label class="text-danger" for="order_detail_status_1"><?= $isConfirm ? '確認しました' : '内容確認済み' ?></label>
                <?php endif; ?>
            </div>
        </div>

        <?= $this->element('../Project/_attached_file', ['screen' => $screen]); ?>
        <div class="form-group row">
            <div class="col-sm-4 text-danger">
                <?php if($isConfirm): ?>
                    <?= $this->Form->checkbox('order_detail_status', [
                        'checked' => $isConfirm ? (isset($orderDetails[0]) && $orderDetails[0]->status == OrderDetailTable::STATUS_CONFIRM)
                            : ($orderDetails[0]->status == OrderDetailTable::STATUS_FINISH),
                        'id' => 'order_detail_status_2',
                        'txt' => '証拠書添付'
                    ]); ?>
                    <label for="order_detail_status_2">確認しました</label>
                <?php endif; ?>
            </div>
            <div class="col-sm-4 text-danger text-center">
                <?php if($isConfirm): ?>
                    <?= $this->Form->checkbox('order_detail_status', [
                        'checked' => $isConfirm ? (isset($orderDetails[0]) && $orderDetails[0]->status == OrderDetailTable::STATUS_CONFIRM)
                            : ($orderDetails[0]->status == OrderDetailTable::STATUS_FINISH),
                        'id' => 'order_detail_status_3',
                        'txt' => '印刷'
                    ]); ?>
                    <label for="order_detail_status_3">印刷しました</label>
                <?php endif; ?>
                <?php if($isContentConfirm): ?>
                    <?= $this->Form->checkbox('order_detail_status', [
                        'checked' => $isConfirm ? (isset($orderDetails[0]) && $orderDetails[0]->status == OrderDetailTable::STATUS_CONFIRM)
                            : ($orderDetails[0]->status == OrderDetailTable::STATUS_FINISH),
                        'id' => 'order_detail_status_2',
                        'txt' => '証拠書添付'
                    ]); ?>
                    <label for="order_detail_status_2">内容確認済み</label>
                <?php endif; ?>
            </div>
            <div class="col-sm-4 text-danger text-center">
                <?php if($isContentConfirm): ?>
                    <?= $this->Form->checkbox('order_detail_status', [
                        'checked' => $isConfirm ? (isset($orderDetails[0]) && $orderDetails[0]->status == OrderDetailTable::STATUS_CONFIRM)
                            : ($orderDetails[0]->status == OrderDetailTable::STATUS_FINISH),
                        'id' => 'order_detail_status_3',
                        'txt' => '添付ファイル'
                    ]); ?>
                    <label for="order_detail_status_3">内容確認済み</label>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4">&nbsp;</label>
            <div class="col-sm-8">
                <?= $this->Form->hidden('order_detail[m_system_joutaikubun_id]', [
                    'value' => isset($orderDetails[0]->m_system_joutaikubun_id) ? $orderDetails[0]->m_system_joutaikubun_id : null
                ]); ?>
                <?= $this->Form->button(__('キャンセル'), [
                    'class' => 'btn btn-secondary', 'type'=>'button',
                    'onclick' => "location.href='" . $this->VHtml->getBackAction($screen) . "'"]) ?>
                <?php if($screen === 'kakuninShori'): ?>
                    <?= $this->Form->button(__('お発注書Ａ～Ｃを出力'), ['class' => 'btn btn-success', 'type'=>'button','id' => 'btn_print_hatchuusho']) ?>
                <?php endif; ?>
                <?= $this->Form->button(__($titleButton), ['class' => 'btn btn-primary', 'type'=>'button','id' => 'btn_confirm_register_status']) ?>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

