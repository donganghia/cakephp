$(function () {
    $('#error-msg').click(function () {
        $(this).remove();
    });
    $('#success-msg').click(function () {
        $(this).remove();
    });

    initDatePicker('.datepicker');
    initDatetimePicker('.datetimepicker');
    initTimePicker('.timepicker');

    $('.coming-soon').click(function () {
        popupAlert('Coming soon');
    }).css({color: 'red'});
});

function logout(url) {
    popupConfirm('ログアウトします。宜しいですか？', function() {
        window.location.href = url;
    });
}

function popupDataForm(title, content, callBackFunc, callBackFuncClose, callBackFuncContentLoaded) {
    $.confirm({
        title: title,
        content: content,
        columnClass: 'col-md-12',
        draggable: false,
        buttons: {
            formSubmit: {
                text: '確定',
                btnClass: 'btn-blue',
                action: callBackFunc
            },
            cancel: {
                text: 'キャンセル',
                action: callBackFuncClose
            }
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$formSubmit.trigger('click'); // reference the button and click it
            });
        },
        // contentLoaded: function(data, status, xhr){
        onOpen: callBackFuncContentLoaded
    });
}

function ajaxDataForm(params, url, callBackFunc, token) {
    return $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-Token': token
        },
        data: params,
        url: url,
        cache: false,
        success: callBackFunc
    }).fail(function () {
        popupAlert('request fail');
    });
}

function ajaxUploadForm(file, url, callBackFunc, token) {
    var formData = new FormData();
    formData.append( "file", file );

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-Token': token
        },
        data: formData,
        url: url,
        cache: false,
        processData: false,
        contentType: false,
        success: callBackFunc
    }).fail(function () {
        popupAlert('request fail');
    });
}

function validMoney(e) {
    var val = $(e).val();
    var valConverted = convertMoneyToNumber(val);

    //reset input value
    if(!$.isNumeric(valConverted) && !valConverted) {
        valConverted = 0;
    }
    $(e).val(convertNumberToMoney(valConverted));
}

function validInt(e) {
    $(e).val(floatNumber($(e).val()));
}

function rowTemplate(type, fieldName, value) {
    var txt = '';
    var input = '';
    if(type === 'hidden') {
        txt = value;
    } else if(fieldName !== 'koudo' && fieldName !== 'mei') {
        input = 'oninput="validMoney(this)"';
    }

    if(fieldName === 'suuryou') {
        input = 'oninput="validInt(this)" maxlength="5"';
    }

    return '<td>'
        +'<input class="form-control" '+input+' type="'+type+'" name="order_detail['+fieldName+'][]" value="'+value+'"/>'
        + txt
        +'</td>';
}

