<?php

return [

    'modules'               => [
        'auth'              => 'Авторизация',
        'home'              => 'Главная',
        'employees'         => 'Сотрудник|Сотрудники',
        'tasks'             => 'Задача|Задачи',
        'projects'          => 'Проект|Проекты',
        'clients'           => 'Клиент|Клиенты',
        'contacts'          => 'Контакт|Контакты',
        'workareas'         => 'Рабочая область|Рабочие области',
        'transactions'      => 'Финанс|Финансы',
        'files'             => 'Файл|Файлы'
    ],

    'operations'            => [
        'login'             => 'Войти',
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
        'disagree'          => 'Нет',
        'acount'            => 'Мой аккаунт',
        'logout'            => 'Выйти',
        'set-new-password'  => 'Установить новый пароль',
        'generate'          => 'Сгенерировать',

    ],

    'messages'              => [
        'auth'              => 'Пожалуйста, авторизуйтесь для входа в систему',
        'loading'           => 'Загрузка...',
        'empty'             => 'Нет данных',
        'undefined'         => 'Не указано',
        'invalid-value'     => ':field - недействительное значение',
        'select'            => ' -- Выберите вариант из списка --',
        'forbidden'         => 'Доступ на страницу закрыт',
        'not-found'         => 'Объект не найден',
        'deleted-object'    => 'Объект был удален. Информация недоступна',
        'success'           => 'Данные успешно сохранены',
        'email-dublicate'   => 'Пользователь с данным Email уже существует',
        'plaintime-fail'    => 'Планируемое время введено некорректно',
        'unknow-employee'   => 'Неизвестный сотрудник',
        'confirmation-ask'  => 'Вы уверены?',
        'deleting-ask'      => 'Данные будут удалены. Вы уверены?',
        'fullname-empty'    => 'Хоть что-то из ФИО должно быть указано',
        'route-error'       => '404.Страница не найдена'
    ],

    'roles'                 => [
        'director'          => 'Директор',
        'manager'           => 'Менеджер',
        'executor'          => 'Исполнитель',
    ],

    'units'                 => [
        'hours'             => 'ч',
        'minutes'           => 'мин',
        'seconds'           => 'с'
    ],

    'notifications'         => [
        'assign-to-task'    => 'Новая задача для вас',
        'return-to-task'    => 'Вернитесь к выполнению задачи',
        'remove-from-task'  => 'Вы сняты с выполнения задачи',
        'complete-task'     => 'Ваша задача выполнена',
        'assign-to-project' => 'Вы назначены на руководство проектом',
        'assign-to-client'  => 'Вы назначены на работу с клиентом',
        'new-salary'        => 'Вам начислены деньги',
    ],

    'fields-name'           => [
        'all'               => 'Все поля',
        'actions'           => 'Действия',
        'notifications'     => 'Уведомления',
        'my-tasks'          => 'Мои текущие задачи',
        'my-projects'       => 'Проекты под моим управлением',
        'fullname'          => 'ФИО',
        'email'             => 'Email',
        'password'          => 'Пароль',
        'new_password'      => 'Новый пароль',
        'password_confirmation' => 'Подтверждение пароля',
        'remember-me'       => 'Запомнить меня',
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
        'assignment-none'   => 'Без приписки',
        'assignment-workarea'=> 'Приписать к рабочей области',
        'assignment-stage'  => 'Приписать к этапу проекта',
        'director'          => 'Постановщик',
        'executor'          => 'Исполнитель',
        'description'       => 'ТЗ',
        'client'            => 'Заказчик',
        'manager'           => 'Менеджер',
        'flows-stages'      => 'Потоки и этапы',
        'flows'             => 'Потоки',
        'stages'            => 'Этапы',
        'sort_order'        => 'Номер сортировки',
        'count_of_tasks'    => 'Число задач',
        'tasks'             => 'Приписанные задачи',
        'site'              => 'Сайт',
        'client-projects'   => 'Заказанные проекты',
        'client-contacts'   => 'Представители',
        'companies'         => 'Компании',
        'resource'          => 'Название ресурса',
        'link'              => 'Ссылка',
        'other-resource'    => 'Дополнительная ссылка',

    ]

    
];
