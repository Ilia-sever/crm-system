-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 30 2017 г., 19:48
-- Версия сервера: 5.7.17-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crm_new`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actions`
--

CREATE TABLE `actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `actions`
--

INSERT INTO `actions` (`id`, `name`, `child_id`) VALUES
(1, 'watch', 5),
(2, 'create', NULL),
(3, 'update', 6),
(4, 'delete', 7),
(5, 'watch_related', 8),
(6, 'update_related', 9),
(7, 'delete_related', 10),
(8, 'watch_controlled', NULL),
(9, 'update_controlled', NULL),
(10, 'delete_controlled', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `post` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `enable`, `remember_token`, `role_id`, `email`, `password`, `surname`, `firstname`, `lastname`, `sex`, `dob`, `post`, `tel`, `skype`) VALUES
(1, 1, 'VmmnCnbCTpG5Q1KsSmZYVoJCPT9B4SN4ssPD6wYwXZ57xfyUX3u0aWem0xgm', 1, 'director@mail.ru', '$2y$10$VsPIqJ4LvvqelB0PLIYSZu.0M2wn4Z1a3hKhZBD5d3zm5PKF.1vpO', 'Директоров', 'Вячеслав', 'Ильич', 'male', '2017-11-30', 'Главный директор', '+7(111) 111-1111', NULL),
(2, 1, '52uISEZxZMPu8UlCWG5s27Q64Me8zu4kwyPxnU71M7PaMN5GKyzpg9rcBP90', 2, 'manager@mail.ru', '$2y$10$cEI7FYRh05bRSTv.W5zl5.v6J64h2R0KnaDsavgyX9LuoI.1f4L46', 'Менеджеров', 'Игорь', 'Вениаминович', 'male', '2017-11-30', 'Project-manager', '+7(222) 222-2222', NULL),
(3, 1, 'RfNe99UGNjO3S3blizg3wd1A3iL550io51VmEagnQBztTkOqsMx0r4dPL1Rl', 3, 'executor@mail.ru', '$2y$10$yatsBwh9OtsDjuORS1tWkOeNM9wYODjhcxDKqyzZ9dlB9dBUEd27C', 'Исполнителев', 'Иван', 'Иванович', 'male', '2017-11-30', 'Веб-программист', '+7(333) 333-3333', NULL),
(4, 1, NULL, 3, 'sssre34@gmail.ru', '$2y$10$Eq/Cw2FUz77WDBew2BwWnelIVgvMvksrIaX9vPZoU9k8t.Zo7vs86', NULL, 'Исполнитель №1', NULL, 'male', '2017-11-23', 'Дизайнер', NULL, NULL),
(5, 1, NULL, 3, 'miss@ya.ru', '$2y$10$w6XQxarUHfYBDQ7nWFPeQO.FMNpMO.7uvbuknzPP1BpejpAchSLZm', NULL, 'Исполнитель №2', NULL, 'female', NULL, 'Дизайнер', NULL, NULL),
(6, 1, NULL, 3, 'superman@gmail.com', '$2y$10$UAcoRDzUhHeRKRNPwg3CTOE3.UvTxjiw83xhbmMsOgOR/wClFA0he', NULL, 'Исполнитель №3', NULL, NULL, NULL, 'Верстальщик', NULL, NULL),
(7, 0, NULL, 3, 'bbb@bbb.ru', '$2y$10$zDuxE44oXBSja0nFh4Szw.TZ6Y.eUBrB/qEaYUawKi2TihH7zgGSK', 'dfgdfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `flows`
--

CREATE TABLE `flows` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(10) UNSIGNED DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `flows`
--

INSERT INTO `flows` (`id`, `name`, `sort_order`, `project_id`) VALUES
(1, 'Разработка', 1, 1),
(2, 'SEO', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2017_10_20_131700_create_employees_table', 1),
(6, '2017_10_26_084550_create_tasks_table', 2),
(7, '2017_10_30_052103_create_projects_table', 3),
(8, '2017_10_30_052715_create_flows_table', 3),
(10, '2017_10_30_052735_create_stages_table', 4),
(11, '2017_11_07_085909_create_notifications_table', 5),
(12, '2017_11_27_183359_create_actions_table', 6),
(13, '2017_11_27_183359_create_modules_table', 6),
(14, '2017_11_27_183359_create_roles_table', 6),
(15, '2017_11_27_183359_create_permissions_table', 7),
(16, '2017_11_28_183359_create_actions_table', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`) VALUES
(1, 'Projects'),
(2, 'Tasks'),
(3, 'Employees'),
(4, 'Clients'),
(5, 'Contacts'),
(6, 'Workareas'),
(7, 'Transactions'),
(8, 'Files');

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `viewed` tinyint(1) DEFAULT NULL,
  `datetimeof` datetime NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `viewed`, `datetimeof`, `title`, `text`, `link`, `employee_id`) VALUES
