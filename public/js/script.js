function getModuleName() {
    //взять id объекта модуля из скрытого input на странице
    return $("#module-code").attr('value');
}

function resetSortButtons() {
    //вернуть иконки сортировок в первоначальный вид
    $('.sort-button').removeClass("sort-button_active");
    $('.sort-button').removeClass("sort-button_active-desc");
    $('.sort-button').removeClass("sort-button_active-asc");
    $('.sort-button').attr('value','desc');
}

function refreshRecords(records) {
    //загрузить новые записи в таблицу объектов модуля + загрузить функционал чекбоксов и кнопок удаления
    $(".records-table tbody").html(records);

    $(".checkbox-main").prop('checked', false);
    $(".checkbox-table").prop('checked', false);
    $(".checkbox-main").change(function() {
        if ($(this).is(':checked')) {
            $(".checkbox-table").prop('checked', true);
        } else {
            $(".checkbox-table").prop('checked', false);
        }
    });
    $(".checkbox-table").change(function() {
        if (!$(this).is(':checked')) {
            if ($(".checkbox-main").is(':checked')) {
                $(".checkbox-main").prop('checked', false);
            }
        }
    });

    $(".delete-button").click(function() {
        deleteConfirmation($(this).attr('name'));
    })
    $(".delete-all-button").click(function() {
        if ($(".checkbox-table:checked").length > 0) {
            deleteConfirmation();
        }
    })
}

function getRecords() {
    //ajax на получение новых записей в таблицу согласно парамертам запроса

    if (getModuleName()==undefined) return;

    let params = {
        'search_field': $(".search-select select option:selected").val(),
        'search_value' : $(".search-input input").val(),
        'sort' : $('.sort-button_active').attr('id'),
        'order' : $('.sort-button_active').attr('value')
    };
         
    $.ajax({
        type: "GET",
        url: "/" + getModuleName() + "/getRecords",
        data: params,
        success: function(records) {
            refreshRecords(records);
        }
    });
}


function deleteConfirmation(delete_val) {

    if (delete_val) {
        $('.confirmation__agree').val(delete_val)
    } else {
        $('.confirmation__agree').val('')
    }
    viewModalWindow($('.delete-confirmation').html());

}

function deleteRecords(delete_arr) {
    //ajax на удаление выбранных записей с последующим обновлением записей таблицы
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: "/" + getModuleName() + "/delete",
        data: { '_token': CSRF_TOKEN, 'deleting': delete_arr },
        success: function(records) {
            refreshRecords(records);
            resetSortButtons();
        }
    });
}

function completeTask(task_id) {
    //ajax на сообщение о выполнении задачи
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: "/complete",
        data: { '_token': CSRF_TOKEN, 'task_id': task_id },
        success: function(data) {
            $(".mytasks").html(data);
        }
    });
}

function setDatepicker(elem) {
    //локализация и установка календаря на input из виджета jqueryui datepicker
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '&#x3c;Пред',
        nextText: 'След&#x3e;',
        currentText: 'Сегодня',
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ],
        monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ],
        dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
        dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        weekHeader: 'Нед',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };

    elem.datepicker($.extend({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
        },
        $.datepicker.regional['ru']
    ));

}

