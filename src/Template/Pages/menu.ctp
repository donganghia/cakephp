<?php

use Cake\Routing\Router;

?>
<div class="page work-schedule" id="work">
    <div class="navi clearfix row">
        <div class="logo col-md-3 col-lg-3"><?= $this->Html->image('e-kurasilogo.png') ?></div>
        <div class="schedule col-md-7 col-lg-7">
            <div class="title">作業予定件数</div>
            <div class="w390">
                <div class="row">
                    <div class="col">本日　99 件</div>
                    <div class="col">明日 99 件</div>
                    <div class="col">明後日 99 件</div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2"><a href="<?= Router::url('/auth/logout'); ?>">ログアウト</a></div>

    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-6 col-lg-6">
                <div class="title-menu-list">業務メニュー</div>
                <div class="menu-list">
                    <div class="row">
                        <div class="col-lg-6"><a href="<?= Router::url('/pages/menu_order'); ?>" class="abt">受注登録</a></div>
                        <div class="col-lg-6"><a href="<?= Router::url('/pages/search1'); ?>" class="abt">案件検索</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><a href="<?= Router::url('/pages/master_maintenance'); ?>" class="abt">マスタ保守</a></div>
                        <div class="col-lg-6"><a href="" class="abt">システム管理</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><a href="<?= Router::url('/pages/record_completion'); ?>" class="abt">完了計上処理</a></div>
                        <div class="col-lg-6"><a href="<?= Router::url('/pages/contact_list'); ?>" class="abt">連絡コメント</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><a href="" class="abt">メルマガ管理</a></div>
                    </div>
                </div>
                <a href="" class="btn-menu next">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                        <g>
                            <title></title>
                            <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                            <path stroke-width="0" d="M11.912 2.626c.513 0 .953.184 1.32.551l9.445 9.445c.358.339.537.774.537 1.306 0 .522-.179.962-.537 1.32l-9.445 9.445c-.377.358-.817.537-1.32.537-.493 0-.929-.179-1.306-.537l-1.088-1.088c-.368-.368-.551-.808-.551-1.32 0-.513.184-.953.551-1.32l4.251-4.251h-10.214c-.503 0-.912-.181-1.226-.544-.314-.363-.472-.8-.472-1.313v-1.857c0-.513.157-.95.472-1.313.314-.363.723-.544 1.226-.544h10.214l-4.251-4.266c-.368-.348-.551-.783-.551-1.306 0-.522.184-.958.551-1.306l1.088-1.088c.368-.368.803-.551 1.306-.551z" style="opacity: 1;"></path>
                        </g>
                    </svg>
                </a>
                <a href="" class="btn-menu back">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26" style="transform: rotate(-180deg) scale(1, 1);">
                        <g>
                            <title></title>
                            <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                            <path stroke-width="0" d="M11.912 2.626c.513 0 .953.184 1.32.551l9.445 9.445c.358.339.537.774.537 1.306 0 .522-.179.962-.537 1.32l-9.445 9.445c-.377.358-.817.537-1.32.537-.493 0-.929-.179-1.306-.537l-1.088-1.088c-.368-.368-.551-.808-.551-1.32 0-.513.184-.953.551-1.32l4.251-4.251h-10.214c-.503 0-.912-.181-1.226-.544-.314-.363-.472-.8-.472-1.313v-1.857c0-.513.157-.95.472-1.313.314-.363.723-.544 1.226-.544h10.214l-4.251-4.266c-.368-.348-.551-.783-.551-1.306 0-.522.184-.958.551-1.306l1.088-1.088c.368-.368.803-.551 1.306-.551z" style="opacity: 1;"></path>
                        </g>
                    </svg>
                </a>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="notice clearfix">
                    <div class="title">お知らせ</div>
                    <label for="">
                        <select name="" id="">
                            <option value="">00 全体</option>
                            <option value="">01 中野</option>
                            <option value="">02 兼山</option>
                            <option value="">03 木元</option>
                        </select>
                    </label>
                </div>
                <ul class="date">
                    <li>2018/08/10 13:50 受注登録有り</li>
                    <li>2018/08/09 16:52 予定日登録有り</li>
                    <li>2018/08/08 17:45 予定日督促送信</li>
                    <li>2018/08/08 11:36 受注登録有り</li>
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
                            <th>案件番号</th>
                            <th>受注日</th>
                            <th>顧客名</th>
                            <th>取引先名</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>EK1810212</td>
                        <td>2018/07/15</td>
                        <td>ABC㈱</td>
                        <td>田中商会</td>
                    </tr>
                    <tr>
                        <td>EK1810225</td>
                        <td>2018/07/18</td>
                        <td>NNN株式会社</td>
                        <td>取引先名</td>
                    </tr>
                    <tr>
                        <td>EK1810230</td>
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
