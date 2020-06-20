<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser $mUser
 */
use Cake\Routing\Router;
use App\Model\Table\MSystemTable;
use App\Model\Table\ProjectTable;
use App\Model\Table\OrdersTable;
use App\Model\Table\OrderDetailTable;
use App\Libs\Crypt;

echo $this->Html->css('project/hatchuusho.css');

$msg = $this->Flash->render('msg');
$screen = $this->request->getParam('action');
?>

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
</style>

<script type="application/javascript">
    var arySupplierSuuryouData = [];
    $(document).ready(function () {
        var msg = '<?= $msg ?>';
        if(msg) {
            popupAlert(msg, function() {}, '完了');
        }

        $('#btn_temp_status').click(function () {
            <?php if($type == ProjectTable::KAKUTEI_TYPE): ?>
                var aryProductId = [];
                var aryProductUnit = [];
                $("[name='order_detail[product_id][]']").each(function () {
                    aryProductId.push($(this).val())
                });
                $("[name='order_detail[suuryou][]").each(function () {
                    aryProductUnit.push($(this).val())
                });

                if(aryProductId.length <= 0) {
                    popupAlert('商品リストは必須項目です。');
                    return false;
                } else {
                    postJSON('<?= Router::url(['controller' => 'Project', 'action' => 'getProject']) ?>',
                        {ary_product: aryProductId, ary_product_quantity: aryProductUnit},
                        function(res) {
                            popupAlert(res.message);
                            return false;
                        });
                }

                $('#is_sendmail').val(0);
            <?php endif; ?>
            $("#status").val(<?= OrdersTable::STATUS_TEMP ?>);
            filterData();
            $("#frm_add_edit_project").submit();
        });

        $('#btn_register_status').click(function () {
            var resMess = validBeforeSubmit();
            if(resMess) {
                popupAlert(resMess);
                return false;
            }

            $("#status").val(<?= OrdersTable::STATUS_REGISTER ?>);
            var strTitle = '';
            var strContent = '';
            <?php if($type == ProjectTable::KAKUTEI_TYPE): ?>
                <?php if(isset($order->id)) : ?>
                    strTitle = '更新データを登録し委託先に送信しますか？';
                <?php else: ?>
                    strTitle = '受注データを登録し委託先に送信しますか？';
                <?php endif; ?>
                var arySupplierName = [];
                $.each($('.shiiresaki-mei'), function( index, e ) {
                    var strName = $.trim($(e).text());
                    if('委託先：SUPPLIER_NAME' != strName) {
                        strName = strName.replace('委託先：', '');
                        arySupplierName.push(strName);
                    }
                });
                strContent = '委託先：' + arySupplierName.join('、');
                strContent += '<div class="text-center"><input type="checkbox" id="tourokunomi">　<label for="tourokunomi">登録のみ</label></div>';
            <?php else: ?>
                <?php if(isset($order->id)) : ?>
                    strTitle = '予定データを更新しますか？';
                <?php else: ?>
                    strTitle = '予定データを登録しますか？';
                <?php endif; ?>
                strContent = '<div class="text-center">申込者名：' + $('#e_moushisha_mei').val() + '</div>';
            <?php endif; ?>

            strTitle = '<div class="text-center">' + strTitle + '</div>';

            popupConfirm(strContent, function() {
                <?php if($type == ProjectTable::KAKUTEI_TYPE): ?>
                    //send mail
                    if($('#tourokunomi:checked').length === 0) {
                        $('#is_sendmail').val(1);
                    } else {
                        $('#is_sendmail').val(0);
                    }
                <?php endif; ?>
                filterData();
                $("#frm_add_edit_project").submit();
            }, function() {}, strTitle);
        });

        checkShoukaisha($('.check_shoukaisha:checked'));
        $('.check_shoukaisha').change(function () {
            checkShoukaisha($(this));
        });

        $('#moushikomisha_douitsu').click(function () {
           if($('#moushikomisha_douitsu').is(':checked')){
               $('#nouhin_juusho, #nouhin_mei').prop('readonly', true);
               copyCustomerInfo();
           } else {
               $('#nouhin_juusho, #nouhin_mei').prop('readonly', false);
           }
        });

        checkShoriJiyuu($('.radio_shori_joukyou:checked').val());
        $('.radio_shori_joukyou').change(function () {
            checkShoriJiyuu($(this).val());
        });

        checkHanbaiKanrihi($('#hanbai_kanrihi_tsuika').is(':checked'));
        $('#hanbai_kanrihi_tsuika').change(function () {
            checkHanbaiKanrihi($(this).is(':checked'));
        });

        checkShusseiNebiki($('#shussei_nebiki_tsuika').is(':checked'));
        $('#shussei_nebiki_tsuika').change(function () {
            checkShusseiNebiki($(this).is(':checked'));
        });

        $('#popup-project-yoitei').click(function () {
            showPopupProject('予定データ選択', '<?= ProjectTable::YOTEI_TYPE ?>');
        });

        $('#popup-project-kakutei').click(function () {
            showPopupProject('過去データ選択', '<?= ProjectTable::KAKUTEI_TYPE ?>');
        });

        $('#popup-customer-list').click(function () {
            ajaxDataForm(
                {'type': 1}, '<?= Router::url(['controller' => 'MCustomer', 'action' => 'popup']) ?>',
                function (data) {
                    popupDataForm(
                        '顧客リスト選択',
                        data,
                        function () {
                            if($("td input[name='id[]']:checked").length > 0) {
                                var selectedRow = $("td input[name='id[]']:checked");
                                var selectedParentRow = selectedRow.parent().parent();

                                var moushisha_moushimei_kanji = $.trim(selectedParentRow.find('.moushisha_moushimei_kanji').text());
                                var youbinbangou = $.trim(selectedParentRow.find('.e_moushisha_youbinbangou').text());
                                var todoufuken = $.trim(selectedParentRow.find('.e_moushisha_juusho_todoufuken').text());
                                var shikuchousonikou = $.trim(selectedParentRow.find('.e_moushisha_juusho_shikuchousonikou').text());
                                var customer_id = $.trim(selectedRow.val());

                                $("#e_moushisha_mei").val(moushisha_moushimei_kanji);
                                $("#e_moushisha_juushotodoufuken").val(youbinbangou+'　'+todoufuken);
                                $("#e_moushisha_juushoshichou").val(shikuchousonikou);
                                $("#customer_id").val(customer_id);
                            } else {
                                $("#e_moushisha_mei").val('');
                                $("#e_moushisha_yuubenbangou").val('');
                                $("#e_moushisha_juushotodoufuken").val('');
                                $("#e_moushisha_juushoshichou").val('');
                                $("#customer_id").val('');
                            }

                            if($('#moushikomisha_douitsu').is(':checked')){
                                $('#nouhin_juusho, #nouhin_mei').prop('readonly', true);
                                copyCustomerInfo();
                            }
                        }
                    );
                }
            );
        });

        $('#keisan').click(function () {
            if($('.detail_product_id').length <= 0) {
                popupAlert('商品リストは必須項目です。');
                return false;
            }

            calculateTotal();
        });

        $('#btn_print_hatchuusho').click(function () {
            var resMess = validBeforeSubmit();
            if(resMess) {
                popupAlert(resMess);
                return false;
            }

            $.dialog({
                title: 'プレビュー表示内容選択<hr>',
                content: '<div class="text-center">発注書Ａ～Ｃに金額表示しますか？</div><div class="text-center"><button class="btn btn-sm btn-secondary" id="money-show">金額表示する</button>　<button class="btn btn-sm btn-secondary" id="money-hide">金額表示しない</button></div>',
                animation: 'opacity',
                closeAnimation: 'opacity',
                animateFromElement: false,
                draggable: false,
                onOpen: function(){
                    var that = this;
                    this.$content.find('#money-show').click(function(){
                        showMoney(true, that);
                    });
                    this.$content.find('#money-hide').click(function(){
                        showMoney(false, that);
                    });
                }
            });
        });
    });

    function getHatchuusho(status) {
        var html = $('#print-body').html();
        var mapObj = {
            T1: 'tab-1',
            T2: 'tab-2',
            T3: 'tab-3',
            CONTENT1: 'tab-1',
            CONTENT2: 'tab-2',
            CONTENT3: 'tab-3'
        };

        if(status) {
            $.extend(mapObj, {'money':'hide'});
            return html.replace(/T1|T2|T3|CONTENT1|CONTENT2|CONTENT3|money/gi, function(matched){
                return mapObj[matched];
            });
        } else {
            $.extend(mapObj, {'unmoney':'hide'});
            return html.replace(/T1|T2|T3|CONTENT1|CONTENT2|CONTENT3|unmoney/gi, function(matched){
                return mapObj[matched];
            });
        }
    }

    function showMoney(status, popup) {
        popup.setTitle('印刷プレビュー<hr>');
        popup.setColumnClass('col-md-12');
        popup.setContent(getHatchuusho(status));
    }

    // valid and show msg
    function validBeforeSubmit() {
        var aryProductId = [];
        var aryEmpty = [];

        //処理状況
        if(!$("[name='order[shori_joukyou]']").is(':checked')) {
            aryEmpty.push('処理状況');
        }
        //申込者
        if($('#e_moushisha_mei').val().length <= 0) {
            aryEmpty.push('申込者');
        }
        //商品リスト
        $("[name='order_detail[product_id][]']").each(function () {
            aryProductId.push($(this).val())
        });

        // empty
        if(aryProductId.length <= 0) {
            aryEmpty.push('商品リスト');
        }

        // return empty msg
        if(aryEmpty.length > 0) {
            return aryEmpty.join('、') + 'は必須項目です。';
        } else {
            return '';
        }
    }

    function copyCustomerInfo() {
        var e_moushisha_mei = $("#e_moushisha_mei").val();
        $("#nouhin_mei").val(e_moushisha_mei);
        var nouhin_juusho = $("#e_moushisha_juushotodoufuken").val();
        nouhin_juusho += $("#e_moushisha_juushoshichou").val();
        $("#nouhin_juusho").val(nouhin_juusho);
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

        if($('#hanbai_kanrihi_tsuika').is(':checked')) {
            var hanbai_kanrihi = $("#hanbai_kanrihi").val();
            $("#hanbai_kanrihi").val(convertMoneyToNumber(hanbai_kanrihi));
            var hanbai_kanrihi_shouhizei = $("#hanbai_kanrihi_shouhizei").val();
            $("#hanbai_kanrihi_shouhizei").val(convertMoneyToNumber(hanbai_kanrihi_shouhizei));
            var hanbai_kanrihi_shoukei = $("#hanbai_kanrihi_shoukei").val();
            $("#hanbai_kanrihi_shoukei").val(convertMoneyToNumber(hanbai_kanrihi_shoukei));
        }

        if($('#shussei_nebiki_tsuika').is(':checked')) {
            var shussei_nebiki_zeinu_goukei = $("#shussei_nebiki_zeinu_goukei").val();
            $("#shussei_nebiki_zeinu_goukei").val(convertMoneyToNumber(shussei_nebiki_zeinu_goukei));
            var shussei_nebiki_shouhizei = $("#shussei_nebiki_shouhizei").val();
            $("#shussei_nebiki_shouhizei").val(convertMoneyToNumber(shussei_nebiki_shouhizei));
            var shussei_nebiki_goukei = $("#shussei_nebiki_goukei").val();
            $("#shussei_nebiki_goukei").val(convertMoneyToNumber(shussei_nebiki_goukei));
            var shussei_nebiki = $("#shussei_nebiki").val();
            $("#shussei_nebiki").val(convertMoneyToNumber(shussei_nebiki));
        }

        if($('#hanbai_kanrihi_tsuika').is(':checked') || $('#shussei_nebiki_tsuika').is(':checked')) {
            var saishuu_goukei = $("#saishuu_goukei").val();
            $("#saishuu_goukei").val(convertMoneyToNumber(saishuu_goukei));
            var souzeinu_rieki = $("#souzeinu_rieki").val();
            $("#souzeinu_rieki").val(convertMoneyToNumber(souzeinu_rieki));
        }

        var zeinu_rieki = $("#zeinu_rieki").val();
        $("#zeinu_rieki").val(convertMoneyToNumber(zeinu_rieki));
    }

    function checkShoukaisha(me) {
        var val = me.val();
        if(val == '<?= OrdersTable::STATUS_ARI ?>') {
            $('#shoukaisha_id').show();
        } else {
            $('#shoukaisha_id').hide();
        }
    }

    function checkShoriJiyuu(val) {
        if(val === '<?= OrdersTable::SHORI_KYANSERY ?>') {
            $('.shori_jiyuu').show();
            $('.seikan').hide();
            $('#shori_jiyuu_2').attr('disabled', 'disabled');
            $('#shori_jiyuu_4').show().removeAttr('disabled');
            $('#shori_jiyuu_3').hide().attr('disabled');
        } else if(val === '<?= OrdersTable::SHORI_MISTUMORI ?>') {
            $('.shori_jiyuu').hide();
            $('.seikan').show();
            $('#shori_jiyuu_4').attr('disabled', 'disabled');
            $('#shori_jiyuu_3').attr('disabled', 'disabled');
            $('#shori_jiyuu_2').removeAttr('disabled');
        } else if(val === '<?= OrdersTable::SHORI_CHUU_SHITSU ?>') {
            $('.shori_jiyuu').show();
            $('.seikan').hide();
            $('#shori_jiyuu_3').show().removeAttr('disabled');
            $('#shori_jiyuu_4').hide().attr('disabled', 'disabled');
            $('#shori_jiyuu_2').attr('disabled', 'disabled');
        } else {
            $('.shori_jiyuu').hide();
            $('.seikan').hide();
            $('#shori_jiyuu_2').attr('disabled', 'disabled');
            $('#shori_jiyuu_3').attr('disabled', 'disabled');
            $('#shori_jiyuu_4').attr('disabled', 'disabled');
        }
    }

    function showPopupProject(strTile, projectType) {
        ajaxDataForm(
            {'type': 1, 'project_type': projectType}, '<?= Router::url(['controller' => 'Project', 'action' => 'popup']) ?>',
            function (data) {
                popupDataForm(strTile, data,
                    function () {
                        if($("td input[name='id[]']:checked").length > 0) {
                            var selectedRow = $("td input[name='id[]']:checked");
                            var orderId = $.trim(selectedRow.val());
                            window.location.href = "<?= Router::url(['controller' => 'Project', 'action' => 'copy']); ?>/" + orderId
                        }
                    }
                );
            }
        );
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
        if(!$('#hanbai_kanrihi_tsuika').is(':checked') && !$('#shussei_nebiki_tsuika').is(':checked')){
            $('.tsuika').hide();
            $('#saishuu_goukei').val('');
            $('#souzeinu_rieki').val('');
            $('#sourieki_ritsu').val('');
        } else {
            $('.tsuika').show();
        }
    }


    // 合計
    function calculateTotal() {
        var juchuu_kingaku_goukei = 0;
        var hatchuu_kingaku_goukei = 0;
        var tax = parseInt($('#zeiritsu').val())/100;


        /* START 発注 */
        $("[name='order_detail[hatchuu_kingaku][]']").each(function () {
            hatchuu_kingaku_goukei += parseInt(convertMoneyToNumber($(this).val()));
        });
        if (hatchuu_kingaku_goukei > 0) {
            var shouhizei = tax * hatchuu_kingaku_goukei;
            var hatchuu_tanka_goukei = shouhizei + hatchuu_kingaku_goukei;
        }
        //金額合計
        var strHatchuuKingaku = convertNumberToMoney(hatchuu_kingaku_goukei);
        $('#hatchuu_kingaku_goukei').val(strHatchuuKingaku);
        //消費税
        var strHatchuuShouhizei = shouhizei ? convertNumberToMoney(shouhizei) : convertNumberToMoney(0);
        $("#shouhizei").val(strHatchuuShouhizei);
        //発注合計
        var strHatchuuGoukei = hatchuu_tanka_goukei ? convertNumberToMoney(hatchuu_tanka_goukei) : convertNumberToMoney(0);
        $("#hatchuu_tanka_goukei").val(strHatchuuGoukei);
        /* END 発注 */


        /* START 受注 */
        $("[name='order_detail[juchuu_kingaku][]']").each(function () {
            juchuu_kingaku_goukei += parseInt(convertMoneyToNumber($(this).val()));
        });
        if (juchuu_kingaku_goukei > 0) {
            var juchuu_shouhizei = tax * juchuu_kingaku_goukei;
            var juchuu_tanka_goukei = juchuu_shouhizei + juchuu_kingaku_goukei;
        }
        // 金額合計
        var strJuchuuKingaku = convertNumberToMoney(juchuu_kingaku_goukei);
        $('#juchuu_kingaku_goukei').val(strJuchuuKingaku);
        // 消費税
        var strJuchuuShouhizei = juchuu_shouhizei ? convertNumberToMoney(juchuu_shouhizei) : convertNumberToMoney(0);
        $("#juchuu_shouhizei").val(strJuchuuShouhizei);
        // 受注合計
        var strJuchuuGoukei = juchuu_tanka_goukei ? convertNumberToMoney(juchuu_tanka_goukei) : convertNumberToMoney(0);
        $("#juchuu_tanka_goukei").val(strJuchuuGoukei);
        /* END 受注 */


        /* START 利益 */
        var zeinuRieki = juchuu_kingaku_goukei - hatchuu_kingaku_goukei;
        var riekiRitsu = (hatchuu_kingaku_goukei <= 0) ? 0 : Math.round((zeinuRieki/hatchuu_kingaku_goukei)*100);

        $('#zeinu_rieki').val(convertNumberToMoney(zeinuRieki));
        $('#rieki_ritsu').val(riekiRitsu);
        /* END 利益 */

        // 販売管理費追加 && 出精値引追加
        var hanbaiKanrihi = '';
        var souzeinuRieki = '';
        var souriekiRitsu = '';
        var intHanbaiKanrihiShoukei = '';
        var intShusseiNebiki = '';
        var intHanbaiKanrihi = '';

        if($('#hanbai_kanrihi_tsuika').is(':checked') && $('#shussei_nebiki_tsuika').is(':checked')) {
            intHanbaiKanrihiShoukei = convertMoneyToNumber($('#hanbai_kanrihi_shoukei').val());
            intHanbaiKanrihiShoukei = (intHanbaiKanrihiShoukei) ? parseInt(intHanbaiKanrihiShoukei) : '';
            intHanbaiKanrihi = convertMoneyToNumber($('#hanbai_kanrihi').val());
            intHanbaiKanrihi = (intHanbaiKanrihi) ? parseInt(intHanbaiKanrihi) : '';
            var intHanbaiKanrihiShouhizei = convertMoneyToNumber($('#hanbai_kanrihi_shouhizei').val());
            intHanbaiKanrihiShouhizei = (intHanbaiKanrihiShouhizei) ? parseInt(intHanbaiKanrihiShouhizei) : '';

            intShusseiNebiki = convertMoneyToNumber($('#shussei_nebiki').val());
            intShusseiNebiki = (intShusseiNebiki) ? parseInt(intShusseiNebiki) : '';

            var intShusseiNebikiZeinuGoukei = juchuu_kingaku_goukei + intHanbaiKanrihi;
            var intShusseiNebikiShouhizei = juchuu_shouhizei + intHanbaiKanrihiShouhizei;
            var intShusseiNebikiGoukei = juchuu_tanka_goukei + intHanbaiKanrihiShoukei;

            $('#shussei_nebiki_zeinu_goukei').val(convertNumberToMoney(intShusseiNebikiZeinuGoukei));
            $('#shussei_nebiki_shouhizei').val(convertNumberToMoney(intShusseiNebikiShouhizei));
            $('#shussei_nebiki_goukei').val(convertNumberToMoney(intShusseiNebikiGoukei));

            hanbaiKanrihi = juchuu_tanka_goukei + intHanbaiKanrihiShoukei - intShusseiNebiki;
            $('#saishuu_goukei').val(convertNumberToMoney(hanbaiKanrihi));


            souzeinuRieki = zeinuRieki + intHanbaiKanrihi - intShusseiNebiki;
            souriekiRitsu = (hatchuu_kingaku_goukei <= 0) ? 0 : Math.round((souzeinuRieki/hatchuu_kingaku_goukei)*100);

            $('#souzeinu_rieki').val(convertNumberToMoney(souzeinuRieki));
            $('#sourieki_ritsu').val(souriekiRitsu);
        }
        // 販売管理費追加
        else if($('#hanbai_kanrihi_tsuika').is(':checked')) {
            intHanbaiKanrihiShoukei = convertMoneyToNumber($('#hanbai_kanrihi_shoukei').val());
            intHanbaiKanrihiShoukei = (intHanbaiKanrihiShoukei) ? parseInt(intHanbaiKanrihiShoukei) : '';
            hanbaiKanrihi = juchuu_tanka_goukei + intHanbaiKanrihiShoukei;
            $('#saishuu_goukei').val(convertNumberToMoney(hanbaiKanrihi));

            intHanbaiKanrihi = convertMoneyToNumber($('#hanbai_kanrihi').val());
            intHanbaiKanrihi = (intHanbaiKanrihi) ? parseInt(intHanbaiKanrihi) : '';
            souzeinuRieki = zeinuRieki + intHanbaiKanrihi;
            souriekiRitsu = (hatchuu_kingaku_goukei <= 0) ? 0 : Math.round((souzeinuRieki/hatchuu_kingaku_goukei)*100);

            $('#souzeinu_rieki').val(convertNumberToMoney(souzeinuRieki));
            $('#sourieki_ritsu').val(souriekiRitsu);
        }
        // 出精値引追加
        else if($('#shussei_nebiki_tsuika').is(':checked')) {
            intShusseiNebiki = convertMoneyToNumber($('#shussei_nebiki').val());
            intShusseiNebiki = (intShusseiNebiki) ? parseInt(intShusseiNebiki) : '';

            $('#shussei_nebiki_zeinu_goukei').val(strJuchuuKingaku);
            $('#shussei_nebiki_shouhizei').val(strJuchuuShouhizei);
            $('#shussei_nebiki_goukei').val(strJuchuuGoukei);

            hanbaiKanrihi = juchuu_tanka_goukei - intShusseiNebiki;
            $('#saishuu_goukei').val(convertNumberToMoney(hanbaiKanrihi));

            souzeinuRieki = zeinuRieki - intShusseiNebiki;
            souriekiRitsu = (hatchuu_kingaku_goukei <= 0) ? 0 : Math.round((souzeinuRieki/hatchuu_kingaku_goukei)*100);

            $('#souzeinu_rieki').val(convertNumberToMoney(souzeinuRieki));
            $('#sourieki_ritsu').val(souriekiRitsu);
        } else {
            $('#hanbai_kanrihi').val('');
            $('#hanbai_kanrihi_shouhizei').val('');
            $('#hanbai_kanrihi_shoukei').val('');
            $('#saishuu_goukei').val('');
            $('#souzeinu_rieki').val('');
            $('#sourieki_ritsu').val('');
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


        <?php if(isset($project->id) && ($projectBangou = $project->bangou)): ?>
            <div class="form-group row">
                <label class="col-sm-1 col-form-label text-right">案件No</label>
                <label class="col-sm-1 col-form-label"><b><?= $projectBangou ?></b></label>
                <label class="col-sm-5"></label>
                <?php if(isset($order->bangou)) : ?>
                    <label class="col-sm-1 col-form-label text-right">
                        <?= ($type == ProjectTable::YOTEI_TYPE) ? '見積No.' : '受注No.' ?>
                    </label>
                    <label class="col-sm-2 col-form-label">
                        <b><?= $order->juchuu_bangou ?></b>
                    </label>
                    <label class="col-sm-2 text-right">
                        <?php if($type == ProjectTable::YOTEI_TYPE && isset($order->id)) : ?>
                            <?= $this->Form->button(__('新規伝票発行'), [
                                'class' => 'btn btn-sm btn-info',
                                'type' => 'button',
                                'onclick' => "window.location.href = '".Router::url(['controller' => 'Project', 'action' => 'shinki-denpyou',Crypt::encrypAES($order->id)])."'",
                                'id' => "btn-add-order"]) ?>
                        <?php endif;?>
                    </label>
                <?php endif;?>
            </div>
        <?php endif; ?>
        <div class="form-group row">
            <?php if($type == ProjectTable::KAKUTEI_TYPE) { ?>
                <label class="col-sm-1 col-form-label text-right">登録種別 <span class="text-danger">*</span></label>
                <div class="col-sm-4 col-form-label">
                    <?php
                        $aryShoriJoukyou = OrdersTable::KAKUTE_TYPE;
                        if(!(isset($order->shori_joukyou) && $order->shori_joukyou == OrdersTable::MODOSHI_JOUKEN))
                            unset($aryShoriJoukyou[OrdersTable::MODOSHI_JOUKEN]);
                    ?>
                    <?= $this->Form->radio('order[shori_joukyou]', $aryShoriJoukyou, [
                        'value' => isset($order->shori_joukyou) ? $order->shori_joukyou : false
                    ]); ?>
                </div>
                <div class="col-sm-2 text-right">
                    <?php if(in_array($screen, ['kakuteiTouroku', 'copy'])) : ?>
                        <?= $this->Form->button(__('予定データから選択'), [
                            'class' => 'btn btn-sm btn-info',
                            'type' => 'button',
                            'id' => 'popup-project-yoitei']) ?>
                    <?php endif; ?>
                </div>

                <label class="col-sm-1 col-form-label text-right">受注日</label>
            <?php } else { ?>
                <label class="col-sm-1 col-form-label text-right">処理状況 <span class="text-danger">*</span></label>
                <div class="col-sm-6 shori">
                    <?php
                    $aryShoriJoukyou = OrdersTable::SHORI_JOUKYOU;
                    if(!isset($project->id)) { //new create
                        unset($aryShoriJoukyou[OrdersTable::SHORI_KYANSERY],
                            $aryShoriJoukyou[OrdersTable::SHORI_CHUU_SHITSU]);
                    }
                    ?>
                    <?= $this->Form->radio('order[shori_joukyou]', $aryShoriJoukyou, [
                        'value' => isset($order->shori_joukyou) ? $order->shori_joukyou : false,
                        'class' => 'radio_shori_joukyou'
                    ]); ?>
                    <label class="shori_jiyuu hide">&nbsp;&nbsp;事由&nbsp;</label>
                    <label class="shori_jiyuu hide">
                        <?= $this->Form->text('order[shori_jiyuu]', [
                            'value' => isset($order->shori_jiyuu) ? $order->shori_jiyuu : null,
                            'id' => 'shori_jiyuu_3',
                            'class' => 'form-control hide'
                        ]); ?>
                        <?= $this->Form->select('order[shori_jiyuu]',
                            $this->VHtml->selectNull(OrderDetailTable::SHORI_JIYUU), [
                                'class' => 'form-control hide',
                                'id' => 'shori_jiyuu_4',
                                'default' => isset($order->shori_jiyuu) ? $order->shori_jiyuu : null,
                            ]); ?>
                    </label>
                    <label class="seikan hide">&nbsp;&nbsp;静観</label>
                    <label class="seikan hide">
                        <?= $this->Form->checkbox('order[seikan]', [
                            'id' => 'shori_jiyuu_2',
                            'checked' => isset($order->seikan) ? $order->seikan : false
                        ]);
                        ?>
                    </label>
                </div>

                <label class="col-sm-1 col-form-label text-right">見積日</label>
            <?php } ?>

            <div class="col-sm-2 col-form-label">
                <?php $orderTourokubi = isset($order->tourokubi) ? $this->VHtml->dateToYYYYMMDD($order->tourokubi) : '';
                if(!isset($order->tourokubi) && !$orderTourokubi) {
                    $orderTourokubi = $this->VHtml->toDayYYYYMMDD();
                }
                ?>
                <?= $this->Form->text('order[tourokubi]', [
                    'value' => $orderTourokubi,
                    'class' => 'form-control datepicker']); ?>
            </div>
            <label class="col-sm-2 col-form-label"></label>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">申込者 <span class="text-danger">*</span></label>
            <div class="col-sm-2">
                <?= $this->Form->hidden('project[type]', ['value' => isset($project->type) ? $project->type : $type]); ?>
                <?= $this->Form->hidden('order[id]', ['value' => isset($order->id) ? $order->id : null]); ?>
                <?= $this->Form->hidden('order[status]', [
                    'value' => isset($order->status) ? $order->status : OrdersTable::STATUS_REGISTER,
                    'id' => 'status'
                ]); ?>
                <?= $this->Form->hidden('project[m_customer_id]', [
                    'value' => isset($project->m_customer_id) ? $project->m_customer_id : '',
                    'id' => 'customer_id'
                ]); ?>
                <?= $this->Form->text('project[e_moushisha_mei]', [
                    'value' => isset($project->e_moushisha_mei) ? $project->e_moushisha_mei : null,
                    'class' => "form-control",
                    'id' => 'e_moushisha_mei',
                    'readonly' => 'readonly',
                    'placeholder' => '氏名']); ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->text('project[e_moushisha_juushotodoufuken]', [
                    'value' => isset($project->e_moushisha_juushotodoufuken) ? $project->e_moushisha_juushotodoufuken : null,
                    'id' => 'e_moushisha_juushotodoufuken',
                    'class' => "form-control",
                    'readonly' => 'readonly',
                    'placeholder' => '〒460-0001　愛知県']); ?>
            </div>
            <div class="col-sm-1">
                <button type="button" id="popup-customer-list" class="btn btn-sm btn-info">顧客検索</button>
            </div>

            <label class="col-sm-1 col-form-label text-right">契約予定</label>
            <div class="col-sm-2">
                <?= $this->Form->text('order[keiyaku_yotei_jiki]', [
                    'value' => isset($order->keiyaku_yotei_jiki) ? $this->VHtml->dateToYYYYMMDD($order->keiyaku_yotei_jiki) : null,
                    'class' => "form-control datepicker",
                    'placeholder' => '時期　（西暦）年/月/日',
                    'id' => 'keiyaku_yotei_jiki']); ?>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right"></label>
            <div class="col-sm-5">
                <?= $this->Form->text('project[e_moushisha_juushoshichou]', [
                    'value' => isset($project->e_moushisha_juushoshichou) ? $project->e_moushisha_juushoshichou : null,
                    'id' => 'e_moushisha_juushoshichou',
                    'class' => "form-control",
                    'readonly' => 'readonly',
                    'placeholder' => '名古屋市中区三の丸０－０－０']); ?>
            </div>
            <div class="col-sm-1">
                <a target="_blank" href="<?= Router::url(['controller' => 'MCustomer', 'action' => 'add']) ?>" class="btn btn-sm btn-secondary">顧客登録</a>
            </div>
            <?php if($type == ProjectTable::YOTEI_TYPE) : ?>
                <label for="nouki_kaishibi" class="col-sm-1 col-form-label text-right">希望納期</label>
                <div class="col-sm-2">
                    <?= $this->Form->text('order_detail[nouki_kaishibi]', [
                        'value' => isset($orderDetails[0]->nouki_kaishibi) ? $this->VHtml->dateToYYYYMMDD($orderDetails[0]->nouki_kaishibi) : null,
                        'class' => "form-control datepicker",
                        'placeholder' => '開始　（西暦）年/月/日',
                        'id' => 'nouki_kaishibi']); ?>
                </div>
                <div class="col-sm-2" >
                    <?= $this->Form->text('order_detail[nouki_shuuryoubi]', [
                        'value' => isset($orderDetails[0]->nouki_shuuryoubi) ? $this->VHtml->dateToYYYYMMDD($orderDetails[0]->nouki_shuuryoubi) : null,
                        'class' => "form-control datepicker",
                        'placeholder' => '終了　（西暦）年/月/日',
                        'id' => 'nouki_shuuryoubi']); ?>
                </div>
            <?php else: ?>
                <label for="m_system_tantou_id" class="col-sm-1 col-form-label text-right">暮らし担当</label>
                <div class="col-sm-2">
                    <?= $this->Form->select('order[m_system_tantou_id]',
                        isset($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) ?
                            $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) : ['' => '-'],
                        [
                            'class' => 'form-control',
                            'id' => 'm_system_tantou_id',
                            'default' => isset($order->m_system_tantou_id) ? $order->m_system_tantou_id : false,
                        ]); ?>
                </div>
            <?php endif; ?>
            <?= $this->Form->hidden('order_detail[m_system_joutaikubun_id]', [
                'value' => isset($orderDetails[0]->m_system_joutaikubun_id) ? $orderDetails[0]->m_system_joutaikubun_id : null
            ]); ?>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">納品先</label>
            <div class="col-sm-2">
                <?= $this->Form->text('project[nouhin_mei]', [
                    'value' => isset($project->nouhin_mei) ? $project->nouhin_mei : false,
                    'class' => "form-control",
                    'id' => 'nouhin_mei',
                    'readonly' => $project->moushikomisha_douitsu ? true : false,
                    'placeholder' => '']); ?>
            </div>
            <div class="col-sm-3">
                <?= $this->Form->text('project[nouhin_juusho]', [
                    'value' => isset($project->nouhin_juusho) ? $project->nouhin_juusho : null,
                    'class' => "form-control",
                    'id' => 'nouhin_juusho',
                    'readonly' => $project->moushikomisha_douitsu ? true : false,
                    'placeholder' => '']); ?>
            </div>
            <div id="moushikomisha_douitsu_label" class="col-sm-1">
                <?= $this->Form->checkbox('project[moushikomisha_douitsu]', [
                    'id' => 'moushikomisha_douitsu',
                    'checked' => isset($project->moushikomisha_douitsu) ? $project->moushikomisha_douitsu : false]);
                ?>
                <label for="moushikomisha_douitsu">申込者と同一</label>
            </div>

            <?php if($type == ProjectTable::YOTEI_TYPE) : ?>
                <label for="m_system_tantou_id" class="col-sm-1 col-form-label text-right">暮らし担当</label>
                <div class="col-sm-2">
                    <?= $this->Form->select('order[m_system_tantou_id]',
                isset($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) ?
                            $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) : ['' => '-'],
                        [
                            'class' => 'form-control',
                            'id' => 'm_system_tantou_id',
                            'default' => isset($order->m_system_tantou_id) ? $order->m_system_tantou_id : false,
                        ]); ?>
                </div>
            <?php else: ?>
                <label for="m_system_ankenkoudo_id" class="col-sm-1 col-form-label text-right">案件コード</label>
                <div class="col-sm-2">
                    <?= $this->Form->select('order[m_system_ankenkoudo_id]',
                        $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_ANKEN_CD]), [
                            'class' => 'form-control',
                            'id' => 'm_system_tantou_id',
                            'default' => isset($order->m_system_ankenkoudo_id) ? $order->m_system_ankenkoudo_id : false,
                        ]); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group row">
            <?php if($type == ProjectTable::YOTEI_TYPE) : ?>
                <label class="col-sm-1 col-form-label text-right">訪問時間</label>
                <div class="col-sm-1">
                    <?= $this->Form->select('order_detail[m_system_houmon_jikan_id]',
                        isset($mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN]) ?
                            $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN]) : [],
                        [
                            'class' => 'form-control',
                            'default' => isset($orderDetails[0]->m_system_houmon_jikan_id) ? $orderDetails[0]->m_system_houmon_jikan_id : ''
                        ]); ?>
                </div>
                <div class="col-sm-1">
                    <?= $this->Form->text('order_detail[houmon_jikan_kaishi]', [
                        'value' => isset($orderDetails[0]) ? $orderDetails[0]->houmon_jikan_kaishi : null,
                        'class' => "form-control text-right timepicker"]); ?>
                </div>
            <?php else : ?>
                <?php if(in_array($screen, ['kakuteiTouroku', 'copy'])) : ?>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-4 text-right">
                        <?= $this->Form->button(__('過去データ参照'), [
                            'class' => 'btn btn-sm btn-info',
                            'type' => 'button',
                            'id' => 'popup-project-kakutei']) ?>
                    </div>
                <?php else: ?>
                    <div class="col-sm-7"></div>
                <?php endif;?>

                <?php $intShoukaishaId = isset($order->shoukaisha_id) ? $order->shoukaisha_id : OrdersTable::STATUS_NASHI; ?>
                <label for="shoukaisha_id" class="col-sm-1 col-form-label text-right">紹介者</label>
                <div class="col-sm-2 col-form-label">
                    <?php foreach (OrdersTable::STATUS_SYOKAI_VALUE as $intStatusSyokai => $strStatusSyokai): ?>
                        <?php $isSyokaiChecked = ($intShoukaishaId == $intStatusSyokai) ? 'checked' : '' ?>
                        <input class="check_shoukaisha" type="radio" name="check_shoukaisha" value="<?= $intStatusSyokai ?>" <?= $isSyokaiChecked ?>> <?= $strStatusSyokai ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->select('order[shoukaisha_id]',
                        $this->VHtml->selectNull($aryMediation), [
                            'class' => 'form-control ' . (($intStatusSyokai == OrdersTable::STATUS_NASHI) ? 'hide ' : ''),
                            'id' => 'shoukaisha_id',
                            'default' => $intShoukaishaId
                        ]); ?>
                </div>

            <?php endif; ?>
        </div>

        <div class="form-group row">
            <label for="m_system_shiharaihouhou_id" class="col-sm-1 col-form-label text-right">支払方法</label>
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
            <label class="col-sm-1 col-form-label text-right">部門</label>
            <div class="col-sm-2">
                <?= $this->Form->select('project[m_system_bumon_id]',
                    isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID]) ?
                        $this->VHtml->selectNull( $mstSystem[MSystemTable::SYSTEM_BUMON_ID]) : [],
                    [
                        'class' => 'form-control',
                        'default' => isset($project->m_system_bumon_id) ? $project->m_system_bumon_id : false,
                    ]); ?>
            </div>
            <label for="kanjou_kamoku" class="col-sm-1 col-form-label text-right">勘定科目</label>
            <div class="col-sm-2">
                <?= $this->Form->select('project[kanjou_kamoku]',
                    isset($mstSystem[MSystemTable::SYSTEM_KANJOU_KAMOKU]) ?
                        $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_KANJOU_KAMOKU]) : ['' =>'-'],
                    [
                        'class' => 'form-control',
                        'default' => isset($project->kanjou_kamoku) ? $project->kanjou_kamoku : false,
                    ]); ?>
            </div>
            <label class="col-sm-1 col-form-label text-right">補助科目</label>
            <div class="col-sm-2">
                <?= $this->Form->select('project[m_system_kamoku_id]',
                    isset($mstSystem[MSystemTable::SYSTEM_KAMOKU_ID]) ?
                        $this->VHtml->selectNull( $mstSystem[MSystemTable::SYSTEM_KAMOKU_ID]) : [],
                    [
                        'class' => 'form-control',
                        'default' => isset($project->m_system_kamoku_id) ? $project->m_system_kamoku_id : false,
                    ]); ?>
            </div>

        </div>

        <?php if($type == ProjectTable::YOTEI_TYPE): ?>
            <?= $this->element('../Project/_list_products', ['button' => true]) ?>
        <?php else : ?>
            <?= $this->element('../Project/_list_product_multi', ['button' => true, 'type' => $type]) ?>
        <?php endif; ?>

        <div class="form-group row">
            <div class="text-right" style="width: 4%">備考&nbsp;</div>
            <div style="width: 46%">
                <?= $this->Form->textArea('project[bikou]', [
                    'value' => isset($project->bikou) ? $project->bikou : '',
                    'class' => "form-control",
                    'rows' => 10]); ?>
            </div>
            <div style="width: 5%"></div>
            <div style="width: 45%">
                <table id="total-detail" class="table table-borderless">
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td width="14%" align="right">税率&nbsp;</td>
                        <td width="19%" class="input-group">
                            <?php $defaultZeiritsu = isset($order->zeiritsu) ? $order->zeiritsu : $intDefaultTax; ?>
                            <?= $this->Form->number('order[zeiritsu]', [
                                'value' => $defaultZeiritsu,
                                'class' => 'form-control',
                                'oninput' => 'validInt(this)',
                                'id' => 'zeiritsu'
                            ]); ?>
                            <div class="input-group-append">
                                <div class="input-group-text form-control-sm">%</div>
                            </div>
                        </td>
                        <td width="15%"></td>
                        <td width="21%" align="right">
                            <button id="keisan" style="width: 100%" type="button" class="btn btn-primary btn-sm">計算</button>
                        </td>
                    </tr>
                    <tr>
                        <td width="14%" align="right">発注金額&nbsp;</td>
                        <td width="20%">
                            <?= $this->Form->text('order[hatchuu_kingaku_goukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->hatchuu_kingaku_goukei) ? $order->hatchuu_kingaku_goukei : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'hatchuu_kingaku_goukei'
                            ]); ?>
                        </td>
                        <td width="14%" align="right">消費税&nbsp;</td>
                        <td width="19%">
                            <?= $this->Form->text('order[shouhizei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->shouhizei) ? $order->shouhizei : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'shouhizei'
                            ]); ?>
                        </td>
                        <td width="15%" align="right">発注合計&nbsp;</td>
                        <td width="21%">
                            <?= $this->Form->text('order[hatchuu_tanka_goukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->hatchuu_tanka_goukei) ? $order->hatchuu_tanka_goukei : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'hatchuu_tanka_goukei'
                            ]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">受注金額&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[juchuu_kingaku_goukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->juchuu_kingaku_goukei) ? $order->juchuu_kingaku_goukei : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'juchuu_kingaku_goukei'
                            ]); ?>
                        </td>
                        <td align="right">消費税&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[juchuu_shouhizei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->juchuu_shouhizei) ? $order->juchuu_shouhizei : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'juchuu_shouhizei'
                            ]); ?>
                        </td>
                        <td align="right">受注合計&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[juchuu_tanka_goukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->juchuu_tanka_goukei) ? $order->juchuu_tanka_goukei : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'juchuu_tanka_goukei'
                            ]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td align="right">税抜利益&nbsp;</td>
                        <td align="right">
                            <?= $this->Form->text('order[zeinu_rieki]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->zeinu_rieki) ? $order->zeinu_rieki : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'zeinu_rieki'
                            ]); ?>
                        </td>
                        <td align="right">利益率&nbsp;</td>
                        <td class="input-group">
                            <?= $this->Form->text('order[rieki_ritsu]', [
                                'value' => isset($order->rieki_ritsu) ? $order->rieki_ritsu : '',
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'rieki_ritsu'
                            ]); ?>
                            <div class="input-group-append">
                                <div class="input-group-text form-control-sm">%</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <?= $this->Form->checkbox('order[hanbai_kanrihi_tsuika]',
                                ['checked' => isset($order->hanbai_kanrihi_tsuika) ? $order->hanbai_kanrihi_tsuika : false, 'id' => 'hanbai_kanrihi_tsuika']); ?>
                            <label for="hanbai_kanrihi_tsuika">販売管理費追加</label>
                        </td>
                        <td colspan="2" align="right">
                            <?= $this->Form->checkbox('order[shussei_nebiki_tsuika]',
                                ['checked' => isset($order->shussei_nebiki_tsuika) ? $order->shussei_nebiki_tsuika : false, 'id' => 'shussei_nebiki_tsuika']); ?>
                            <label for="shussei_nebiki_tsuika">出精値引追加</label>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="hanbai_kanrihi_tsuika hide">
                        <td align="right">販管費&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[hanbai_kanrihi]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->hanbai_kanrihi) ? $order->hanbai_kanrihi : ''),
                                'class' => 'form-control text-right',
                                'oninput' => 'validMoney(this)',
                                'id' => 'hanbai_kanrihi'
                            ]); ?>
                        </td>
                        <td align="right">消費税&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[hanbai_kanrihi_shouhizei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->hanbai_kanrihi_shouhizei) ? $order->hanbai_kanrihi_shouhizei : ''),
                                'class' => 'form-control text-right',
                                'oninput' => 'validMoney(this)',
                                'id' => 'hanbai_kanrihi_shouhizei'
                            ]); ?>
                        </td>
                        <td align="right">小計&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[hanbai_kanrihi_shoukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->hanbai_kanrihi_shoukei) ? $order->hanbai_kanrihi_shoukei : ''),
                                'class' => 'form-control text-right',
                                'oninput' => 'validMoney(this)',
                                'id' => 'hanbai_kanrihi_shoukei'
                            ]); ?>
                        </td>
                    </tr>
                    <tr class="shussei_nebiki_tsuika top-border hide">
                        <td align="right">税抜合計&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[shussei_nebiki_zeinu_goukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->shussei_nebiki_zeinu_goukei) ? $order->shussei_nebiki_zeinu_goukei : ''),
                                'class' => 'form-control text-right',
                                'id' => 'shussei_nebiki_zeinu_goukei',
                                'readonly' => true
                            ]); ?>
                        </td>
                        <td align="right">消費税&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[shussei_nebiki_shouhizei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->shussei_nebiki_shouhizei) ? $order->shussei_nebiki_shouhizei : ''),
                                'class' => 'form-control text-right',
                                'id' => 'shussei_nebiki_shouhizei',
                                'readonly' => true
                            ]); ?>
                        </td>
                        <td align="right">合計&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[shussei_nebiki_goukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->shussei_nebiki_goukei) ? $order->shussei_nebiki_goukei : ''),
                                'class' => 'form-control text-right',
                                'id' => 'shussei_nebiki_goukei',
                                'readonly' => true
                            ]); ?>
                        </td>
                    </tr>
                    <tr class="shussei_nebiki_tsuika">
                        <td colspan="4"></td>
                        <td colspan="">▲出精値引&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[shussei_nebiki]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->shussei_nebiki) ? $order->shussei_nebiki : ''),
                                'id' => 'shussei_nebiki',
                                'oninput' => 'validMoney(this)',
                                'class' => 'form-control text-right'
                            ]); ?>
                        </td>
                    </tr>
                    <tr class="top-border tsuika hide">
                        <td colspan="4"></td>
                        <td colspan="">最終合計&nbsp;</td>
                        <td>
                            <?= $this->Form->text('order[saishuu_goukei]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->saishuu_goukei) ? $order->saishuu_goukei : ''),
                                'class' => 'form-control text-right',
                                'id' => 'saishuu_goukei',
                                'readonly' => true
                            ]); ?>
                        </td>
                    </tr>
                    <tr class="tsuika hide">
                        <td colspan="2"></td>
                        <td align="right">総税抜利益&nbsp;</td>
                        <td align="right">
                            <?= $this->Form->text('order[souzeinu_rieki]', [
                                'value' => $this->VHtml->convertNumberToMoney(isset($order->souzeinu_rieki) ? $order->souzeinu_rieki : ''),
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'souzeinu_rieki'
                            ]); ?>
                        </td>
                        <td align="right">利益率&nbsp;</td>
                        <td class="input-group">
                            <?= $this->Form->text('order[sourieki_ritsu]', [
                                'value' => isset($order->sourieki_ritsu) ? $order->sourieki_ritsu : '',
                                'class' => 'form-control text-right',
                                'readonly' => true,
                                'id' => 'sourieki_ritsu'
                            ]); ?>
                            <div class="input-group-append">
                                <div class="input-group-text form-control-sm">%</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if($screen === 'copy'): ?>
            <input name="screen" type="hidden" value="<?= $screen ?>">
            <input name="old_project_id" type="hidden" value="<?= $oldProjectId ?>">
            <input name="old_order_id" type="hidden" value="<?= $oldOrderId ?>">
        <?php endif; ?>

        <?= $this->element('../Project/_attached_file', ['screen' => $screen]) ?>

        <div class="form-group row">
            <label class="col-sm-4">&nbsp;</label>
            <div class="col-sm-8">
                <a class="btn btn-secondary" href="<?= $this->VHtml->getBackAction($screen); ?>">キャンセル</a>

                <?php if(isset($order->id) && ($order->id) && isset($orderDetails) && ($orderDetails)): ?>
                    <?php if($type == ProjectTable::YOTEI_TYPE): ?>
                        <a target="_blank" class="btn btn-success" href="<?= Router::url(['controller' => 'Excel', 'action' => 'exportMitsumori', Crypt::encrypAES($order->id)]); ?>">お見積を出力</a>
                    <?php else: ?>
                        <?php $this->Form->button(__('お発注書Ａ～Ｃを出力'), ['class' => 'btn btn-success', 'type'=>'button','id' => 'btn_print_hatchuusho']) ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?= $this->Form->button(__('一時保存'), ['class' => 'btn btn-success', 'type'=>'button','id' => 'btn_temp_status']) ?>
                <?= $this->Form->button(__('保存'), ['class' => 'btn btn-primary', 'type'=>'button','id' => 'btn_register_status']) ?>
            </div>
        </div>
    </div>
    <?php if($type == ProjectTable::KAKUTEI_TYPE): ?>
        <input type="hidden" id="is_sendmail" name="is_sendmail" value="1">
    <?php else : ?>
        <input type="hidden" id="is_sendmail" name="is_sendmail" value="0">
    <?php endif; ?>
    <?= $this->Form->end(); ?>
</div>

