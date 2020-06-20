
<?php
  use App\Libs\Utility;
  use Cake\Routing\Router;

  if(!isset($order_comment_details)) {
    $order_comment_details = [];
  }

  if(!isset($login_user)) {
    $login_user = null;
  }

  if(!isset($modal_id)) {
    $modal_id = "modalComment";
  }

?>

<div id="<?= $modal_id ?>" class="modal fade modal-comment modal-comment-<?= $order_encrypted ?>-<?= $m_supplier_encrypted ?>" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1>
          <span class="badge badge-danger">連絡事項</span>
          <i style="color: #5e5858;" class="fa fa-comments-o"></i>
         </h1>
      </div>
      <div class="modal-body">
      
        <div class="comments">
          <?php foreach($order_comment_details as $order_comment_detail) {
            if($login_user && $login_user["id"] == $order_comment_detail->m_user_id) { ?>
              <div class="comment-wrapper">
                <div class="comment-info">
                  <i class="fa fa-commenting"></i>
                  <span><?= $order_comment_detail->m_user->name ?>: <?= Utility::dateFull($order_comment_detail->created) ?></span>
                </div>
                <div class="comment-content"><?= htmlentities($order_comment_detail->content) ?></div>
              </div>
            <?php } else { ?>
              <div class="comment-wrapper">
                <div class="comment-info">
                  <i class="fa fa-commenting-o"></i>
                  <span><?= $order_comment_detail->m_user->name ?>: <?= Utility::dateFull($order_comment_detail->created) ?></span>
                </div>
                <div class="comment-content"><?= htmlentities($order_comment_detail->content) ?></div>
              </div>
            <?php }} ?>
        </div>        

        <div class="comment-wrapper" style="margin-bottom: 0;">
          <div class="comment-info comment-user">
            <i class="fa fa-user-circle-o"></i>
            <span><?= $login_user? $login_user["name"] : "" ?></span>
          </div>
          <textarea class="comment-input" placeholder="文字入力欄"></textarea>
        </div>
      </div>
      <div class="modal-footer" style="display: block; text-align: left;">
        <button type="button" class="btn btn-dark" data-dismiss="modal">キャンセル</button>
        <button type="button" class="btn btn-primary btn-save-comment">追加完了</button>
      </div>
    </div>

  </div>
</div>


<script class="modal-comment-<?= $order_encrypted ?>-<?= $m_supplier_encrypted ?>">
  $("#<?= $modal_id ?>").on("hidden.bs.modal", function(){
    $(".modal-comment-<?= $order_encrypted ?>-<?= $m_supplier_encrypted ?>").remove();
  });	

  $("#<?= $modal_id ?>").on("shown.bs.modal", function(){
    var lastCommentContent = $(this).find(".comment-content").last();
    if(lastCommentContent.length > 0) {
      lastCommentContent[0].scrollIntoView();
    }
  });	

  $("#<?= $modal_id ?> .btn-save-comment").on("click", function(e) {
    e.preventDefault();
    var content = $("#<?= $modal_id ?> .comment-input").val();
    if(!content) {
      $("#<?= $modal_id ?> .comment-input").focus();
      return;
    }

    var params = {
      project_id: '<?= $project_encrypted ?>',
      order_id: '<?= $order_encrypted ?>',
      m_supplier_id: '<?= $m_supplier_encrypted ?>',
      content: content,
    };
    var url = '<?= Router::url(['controller' => 'Comment', 'action' => 'saveComment']) ?>';
    var token = '<?= json_encode($this->request->getParam('_csrfToken')) ?>';

    ajaxDataForm(params, url, function(response){
        response = JSON.parse(response);
        if(response.success) {
          $("#<?= $modal_id ?>").modal("hide");      
          if(typeof(saveCommentCallback) !== "undefined" && saveCommentCallback)   {
            saveCommentCallback(response);
          }  
        }
        else {
          popupAlert(response.message);
        }
    }, token);    
  });

  $("#<?= $modal_id ?>").modal("show");
</script>