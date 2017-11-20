<?php

return [

    'modules'               => [
        'home'              => 'Главная',
        'employees'         => 'Сотрудник|Сотрудники',
        'tasks'             => 'Задача|Задачи',
        'projects'          => 'Проект|Проекты',
        'clients'           => 'Клиент|Клиент',
        'contacts'          => 'Контакт|Контакты',
        'workareas'         => 'Рабочая область|Рабочие области',
        'transactions'      => 'Финанс|Финансы',
        'files'             => 'Файл|Файлы'
    ],

    'operations'            => [
        'save'              => 'Сохранить',
        'add'               => 'Добавить',
        'edit'              => 'Редактировать',
        'delete'            => 'Удалить',
        'delete-selected'   => 'Удалить выбранные',
        'search'            => 'Искать',
        'search-by'         => 'Искать по',
        'creating-object'   => 'Создание объекта ',
        'showing-object'    => 'Просмотр объекта ',
        'editing-object'    => 'Редактирование объекта ',
        'add-flow'          => 'Новый поток',
        'edit-flow'         => 'Изменение потока',
        'add-stage'         => 'Новый этап',
        'edit-stage'        => 'Изменение этапа',
        'back'              => 'Назад',
        'detail'            => 'Подробнее...',
        'done'              => 'Выполнено!',
        'watch-other'       => 'Смотреть другие',
        'agree'             => 'Да',
        'disagree'          => 'Нет'

    ],

    'messages'              => [
        'loading'           => 'Загрузка...',
        'empty'             => 'Нет данных',
        'not-found'         => 'Объект не найден',
        'deleted-object'    => 'Объект был удален. Информация недоступна',
        'success'           => 'Данные успешно сохранены',
        'email-dublicate'   => 'Пользователь с данным Email уже существует',
        'plaintime-fail'    => 'Планируемое время введено некорректно',
        'unknow-employee'   => 'Неизвестный сотрудник',
        'confirmation-ask'  => 'Вы уверены?',
        'deleting-ask'      => 'Данные будут удалены. Вы уверены?'
    ],

    'units'                 => [
        'hours'             => 'ч',
        'minutes'           => 'мин',
        'seconds'           => 'с'
    ],

    'notifications'         => [
        'assign-to-task'    => 'Назначение на задачу',
        'remove-from-task'  => 'Снятие с задачи',
        'complete-task'     => 'Выполнение поставленной задачи',
        'assign-to-project' => 'Назначение на проект',
        'new-salary'        => 'Получение заработной платы'
    ],

    'fields-name'           => [
        'all'               => 'Все поля',
        'actions'           => 'Действия',
        'fullname'          => 'ФИО',
        'email'             => 'Email',
        'tel'               => 'Телефон',
        'role'              => 'Роль',
        'surname'           => 'Фамилия',
        'firstname'         => 'Имя',
        'lastname'          => 'Отчество',
        'sex'               => 'Пол',
        'sexes'             => [
            'male'          => 'мужской',
            'female'        => 'женский'    
        ],
        'dob'               => 'Дата рождения',
        'post'              => 'Должность',
        'skype'             => 'Skype',
        'socnetworks'       => 'Социальные сети',
        'name'              => 'Название',
        'status'            => 'Статус',
        'statuses'          => [
            'began'         => 'В процессе',
            'complete'      => 'Выполнена',
            'failed'        => 'Провалена'
        ],
        'stage-statuses'    => [
            'began'         => 'Не закончен',
            'complete'      => 'Закончен',
        ],
        'deadline'          => 'Крайний срок',
        'plaintime'         => 'Планируемое время',
        'assignment'        => 'Приписка',
        'workarea'          => 'Рабочая область',
        'stage'             => 'Этап проекта',
        'director'          => 'Постановщик',
        'executor'          => 'Исполнитель',
        'description'       => 'ТЗ',
        'client'            => 'Заказчик',
        'manager'           => 'Менеджер',
        'flows-stages'      => 'Потоки и этапы',
        'flows'             => 'Потоки',
        'stages'            => 'Этапы',
        'sort_order'        => 'Номер сортировки',
        'notifications'     => 'Уведомления',
        'my-tasks'          => 'Мои текущие задачи',
        'my-projects'       => 'Проекты под моим управлением'

    ]

    
];
