-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 06 2022 г., 22:41
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todolist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `managers`
--

CREATE TABLE `managers` (
  `user_id` int(11) NOT NULL,
  `login` varchar(31) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `managers`
--

INSERT INTO `managers` (`user_id`, `login`, `password`, `status`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1),
(2, 'adgj1', '289dff07669d7a23de0ef88d2f7129e7', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb4 NOT NULL,
  `status` int(2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `status`, `user_id`) VALUES
(1, 'абракадабра ужик сьел жабу bnbnbn', 4, 2),
(2, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(3, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа rrrrr', 3, 34),
(4, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(5, 'абракадабра ужик сьел жабу', 1, 34),
(6, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(7, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(8, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(9, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(10, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(11, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(12, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(13, 'овпг пн псьтпоп6т марнап3лвт анвтч8а швн ас и ваван в6в8чтв сав нт8 е5чтв оа', 0, 34),
(14, 'asdf asdf asdf 567', 0, 2),
(15, 'zxzxzxzx fgfggf', 0, 3),
(16, 'zxzxzxzx', 0, 3),
(17, 'asaadsdfg', 0, 1),
(18, 'fffffffffffffff', 0, 3),
(19, 'bbbbbbbbbbbbbbbb', 0, 3),
(20, '777 mmmmmmmmmmmmmmmmmmmm ', 0, 2),
(21, '666 wwwwwwwwwwww', 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `taskusers`
--

CREATE TABLE `taskusers` (
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `taskusers`
--

INSERT INTO `taskusers` (`user_id`, `task_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(1, 4),
(2, 5);

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
(3, 'qwer', 'dfghj@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `taskusers`
--
ALTER TABLE `taskusers`
  ADD UNIQUE KEY `user_id` (`user_id`,`task_id`),
  ADD UNIQUE KEY `task_id` (`task_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
