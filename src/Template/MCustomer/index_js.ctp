<?php use Cake\Routing\Router; ?>
<script type="application/javascript">
    var tableId = '#table-list';
    $(function () {
        initDatatable(tableId,
            {
                'ajax': '<?= Router::url(['controller'=> 'MCustomer', 'action'=> 'index']) ?>',
                "autoWidth": false,
                "order": [[12, "desc"]],
                "columns":[
                    { "name": "action", "orderable": false, 'width': '5%' },
                    { "name": "MMaster.name", 'width': '10%' },
                    { "name": "MCustomer.moushisha_moushimei_kanji", 'width': '150px'  },
                    { "name": "MCustomer.moushisha_moushimei_kana", 'width': '150px'  },
                    { "name": "MCustomer.tokui_saki_ryakushou", 'width': '150px' },
                    { "name": "MCustomer.e_moushisha_youbinbangou", 'width': '120px' },
                    { "name": "MCustomer.e_moushisha_juusho_todoufuken", 'width': '180px' },
                    { "name": "MCustomer.e_moushisha_juusho_shikuchousonikou", 'width': '120px' },
                    { "name": "MCustomer.denwa", 'width': '120px' },
                    { "name": "MCustomer.keitai_bangou", 'width': '120px' },
                    { "name": "MCustomer.fakkusu_bangou", 'width': '120px' },
                    { "name": "MCustomer.meirumegajin_meiru", 'width': '120px' },
                    { "name": "MCustomer.created", "visible": false }
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

        toggleKensaku($('#is_kensaku').val());

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