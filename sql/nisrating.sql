-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 14 2019 г., 17:27
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nisrating`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `actions`
--

INSERT INTO `actions` (`id`, `action`) VALUES
(1, 'Добавить балл'),
(2, 'Добавить пользователя'),
(3, 'Отклонить предложение'),
(4, 'Принять предложение'),
(5, 'Отнять балл'),
(6, 'Удалить пользователя');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coefficient` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`, `coefficient`) VALUES
(1, 'Под эгидой НИШ/Школьный', 2),
(2, 'Под эгидой НИШ/Областной', 4),
(3, 'Под эгидой НИШ/Республиканский', 7),
(4, 'Под эгидой НИШ/Международный', 15),
(5, 'НЕ Под эгидой НИШ/Школьный', 0.5),
(6, 'НЕ Под эгидой НИШ/Областной ', 1),
(7, 'НЕ Под эгидой НИШ/Республиканский', 3),
(8, 'НЕ Под эгидой НИШ/Международный', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `grade` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `shanyrak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `grades`
--

INSERT INTO `grades` (`id`, `grade`, `letter`, `rating`, `shanyrak`) VALUES
(1, '11', 'с', 0, 1),
(2, '11', 'b', 0, 2),
(3, '8', 'D', 0, 4),
(4, '12', 'D', 0, 4),
(5, '8', 'A', 0, 5),
(6, '10', 'A', 0, 5),
(7, '9', 'C', 0, 6),
(8, '10', 'C', 0, 6),
(9, '7', 'F', 0, 7),
(10, '12', 'A', 0, 7),
(11, '10', 'F', 0, 8),
(12, '11', 'F', 0, 8),
(13, '7', 'D', 0, 8),
(14, '7', 'A', 0, 9),
(15, '10', 'D', 0, 9),
(16, '8', 'E', 0, 10),
(17, '11', 'E', 0, 10),
(18, '9', 'A', 0, 3),
(19, '11', 'A', 0, 3),
(20, '8', 'B', 0, 2),
(21, '7', 'C', 0, 11),
(22, '10', 'E', 0, 11),
(23, '7', 'E', 0, 12),
(24, '10', 'B', 0, 12),
(25, '7', 'B', 0, 13),
(26, '9', 'B', 0, 13),
(27, '9', 'C', 0, 1),
(28, '11', 'D', 0, 14),
(29, '12', 'C', 0, 14),
(30, '8', 'C', 0, 15),
(31, '11', 'B', 0, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  `acted_to` int(11) NOT NULL,
  `type` enum('shanyrak','student','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `place` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coefficient` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `places`
--

INSERT INTO `places` (`id`, `place`, `coefficient`) VALUES
(1, '1 место', 6),
(2, '2 место', 4),
(3, '3 место', 2),
(4, 'Участие', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `place` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `part_amount` int(11) NOT NULL,
  `points` double NOT NULL,
  `author` int(11) NOT NULL,
  `added_to` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `proof` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Админ'),
(2, 'Лидер');

-- --------------------------------------------------------

--
-- Структура таблицы `shanyraks`
--

CREATE TABLE `shanyraks` (
  `id` int(11) NOT NULL,
  `shanyrak` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `img` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shanyraks`
--

INSERT INTO `shanyraks` (`id`, `shanyrak`, `rating`, `img`) VALUES
(1, 'Сарыарқа', 0, 'saryarqa.png'),
(2, 'Каспий', 0, 'kaspii.png'),
(3, 'Жетісу', 0, 'jetisy.png'),
(4, 'Ақжайық', 0, 'aqjaiyq.png'),
(5, 'Алатау', 0, 'alatau.png'),
(6, 'Алаш', 0, 'alash.png\r\n'),
(7, 'Арыс', 0, 'arys.png'),
(8, 'Атамекен', 0, 'atameken.png'),
(9, 'Байқоңыр', 0, 'baiqonur.png'),
(10, 'Бәйтерек', 0, 'baiterek.png'),
(11, 'Оқжетпес', 0, 'oqjetpes.png'),
(12, 'Орда', 0, 'orda.png'),
(13, 'Самұрық', 0, 'samuryq.png'),
(14, 'Тұлпар', 0, 'tulpar.png'),
(15, 'Хан Тәңірі', 0, 'hantaniri.png');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `status`) VALUES
(1, 'Новый'),
(2, 'Принято'),
(3, 'Отклонено');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` int(11) NOT NULL,
  `rating` double NOT NULL,
  `is_olymp` tinyint(1) NOT NULL,
  `is_project` tinyint(1) NOT NULL,
  `img` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `first_name`, `middle_name`, `last_name`, `grade`, `rating`, `is_olymp`, `is_project`, `img`) VALUES
(1, 'Акылбек', 'Дарханович', 'Максутов', 1, 0, 1, 1, 'akyl.jpg'),
(2, 'Данияр', '', 'Жаркынулы', 2, 0, 1, 1, 'doni.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coefficient` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `type`, `coefficient`) VALUES
(1, 'Предметный/Проектный', 3),
(2, 'Робототехника/Искусство', 2),
(3, 'Остальное', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `avatar` varchar(300) DEFAULT NULL,
  `shanyrak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`, `avatar`, `shanyrak`) VALUES
(1, 'donu', '$2y$10$/GUHEPNbZRPQ02z/X5sOK.g7olEbCYVoYDb/Vv1s9DYXgKJDc4nYy', 1, 'doni.jpg', 2),
(9, 'akyl', '$2y$10$6mSw5GN16Pk//WlzIm/z6e6cASO.pW3MSGHFSdEPD7Fj2tYppc2N2', 2, NULL, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shanyraks`
--
ALTER TABLE `shanyraks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `shanyraks`
--
ALTER TABLE `shanyraks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