(1, 1, '2017-11-30 18:18:45', 'Назначение на проект', 'Разработка интернет-магазина', '/projects/show/1', 2),
(2, 1, '2017-11-30 18:21:11', 'Назначение на проект', 'Разработка корпортала', '/projects/show/2', 1),
(3, 1, '2017-11-30 18:22:19', 'Назначение на задачу', 'Закодить контроллер корзины, Крайний срок 30.12.2017, Планируемое время 5 ч ', '/tasks/show/1', 3),
(4, 1, '2017-11-30 18:28:51', 'Назначение на задачу', 'впапк, Планируемое время 32 ч 42 мин', '/tasks/show/2', 1),
(5, 1, '2017-11-30 18:32:16', 'Назначение на задачу', 'апрапр, Планируемое время 43 ч 53 мин', '/tasks/show/3', 1),
(6, 1, '2017-11-30 18:32:55', 'Назначение на задачу', 'авпвапав, Планируемое время 35 ч 34 мин', '/tasks/show/4', 1),
(7, 1, '2017-11-30 18:33:41', 'Назначение на задачу', 'парапрап, Планируемое время 34 ч 53 мин', '/tasks/show/5', 1),
(8, 1, '2017-11-30 18:36:02', 'Назначение на задачу', 'Закодить контроллеры корзины, Планируемое время 4 ч ', '/tasks/show/6', 3),
(9, 1, '2017-11-30 18:36:49', 'Назначение на задачу', 'Обсудить ТЗ с заказчиком, Крайний срок 29.11.2017, Планируемое время 2 ч ', '/tasks/show/7', 2),
(10, 1, '2017-11-30 18:37:12', 'Выполнение поставленной задачи', 'Обсудить ТЗ с заказчиком, Крайний срок 29.11.2017, Планируемое время 2 ч ', '/tasks/show/7', 1),
(11, 0, '2017-11-30 18:37:36', 'Назначение на задачу', 'Нарисовать логотипы, Крайний срок 18.11.2017, Планируемое время 30 мин', '/tasks/show/8', 5),
(12, 1, '2017-11-30 18:38:16', 'Назначение на задачу', 'Продумать архитектуру, Крайний срок 25.11.2017, Планируемое время 8 ч 30 мин', '/tasks/show/9', 3),
(13, 0, '2017-11-30 18:42:33', 'Назначение на задачу', 'Помочь менеджеру, Планируемое время 5 мин', '/tasks/show/10', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `module_id` int(10) UNSIGNED DEFAULT NULL,
  `action_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `module_id`, `action_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 1, 4),
(5, 2, 1, 5),
(6, 2, 1, 0),
(7, 2, 1, 6),
(8, 2, 1, 0),
(9, 3, 1, 5),
(10, 3, 1, 0),
(11, 3, 1, 0),
(12, 3, 1, 0),
(13, 1, 2, 1),
(14, 1, 2, 2),
(15, 1, 2, 3),
(16, 1, 2, 4),
(17, 2, 2, 5),
(18, 2, 2, 2),
(19, 2, 2, 9),
(20, 2, 2, 10),
(21, 3, 2, 5),
(22, 3, 2, 2),
(23, 3, 2, 9),
(24, 3, 2, 10),
(25, 1, 3, 1),
(26, 1, 3, 2),
(27, 1, 3, 3),
(28, 1, 3, 4),
(29, 2, 3, 1),
(30, 2, 3, 0),
(31, 2, 3, 6),
(32, 2, 3, 0),
(33, 3, 3, 1),
(34, 3, 3, 0),
(35, 3, 3, 6),
(36, 3, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `manager_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `enable`, `name`, `client_id`, `manager_id`) VALUES
(1, 1, 'Разработка интернет-магазина', 1, 2),
(2, 1, 'Разработка корпортала', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'director'),
(2, 'manager'),
(3, 'executor');

-- --------------------------------------------------------

--
-- Структура таблицы `stages`
--

CREATE TABLE `stages` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` enum('began','complete','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(10) UNSIGNED DEFAULT NULL,
  `flow_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `stages`
--

INSERT INTO `stages` (`id`, `status`, `name`, `sort_order`, `flow_id`) VALUES
(1, 'complete', 'Сбор требований', 1, 1),
(2, 'began', 'Бэкенд', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `status` enum('began','complete','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date DEFAULT NULL,
  `plaintime` time NOT NULL,
  `workarea_id` int(10) UNSIGNED DEFAULT NULL,
  `stage_id` int(10) UNSIGNED DEFAULT NULL,
  `director_id` int(10) UNSIGNED DEFAULT NULL,
  `executor_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `enable`, `status`, `name`, `deadline`, `plaintime`, `workarea_id`, `stage_id`, `director_id`, `executor_id`, `description`) VALUES
(1, 0, 'began', 'Закодить контроллер корзины', '2017-12-30', '05:00:00', NULL, NULL, NULL, 3, 'Конкретные указания, пока что их нет'),
(2, 0, 'began', 'впапк', NULL, '32:42:00', NULL, NULL, NULL, 1, NULL),
(3, 0, 'began', 'апрапр', NULL, '43:53:00', NULL, NULL, NULL, 1, NULL),
(4, 0, 'began', 'авпвапав', NULL, '35:34:00', NULL, NULL, NULL, 1, NULL),
(5, 0, 'began', 'парапрап', NULL, '34:53:00', NULL, NULL, 1, 1, NULL),
(6, 1, 'began', 'Закодить контроллеры корзины', '2017-12-31', '04:00:00', NULL, NULL, 1, 3, 'ТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗ'),
(7, 1, 'complete', 'Обсудить ТЗ с заказчиком', '2017-11-29', '02:00:00', NULL, NULL, 1, 2, 'ТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗ'),
(8, 1, 'began', 'Нарисовать логотипы', '2017-11-18', '00:30:00', NULL, NULL, 1, 5, 'ТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗ'),
(9, 1, 'began', 'Продумать архитектуру', '2017-11-25', '08:30:00', NULL, NULL, 1, 3, 'ТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗ'),
(10, 1, 'began', 'Помочь менеджеру', NULL, '00:05:00', NULL, NULL, 2, 6, 'Переложи пожалуйста вон те бумаги вон туда, спасибо'),
(11, 1, 'failed', 'Разобрать документы', NULL, '01:10:00', NULL, NULL, 3, 4, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flows`
--
ALTER TABLE `flows`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `flows`
--
ALTER TABLE `flows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
