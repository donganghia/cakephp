<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Libs;

class Message
{

    //data process
    const SAVED = '正常に保存されました。';
    const UNSAVED = '保存できません。';
    const DELETED = '正常に削除されました。';
    const UNDELETED = '削除ができません。';
    const INVALID_PARAM = 'パラメータは無効です。';
    const INVALID_REQUEST = 'リクエストは無効です。';
    const ERROR_OCCURRED = 'エラーが発生しました。';
    const FILE_CORRUPTED = 'ファイルが壊れた。';
    const PERMISSION_DENIED = 'Permission denied';
    const SEND_MAIL_ERROR = 'ご利用頂き、ありがとうございます。<br/>サーバーが異常になっていますので%s秒後、御再度送信下さい。';


    //valid data
    const REQUIRED = '%sは必須項目です。';
    const NOT_SPECIAL_CHARACTER = '%sに特殊文字が含まれています。';
    const WITHIN_1_20 = '%sは１－２０文字内で入力して下さい。';
    const WITHIN_6_20 = '%sは６－２０文字内で入力して下さい。';
    const WITHIN = '%sは%s文字内で入力して下さい。';
    const INCORRECT = '%sが無効な形式です。';
    const FIELD_NOT_FOUND = '%sが見つかりません。';

    const M_CUSTOMER_EDIT_CONFIRM = '顧客マスタを更新しますか？';
    const M_CUSTOMER_EDIT_DONE = '顧客マスタを更新しました';

}