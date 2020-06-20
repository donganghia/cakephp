<?php
use App\Model\Table\MUserTable;
use App\Model\Table\MSystemTable;
use Cake\Routing\Router;
?>
<?php if($aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI) : ?>
<div class="page work-schedule" id="work">
<?php else : ?>
<div class="page work_menu" id="work">
<?php endif; ?>
<!-- START div -->
    <div class="navi clearfix row">
        <div class="logo col-md-3 col-lg-3"><?= $this->Html->image('e-kurasilogo.png') ?></div>
        <div class="schedule col-md-7 col-lg-7">
            <?php if($aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI) : ?>
                <div class="title">作業予定件数</div>
                <div class="w390">
                    <div class="row">
                        <div class="col">本日　<?= $arySagyouAnken['honjitsu'] ;?> 件</div>
                        <div class="col">明日 <?= $arySagyouAnken['ashita'] ;?>  件</div>
                        <div class="col">明後日 <?= $arySagyouAnken['asatte'] ;?>  件</div>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-md-4 col-lg-4 title text-center">未確認案件数</div>
                    <div class="col-md-4 col-lg-4 title text-center">予定日未返信件数</div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="text-center matter"><?=$countKakuninShoriIchiran?> 件</div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="text-center matter"><?= $countMiKaitouIchiran;?> 件</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-2 col-lg-2"><a href="#" onclick="logout('<?= Router::url('/auth/logout'); ?>')">ログアウト</a></div>
    </div>
    <div class="content">
        <div class="form-group row">
            <div class="col-sm-12">
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('success') ?>
                <?= $this->Flash->render('error') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-6 col-lg-6">
                <div class="title-menu-list">業務メニュー</div>
                <div class="menu-list">
                    <?php if($aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI) : ?>
                        <div class="row">
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Menu', 'action'=> 'juchuuTouroku']); ?>" class="abt">受注登録</a></div>
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Project', 'action'=> 'ankenKensaku']); ?>" class="abt">案件検索</a></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Menu', 'action'=> 'mHoshuTouroku']); ?>" class="abt">マスター保守</a></div>
                            <div class="col-lg-6"><a class="abt coming-soon">その他処理</a></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Menu', 'action'=> 'mKanryouKeijouShori']); ?>" class="abt">完了計上処理</a></div>
                            <div class="col-lg-6"><a class="abt coming-soon" href="#" class="">各種データ抽出</a></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><a class="abt coming-soon">メルマガ管理</a></div>
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Menu', 'action'=> 'shisutemuKanri']); ?>" class="abt">システム管理</a></div>
                        </div>
                    <?php else : ?>
                        <div class="row">
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Project', 'action'=> 'kakunin-shori-ichiran']); ?>" class="abt">案件確認処理</a></div>
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Project', 'action'=> 'anken-kensaku-ichiran']); ?>" class="abt">案件検索</a></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'Project', 'action'=> 'anken-kanryou-touroku']); ?>" class="abt">作業完了登録</a></div>
                            <div class="col-lg-6"><a href-2="<?= Router::url( '/pages2/confirm_push')?>" class="abt coming-soon">督促確認</a></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"><a href="<?= Router::url(['controller'=> 'comment', 'action'=> 'index']); ?>" class="">連絡コメント</a></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="notice clearfix">
                    <div class="title">お知らせ</div>
                    <?php if($aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI) : ?>
                        <?= $this->Form->select('m_system_tantou_id',
                            isset($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) ?
                                $this->VHtml->selectAll($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) : ["" => "全体"],
                            [
                                'class' => 'form-control',
                                'id' => 'm_system_tantou_id',
                                'default' => "",
                            ]); ?>
                    <?php endif; ?>
                </div>
                <ul class="notification" id="notification_data_list">
                    <?php if(!empty($aryOrderNotification)) {
                        foreach ($aryOrderNotification as $v) {
                            echo isset($v['href'])  ? "<li><a href='".$v['href']."'>".$v['title']."</a></li>"
                                                    : "<li>".$v['title']."</li>";
                        }
                    }?>
                </ul>
            </div>
        </div>
        <br>
        <?= $this->element('../Project/mi_kaitou_ichiran', [
            'titleTable' => '作業予定日未回答リスト'
        ]); ?>
    </div>
</div>
    <script type="application/javascript">
        $('#m_system_tantou_id').change(function () {
            ajaxDataForm(
                {'m_system_tantou_id': $('#m_system_tantou_id').val()},
                '<?= Router::url(['controller' => 'Menu', 'action' => 'getOrderNotification']) ?>',
                function (response) {
                   var data = JSON.parse(response);
                   var url;
                    $("#notification_data_list").html(null);
                    if(data.length >0) {
                        data.forEach(function(item) {
                            // do something with `item` notification_data_list
                            url = typeof item.href !== 'undefined' ? item.href : '';
                            $("#notification_data_list").append(
                                url ? "<li><a href='"+url+"'>"+item.title+"</a></li>" : "<li>"+item.title+"</li>"
                            );
                        });
                    }
                }
            );
        });
    </script>