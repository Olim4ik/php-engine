-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2022 г., 12:42
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `engine.com`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `user_id`, `name`, `order_id`, `url`, `date`, `status`) VALUES
(1, 0, 16, 'follower', 0, 'list-role.php', '2022-05-28 13:05:47', 'active'),
(2, 0, 16, 'admin', 0, 'list-role.php', '2022-05-28 13:06:06', 'active'),
(3, 0, 16, 'superAdmin', 0, 'list-role.php', '2022-05-28 13:06:15', 'active'),
(8, 0, 16, 'active', 0, 'list-status.php', '2022-05-28 13:46:24', 'active'),
(9, 0, 16, 'del', 0, 'list-status.php', '2022-05-28 13:46:27', 'active'),
(10, 0, 16, 'manager', 0, 'list-role.php', '2022-05-29 17:36:32', 'del');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(20) NOT NULL DEFAULT 'follower'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `status`, `date`, `role`) VALUES
(16, 'youngproger47@gmail.com', '4297f44b13955235245b2497399d7a93', 'active', '2022-05-28 12:43:54', 'superAdmin'),
(17, 'aaa@gmail.com', '4297f44b13955235245b2497399d7a93', 'active', '2022-05-29 16:20:39', 'admin'),
(18, 'asd@gmail.com', '4297f44b13955235245b2497399d7a93', 'active', '2022-05-29 16:20:53', 'follower'),
(19, 'odjavharov@gmail.com', '1cbf424452ed5c10fa38689c94c4a003', 'active', '2022-05-30 09:17:57', 'follower'),
(20, 'odjavharov2@gmail.com', '4297f44b13955235245b2497399d7a93', 'active', '2022-05-30 09:18:56', 'follower');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
