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
    //загрузить новые записи в таблицу объектов модуля + загрузить функционал табличных элементов
    $(".records-table tbody").html(records);

    $(".checkbox-main").prop('checked', false);
    $(".checkbox-table").prop('checked', false);
    $(".checkbox-main").change(function() {
        if ($(this).is(':checked')) {
            $(".checkbox-table:enabled").prop('checked', true);
        } else {
            $(".checkbox-table:enabled").prop('checked', false);
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

    $('.pagination__button').click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        getRecords($(this).text());
    })
}

function getRecords(page) {
    //ajax на получение новых записей в таблицу модуля согласно парамертам запроса

    if (getModuleName()==undefined) return;

    if (page == undefined) page = 1;

    let params = {
        'search_field': $(".search-select select option:selected").val(),
        'search_value' : $(".search-input input").val(),
        'sort' : $('.sort-button_active').attr('id'),
        'order' : $('.sort-button_active').attr('value'),
        'page' : page
    };

    if (params['search_value']=='') {

        params['search_field'] = '';
    }
         
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
    // функция для генерирации модального окна подтверждения удаления
    if (delete_val) {
        $('.confirmation__agree').val(delete_val)
    } else {
        $('.confirmation__agree').val('')
    }
    viewModalWindow($('.delete-confirmation').html());

}

function deleteRecords(delete_arr) {
    //ajax на удаление выбранных записей с последующим обновлением записей таблицы
    // либо на удаление текущего объекта c последующей перезагрузкой
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    let is_table = false;
    if ($('.records-table').length > 0) {
        is_table = true;
    }
    $.ajax({
        type: "POST",
        url: "/" + getModuleName() + "/delete",
        data: { '_token': CSRF_TOKEN, 'deleting': delete_arr},
        success: function(data) {
            if (is_table) {
                getRecords();
                resetSortButtons();
            } else {
                location.reload();
            }
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
            yearRange: 'c-60:c+1',
        },
        $.datepicker.regional['ru']
    ));

}

function upgradeSelects() {
    //апгрейд селектов плагином select2
    $('.select-plus').select2({
        width: '100%',
        placeholder: " -- Выберите вариант из списка --",
        language: {
             noResults: function(term) {
                 return "Ничего не найдено";
            }
        }
    });
}

