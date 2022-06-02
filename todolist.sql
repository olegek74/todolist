-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 02 2022 г., 21:38
-- Версия сервера: 5.7.25-0ubuntu0.18.04.2
-- Версия PHP: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `admin_todolist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(127) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `managers`
--

CREATE TABLE `managers` (
  `user_id` int(11) NOT NULL,
  `login` varchar(31) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `role` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `managers`
--

INSERT INTO `managers` (`user_id`, `login`, `password`, `role`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 2),
(2, 'adgj1', 'e10adc3949ba59abbe56e057f20f883e', 0),
(8, 'oleg', 'e10adc3949ba59abbe56e057f20f883e', 0),
(9, 'snegokop', 'e10adc3949ba59abbe56e057f20f883e', 0),
(3, 'fedotdanetot', 'e10adc3949ba59abbe56e057f20f883e', 0),
(10, 'babenko', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb4 NOT NULL,
  `status` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `status`, `user_id`, `category_id`) VALUES
(1, 'edited 123 ttt', 400, 2, NULL),
(2, 'это могу редактировать не будучи админом', 2, 34, NULL),
(4, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав', 0, 3, NULL),
(5, 'абракадабра ужик сьел жабу !!!', 1, 34, NULL),
(6, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34, NULL),
(7, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34, NULL),
(8, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34, NULL),
(9, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34, NULL),
(11, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34, NULL),
(12, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34, NULL),
(13, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа tt', 0, 34, NULL),
(14, 'asdf asdf asdf 567', 0, 2, NULL),
(15, 'zxzxzxzx fgfggf', 0, 3, NULL),
(16, 'zxzxzxzx', 0, 3, NULL),
(17, 'asaadsdfg', 0, 1, NULL),
(18, 'отредактировано админом', 0, 3, NULL),
(19, 'bbbbbbbbbbbbbbbb', 0, 3, NULL),
(22, 'qqwqeqe 0202', 1, 2, NULL),
(23, 'добавила задачу админом', 0, 1, NULL),
(24, 'Alek testtest', 0, 1, NULL),
(26, 'Чаще же всего заметно было потемневших двуглавых государственных орлов, которые теперь.', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(31) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(63) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'admin', 'admin@i.ua'),
(2, 'adgjl', 'adgj@i.ua'),
(3, 'Федот да не тот', 'fedot-da-ne-tot@gmail.com'),
(8, 'OlegShop', 'oleg@i.ua'),
(9, 'Иннокентий', 'snegokop@i.ue'),
(10, 'Марина Gt', 'babenko@ukr.ua');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `managers`
--
ALTER TABLE `managers`
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
