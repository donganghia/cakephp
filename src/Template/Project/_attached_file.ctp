<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser $mUser
 */

use Cake\Routing\Router;
use App\Model\Table\MUserTable;

$col = (isset($arySanshou) && $arySanshou) ? '4' : '8'; ?>

<style type="text/css">
    .explorer-caption {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0;
        width: 180px;
    }

    .file-drop-zone-title {
        padding: 50px 10px;
    }

    .file-input {
        width: 300px;
    }

    .name-file {
        <?php if($col === '4'): ?>
        width: 80%;
        <?php else: ?>
        width: 85%;
        <?php endif; ?>
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    /**/
    .file-error-message ul {
        list-style-type: none;
        padding: 0;
    }

    .file-caption, .btn-file {
        border-radius: 0;
    }

    .kv-file-content {
        display: none;
    }

    .file-actions .file-footer-buttons button, .preview-zone .btn, .btn-small {
        min-width: auto;
    }

    .file-preview-frame {
        width: 95%;
    }

    samp, .file-upload-indicator {
        display: none !important;
    }

    .theme-explorer .file-actions-cell {
        width: 80px;
    }

    .list-group li {
        padding: .2rem .75rem;
    }
</style>

<script type="application/javascript">
    function downloadAtachmentFile(orderAttachmentId) {
        window.location.href = "<?= Router::url(['controller' => 'Project', 'action' => 'downloadFile']); ?>/"+orderAttachmentId;
    }
</script>
<input type="hidden" id="tempo-token" name="tempo_token" value="<?= $strTempoToken ?>">
<hr>

<div class="form-group row">
    <label class="col-sm-4 text-center">
        <b>ファイルを添付してください。</b>
    </label>
    <label class="col-sm-<?= $col ?> text-center">
        <b><?php if($aryLoginUser['type'] == MUserTable::TYPE_PARTNER): ?>
            証拠書添付
        <?php else : ?>
            添付
        <?php endif; ?></b>
    </label>
    <?php if (isset($arySanshou) && $arySanshou): ?>
        <label class="col-sm-4 text-center">
            <b><?php if($aryLoginUser['type'] == MUserTable::TYPE_PARTNER): ?>
                添付
            <?php else : ?>
                証拠書添付
            <?php endif; ?></b>
        </label>
    <?php endif; ?>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <div class="uploadPart">
            <div align="center">
                <div align="center" class="uploadBorder">
                    <input id="tempo" type="file" multiple>
                </div>
                <div align="center" class="uploadBorder">
                    <div id="kartik-file-errors"></div>
                </div>

            </div>
            <div class="text-danger">
                <br>
                ※最大アップロードサイズ：5MB。<br>
                ※可能な上限数は10個です。<br>
                ※jpg、jpeg、png、xls、xlsx、doc、docx、pdf、txt、csv、rtfのファイルのみサポートしています。
            </div>
        </div>
    </div>


    <div class="col-sm-<?= $col ?>">
        <div class="preview-zone">
            <?php
            if($screen === 'shinkiDenpyou' && $this->request->is(['get']) && $aryAttached) {
                $aryAttached = [];
            }
            ?>
            <ul class="list-group">
            <?php if (isset($aryAttached) && $aryAttached): ?>
                <?php $no = 0; ?>
                <?php foreach ($aryAttached as $itemAttached): ?>
                    <?php
                    $strDataAttr = 'data-no="'.$no.'" data-name="'.$itemAttached->name.'" data-attached-id="'.$itemAttached->id.'"';
                    ?>

                    <li class="block-file list-group-item d-flex justify-content-between align-items-center preview-show-<?= $no ?>">
                        <div class="name-file"><?= $itemAttached->view_name ?></div>
                        <input type="hidden" name="attached[<?= $no ?>][id]" value="<?= $itemAttached->id ?>">
                        <input type="hidden" name="attached[<?= $no ?>][name]" value="<?= $itemAttached->name ?>">
                        <input type="hidden" name="attached[<?= $no ?>][view_name]" value="<?= $itemAttached->view_name ?>">
                        <i class="fa fa-lg fa-trash delete-file btn btn-sm btn-danger" aria-hidden="true" title="削除する" <?= $strDataAttr ?>></i>
                        <?php if(isset($itemAttached->id)): ?>
                            <i class="fa fa-lg fa-download btn btn-sm btn-primary" onclick="downloadAtachmentFile(<?= $itemAttached->id ?>) " aria-hidden="true" title="ダウンロードする"></i>
                        <?php endif; ?>
                    </li>
                    <?php $no++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>
        </div>
        <div class="delete-zone">
            <?php if (isset($aryAttachedDeleteId) && $aryAttachedDeleteId): ?>
                <?php foreach ($aryAttachedDeleteId as $itemAttachedDeleteId): ?>
                    <input type="hidden" name="attached_delete_id[]" value="<?= $itemAttachedDeleteId ?>">
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($arySanshou) && $arySanshou): ?>
        <div class="col-sm-4">
            <ul class="list-group">
                <?php foreach ($arySanshou as $itemSanshou): ?>
                    <?php
                    $no = 'second-' . $itemSanshou->id;
                    $strDataAttr = 'data-no="'.$no.'" data-name="'.$itemSanshou->name.'" data-attached-id="'.$itemSanshou->id.'"';
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center preview-show-<?= $no ?>">
                        <div class="name-file"><?= $itemSanshou->view_name ?></div>
                        <?php if($aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI): ?>
                            <i class="fa fa-lg fa-trash delete-file btn btn-sm btn-danger btn-small" aria-hidden="true" title="削除する" <?= $strDataAttr ?>></i>
                            <i class="fa fa-lg fa-download btn btn-sm btn-primary btn-small" onclick="downloadAtachmentFile(<?= $itemSanshou->id ?>);" aria-hidden="true" title="ダウンロードする"></i>
                        <?php else:?>
                            <i class="fa fa-lg fa fa-download btn btn-sm btn-primary" onclick="downloadAtachmentFile(<?= $itemSanshou->id ?>);" aria-hidden="true" title="ダウンロードする"></i>
                        <?php endif;?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<script type="application/javascript">
    var tempoId = '#tempo';
    var uploadViewNum = $('.block-file').length;

    $(function () {
        fileInput(tempoId, {
            uploadUrl: '<?= Router::url(['controller'=> 'Project', 'action'=> 'addFile']) ?>/' + getTempoToken()
        }).on('fileuploaded', function(event, data, id, index) {
            //load img
            var objRes = data.response;
            if(typeof objRes.data.view_name !== undefined && objRes.data.view_name !== '') {
                $('.preview-zone .list-group').prepend(showTemplate(objRes.data));
                uploadViewNum++;
            }

            //remove after upload
            $(document).find('#' + id).remove();

            if($(document).find('.kv-file-upload').length <= 0) {
                //clear input
                setTimeout(function() {
                    $(tempoId).fileinput('clear');
                }, 800);
            }
        });

        $(document).on('click', '.delete-file', function() {
            var fileId = $(this).data('attached-id'),
                fileNo = $(this).data('no'),
                fileName = $(this).data('name');

            if((fileNo || fileNo == 0) && fileName) {
                popupConfirm('削除します。宜しいですか？', function () {
                    if(fileId) {
                        $('.preview-show-' + fileNo).remove();
                        $('.delete-zone').append(deleteTemplate(fileId));
                    } else {
                        postJSON('<?= Router::url(['controller'=> 'Project', 'action'=> 'deleteFile']) ?>/' + getTempoToken(),
                            { name: fileName },
                            function (res) {
                                if(res.status) {
                                    $('.preview-show-' + fileNo).remove();
                                    //deleteTemplate
                                    if(res.error !== undefined) {
                                        pr(res.error);
                                    }
                                } else {
                                    if(res.error !== undefined) {
                                        popupAlert(res.error);
                                    }
                                }
                            });
                    }
                });
            }
        });
    });

    function showTemplate(data) {
        var strViewName = data.view_name;
        var strName = data.name;
        var strDataAttr = 'data-no="' + uploadViewNum + '" data-name="' + strName + '" data-attached-id=""';

        return '<li class="block-file list-group-item d-flex justify-content-between align-items-center preview-show-'+uploadViewNum+'">'
            +'<div class="name-file">'+strViewName+'</div>'
            +'<input type="hidden" name="attached['+uploadViewNum+'][id]" value="">'
            +'<input type="hidden" name="attached['+uploadViewNum+'][name]" value="'+strName+'">'
            +'<input type="hidden" name="attached['+uploadViewNum+'][view_name]" value="'+strViewName+'">'
            +'<i class="fa fa-lg fa-trash delete-file btn btn-sm btn-danger" aria-hidden="true" title="削除する" '+strDataAttr+'></i>'
        +'</li>';
    }

    function deleteTemplate(value) {
        return '<input type="hidden" name="attached_delete_id[]" value="'+value+'">';
    }

    function getTempoToken() {
        return $('#tempo-token').val();
    }
</script>