function generatePassword() {
    var chars = ['a', 'c', 'r', 't', 'i','s','H','W', 'X', 'Y', 'z','0', '1', '2', '3', '5', '8','_','€','¥','£','^','`'];
    var out = '';
    for (var i = 0; i < 9; i++) {
        var index = Math.floor(Math.random() * (chars.length - 1)) + 1;
        out += chars[index];
    }
    return out;
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

    $(".flows-list").accordion({
        active: false,
        collapsible: true,
        heightStyle: "content"
    });   

    $(".flows-stages-back").click(function(event) {
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

    $(".flow-save").click(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "/flows/save",
                data: $(".flow-form").serialize(),
                success: function(content) {
                    if (content == '') {
                        $(".flows-stages__control").click();
                    } else if (content.match(/^\d+$/)) {
                        $("input[name='flows_list']").val($("input[name='flows_list']").val()+content+';');
                        $(".flows-stages__control").click();
                    } else {
                        viewModalWindow(content);
                    }
                }
            });
    });

    $(".stages-add").click(function(event) {
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

    $(".stage-save").click(function(event) {
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



    //1. функционал кнопки акаунта
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


    
    //2. первичная загрузка данных в таблицу модулей
    
    if ($(".records-table").length > 0) {
        getRecords();
    }

    //3. запуск поиска новых записей при разных действиях

    if ($(".search-input input").length > 0) {

        //$(".search-input input").keyup(function() { getRecords(); });
        $(".search-input button").click(function() { getRecords(); });
        $(".search-select select").change(function() { getRecords(); });

    }
    
    //4. запуск сортировки записей таблицы при нажатии на кнопку сортировки

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


    //5. обработка всплывающего уведомления

    if ($('.message').length > 0) {
        $('.message').show('fade',1000);
        setTimeout(function() {$('.message').hide('fade',1000)}, 2000)
        
    }


    //6. запуск отправки мгновенного сообщения о выполнении задачи

    $(".complete-button").click(function() {
        let task_id = $(this).attr('name');
        completeTask(task_id);
    })


    //7. установка функционала полям в формах создания/редактирования объектов

    upgradeSelects();

    //запуск вкладок
    $( "#tabs" ).tabs();

    //запуск календаря в поле даты    
    setDatepicker($('.modal-calendar'));

    //маска ввода для поля телефона
    $(".phone-masked").mask("+7(999) 999-9999");

    //маска ввода для поля планируемого времени
    $('.modal-clock').mask("99 ч 99 мин");

    //функционал поля с чекбоксом для разворота
    if ($(".checkbox-tab").length > 0) {

        $('.checkbox-tab__checkbox').change(function() {

            let tab = $(this).closest('.checkbox-tab__tab');

            if (!$(this).is(':checked')) {
                tab.find('input').val('');
                tab.find('.select-plus').val('').trigger("change");
                tab.hide();
            } else {
                tab.show();
            }
        });
        $('.checkbox-tab__checkbox').change();

    }

    //функционал поля с переключаемыми кнопками панелями
    if ($(".radio-tabs").length > 0) {

        $('.radio-tabs__radio').change(function() {

            $('.radio-tabs__tab').removeClass('radio-tabs__tab_active');

            $('.radio-tabs input').val('');
            $('.radio-tabs .select-plus').val('').trigger("change");

            let opening_tab_id = $(this).attr('for');
            $('#' + opening_tab_id).addClass('radio-tabs__tab_active');
        }) 
    }

    //функционал поля множественных полей
    if ($(".multifield").length > 0) {

        $('.multifield__add').click(function(event) {
            event.preventDefault();
            new_item = $(this).parent().find('.multifield__example').clone();
            new_item.removeClass('multifield__example').insertBefore($(this).parent().find('.multifield__add'));
            new_item.find('.select-plus-ready').addClass('select-plus');
            upgradeSelects();
            $('.multifield__delete').click(function(event) {
                event.preventDefault();
                $(this).parent().remove();
            })            
        }) 
        $('.multifield__delete').click(function(event) {
            event.preventDefault();
            $(this).parent().remove();
        })
    }

    //функционал таблицы редактирования
    if ($(".multitable").length > 0) {

        $('.multitable__add').click(function(event) {
            event.preventDefault();
            new_number = parseInt($(this).val());
            new_row = $(this).closest('.multitable').find('.multitable__example').clone();
            new_row.removeClass('multitable__example').insertBefore($(this).closest('.multitable__final'));
            new_row.find('input').each(function() {
                $(this).attr('name',$(this).attr('name')+'[new_'+new_number+']');
            });
            $(this).val(new_number+1);
            $('.multitable__delete').click(function(event) {
                event.preventDefault();
                $(this).closest('.multitable__row').remove();
                $('.button-notice').show();
            })            
        }) 
        $('.multitable__delete').click(function(event) {
            event.preventDefault();
            $(this).closest('.multitable__row').remove();
            $('.button-notice').show();
        })
    }

    //функционал кнопки настройки поля потоков и этапов
    $(".flows-stages__control").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: "/projects/flows_stages_modal",
                data: $(".object-form").serialize(),
                success: function(content) {
                    viewModalWindow(content);
                }
            });
    });

    //генерация пароля 
    $('.password-generate__btn').click(function(event) {
        event.preventDefault();
        $('.password-generate__value').text(generatePassword());
    })

    //выбор типа транзакции
    if ($(".indication").length > 0) {
        var first_start = true;
        $('.indication').change(function() {
            $('.indicate').hide();
            if (first_start == false) {
                $('.indicate input').val('');
                $('.indicate .select-plus').val('').trigger("change");
            }
            for_arr = $('.indication option:selected').attr('for').split(/[\n\s]+/);
            $.each(for_arr, function(index, for_class) {
                if (for_class)
                $('.'+for_class).show();
            });
            first_start = false;
        })
        $('.indication').change();
    }


    
    


    //8 функционал страниц детального просмотра

    //конпка удалить
    $(".module-button_delete").click(function(event) {
        event.preventDefault();
        deleteConfirmation($(this).attr('name'));
    })

    //функционал ленты потоков-этапов в просмотре проекта
    if ($(".stages-strip").length > 0) {

        $('.stage-block__btn').click(function() {

            if ($(this).parent().find('.stage-tasks').css('display')=='none') {
                $('.stage-tasks').hide();
                $(this).parent().find('.stage-tasks').show();
            } else {
                $('.stage-tasks').hide();

            }
        })
    }

    //9 другое


});