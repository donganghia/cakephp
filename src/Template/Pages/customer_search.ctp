<?php

use Cake\Routing\Router;

?>
<div class="page page_register custom_master" id="customer">
    <div class="navi">
        <h1 class="title">顧客検索</h1>
        <div class="date_schedule clearfix">
            <span>最終更新日</span>
            <input type="text" class="date year" placeholder="<?= date('Y') ?>">
            <span>／</span>
            <input type="text" class="date month" placeholder="<?= date('m') ?>">
            <span>／</span>
            <input type="text" class="date day" placeholder="<?= date('d') ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="content">
        <div class="info">
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">会員番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                    <div class="col-xl-2">会員種類</div>
                    <div class="col-xl-3"><input type="text" class="input w_29" placeholder="00"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">検索対象</div>
                    <div class="col-xl-10">
                        <label for=""><input type="checkbox" checked> 申込者</label>
                        <label for=""><input type="checkbox" checked> 得意先</label>
                        <label for=""><input type="checkbox" checked> 需要先</label>
                        <label for=""><input type="checkbox" checked> その他</label>
                    </div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">会員種別</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">01 一般会員</option>
                                <option value="">02 くらし安心会員</option>
                                <option value="">03 くらし楽とく会員</option>
                                <option value="">04 暮らしサポートセット会員</option>
                                <option value="">05 非会員</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">氏名</div>
                    <div class="col-xl-8"><input type="text" class="input" placeholder="テスト"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">担当者名</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">999999 代表</option>
                                <option value="">1 中野</option>
                                <option value="">3 瀬戸</option>
                                <option value="">6 兼山</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">カナ</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">支払区分</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">0 商品設定</option>
                                <option value="">1 税抜き</option>
                                <option value="">2 税込</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">郵便番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                    <div class="col-xl-2">都道府県</div>
                    <div class="col-xl-3">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">愛知県</option>
                                <option value="">東京都</option>
                                <option value="">大阪府</option>
                                <option value="">京都府</option>
                                <option value="">広島県</option>
                                <option value="">福岡県</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">源泉</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">0 商品設定</option>
                                <option value="">1 税抜き</option>
                                <option value="">2 税込</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">市区町村番地</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">ビル名等</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">電話番号</div>
                    <div class="col-xl-2"><input type="text" class="input"></div>
                    <div class="col-xl-2">携帯電話</div>
                    <div class="col-xl-2"><input type="text" class="input"></div>
                    <div class="col-xl-2">FAX番号</div>
                    <div class="col-xl-2"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">ﾒｰﾙｱﾄﾞﾚｽ</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                </div>
            </div>

        </div>
        <div class="clearfix">
            <a href="" class="abt search float-right">検索</a>
        </div>
        <div class="title">検索結果一覧</div>
        <div class="table-control scroll">
            <table class="w_2000">
                <thead>
                <tr>
                    <th style="width: 52px;">操作</th>
                    <th style="width: 58px;">対象</th>
                    <th style="width: 81px;">会員種別</th>
                    <th style="width: 158px;">氏名</th>
                    <th style="width: 74px;">カナ</th>
                    <th style="width: 52px;">略称</th>
                    <th style="width: 80px;">郵便番号</th>
                    <th style="width: 83px;">都道府県名</th>
                    <th style="width: 122px;">市区町村番地</th>
                    <th style="width: 111px;">電話番号</th>
                    <th style="width: 97px;">携帯番号</th>
                    <th style="width: 103px;">FAX番号</th>
                    <th style="width: 150px;">ﾒｰﾙｱﾄﾞﾚｽ</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">
                        <input type="radio">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 10 17.9971 C 5.5825 17.9971 2.0024 14.4175 2.0024 10 C 2.0024 5.5825 5.5825 2.0029 10 2.0029 C 14.4175 2.0029 17.9976 5.5825 17.9976 10 C 17.9976 14.4175 14.4175 17.9971 10 17.9971 ZM 18.565 16.95 L 17.7 16.085 C 19.0234 14.4127 19.8125 12.2986 19.8125 10 C 19.8125 4.5801 15.4199 0.1875 10 0.1875 C 4.5801 0.1875 0.1875 4.5801 0.1875 10 C 0.1875 15.4199 4.5801 19.8125 10 19.8125 C 12.2983 19.8125 14.4125 19.023 16.085 17.7 L 16.95 18.565 C 16.5819 19.2558 16.6879 20.1317 17.2705 20.7139 L 21.8843 25.3291 C 22.5981 26.0425 23.7544 26.0425 24.4678 25.3291 L 25.3291 24.4683 C 26.042 23.7549 26.042 22.5981 25.3291 21.8848 L 20.7148 17.2695 C 20.1323 16.687 19.2561 16.5812 18.565 16.95 ZM 12.0122 14.8579 C 8.0972 14.8579 4.9229 11.6841 4.9229 7.7686 C 4.9229 7.6641 4.9336 7.563 4.9385 7.459 C 4.4219 8.2954 4.1182 9.2783 4.1182 10.3325 C 4.1182 13.3599 6.5718 15.813 9.5986 15.813 C 10.7671 15.813 11.8477 15.4443 12.7383 14.8213 C 12.4995 14.8452 12.2568 14.8579 12.0122 14.8579 Z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>申込者</td>
                    <td>02 くらし安心会員</td>
                    <td>テスト</td>
                    <td>テスト</td>
                    <td></td>
                    <td>460-0001</td>
                    <td>愛知県</td>
                    <td>名古屋市中区三の丸０－０－０</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">
                        <input type="radio">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 10 17.9971 C 5.5825 17.9971 2.0024 14.4175 2.0024 10 C 2.0024 5.5825 5.5825 2.0029 10 2.0029 C 14.4175 2.0029 17.9976 5.5825 17.9976 10 C 17.9976 14.4175 14.4175 17.9971 10 17.9971 ZM 18.565 16.95 L 17.7 16.085 C 19.0234 14.4127 19.8125 12.2986 19.8125 10 C 19.8125 4.5801 15.4199 0.1875 10 0.1875 C 4.5801 0.1875 0.1875 4.5801 0.1875 10 C 0.1875 15.4199 4.5801 19.8125 10 19.8125 C 12.2983 19.8125 14.4125 19.023 16.085 17.7 L 16.95 18.565 C 16.5819 19.2558 16.6879 20.1317 17.2705 20.7139 L 21.8843 25.3291 C 22.5981 26.0425 23.7544 26.0425 24.4678 25.3291 L 25.3291 24.4683 C 26.042 23.7549 26.042 22.5981 25.3291 21.8848 L 20.7148 17.2695 C 20.1323 16.687 19.2561 16.5812 18.565 16.95 ZM 12.0122 14.8579 C 8.0972 14.8579 4.9229 11.6841 4.9229 7.7686 C 4.9229 7.6641 4.9336 7.563 4.9385 7.459 C 4.4219 8.2954 4.1182 9.2783 4.1182 10.3325 C 4.1182 13.3599 6.5718 15.813 9.5986 15.813 C 10.7671 15.813 11.8477 15.4443 12.7383 14.8213 C 12.4995 14.8452 12.2568 14.8579 12.0122 14.8579 Z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>申込者</td>
                    <td>05 非会員</td>
                    <td>テスト1</td>
                    <td>テスト1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">
                        <input type="radio">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 10 17.9971 C 5.5825 17.9971 2.0024 14.4175 2.0024 10 C 2.0024 5.5825 5.5825 2.0029 10 2.0029 C 14.4175 2.0029 17.9976 5.5825 17.9976 10 C 17.9976 14.4175 14.4175 17.9971 10 17.9971 ZM 18.565 16.95 L 17.7 16.085 C 19.0234 14.4127 19.8125 12.2986 19.8125 10 C 19.8125 4.5801 15.4199 0.1875 10 0.1875 C 4.5801 0.1875 0.1875 4.5801 0.1875 10 C 0.1875 15.4199 4.5801 19.8125 10 19.8125 C 12.2983 19.8125 14.4125 19.023 16.085 17.7 L 16.95 18.565 C 16.5819 19.2558 16.6879 20.1317 17.2705 20.7139 L 21.8843 25.3291 C 22.5981 26.0425 23.7544 26.0425 24.4678 25.3291 L 25.3291 24.4683 C 26.042 23.7549 26.042 22.5981 25.3291 21.8848 L 20.7148 17.2695 C 20.1323 16.687 19.2561 16.5812 18.565 16.95 ZM 12.0122 14.8579 C 8.0972 14.8579 4.9229 11.6841 4.9229 7.7686 C 4.9229 7.6641 4.9336 7.563 4.9385 7.459 C 4.4219 8.2954 4.1182 9.2783 4.1182 10.3325 C 4.1182 13.3599 6.5718 15.813 9.5986 15.813 C 10.7671 15.813 11.8477 15.4443 12.7383 14.8213 C 12.4995 14.8452 12.2568 14.8579 12.0122 14.8579 Z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>申込者</td>
                    <td>05 非会員</td>
                    <td>仮テスト</td>
                    <td>カリテスト</td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                    <td></td>
                    <td></td>
                    <td></td>
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="attack">
            <div class="row">
                <div class="col-xl-1"></div>
                <div class="col-xl-5"></div>
                <div class="col-xl-6">
                    <a href="<?= Router::url('/pages/registerSchedule'); ?>" class="abt register">確定</a>
                    <a href="" class="abt cancel">キャンセル</a>
                </div>
            </div>
        </div>
    </div>
</div>
