<?php
use Cake\Routing\Router;
use App\Libs\Message;
?>

<script type="application/javascript">
    $(function() {
        $('.nav-link').click(function () {
            if($(this).data('value')) {
                $('#active_tab').val($(this).data('value'));
            }
        });

        $('#create-new-kainin').click(function () {
            checkKaiin(1);
        });

        $('#select-id').change(function () {
            alert($(this).val());
            location.href = '<?= Router::url(['controller'=> 'MCustomer', 'action'=> 'edit']) ?>/' + $(this).val();
        });

        $('.e_touroku_chekku_ran').change(function () {
            $('.e_touroku_chekku_ran').val($(this).val());
        });
        $('.e_chekku_rankinyuushaid_mei').change(function () {
            $('.e_chekku_rankinyuushaid_mei').val($(this).val());
        });
        $('.e_chekku_kinyou_jikan').change(function () {
            $('.e_chekku_kinyou_jikan').val($(this).val());
        });
        $('.kigyou_dantai_koudo').change(function () {
            $('.kigyou_dantai_koudo').val($(this).val());
        });
        $('.nikkunemu').change(function () {
            $('.nikkunemu').val($(this).val());
        });
        $('.pasuwado').change(function () {
            $('.pasuwado').val($(this).val());
        });

        <?php if($type === 'edit') : ?>
            checkKaiin("<?= $isKaiin ? 1 : 0 ?>");
        <?php endif; ?>
    });

    function checkKaiin(isCheck) {
        if(isCheck == 1) {
            $('#select-id').attr('name', '');
            $('.kaiin').show();
            $('.none-kaiin').hide();
        } else {
            $('#select-id').attr('name', 'select_id');
            $('.kaiin').hide();
            $('.none-kaiin').show();
        }
    }

    $(document).on("submit", "#frmCustomer", function(e) {
        if(this.check_submit) {
            return true;
        }

        var frm = this;
        popupConfirm('<?= Message::M_CUSTOMER_EDIT_CONFIRM ?>', function() {
            frm.check_submit = true;
            frm.submit();
        });
        return false;
    });
</script>