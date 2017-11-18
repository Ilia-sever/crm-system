-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 11 2017 г., 02:20
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
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `enable` tinyint(1) DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `employees` (`id`, `enable`, `role_id`, `email`, `password`, `surname`, `firstname`, `lastname`, `sex`, `dob`, `post`, `tel`, `skype`) VALUES
(1, 0, 1, 'aaa@aa.aaaa', '$2y$11$p3fUjHMD8ruB8T.xvyeKneDdGCGCnSbIGeFh/zgWaTWnjIovMhe02', 'Главный', 'Директор', '', 'male', '2017-10-20', 'маньяк', '+7(666) 666-6666', 'aa.aaaa'),
(5, 0, 1, 'oasasas@asaa.as', '$2y$11$8mKkD2t57lix34mSSJy2cOjsKXV6KGSFrhq5QVDOrxiGIA2FZeVNK', 'Простой', 'Человек', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 0, 1, 'ccocc@cc.ccc', '$2y$11$KFccytdxgv1GdRnw6VHmIelaF/9Rw7bvZdLHN3ME7cK4IhuiwNXoC', 'Что', 'Это', 'Такое', NULL, NULL, NULL, '+7(664) 534-5345', NULL),
(10, 1, 1, 'ivanov@mail.ru', '$2y$11$avt0wODydUdKPHuNI5V5uOA7VsB.zHDbTZGYcQSRX6p8KiCq6MHcm', 'Иванов', 'Иван', 'Сотрудникович', 'male', '1997-10-02', 'Маньяк', '+7(655) 656-5656', 'ivanovva'),
(11, 1, 1, 'ipettttr@gmail.com', '$2y$11$MDOuMQL9sBZyZTVeXElONuiGs/TVIOUMK3UaL67pymECiYzT55P7i', 'Петров', 'Директор', 'Вениаминович', 'male', '1977-10-30', 'Начальник', '+7(868) 786-8678', NULL),
(12, 1, 1, 'sadsa@yandex.ru', '$2y$11$t4RcSFhbrmSg0QLS6CV0H.bGT1xjADQVHC9G6ibRBibUvmiHW0b/6', 'Простой', 'Менеджер', NULL, 'female', '2017-10-11', NULL, '+7(444) 334-4425', NULL),
(13, 1, 3, 'anonim@mail.ru', '$2y$11$qpVTzKrP87fKOC4nYPopgef4gG42UzKJpnJrG8EbUSSfIiI0Jzbt2', 'Аноним', NULL, NULL, NULL, NULL, NULL, '+7(343) 424-3432', NULL),
(14, 1, 1, 'grenme@gmail.com', '$2y$11$ORJ34c4cVPWEr6PQiAOMCuY98qfGDe5gGUrAcl71TA8zcOMzAihL6', 'Браун', 'Грин', NULL, NULL, NULL, NULL, '+7(243) 423-4243', NULL);

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
(27, 'Поток \"XXX\"', 1, NULL),
(28, 'Поток \"YYY\"', 2, NULL),
(29, 'Поток \"XXX\"', 1, 5),
(30, 'Поток \"YYY\"', 0, 5),
(31, 'Потоккк', 100, NULL),
(32, 'Потоккк', 2, 6),
(33, 'ПОТОКККК', 1, 6),
(34, 'Эй Хоп', 2, NULL);

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
(11, '2017_11_07_085909_create_notifications_table', 5);

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
(1, 1, '2017-11-08 00:00:00', 'УВЕДОМЛЕЕЕЕНИЕ', 'что что что что что что что что что что что что что что что что что чточто что что что что что что что что что что что что что что что что что что что что что что что что что что что что что что что что что что что', '/tasks/', 10),
(2, 1, '2017-11-07 00:00:00', 'Произошло', 'ПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоПроизошлоооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооо', '/tasks/show/5', 10),
(3, 1, '2017-11-02 00:00:00', 'Лишнее', 'рррррррррррррррррррррр ррррррррррррррррр ррррррррррр р р р рррррррррррр р р р рр ррррррррррррррррр р ррррррр', '/', 11),
(4, 1, '2017-11-07 11:27:32', 'Назначение на новую задачу', 'Срочно пора приступать, бегом', '/tasks/show10', 10),
(5, 1, '2017-11-07 11:31:15', 'Назначение на новую задачу', 'Срочно пора приступать, бегом', '/tasks/show/11', 10),
(6, 1, '2017-11-07 11:41:32', 'Назначение на новую задачу', 'Беги далеко далеко, ', '/tasks/show/15', 10),
(7, 0, '2017-11-08 07:37:21', 'Назначение на новую задачу', 'что же делать, Крайний срок08.11.2017, Планируемое время11 ч 11 мин, ', '/tasks/show/18', NULL),
(8, 0, '2017-11-08 10:53:38', 'Назначение на новую задачу', 'Чтозанах, Крайний срок 08.11.2017, Планируемое время 12 ч 21 мин, ', '/tasks/show/19', NULL),
(9, 1, '2017-11-08 10:54:39', 'Назначение на новую задачу', 'Чтотытакое, Крайний срок 08.11.2017, Планируемое время 11 ч 11 мин, ', '/tasks/show/20', 10),
(10, 1, '2017-11-08 11:00:07', 'Назначение на новую задачу', 'Разработать диаграмму, Крайний срок 04.10.2017, Планируемое время 3 ч 20 мин, РАБОБЛАСТЬ5', '/tasks/show/8', 10),
(11, 0, '2017-11-08 11:00:07', 'Снятие с задачи', 'Разработать диаграмму, Крайний срок 04.10.2017, Планируемое время 3 ч 20 мин, РАБОБЛАСТЬ5', '/tasks/show/8', 13),
(12, 0, '2017-11-08 11:00:46', 'Назначение на новую задачу', 'Разработать диаграмму, Крайний срок 04.10.2017, Планируемое время 3 ч 20 мин, РАБОБЛАСТЬ5', '/tasks/show/8', 13),
(13, 1, '2017-11-08 11:00:46', 'Снятие с задачи', 'Разработать диаграмму, Крайний срок 04.10.2017, Планируемое время 3 ч 20 мин, РАБОБЛАСТЬ5', '/tasks/show/8', 10),
(14, 0, '2017-11-08 11:09:51', 'Назначение на задачу', 'xnjjjjjjj, Крайний срок 08.11.2017, Планируемое время 34 ч 24 мин, ', '/tasks/show/21', 12),
(15, 1, '2017-11-08 11:10:10', 'Выполнение поставленной задачи', 'xnjjjjjjj, Крайний срок 08.11.2017, Планируемое время 34 ч 24 мин, ', '/tasks/show/21', 10),
(16, 1, '2017-11-08 14:13:37', 'Назначение на задачу', 'делать что-то, Крайний срок 01.11.2017, Планируемое время 22 ч 22 мин, ', '/tasks/show/22', 10),
(17, 1, '2017-11-08 14:22:48', 'Назначение на задачу', 'ааааааа, Крайний срок 24.11.2017, Планируемое время 22 ч 22 мин, ', '/tasks/show/23', 10),
(18, 0, '2017-11-09 10:42:20', 'Назначение на проект', 'ПРОЕКТ2', '/projects/show/6', 11),
(19, 1, '2017-11-09 10:45:17', 'Назначение на проект', 'ПроектNew', '/projects/show/2', 10),
(20, 0, '2017-11-09 10:48:31', 'Назначение на задачу', 'ааааааа, Крайний срок 24.11.2017, Планируемое время 22 ч 22 мин, ', '/tasks/show/23', 11),
(21, 1, '2017-11-09 10:48:31', 'Снятие с задачи', 'ааааааа, Крайний срок 24.11.2017, Планируемое время 22 ч 22 мин, ', '/tasks/show/23', 10),
(22, 1, '2017-11-09 10:48:39', 'Назначение на задачу', 'ааааааа, Крайний срок 24.11.2017, Планируемое время 22 ч 22 мин, ', '/tasks/show/23', 10),
(23, 0, '2017-11-09 10:48:39', 'Снятие с задачи', 'ааааааа, Крайний срок 24.11.2017, Планируемое время 22 ч 22 мин, ', '/tasks/show/23', 11),
(24, 1, '2017-11-09 12:51:13', 'Назначение на задачу', 'Просто задача обычная, Крайний срок 18.11.2017, Планируемое время 22 ч , ', '/tasks/show/24', 10),
(25, 0, '2017-11-09 13:34:50', 'Назначение на проект', 'ПРОЕКТ2', '/projects/show/6', 12),
(26, 1, '2017-11-09 13:35:48', 'Назначение на проект', 'ПРОЕКТ2', '/projects/show/6', 10);

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
(1, 1, 'Проект111', 13, 10),
(2, 1, 'ПроектNew', 13, 10),
(3, 0, 'ЭТООО', 13, 10),
(4, 0, 'ЭТООО', 13, 10),
(5, 1, 'Простой проект', 10, 10),
(6, 1, 'ПРОЕКТ2', 13, 10);

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
(8, 'began', 'ЭтапФёрст', 3, 27),
(9, 'began', 'ЭтапСеконд', 1, 27),
(10, 'complete', 'ааааааа', NULL, 31),
(11, 'began', 'Этап Y1', NULL, 30),
(12, 'began', 'Этап Y2', NULL, 30),
(15, 'began', 'Хоп хей', NULL, 33),
(16, 'began', 'Лалалей', NULL, 33);

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
(1, 1, 'complete', 'Убить Билла', '2017-10-18', '20:01:00', NULL, 23, 1, 10, 'крякни Билла и возвращайся'),
(2, 0, 'failed', 'Уйти', '2017-10-15', '00:07:13', 2, NULL, 5, 1, 'выйти уйти прийти зайти подойти'),
(3, 0, 'began', 'Сделать что-то', NULL, '08:00:30', NULL, NULL, 1, NULL, NULL),
(4, 0, 'began', 'что делать то', NULL, '02:00:00', NULL, NULL, 1, NULL, NULL),
(5, 0, 'complete', 'Куда идти', '2017-11-25', '20:00:00', NULL, NULL, 1, NULL, 'ааааа'),
(6, 1, 'began', 'Оформить заявку', '2017-11-09', '02:00:00', NULL, 23, 1, 12, 'Взять и сделать просто, не медлительность'),
(7, 1, 'began', 'Взять документы', '2017-10-31', '00:01:00', 2, NULL, 1, 14, 'Возьми их и неси просто'),
(8, 1, 'failed', 'Разработать диаграмму', '2017-10-04', '03:20:00', 5, NULL, 1, 13, 'уже сделали, неважно'),
(9, 0, 'began', 'hmmmmm', '2017-10-11', '21:32:00', NULL, NULL, 1, 10, NULL),
(10, 0, 'complete', 'Задачазадаччччааа', NULL, '22:22:00', NULL, NULL, 1, 10, NULL),
(11, 1, 'complete', 'Выполнитьвыполнить', NULL, '22:22:00', NULL, NULL, 1, 10, NULL),
(12, 0, 'began', 'Беги далеко далеко', NULL, '22:22:00', NULL, NULL, 1, 10, NULL),
(13, 0, 'began', 'Беги далеко далеко', NULL, '22:22:00', NULL, NULL, 1, 10, NULL),
(14, 0, 'began', 'Беги далеко далеко', NULL, '22:22:00', NULL, NULL, 1, 10, NULL),
(15, 0, 'began', 'Беги далеко далеко', NULL, '22:22:00', NULL, NULL, 1, 10, NULL),
(16, 0, 'began', 'что же делать', NULL, '11:11:00', NULL, NULL, 1, 10, NULL),
(17, 0, 'began', 'что же делать', NULL, '11:11:00', NULL, NULL, 1, 10, NULL),
(18, 0, 'began', 'что же делать', NULL, '11:11:00', NULL, NULL, 1, 10, NULL),
(19, 0, 'began', 'Чтозанах', '2017-11-24', '12:21:00', NULL, NULL, 1, 10, NULL),
(20, 0, 'complete', 'Чтотытакое', NULL, '11:11:00', NULL, NULL, 1, 10, NULL),
(21, 0, 'complete', 'xnjjjjjjj', NULL, '34:24:00', NULL, NULL, 10, 12, NULL),
(22, 0, 'complete', 'делать что-то', '2017-11-01', '22:22:00', NULL, NULL, 10, 10, NULL),
(23, 0, 'began', 'ааааааа', '2017-11-24', '22:22:00', NULL, NULL, 10, 10, NULL),
(24, 1, 'began', 'Просто задача обычная', '2017-11-18', '22:00:00', NULL, NULL, 10, 10, 'эт ну ппрост');

--
-- Индексы сохранённых таблиц
--

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
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
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
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `flows`
--
ALTER TABLE `flows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