function downloadCsvData(response) {
    var result = JSON.parse(response);
    var blob = new Blob([result.csvData],{type: "text/csv;charset=utf-8;"});

    if (navigator.msSaveBlob) {
        navigator.msSaveBlob(blob, result.fileName)  ;
    } else {
        var link = document.createElement("a");
        var csvUrl = URL.createObjectURL(blob);
        link.href = csvUrl;
        link.style = "visibility:hidden";
        link.download = result.fileName;

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

function popupConfirm(content, callBackFunc, callBackFuncClose, title) {
    if(typeof(title) == "undefined") {
        title = '確認';
    }

    title += '<hr>';

    $.confirm({
        title: title,
        content: content,
        animation: 'opacity',
        closeAnimation: 'opacity',
        animateFromElement: false,
        draggable: false,
        buttons: {
            ok: {
                btnClass: 'btn-primary',
                text: '確定',
                action: function(){
                    if (callBackFunc) {
                        callBackFunc();
                    }
                }
            },
            close: {
                text: 'キャンセル',
                action: function(){
                    if (callBackFuncClose) {
                        callBackFuncClose();
                    }
                }
            }
        }
    });
}

function popupAlert (content, callBackFunc, btnText) {
    if(typeof(btnText) == "undefined") {
        btnText = '閉じる';
    }
    $.confirm({
        title: '通知<hr>',
        content: content,
        animation: 'opacity',
        closeAnimation: 'opacity',
        animateFromElement: false,
        draggable: false,
        buttons: {
            ok: {
                btnClass: 'btn-primary',
                text: btnText,
                action: callBackFunc
            }
        }
    });
}

function getJSON(requestPath, params, callBackFunc, obj) {
    $.getJSON(requestPath, params, function (data, textStatus, jqXHR) {
        if (textStatus === 'success') {
            if (callBackFunc) {
                callBackFunc(data, obj);
            }
        } else {
            pr(data);
        }
    }).fail(function (jqXHR, textStatus, error) {
        pr(error);
    });
}

function postJSON(requestPath, params, callBackFunc, obj) {
    $.post(requestPath, params, function (data, textStatus, jqXHR) {
        if (textStatus === 'success') {
            if (callBackFunc) {
                callBackFunc(data, obj);
            }
        } else {
            pr(data);
        }
    }, 'json').fail(function (jqXHR, textStatus, error) {
        pr(error);
    });
}

function tableDelete(url) {
    popupConfirm('削除します。宜しいですか？', function () {
        window.location.href = url;
    });
}

function pr(v) {
    return console.log(v);
}

function floatNumber(t) {
    var times = 0;
    return  ((t + '').replace(/[！-～]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    })).replace(/[。．]+/g, '.')
        .replace(/^\.|[^0-9.]/g, '')
        .replace(/\./g, function (c) {
            times++;
            return (times==1)? c:'';
        });
}

function initDatatable(table_id, config) {
    config.language = {
        "emptyTable":     "条件に一致するデータが見つかりません。",
        "info":           " _TOTAL_ 件中 _START_ から _END_ まで表示",
        "infoEmpty":      " 0 件中 0 から 0 まで表示",
        "infoFiltered":   "（全 _MAX_ 件より抽出）",
        "infoPostFix":    "",
        "infoThousands":  ",",
        "loadingRecords": "読み込み中...",
        "processing":     "処理中...",
        "zeroRecords":    "条件に一致するデータが見つかりません。",
        "paginate": {
            "first":    "先頭",
            "last":     "最終",
            "next":     "次",
            "previous": "前"
        }
    };
    config.dom = '<"text"><"top" <"pull-left" i><"pull-right" p>><"clearfix">rt<"bottom" <"pull-left" i><"pull-right" p>><"clearfix">';
    config.pageLength = $PAGE_LENGTH;
    config.processing = true;
    config.serverSide = true;
    config.paging = true;
    $.each(config.columns, function( index, value ) {
        if(typeof value.name !== 'undefined' && value.name !== "action") {
            value.render  = $.fn.dataTable.render.text();
            value.orderable = false;
        }
    });

    return $(table_id).DataTable(config);
}

function initDatePicker(listId) {
    initPicker(listId, 'YYYY/MM/DD', '（西暦）年/月/日');
}

function initDatetimePicker(listId) {
    initPicker(listId, 'YYYY/MM/DD HH:mm:ss', '（西暦）年/月/日 00:00:00');
}

function initTimePicker(listId) {
    if($(listId).length > 0) {

        $(listId).addClass('text-right');

        $.each($(listId), function(index, e) {
            if(!$(e).attr('placeholder')) {
                $(e).attr('placeholder', '00:00');
            }
            new Cleave(e, {
                time: true,
                timePattern: ['h', 'm']
            });
        });
    }
}

function initPicker(listId, format, placeholder) {
    if($(listId).length > 0) {
        $(listId).datetimepicker({
            useCurrent: false,
            showClear: true,
            showClose: true,
            locale: moment.locale('ja'),
            format: format
        }).addClass('text-right');

        $.each($(listId), function( index, e ) {
            if(!$(e).attr('placeholder')) {
                $(e).attr('placeholder', placeholder);
            }
        });
    }
}

function initNumeral(listId) {
    if($(listId).length > 0) {
        $.each($(listId), function(index, e) {
            new Cleave(listId, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    }
}

function fileInput(listId, config) {
    if($(listId).length > 0) {
        var initConfig = {
            theme: "explorer",
            language: 'ja',
            allowedFileExtensions : ['jpg', 'jpeg', 'png','xls','xlsx','doc','docx','pdf','txt','csv','rtf'],
            browseClass: 'btn btn-sm btn-primary',
            removeClass: 'btn btn-sm btn-danger btn-secondary',
            cancelClass: 'btn btn-sm btn-default btn-secondary',
            uploadClass: 'btn btn-sm btn-primary btn-secondary',
            elErrorContainer: '#kartik-file-errors',
            overwriteInitial: false,
            browseOnZoneClick: false,
            showClose: false,
            showPreview: true,
            showCaption: false,
            dropZoneEnabled: false,
            maxFileSize: 5*1024,
            maxFileCount: 10,
            fileActionSettings: {
                showDownload: false,
                showZoom: false,
                showDrag: false
            },
            uploadExtraData: {
                img_key: "1000",
                img_keywords: "happy, nature"
            },
            preferIconicPreview: true,
        };

        if(typeof(config) != undefined) {
            $.extend(initConfig, config);
        }

        return $(listId).fileinput(initConfig);
    }
}

const formatter = new Intl.NumberFormat('ja-JP', {
    style: 'currency',
    currency: 'JPY'
});

function convertNumberToMoney(number) {
    return formatter.format(number);
}

function convertMoneyToNumber(money) {
    return typeof  money !== 'undefined' ? money.replace(/[^\d.]/g, '') : null;
}

// ファイルサイズ表示
function formatBytes(bytes, decimals) {
    if(bytes == 0) return '0 Byte';
    var k = 1000; // or 1024 for binary
    var dm = decimals + 1 || 3;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function getExt(file) {
    return file.split('.').pop();
}

function clearForm(formId, callBackFunc) {
    // $(formId + ' input, ' + formId + ' textarea, ' + formId + ' select').each(function() {
        /*if ($(this).prop('tagName') == 'INPUT' && ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox')) {
            $(this).prop('checked', false);
        } else {
            $(this).val('');
        }*/
    // });

    $(formId)[0].reset();;
    if (callBackFunc) {
        callBackFunc();
    }
}

function showLoader(on) {
    if (on === false) {
        $('#process-content').modal('hide');
    } else {
        $('#process-content').modal('show');
    }
}