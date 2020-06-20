<?php
use Cake\Routing\Router;
?>
<script type="application/javascript">
    $(document).ready(function () {
        $('#test-popup-products').click(function () {
            ajaxDataForm(
                {'type': 1},
                "<?= Router::url(['controller' => 'MProduct', 'action' => 'popup']) ?>",
                function (data) {
                    popupDataForm(
                        '商品リスト選択',
                        data,
                        function () {
                        //...callBackFunc
                            var selectedData  = [];
                            $("input[name='id[]']:checked").each( function () {
                                var row  = [];
                                $(this).parent().parent().children().each(function(){
                                    // key 0: checkbox, 1: koudo, 2: mei, 3: naiyou, 4: tani, 5: ekisei_zaiko_suuryou, 6: mei_sakuin
                                    row.push($(this).text());
                                });
                                selectedData.push(row);
                            });
                            console.log(selectedData);
                        },
                        function () {
                        }
                     );
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });
    });
</script>

<div class="page page_register product_master" id="product">
    <div class="navi">
        <h1 class="title">Test popup products</h1>
    </div>
    <div class="text-center">
        <button id="test-popup-products" class="btn btn-primary" type="button">test test</button>
    </div>
</div>

