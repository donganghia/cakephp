<?php

use Cake\Routing\Router;

?>
<div class="page page_register record_completion" id="search">
    <div class="navi">
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
        <h1 class="title">完了計上処理</h1>
    </div>
    <div class="content">
        <div class="info">
            <div class="row">
                <div class="col-xl-1"></div>
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >案件番号</a></div>
                        <div class="col-xl-8">
                            <input class="w_320" placeholder="案件番号">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >受注番号</a></div>
                        <div class="col-xl-8">
                            <input class="w_320" placeholder="受注番号">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >顧客名</a></div>
                        <div class="col-xl-8">
                            <input class="w_320" placeholder="顧客名">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >作業完了日</a></div>
                        <div class="col-xl-8">
                            <input type="text" class="date year" placeholder="年（西暦）">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date month" placeholder="月">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date day" placeholder="日">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <a href="" class="plus">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                                    <g>
                                        <title></title>
                                        <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                        <path stroke-width="0" d="M12.071 6.5c-.251 0-.469.092-.653.276-.184.184-.276.401-.276.653v3.714h-3.714c-.251 0-.469.092-.653.276-.184.184-.276.401-.276.653v1.857c0 .251.092.469.276.653.184.184.401.276.653.276h3.714v3.714c0 .251.092.469.276.653.184.184.401.276.653.276h1.857c.251 0 .469-.092.653-.276.184-.184.276-.401.276-.653v-3.714h3.714c.251 0 .469-.092.653-.276.184-.184.276-.401.276-.653v-1.857c0-.251-.092-.469-.276-.653-.184-.184-.401-.276-.653-.276h-3.714v-3.714c0-.251-.092-.469-.276-.653-.184-.184-.401-.276-.653-.276h-1.857zm.929-4.643c2.022 0 3.886.498 5.593 1.494 1.707.996 3.059 2.348 4.055 4.055.996 1.707 1.494 3.572 1.494 5.593 0 2.022-.498 3.886-1.494 5.593-.996 1.707-2.348 3.059-4.055 4.055-1.707.996-3.572 1.494-5.593 1.494-2.022 0-3.886-.498-5.593-1.494-1.707-.996-3.059-2.348-4.055-4.055-.996-1.707-1.494-3.572-1.494-5.593 0-2.022.498-3.886 1.494-5.593.996-1.707 2.348-3.059 4.055-4.055 1.707-.996 3.572-1.494 5.593-1.494z" style="opacity: 1;"></path>
                                    </g>
                                </svg>
                                詳細検索
                            </a>


                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-xl-12">
                            <a href="" class="btn-blue search float-xl-right">検索</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1"></div>
            </div>

        </div>

        <div class="table-control row">
            <div class="col-xl-12 col-lg-12">
                <div class="title">作業完了案件一覧</div>
                <table>
                    <thead>
                    <tr>
                        <th style="width: 166px;">案件番号</th>
                        <th style="width: 166px;">受注番号</th>
                        <th style="width: 166px;">顧客名</th>
                        <th style="width: 166px;">作業予定日</th>
                        <th style="width: 166px;">カテゴリー</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a href="<?= Router::url('/pages/account_processing'); ?>">EK20181206</a></td>
                        <td><a href="<?= Router::url('/pages/account_processing'); ?>">1036</a></td>
                        <td><a href="<?= Router::url('/pages/account_processing'); ?>">山本商店</a></td>
                        <td><a href="<?= Router::url('/pages/account_processing'); ?>">2018/08/26</a></td>
                        <td><a href="<?= Router::url('/pages/account_processing'); ?>">ﾊｳｽｸﾘｰﾆﾝｸﾞ</a></td>
                    </tr>
                    <tr>
                        <td></td>
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
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
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
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <div class="title">完了済み未計上一覧</div>
                <table>
                    <thead>
                    <tr>
                        <th style="width: 166px;">案件番号</th>
                        <th style="width: 166px;">受注番号</th>
                        <th style="width: 166px;">顧客名</th>
                        <th style="width: 166px;">作業予定日</th>
                        <th style="width: 166px;">カテゴリー</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
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
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
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
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
