-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 14 2017 г., 01:01
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
(10, 'delete_controlled', NULL),
(11, 'set_role_id', NULL),
(12, 'set_post', NULL),
(13, 'setup_types', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `agents`
--

CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `agents`
--

INSERT INTO `agents` (`id`, `client_id`, `contact_id`) VALUES
(5, 1, 2),
(6, 3, 2),
(7, 2, 4),
(8, 1, 3),
(10, 2, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_id` int(10) UNSIGNED DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `task_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attachments`
--

INSERT INTO `attachments` (`id`, `document_id`, `project_id`, `task_id`) VALUES
(1, 3, 1, NULL),
(2, 4, 1, NULL),
(3, 7, NULL, 9),
(4, 8, NULL, 9),
(6, 5, 1, NULL),
(7, 8, 7, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `enable`, `name`, `site`, `manager_id`) VALUES
(1, 1, 'ООО \"Компани\"', 'www.company.ru', 2),
(2, 1, 'ИП Заказчик', 'iamip.ru', 2),
(3, 1, 'ЗАО \"Клиентура\"', NULL, 1),
(4, 0, 'ррррооокккк', NULL, NULL),
(5, 0, 'ррррр', NULL, NULL),
(6, 1, 'Аноним', 'xxx.ru', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `enable`, `surname`, `firstname`, `lastname`, `email`, `tel`, `skype`) VALUES
(1, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Агентов', 'Руслан', 'Русланович', 'rus@mail.ru', '+7(645) 645-6456', 'rss.rty'),
(3, 1, 'Агентов', 'Всеволод', 'Всеволодович', 'ves@ya.ru', NULL, NULL),
(4, 1, 'Агент', 'Миша', NULL, NULL, '+7(777) 777-7777', NULL),
(5, 0, 'ываыв', 'ываыва', 'выаыва', NULL, NULL, NULL),
(6, 0, 'fgh', NULL, NULL, NULL, NULL, NULL),
(7, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 0, 'рокер', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetimeof` datetime NOT NULL,
  `link` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `documents`
--

INSERT INTO `documents` (`id`, `enable`, `name`, `datetimeof`, `link`, `author_id`) VALUES
(1, 1, 'Лабораторная работа №1.pdf', '2017-12-13 21:56:24', 'laboratornaya_rabota_1.pdf', 1),
(2, 1, 'макет.psd', '2017-12-13 21:57:03', 'maket.psd', 1),
(3, 1, 'дизайн главной страницы.jpg', '2017-12-13 21:57:27', 'dizayn_glavnoy_stranici.jpeg', 2),
(4, 1, 'дизайн каталога.jpg', '2017-12-13 21:57:32', 'dizayn_kataloga.jpeg', 2),
(5, 1, 'ГОСТы.docx', '2017-12-13 21:57:41', 'gosti.docx', 1),
(6, 1, '45645##@#_$002.zip', '2017-12-13 21:57:53', '45645_002.zip', 2),
(7, 1, 'должностные инструкции.txt', '2017-12-13 21:58:07', 'doljnostnie_instrukcii.txt', 1),
(8, 1, 'картинка 4к.jpg', '2017-12-13 21:58:22', 'kartinka_4k.jpeg', 1),
(9, 1, 'удаленная картинка.png', '2017-12-13 21:58:40', 'fsdfsdf___sdfsdfsdfsd_fsd_fsd_sfdfsdsffddsfdfgvdf.png', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
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
(1, 1, '4p6BGRTtPRo9peNdVqu4M2fG58C8Hmw4TBRe195GubFVG1uBtA598m6um9P4', 1, 'director@mail.ru', '$2y$10$VsPIqJ4LvvqelB0PLIYSZu.0M2wn4Z1a3hKhZBD5d3zm5PKF.1vpO', 'Директоров', 'Вячеслав', 'Ильич', 'male', '2017-11-30', 'Главный директор', '+7(111) 111-1111', NULL),
(2, 1, '1910sj8SmTAX3CaIHOrgXZPv1abaQSxJouBZ4s7bYYveIrt3bDwKbWaTAdcC', 2, 'manager@mail.ru', '$2y$10$cEI7FYRh05bRSTv.W5zl5.v6J64h2R0KnaDsavgyX9LuoI.1f4L46', 'Менеджеров', 'Игорь', 'Вениаминович', 'male', '2017-11-30', 'Project-manager', '+7(222) 222-2223', NULL),
(3, 1, 'W8JF7MlrmgGntrWHkJ82t32ibkJUmyoJr6iBhzSIhaQ5m3VUtzvdGVoDGEiB', 3, 'executor@mail.ru', '$2y$10$yatsBwh9OtsDjuORS1tWkOeNM9wYODjhcxDKqyzZ9dlB9dBUEd27C', 'Исполнителев', 'Иван', 'Иванович', 'male', '2017-11-30', 'Веб-программист', '+7(333) 333-3333', NULL),
(4, 1, NULL, 3, 'sssre34@gmail.ru', '$2y$10$Eq/Cw2FUz77WDBew2BwWnelIVgvMvksrIaX9vPZoU9k8t.Zo7vs86', NULL, 'Исполнитель №1', NULL, 'male', '2017-11-23', 'Дизайнер', NULL, NULL),
(5, 1, NULL, 3, 'miss@ya.ru', '$2y$10$w6XQxarUHfYBDQ7nWFPeQO.FMNpMO.7uvbuknzPP1BpejpAchSLZm', NULL, 'Исполнитель №2', NULL, 'female', NULL, 'Дизайнер', NULL, NULL),
(6, 1, NULL, 3, 'superman@gmail.com', '$2y$10$UAcoRDzUhHeRKRNPwg3CTOE3.UvTxjiw83xhbmMsOgOR/wClFA0he', NULL, 'Исполнитель №3', NULL, NULL, NULL, 'Верстальщик', NULL, NULL),
(7, 0, NULL, 3, 'bbb@bbb.ru', '$2y$10$zDuxE44oXBSja0nFh4Szw.TZ6Y.eUBrB/qEaYUawKi2TihH7zgGSK', 'dfgdfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 0, NULL, 1, 'rewr@werwe.rwer', '$2y$10$pTds.lcPJmddrHqkOD2zouhNz84SAJLROvskgY7ZxfHNfnpcR4Zbq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(2, 'SEO', 2, 1),
(3, 'Начало', 1, 2),
(7, 'ровар', 7, 4),
(8, 'ррр', NULL, 4),
(9, 'нова', NULL, 5),
(10, 'хмм', NULL, 6),
(11, 'охххх', 1, 7),
(12, 'охххххххххххх', 2, 7);

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
(1, '2017_00_01_000000_create_modules_table', 1),
(2, '2017_00_02_000000_create_roles_table', 1),
(3, '2017_00_03_000000_create_actions_table', 1),
(4, '2017_00_04_000000_create_permissions_table', 1),
(5, '2017_00_05_000000_create_employees_table', 1),
(6, '2017_00_06_000000_create_notifications_table', 1),
(7, '2017_00_07_000000_create_clients_table', 1),
(8, '2017_00_08_000000_create_contacts_table', 1),
(9, '2017_00_09_000000_create_agents_table', 1),
(10, '2017_00_10_000000_create_socnetworks_table', 1),
(11, '2017_00_11_000000_create_projects_table', 1),
(12, '2017_00_12_000000_create_flows_table', 1),
(13, '2017_00_13_000000_create_stages_table', 1),
(14, '2017_00_14_000000_create_workareas_table', 1),
(15, '2017_00_15_000000_create_tasks_table', 1),
(23, '2017_00_16_000000_create_transaction_types_table', 2),
(24, '2017_00_17_000000_create_transactions_table', 2),
(25, '2017_00_18_000000_create_documents_table', 3),
(26, '2017_00_19_000000_create_attachments_table', 3);

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
(8, 'Documents');

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `viewed` tinyint(1) DEFAULT NULL,
  `datetimeof` datetime NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `viewed`, `datetimeof`, `title`, `text`, `link`, `employee_id`) VALUES
(1, 1, '2017-12-13 23:09:37', 'Новая задача для вас', 'Продумать архитектуру, Крайний срок 25.11.2017, Планируемое время 8 ч , Бэкенд', '/tasks/show/9', 1),
(2, 1, '2017-12-13 23:09:37', 'Вы сняты с выполнения задачи', 'Продумать архитектуру, Крайний срок 25.11.2017, Планируемое время 8 ч , Бэкенд', '/tasks/show/9', 3),
(3, 1, '2017-12-13 23:09:58', 'Новая задача для вас', 'Продумать архитектуру, Крайний срок 25.11.2017, Планируемое время 8 ч , Бэкенд', '/tasks/show/9', 3),
(4, 1, '2017-12-13 23:09:58', 'Вы сняты с выполнения задачи', 'Продумать архитектуру, Крайний срок 25.11.2017, Планируемое время 8 ч , Бэкенд', '/tasks/show/9', 1),
(5, 1, '2017-12-13 23:10:44', 'Новая транзакция, связанная с вами', 'Зарплата сотруднику (20,000 ₽). Сотрудник: Директоров Вячеслав Ильич ', '/transactions/show/13', 1),
(6, 1, '2017-12-13 23:11:01', 'Вы назначены на работу с клиентом', 'Аноним (xxx.ru)', '/clients/show/6', 1),
(7, 1, '2017-12-13 23:13:10', 'Новая задача для вас', 'Сформировать концепцию дизайна, Крайний срок 30.12.2017, Планируемое время 1 ч 30 мин, Фронтенд', '/tasks/show/20', 1),
(8, 1, '2017-12-14 00:57:31', 'Вы назначены на руководство проектом', 'чтото необычное', '/projects/show/7', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `module_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
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
(6, 2, 1, 6),
(7, 3, 1, 5),
(8, 1, 2, 1),
(9, 1, 2, 2),
(10, 1, 2, 3),
(11, 1, 2, 4),
(12, 2, 2, 5),
(13, 2, 2, 2),
(14, 2, 2, 9),
(15, 2, 2, 10),
(16, 3, 2, 5),
(17, 3, 2, 2),
(18, 3, 2, 9),
(19, 3, 2, 10),
(20, 1, 3, 1),
(21, 1, 3, 2),
(22, 1, 3, 3),
(23, 1, 3, 4),
(24, 1, 3, 11),
(25, 1, 3, 12),
(26, 2, 3, 1),
(27, 2, 3, 6),
(28, 3, 3, 1),
(29, 3, 3, 6),
(30, 1, 4, 1),
(31, 1, 4, 2),
(32, 1, 4, 3),
(33, 1, 4, 4),
(34, 2, 4, 1),
(35, 2, 4, 6),
(36, 1, 5, 1),
(37, 1, 5, 2),
(38, 1, 5, 3),
(39, 1, 5, 4),
(40, 2, 5, 1),
(41, 2, 5, 6),
(42, 1, 6, 1),
(43, 1, 6, 2),
(44, 1, 6, 3),
(45, 1, 6, 4),
(46, 2, 6, 1),
(47, 3, 6, 1),
(48, 1, 7, 1),
(49, 1, 7, 2),
(50, 1, 7, 3),
(51, 1, 7, 13),
(52, 1, 7, 4),
(53, 2, 7, 5),
(54, 2, 7, 2),
(55, 2, 7, 9),
(56, 2, 7, 10),
(57, 3, 7, 5),
(58, 1, 8, 1),
(59, 1, 8, 2),
(60, 1, 8, 3),
(61, 1, 8, 4),
(62, 2, 8, 5),
(63, 2, 8, 2),
(64, 2, 8, 9),
(65, 2, 8, 10),
(66, 3, 8, 5),
(67, 3, 8, 2),
(68, 3, 8, 9),
(69, 3, 8, 10);

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
(2, 1, 'Разработка корпортала', 3, 1),
(3, 0, 'jhh', NULL, 1),
(4, 0, 'лолка', NULL, 1),
(5, 0, 'рок', NULL, 1),
(6, 0, 'хм..', NULL, 1),
(7, 0, 'чтото необычное', 3, 2);

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
-- Структура таблицы `socnetworks`
--

CREATE TABLE `socnetworks` (
  `id` int(10) UNSIGNED NOT NULL,
  `resource` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `socnetworks`
--

INSERT INTO `socnetworks` (`id`, `resource`, `link`, `employee_id`, `contact_id`) VALUES
(1, 'Вконтакте', 'https://vk.com/id333333', NULL, 4),
(2, 'Вконтакте', 'http://vk.com/id...', 1, NULL),
(3, 'Одноклассники', 'http://ok.ru/id...', 1, NULL),
(4, NULL, 'tambler.ru/xxx', 2, NULL);

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
(2, 'began', 'Бэкенд', 2, 1),
(3, 'began', 'Первичный анализ', NULL, 3),
(5, 'began', 'Оптимизация', 3, 1),
(6, 'began', 'Микроразметка', 1, 2),
(7, 'complete', 'лаль', 5, 8),
(8, 'began', 'ору', 2, 8),
(9, 'began', 'рык', NULL, 9),
(10, 'began', 'хммм', NULL, 10),
(11, 'began', 'это', 2, 11),
(12, 'began', 'когда', 1, 11),
(13, 'began', 'кончится', 100, 11);

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
  `plaintime` time DEFAULT NULL,
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
(6, 1, 'complete', 'Закодить контроллеры корзины', '2017-12-31', '04:00:00', 2, NULL, 1, 3, 'ТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТ ЗТЗТЗТЗТЗТЗТЗТЗТ ЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТ ЗТЗТЗТЗТЗТЗ'),
(7, 1, 'complete', 'Обсудить ТЗ с заказчиком', '2017-11-29', '02:00:00', NULL, 3, 1, 2, 'ТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗ'),
(8, 1, 'complete', 'Нарисовать логотипы', '2017-12-14', '00:30:00', NULL, 5, 1, 1, 'ТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗТЗ'),
(9, 1, 'began', 'Продумать архитектуру', '2017-11-25', '08:00:00', 2, NULL, 1, 3, 'Архитектура программного обеспечения (англ. software architecture) — совокупность важнейших решений об организации программной системы. Архитектура включает:\r\n\r\nвыбор структурных элементов и их интерфейсов, с помощью которых составлена система, а также их поведения в рамках сотрудничества структурных элементов;\r\nсоединение выбранных элементов структуры и поведения во всё более крупные системы;\r\nархитектурный стиль, который направляет всю организацию — все элементы, их интерфейсы, их сотрудничество и их соединение.'),
(10, 1, 'began', 'Помочь менеджеру', NULL, '00:05:00', NULL, NULL, 2, 6, 'Переложи пожалуйста вон те бумаги вон туда, спасибо'),
(11, 1, 'failed', 'Разобрать документы', NULL, '01:10:00', NULL, 1, 3, 4, NULL),
(12, 0, 'complete', 'ррррррр', '2017-12-14', '34:53:00', NULL, NULL, 1, 1, NULL),
(13, 0, 'began', '34534535', NULL, '34:53:00', NULL, NULL, 1, 1, NULL),
(14, 0, 'began', 'gggggggdf', NULL, '45:34:00', NULL, NULL, 1, 1, NULL),
(15, 1, 'began', 'Опросить заказчика', '2017-12-15', '30:00:00', NULL, 1, 1, 5, NULL),
(16, 0, 'began', 'прапр', NULL, '00:00:00', NULL, NULL, 1, 1, NULL),
(17, 0, 'began', 'прапр', NULL, '00:00:00', NULL, NULL, 1, 1, NULL),
(18, 0, 'began', 'рппрпрпр', NULL, '55:55:00', 1, NULL, 1, 1, NULL),
(19, 0, 'began', 'лолкалолка', NULL, '00:00:00', NULL, NULL, 3, 1, NULL),
(20, 1, 'began', 'Сформировать концепцию дизайна', '2017-12-30', '01:30:00', 1, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `sum` int(10) UNSIGNED NOT NULL,
  `datetimeof` datetime NOT NULL,
  `comment` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`id`, `enable`, `type_id`, `sum`, `datetimeof`, `comment`, `project_id`, `client_id`, `employee_id`, `author_id`) VALUES
(4, 1, 3, 2000, '2017-12-10 23:45:55', NULL, 2, 3, NULL, 1),
(5, 1, 4, 2000, '2017-12-10 23:46:31', NULL, NULL, NULL, 2, 1),
(6, 1, 4, 1000, '2017-12-10 23:47:09', 'эт тебе', NULL, NULL, 3, 2),
(7, 1, 5, 200, '2017-12-10 23:47:49', NULL, NULL, NULL, NULL, 1),
(8, 1, 4, 10000, '2017-12-10 23:50:02', 'а это мне', NULL, NULL, 1, 1),
(9, 1, 4, 300, '2017-12-11 00:25:51', NULL, NULL, NULL, 1, 1),
(10, 1, 3, 30000, '2017-12-11 00:54:21', 'огого', 2, 3, NULL, 1),
(11, 1, 3, 2000, '2017-12-11 01:11:39', NULL, 1, 1, NULL, 2),
(12, 0, 3, 400, '2017-12-11 01:12:46', NULL, 1, 3, NULL, 2),
(13, 1, 4, 20000, '2017-12-13 23:10:43', 'Сам себе взял, сам себе заплатил', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `income` tinyint(1) DEFAULT NULL,
  `indicate_project` tinyint(1) DEFAULT NULL,
  `indicate_client` tinyint(1) DEFAULT NULL,
  `indicate_employee` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `name`, `income`, `indicate_project`, `indicate_client`, `indicate_employee`) VALUES
(3, 'Оплата проекта', 1, 1, 1, NULL),
(4, 'Зарплата сотруднику', NULL, NULL, NULL, 1),
(5, 'Амортизационные отчисления', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `workareas`
--

CREATE TABLE `workareas` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `workareas`
--

INSERT INTO `workareas` (`id`, `enable`, `name`) VALUES
(1, 1, 'Фронтенд'),
(2, 1, 'Бэкенд'),
(3, 0, 'kjkrbbbbbbbbbbbbfgdgggggggggggggggggggggggggggdfgdfgdfg'),
(4, 0, 'лоххх');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actions_child_id_foreign` (`child_id`);

--
-- Индексы таблицы `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agents_client_id_foreign` (`client_id`),
  ADD KEY `agents_contact_id_foreign` (`contact_id`);

--
-- Индексы таблицы `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_document_id_foreign` (`document_id`),
  ADD KEY `attachments_project_id_foreign` (`project_id`),
  ADD KEY `attachments_task_id_foreign` (`task_id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_manager_id_foreign` (`manager_id`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_author_id_foreign` (`author_id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `flows`
--
ALTER TABLE `flows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flows_project_id_foreign` (`project_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_employee_id_foreign` (`employee_id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`),
  ADD KEY `permissions_module_id_foreign` (`module_id`),
  ADD KEY `permissions_action_id_foreign` (`action_id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_client_id_foreign` (`client_id`),
  ADD KEY `projects_manager_id_foreign` (`manager_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `socnetworks`
--
ALTER TABLE `socnetworks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socnetworks_employee_id_foreign` (`employee_id`),
  ADD KEY `socnetworks_contact_id_foreign` (`contact_id`);

--
-- Индексы таблицы `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stages_flow_id_foreign` (`flow_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_workarea_id_foreign` (`workarea_id`),
  ADD KEY `tasks_stage_id_foreign` (`stage_id`),
  ADD KEY `tasks_director_id_foreign` (`director_id`),
  ADD KEY `tasks_executor_id_foreign` (`executor_id`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_type_id_foreign` (`type_id`),
  ADD KEY `transactions_project_id_foreign` (`project_id`),
  ADD KEY `transactions_client_id_foreign` (`client_id`),
  ADD KEY `transactions_employee_id_foreign` (`employee_id`),
  ADD KEY `transactions_author_id_foreign` (`author_id`);

--
-- Индексы таблицы `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workareas`
--
ALTER TABLE `workareas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `flows`
--
ALTER TABLE `flows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `socnetworks`
--
ALTER TABLE `socnetworks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `workareas`
--
ALTER TABLE `workareas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `actions` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `agents_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attachments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attachments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `flows`
--
ALTER TABLE `flows`
  ADD CONSTRAINT `flows_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `socnetworks`
--
ALTER TABLE `socnetworks`
  ADD CONSTRAINT `socnetworks_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `socnetworks_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `flows` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_director_id_foreign` FOREIGN KEY (`director_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_executor_id_foreign` FOREIGN KEY (`executor_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_workarea_id_foreign` FOREIGN KEY (`workarea_id`) REFERENCES `workareas` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `transaction_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