function modalWindowFunctional() {
    //скрипт, действующий внутри модальных окон


    /*
    1. Функционал для модального окна "Потоки и этапы":
        - установка виджетов, 
        - кнопка "назад",
        - ajax запросы на добавление, изменение, удаление потоков и этапов
        при нажатии соответствующих кнопок
    */

    $(".flows-list").accordion();   

    $(".flows-stages-back").click(function() {
        event.preventDefault();
        
        $(".flows-stages__control").click();
    })

    $(".flows-add").click(function(event) {
        event.preventDefault();
        let project = $("input[name='id']").val();
        if (project == '') project=0;
        $.ajax({
            type: "GET",
            url: "/flows/control/"+project+"/0",
            success: function(content) {
                viewModalWindow(content);
            }
        });   
    });

    $(".flow-item__edit").click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        let project = $("input[name='id']").val();
        if (project == '') project=0;
        $.ajax({
            type: "GET",
            url: "/flows/control/"+project+"/" + $(this).val(),
            success: function(content) {
                viewModalWindow(content);
            }
        });   
    });

    $(".flow-item__delete").click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "/flows/delete",
            data: { '_token': CSRF_TOKEN, 'deleting': $(this).val() },
            success: function(content) {
                $(".flows-stages__control").click();
            }
        });   
    });

    $(".flow-save").click(function() {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "/flows/save",
                data: $(".flow-form").serialize(),
                success: function(content) {
                    if (content == '') {
                        $(".flows-stages__control").click();
                    } else if (content.match(/^\d+$/)) {
                        $("input[name='flows']").val($("input[name='flows']").val()+content+';');
                        $(".flows-stages__control").click();
                    } else {
                        viewModalWindow(content);
                    }
                }
            });
    });


    $(".stages-add").click(function() {
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: "/stages/control/"+$(this).val()+"/0",
            success: function(content) {
                viewModalWindow(content);
            }
        }); 

    })

    $(".stage-item__edit").click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: "/stages/control/0/" + $(this).val(),
            success: function(content) {
                viewModalWindow(content);
            }
        });   
    });

    $(".stage-item__delete").click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "/stages/delete",
            data: { '_token': CSRF_TOKEN, 'deleting': $(this).val() },
            success: function(content) {
                $(".flows-stages__control").click();
            }
        });   
    });

    $(".stage-save").click(function() {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "/stages/save",
                data: $(".stage-form").serialize(),
                success: function(content) {
                    if (content == '') {
                        $(".flows-stages__control").click();
                    } else {
                        viewModalWindow(content);
                    }
                }
            });
    });

    //2. Функционал для модального окна "Подтверждение удаления"

    $(".confirmation__agree").click(function() {

        let deleting = [];

        if ($(this).val() != '') {
            deleting = [$(this).val()];
        } else {
            $(".checkbox-table:checked").each(function() {
                deleting.push($(this).val());
            })  
        }

        $.fancybox.close();
        deleteRecords(deleting);

    })


}

function viewModalWindow (content) {
    //открыть новое модальное окно с данным содержимым, загрузить в него функционал 

    $.fancybox.close();
    $("#fancybox-content").show();
    $(".fancybox-init").fancybox({afterLoad: function() {
        modalWindowFunctional() 
    }});
    $("#fancybox-content").html(content);
    $(".fancybox-init").click();
}


$(document).ready(function() {

    //главный скрипт


    
    //1. первичная загрузка данных в таблицу модулей
    
    if ($(".records-table").length > 0) {
        getRecords();
    }



    //2. запуск поиска новых записей при разных действиях

    if ($(".search-input input").length > 0) {

        if ($(".search-input input").val()!='') getRecords();;
        $(".search-input input").keyup(function() { getRecords(); });
        $(".search-input button").click(function() { getRecords(); });
        $(".search-select select").change(function() { getRecords(); });

    }
    


    //4. запуск отправки мгновенного сообщения о выполнении задачи

    $(".complete-button").click(function() {
        let task_id = $(this).attr('name');
        completeTask(task_id);
    })


    //5. запуск сортировки записей таблицы при нажатии на кнопку сортировки

    $(".sort-button").click(function () {
        let sort = $(this).attr('id'); 
        let order = $(this).attr('value');
        resetSortButtons();
        new_order = (order=='asc') ? 'desc' : 'asc';
        $(this).attr('value',new_order);
        $(this).addClass('sort-button_active');
        $(this).addClass('sort-button_active-'+order);
        getRecords();
    })


    //6. обработка всплывающего уведомления

    if ($('.message').length > 0) {
        $('.message').show('fade',1000);
        setTimeout(function() {$('.message').hide('fade',1000)}, 2000)
        
    }


    //7. установка функционала полям в формах создания/редактирования объектов

    //запуск календаря в поле даты    
    setDatepicker($('.modal-calendar'));

    //маска ввода для поля телефона
    $(".phone-masked").mask("+7(999) 999-9999");

    //маска ввода для поля планируемого времени
    $('.modal-clock').mask("99 ч 99 мин");

    //функционал кнопки настройки поля потоков и этапов
    $(".flows-stages__control").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: "/projects/flows",
                data: $(".object-form").serialize(),
                success: function(content) {
                    viewModalWindow(content);
                }
            });
    });

     $( "#tabs" ).tabs();

     //8

     $('.navigation__link_acount').click(function() {
        if ($('.acount-panel').css('display') =='none') {
            $('.acount-panel').show();
        } else {
            $('.acount-panel').hide();
        }
     })

     $('.acount-panel__link_logout').click(function() {
        $('.acount-panel__form').submit();
     })


});