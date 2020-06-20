<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Libs;

class Constant
{

    const TITLE = 'WebEDI案件管理';
    // ログインコントローラー定義
    static $ROUTE_LOGIN = ['controller' => 'Auth', 'action' => 'login'];
    // ログイン成功時、遷移ページ
    static $ROUTE_LOGIN_REDIRECT = ['controller' => 'Menu', 'action' => 'main'];
    // ログアウト後、遷移ページ
    static $ROUTE_LOGOUT_REDIRECT = ['controller' => 'Auth', 'action' => 'login'];

    // 日付フォーマット
    const YMD_HIS_DB = 'Y-m-d H:i:s';
    const YMD = 'Y-m-d';
    const YMD_JA = 'Y年m月d日';

    // DBの削除フラグの値
    const OFF = 0;
    const ON = 1;

    const SEARCH_EMPTY = ['' => 'すべて'];
    const SELECT_EMPTY = ['' => '-'];
    const SELECT_ALL = ['' => '全体'];
    const REQUIRED_SELECT = ['' => '選択'];

    //clear cache js && css
    const CACHE_TIME = '20190131_1';

    const PAGE_LENGTH = 10;

    //Folder path
    const PROJECT_TEMPS = WWW_ROOT.'uploads/temps/';
    const PROJECT_PATH = WWW_ROOT.'uploads/projects/';
    const EXCEL_TEMPLATE_PATH = WWW_ROOT.'excel/';

}