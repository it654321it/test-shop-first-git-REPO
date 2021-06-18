-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 18 2021 г., 19:15
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin_role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`customer_id`, `last_name`, `first_name`, `telephone`, `email`, `city`, `password`, `admin_role`) VALUES
(1, 'Півкач', 'Михайло', '+380501111111', 'mykhailo.pivkach@transoftgroup.com', 'Мукачево', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(2, 'Іваненко', 'Стас', '+380951231212', 'iv_stas_2@gmail.com', 'Ужгород', 'c81e728d9d4c2f636f067f89cc14862c', 0),
(3, 'Чабаненко', 'Роман', '+380312137862', 'chaban_r_3@mail.ua', 'Свалява', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 0),
(4, 'Майло', 'Святослав', '+380503419808', 'maylo_svat_4@i.ua', 'Виноградів', 'a87ff679a2f3e71d9181a67b7542122c', 0),
(5, 'Стефанчук', 'Владислава', '+380679934121', 'vlada_ste_5@ukr.net', 'Берегово', 'e4da3b7fbbce2345d7772b0674a318d5', 0),
(6, 'Jessy', 'John', '0998877654', 'jj@mail.ua', 'lutsk', '4b83187c2d5a9c72104cfbd994ad66aa', 0),
(7, 'Vildman', 'John', '0959911234', 'jj-@mail.ua', 'lviv', 'd0c8a72effc8f974387d30dbabbd8e56', 0),
(8, 'Jessy', 'John', '0675544321', 'jj-1@mail.ua', 'lviv', 'd0c8a72effc8f974387d30dbabbd8e56', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `admin_role` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customer_id`, `last_name`, `first_name`, `phone`, `email`, `password`, `city`, `admin_role`) VALUES
(2, 'Півкач', 'Михайло', '+380501111111', 'mykhailo.pivkach@transoftgroup.com', '3fc0a7acf087f549ac2b266baf94b8b1', 'Мукачево', 1),
(13, 'Murff', 'Donald', '+443125911482', 'murf@microsoft.com', '440655d6d98f244c507d27576a9209c5', 'Chicago', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`, `active`, `sort_order`) VALUES
(1, 'Товари', '/product/list', 1, 1),
(2, 'Клієнти', '/customer/list', 1, 2),
(3, 'Тест', '/test/test', 1, 3),
(4, 'Експорт в Xml', '/product/xml', 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `nameOrd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` bigint(15) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `date_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `nameOrd`, `email`, `telephone`, `sku`, `name`, `price`, `date_at`) VALUES
(1, 'Михайло', 'mykhailo.pivkach@transoftgroup.com', 313137862, 'фывфывыф', '<h1>выфвфыв</h1>', '0.00', '2019-11-21 08:33:46');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `sku` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `qty` decimal(12,3) NOT NULL DEFAULT 0.000,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `qty`, `description`) VALUES
(3, 't00003', 'Телефон 3', '24.00', '5.000', '<h1>Телефон 3</h1>'),
(4, 't00004', ' <h1>Телефон 4</h1> ', '8.00', '2.000', ' &lt;h1&gt;Телефон 4&lt;/h1&gt; '),
(27, 't15', 'Java', '15.05', '15.000', 'good old');

-- --------------------------------------------------------

--
-- Структура таблицы `sales_order`
--

CREATE TABLE `sales_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sales_order`
--

INSERT INTO `sales_order` (`order_id`, `customer_id`, `datetime`) VALUES
(1, 1, '2019-10-24 12:29:59'),
(2, 1, '2019-10-24 12:31:17'),
(3, 1, '2019-10-24 12:44:08'),
(4, 1, '2019-10-24 12:44:10');

-- --------------------------------------------------------

--
-- Структура таблицы `sales_orderitem`
--

CREATE TABLE `sales_orderitem` (
  `orderitem_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` decimal(12,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sales_orderitem`
--

INSERT INTO `sales_orderitem` (`orderitem_id`, `order_id`, `product_id`, `qty`) VALUES
(3, 2, 3, '1.000'),
(4, 2, 4, '2.000');

-- --------------------------------------------------------

--
-- Структура таблицы `shopping`
--

CREATE TABLE `shopping` (
  `orderitem_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `result` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shopping`
--

INSERT INTO `shopping` (`orderitem_id`, `customer_id`, `product_id`, `qty`, `datetime`, `result`) VALUES
(3, 1, 4, 1, '2019-11-21 08:53:59', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `name`, `date`) VALUES
(1, 'test', '2019-10-22 18:44:59');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_ORDER_CUSTOMER` (`customer_id`);

--
-- Индексы таблицы `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `FK_ORDERITEM_ORDER` (`order_id`),
  ADD KEY `FK_ORDERITEM_PRODUCT` (`product_id`);

--
-- Индексы таблицы `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `FK_ORDERITEM_ORDER` (`customer_id`),
  ADD KEY `FK_ORDERITEM_PRODUCT` (`product_id`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  MODIFY `orderitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `shopping`
--
ALTER TABLE `shopping`
  MODIFY `orderitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `sales_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD CONSTRAINT `sales_orderitem_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_orderitem_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shopping`
--
ALTER TABLE `shopping`
  ADD CONSTRAINT `shopping_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
