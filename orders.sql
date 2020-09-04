-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 04 2020 г., 09:03
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `orders`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`) VALUES
(1, 'Продукт 60', '', 16),
(2, 'Продукт 8', '', 23),
(3, 'Продукт 42', '', 15),
(5, 'Продукт 5312', '', 29),
(6, 'Продукт 20', '', 45),
(7, 'Продукт 24', '', 53),
(8, 'Продукт 1', '', 37),
(9, 'Продукт 53', '', 29),
(10, 'Продукт 1212', '', 50),
(11, 'Продукт 37', '', 13),
(13, 'Продукт 33', '', 55),
(14, 'Продукт 55', '', 23),
(15, 'Продукт 56', '', 54),
(16, 'Продукт 54', '', 9),
(17, 'Продукт 41', '', 47),
(18, 'Продукт 44', '', 13),
(19, 'Продукт 34', '', 24);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'user1'),
(2, 'user2'),
(3, 'user3'),
(4, 'user4'),
(5, 'user5'),
(6, 'user6');

-- --------------------------------------------------------

--
-- Структура таблицы `user_product`
--

CREATE TABLE `user_product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `dt_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_product`
--

INSERT INTO `user_product` (`id`, `user_id`, `product_id`, `dt_created`, `comment`) VALUES
(1, 2, 15, '2020-09-01 07:19:02', NULL),
(2, 2, 19, '2020-09-01 07:19:05', NULL),
(3, 3, 11, '2020-09-01 07:19:08', NULL),
(4, 5, 10, '2020-09-01 07:19:10', NULL),
(5, 5, 7, '2020-09-01 07:19:13', NULL),
(6, 2, 14, '2020-09-01 07:19:16', NULL),
(7, 2, 17, '2020-09-01 07:19:18', NULL),
(8, 5, 17, '2020-09-01 07:19:21', NULL),
(9, 2, 3, '2020-09-01 07:19:23', NULL),
(10, 1, 19, '2020-09-01 07:19:26', NULL),
(11, 1, 8, '2020-09-01 07:19:30', NULL),
(12, 6, 9, '2020-09-01 07:19:32', NULL),
(13, 4, 7, '2020-09-01 07:19:36', NULL),
(14, 3, 17, '2020-09-01 07:19:39', NULL),
(16, 3, 18, '2020-09-01 07:19:47', NULL),
(17, 5, 6, '2020-09-01 07:20:13', NULL),
(18, 1, 15, '2020-09-01 07:20:16', NULL),
(19, 6, 8, '2020-09-01 07:20:18', NULL),
(20, 5, 7, '2020-09-01 07:20:21', NULL),
(21, 3, 19, '2020-09-01 07:20:24', NULL),
(22, 6, 10, '2020-09-01 07:20:26', NULL),
(23, 5, 3, '2020-09-01 07:20:29', NULL),
(24, 1, 16, '2020-09-01 07:20:31', NULL),
(25, 6, 2, '2020-09-01 07:20:34', NULL),
(26, 5, 2, '2020-09-01 07:20:36', NULL),
(27, 1, 17, '2020-09-01 07:20:39', NULL),
(28, 4, 17, '2020-09-01 07:20:41', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user_product`
--
ALTER TABLE `user_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `user_product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
