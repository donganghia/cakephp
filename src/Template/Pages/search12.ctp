<?php

use Cake\Routing\Router;

?>
<div class="page page_register page_search12" id="search">
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
        <h1 class="title">案件検索</h1>
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
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >顧客名</a></div>
                        <div class="col-xl-8">
                            <input class="w_320" placeholder="顧客名">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >登録日</a></div>
                        <div class="col-xl-8">
                            <input type="text" class="date year" placeholder="年（西暦）">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date month" placeholder="月">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date day" placeholder="日">
                            <span>&nbsp;~&nbsp;</span>
                            <input type="text" class="date year" placeholder="年（西暦）">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date month" placeholder="月">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date day" placeholder="日">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >受注日</a></div>
                        <div class="col-xl-8">
                            <input type="text" class="date year" placeholder="年（西暦）" value="2018">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date month" placeholder="月" value="08">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date day" placeholder="日" value="08">
                            <span>&nbsp;~&nbsp;</span>
                            <input type="text" class="date year" placeholder="年（西暦）" value="2018">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date month" placeholder="月" value="08">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date day" placeholder="日" value="08">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4"><a href="" class="btn-blue btn-row" >作業予定日</a></div>
                        <div class="col-xl-8">
                            <input type="text" class="date year" placeholder="年（西暦）">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date month" placeholder="月">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date day" placeholder="日">
                            <span>&nbsp;~&nbsp;</span>
                            <input type="text" class="date year" placeholder="年（西暦）">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date month" placeholder="月">
                            <span>&nbsp;／&nbsp;</span>
                            <input type="text" class="date day" placeholder="日">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                        状態オプション
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <label for=""><input type="checkbox" value="予定案件"> 予定案件</label>
                            <label for=""><input type="checkbox" value="見積中"> 見積中</label>
                            <label for=""><input type="checkbox" value="予定日未確定"> 予定日未確定</label>
                            <label for=""><input type="checkbox" value="予定日確定済"> 予定日確定済</label>
                            <label for=""><input type="checkbox" value="作業未完了"> 作業未完了</label>
                            <label for=""><input type="checkbox" value="完了報告済み"> 完了報告済み</label>
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

                            <svg class="icon_search float-xl-right" xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                                <g>
                                    <title></title>
                                    <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                    <path stroke-width="0" d="M 10 17.9971 C 5.5825 17.9971 2.0024 14.4175 2.0024 10 C 2.0024 5.5825 5.5825 2.0029 10 2.0029 C 14.4175 2.0029 17.9976 5.5825 17.9976 10 C 17.9976 14.4175 14.4175 17.9971 10 17.9971 ZM 18.565 16.95 L 17.7 16.085 C 19.0234 14.4127 19.8125 12.2986 19.8125 10 C 19.8125 4.5801 15.4199 0.1875 10 0.1875 C 4.5801 0.1875 0.1875 4.5801 0.1875 10 C 0.1875 15.4199 4.5801 19.8125 10 19.8125 C 12.2983 19.8125 14.4125 19.023 16.085 17.7 L 16.95 18.565 C 16.5819 19.2558 16.6879 20.1317 17.2705 20.7139 L 21.8843 25.3291 C 22.5981 26.0425 23.7544 26.0425 24.4678 25.3291 L 25.3291 24.4683 C 26.042 23.7549 26.042 22.5981 25.3291 21.8848 L 20.7148 17.2695 C 20.1323 16.687 19.2561 16.5812 18.565 16.95 ZM 12.0122 14.8579 C 8.0972 14.8579 4.9229 11.6841 4.9229 7.7686 C 4.9229 7.6641 4.9336 7.563 4.9385 7.459 C 4.4219 8.2954 4.1182 9.2783 4.1182 10.3325 C 4.1182 13.3599 6.5718 15.813 9.5986 15.813 C 10.7671 15.813 11.8477 15.4443 12.7383 14.8213 C 12.4995 14.8452 12.2568 14.8579 12.0122 14.8579 Z" style="opacity: 1;"></path>
                                </g>
                            </svg>
                            <svg class="icon_search float-xl-right" xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                                <g>
                                    <title></title>
                                    <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                    <path stroke-width="0" d="M 10.0391 1 L 15.9922 1 L 21 1 C 21.5498 1 22 1.4492 22 2.001 L 22 12.0005 C 22 12.5508 21.5498 13 21 13 L 4.9995 13 C 4.4492 13 4 12.5508 4 12.0005 L 4 7.0752 L 4 2.001 C 4 1.4492 4.4492 1 4.9995 1 L 10.0391 1 ZM 4.2593 25.8613 C 5.8848 25.8613 21.4795 25.8613 21.4795 25.8613 C 23.1348 25.8613 25 24.0869 25 22.4316 L 25 3.0005 C 25 1.3433 23.6563 0 21.999 0 L 16.9834 0 L 9.0479 0 L 4 0 C 2.3433 0 1 1.3433 1 3.0005 L 1 5.8613 L 1 9.9727 C 1 9.9727 1 21.7988 1 22.3408 C 1 24.7773 2.8149 25.8613 4.2593 25.8613 ZM 7 16.999 C 7 16.4492 7.4487 16 7.9995 16 L 19 16 C 19.5508 16 20 16.4492 20 16.999 L 20 23.999 C 20 24.5498 19.5508 25 19 25 L 7.9995 25 C 7.4487 25 7 24.5498 7 23.999 L 7 16.999 ZM 12 17 L 9 17 L 9 24 L 12 24 L 12 17 Z" style="opacity: 1;"></path>
                                </g>
                            </svg>
                            <a href="" class="btn-blue search float-xl-right">検索</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1"></div>
            </div>

        </div>

        <div class="table-control row">
            <div class="col-xl-12 col-lg-12">
                <div class="title">検索結果一覧</div>
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
                        <td><a href="<?= Router::url('/pages/register_confirm_reference'); ?>">EK201801206</a></td>
                        <td><a href="<?= Router::url('/pages/register_confirm_reference'); ?>">1036</a></td>
                        <td><a href="<?= Router::url('/pages/register_confirm_reference'); ?>">山本商店</a></td>
                        <td></td>
                        <td><a href="<?= Router::url('/pages/register_confirm_reference'); ?>">ﾊｳｽｸﾘｰﾆﾝｸﾞ</a></td>
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
            <div class="col-xl-12 col-lg-12">
                <a href="" class="abt float-xl-right csv">CSV出力</a>
            </div>
        </div>

    </div>
</div>
