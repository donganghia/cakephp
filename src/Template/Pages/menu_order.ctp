<?php

use Cake\Routing\Router;

?>
<div class="page operation_selection" id="selection">
    <div class="go_back">
        <a href="<?= Router::url('/pages/menu'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                <g>
                    <title></title>
                    <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0"
                          fill="transparent"></rect>
                    <path stroke-width="0"
                          d="M8.357.929c.251 0 .469.092.653.276.184.184.276.401.276.653v3.714h3.25c6.897 0 11.128 1.949 12.695 5.847.513 1.296.769 2.907.769 4.831 0 1.606-.614 3.787-1.843 6.544l-.152.348-.196.435c-.058.126-.121.232-.189.319-.116.164-.251.247-.406.247-.145 0-.259-.048-.341-.145-.082-.097-.123-.218-.123-.363l.036-.384.036-.341c.048-.658.073-1.253.073-1.785 0-.977-.085-1.852-.254-2.626-.169-.774-.404-1.444-.704-2.009-.3-.566-.687-1.054-1.161-1.465-.474-.411-.984-.747-1.531-1.008-.547-.261-1.19-.467-1.93-.617-.74-.15-1.485-.254-2.234-.312-.75-.058-1.598-.087-2.546-.087h-3.25v3.714c0 .251-.092.469-.276.653-.184.184-.401.276-.653.276-.251 0-.469-.092-.653-.276l-7.429-7.429c-.184-.184-.276-.401-.276-.653 0-.251.092-.469.276-.653l7.429-7.429c.184-.184.401-.276.653-.276z"></path>
                </g>
            </svg>
            <span>戻る</span>
        </a>

    </div>
    <div class="content">
        <h1 class="title">登録作業選択</h1>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="row col-lg-8">
                <div class="col-lg-5">新規登録</div>
                <div class="col-lg-2"></div>
                <div class="col-lg-5">既存データ編集</div>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="row col-lg-8">
                <div class="col-lg-5 select_box">
                    <a href="<?= Router::url('/pages/register_schedule'); ?>" class="abt">予定注文登録</a>
                    <a href="<?= Router::url('/pages/register_confirm'); ?>" class="abt">確定注文登録</a>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-5 select_box">
                    <a href="<?= Router::url('/pages/data_schedule'); ?>" class="abt">予定データ一覧</a>
                    <a href="" class="abt">受注済データ一覧</a>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="table-control">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="row col-lg-8">
                    <div class="title">登録未完了一時保存リスト</div>
                    <table>
                        <thead>
                        <tr>
                            <th>案件番号</th>
                            <th>最終更新日</th>
                            <th>顧客名</th>
                            <th>カテゴリー</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>EK1810235</td>
                            <td>2018/08/01</td>
                            <td>㈱NNN</td>
                            <td>ハウスクリーニング</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
