<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser $mUser
 */

use App\Model\Table\MUserTable;
use Cake\Routing\Router;
?>

<script type="application/javascript">
    $(function() {
        activeSupplier();

        $('#type').change(function () {
            activeSupplier();
        });

        $('#save').click(function () {
            $('.form-data').submit();
        });
    });

    function activeSupplier() {
        if($('#type').val() === '<?= MUserTable::TYPE_PARTNER ?>') {
            $('#m_supplier').show();
        } else {
            $('#m_supplier').hide();
        }
    }
</script>

<div class="page page_register register_master" id="master">
    <div class="navi">
        <?= $this->element('_back', ['url' => Router::url(['controller'=> 'MUser', 'action'=> 'index'])]); ?>
        <h1 class="title"><?= $title ?></h1>
    </div>
    
    <?= $this->Form->create($mUser, ['autocomplete' => 'off']) ?>
        <div class="form-data">
            <div class="form-group row">
                <div class="col-sm-12">
                    <?= $this->Flash->render() ?>
                    <?= $this->Flash->render('success') ?>
                    <?= $this->Flash->render('error') ?>
                </div>
            </div>
            <?php if(isset($mUser->id)) : ?>
                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label">利用者ＩＤ<span class="required">*</span></label>
                    <div class="col-sm-8"><b><?= $mUser->username; ?></b></div>
                </div>
            <?php else: ?>
                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label">利用者ＩＤ<span class="required">*</span></label>
                    <div class="col-sm-8">
                        <?= $this->Form->text('username', [
                            'class' => 'form-control',
                            'placeholder' => '(例) user12345']); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">パスワード<span class="required">*</span></label>
                    <div class="col-sm-8">
                        <?= $this->Form->password('password', ['class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="re_new_password" class="col-sm-4 col-form-label">パスワード（確認）<span class="required">*</span></label>
                    <div class="col-sm-8">
                        <?= $this->Form->password('re_new_password', ['class' => 'form-control']); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">名前<span class="required">*</span></label>
                <div class="col-sm-8">
                    <?= $this->Form->text('name', [
                        'class' => 'form-control',
                        'placeholder' => '(例)太郎']); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-4 col-form-label">電話番号</label>
                <div class="col-sm-8">
                    <?= $this->Form->text('phone', [
                        'class' => 'form-control',
                        'placeholder' => '(例) 08011112222']); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">メールアドレス</label>
                <div class="col-sm-8">
                    <?= $this->Form->text('email', [
                        'class' => 'form-control',
                        'placeholder' => '(例) user@xyz.com']); ?>
                </div>
            </div>
            <?php if(false) : ?>
                <div class="form-group row">
                    <label for="m_role_id" class="col-sm-4 col-form-label">権限</label>
                    <div class="col-sm-8">
                        <?= $this->Form->select('m_role_id', $aryMRole, [
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?= $this->Form->hidden('m_role_id', ['value' => 1]); ?>
            <div class="form-group row">
                <label for="type" class="col-sm-4 col-form-label">役割</label>
                <div class="col-sm-8">
                    <?= $this->Form->select('type', MUserTable::TYPE_VALUE, [
                        'id' => 'type',
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div id="m_supplier" class="form-group row">
                <label for="m_role_id" class="col-sm-4 col-form-label">仕入先<span class="required">*</span></label>
                <div class="col-sm-8">
                    <?= $this->Form->select('m_supplier_id', $this->VHtml->requiredSelect($aryMSupplier),[
                        'class' => 'form-control'
                    ]); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="m_role_id" class="col-sm-4 col-form-label">メール送信</label>
                <div class="col-sm-8">
                    <?= $this->Form->checkbox('is_mail_manga'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="m_role_id" class="col-sm-4 col-form-label">有効</label>
                <div class="col-sm-8">
                    <?= $this->Form->checkbox('is_active'); ?>
                </div>
            </div>
        </div>
        <div class="form-data-footer">
            <div class="pull-left">
                <a class="btn btn-secondary" role="button" href="<?= Router::url(['controller'=> 'MUser', 'action'=> 'index']) ?>"><?= __('キャンセル') ?></a>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
            <div class="clearfix"></div>
        </div>
    <?= $this->Form->end() ?>
</div><br>
