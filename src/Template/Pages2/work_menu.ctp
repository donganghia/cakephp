<?php
use Cake\Routing\Router;
?>
<div class="page work_menu" id="work">
    <div class="navi clearfix row">
        <div class="logo col-md-3 col-lg-3"><?= $this->Html->image('e-kurasilogo.png') ?></div>
        <div class="schedule col-md-7 col-lg-7">
            <div class="row">
                <div class="col-md-4 col-lg-4 title text-center">未確認案件数</div>
                <div class="col-md-4 col-lg-4 title text-center">予定日未返信件数</div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="text-center matter">99 件</div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="text-center matter">99 件</div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2"><a href="<?= Router::url( '/pages2/login'); ?>">ログアウト</a></div>

    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-6 col-lg-6">
                <div class="title-menu-list">業務メニュー</div>
                <div class="menu-list">
                    <div class="row">
                        <div class="col-lg-6"><a href="<?= Router::url( '/pages2/confirm_processing'); ?>" class="abt">案件確認処理</a></div>
                        <div class="col-lg-6"><a href="<?= Router::url( '/pages2/search')?>" class="abt">案件検索</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><a href="<?= Router::url( '/pages2/done')?>" class="abt">作業完了登録</a></div>
                        <div class="col-lg-6"><a href="<?= Router::url( '/pages2/confirm_push')?>" class="abt">督促確認</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><a href="<?= Router::url( '/pages2/contact_comment')?>" class="abt">連絡コメント</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="notice clearfix">
                    <div class="title">お知らせ</div>
                </div>
                <ul class="date">
                    <li><a href="<?= Router::url( '/pages2/confirm_processing2')?>">2018/08/08 17:48 予定日督促受信</a></li>
                    <li><a href="<?= Router::url( '/pages2/confirm_processing2')?>">2018/08/08 12:30 案件登録有り</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-7">
                <div class="title-table">作業予定日未回答リスト</div>
                <table>
                    <thead>
                        <tr>
                            <th>発注番号</th>
                            <th>受注日</th>
                            <th>顧客名</th>
                            <th>カテゴリー</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>10212</td>
                        <td>2018/07/15</td>
                        <td>ABC㈱</td>
                        <td>田中商会</td>
                    </tr>
                    <tr>
                        <td>10225</td>
                        <td>2018/07/18</td>
                        <td>NNN株式会社</td>
                        <td>取引先名</td>
                    </tr>
                    <tr>
                        <td>10230</td>
                        <td>2018/07/25</td>
                        <td>山田一郎</td>
                        <td>株式会社OOO</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
