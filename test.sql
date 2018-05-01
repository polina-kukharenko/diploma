-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 07 2017 г., 20:24
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id_address` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`id_address`),
  KEY `organisation` (`id_user`),
  KEY `organisation_2` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id_address`, `id_user`, `city`, `address`) VALUES
(1, 9, 'Старый Оскол', 'Молодёжный проспект, 19'),
(2, 9, 'Старый Оскол', 'проспект Губкина, 7'),
(3, 9, 'Старый Оскол', 'микрорайон Надежда, 11б'),
(4, 9, 'Губкин', 'Народная улица, 33А'),
(5, 9, 'Губкин', 'Железнодорожная улица'),
(6, 2, 'Шебекино', 'проспект Макарон, 10'),
(7, 11, 'Белгород', 'Бассейный переулок, 4');

-- --------------------------------------------------------

--
-- Структура таблицы `auto`
--

CREATE TABLE IF NOT EXISTS `auto` (
  `id_auto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(10) NOT NULL,
  `sections` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `S` int(11) NOT NULL COMMENT 'Расчеты',
  PRIMARY KEY (`id_auto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `auto`
--

INSERT INTO `auto` (`id_auto`, `number`, `sections`, `volume`, `S`) VALUES
(1, 'р750оо', 2, 16695, 0),
(2, 'р744оо', 2, 23695, 0),
(3, 'с319не', 1, 7845, 0),
(4, 'р414ух', 1, 8620, 0),
(5, 'р343уу', 3, 17045, 0),
(6, 'н606тн', 3, 17045, 0),
(7, 'н688хм', 3, 25110, 0),
(8, 'о729вт', 4, 28128, 0),
(9, 'о101вх', 3, 24965, 0),
(10, 'о626кт', 3, 17062, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dogovors`
--

CREATE TABLE IF NOT EXISTS `dogovors` (
  `no_dogovor_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_resurs` int(11) unsigned NOT NULL,
  `date_start` date NOT NULL,
  `uslovie` int(10) NOT NULL,
  `status_dogovor` int(11) unsigned NOT NULL,
  PRIMARY KEY (`no_dogovor_id`),
  KEY `organisation` (`id_user`,`id_resurs`),
  KEY `status_dogovor` (`status_dogovor`),
  KEY `status_dogovor_2` (`status_dogovor`),
  KEY `status_dogovor_3` (`status_dogovor`),
  KEY `id_resurs_fk` (`id_resurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `dogovors`
--

INSERT INTO `dogovors` (`no_dogovor_id`, `id_user`, `id_resurs`, `date_start`, `uslovie`, `status_dogovor`) VALUES
(1, 9, 2, '2016-11-16', 8000, 1),
(2, 2, 1, '2016-04-17', 14000, 1),
(3, 9, 4, '2017-01-18', 15000, 2),
(4, 11, 4, '2017-05-29', 16000, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `id_driver` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last_name_driver` varchar(20) NOT NULL,
  `telephon_num` varchar(20) NOT NULL,
  PRIMARY KEY (`id_driver`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `drivers`
--

INSERT INTO `drivers` (`id_driver`, `last_name_driver`, `telephon_num`) VALUES
(1, 'Кунаев А. Л.', '5234523'),
(2, 'Буров В. А.', '7658678657'),
(3, 'Щербак А. В.', '658345784'),
(4, 'Минков К. И.', '658326342'),
(5, 'Зиборов Н. Н.', '4543657'),
(6, 'Шаповный Ю. В.', '4543657'),
(7, 'Опорный С. В.', '867867657'),
(8, 'Севаев В. В.', '8656867657'),
(9, 'Дорнеев С. Н.', '54377247'),
(10, 'Харитонский Г. П.', '1445837247');

-- --------------------------------------------------------

--
-- Структура таблицы `info_users`
--

CREATE TABLE IF NOT EXISTS `info_users` (
  `id` int(11) unsigned NOT NULL,
  `organization_name` varchar(50) NOT NULL,
  `org_address` varchar(100) NOT NULL,
  `org_telephone_num` varchar(20) NOT NULL,
  `contact_agent` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info_users`
--

INSERT INTO `info_users` (`id`, `organization_name`, `org_address`, `org_telephone_num`, `contact_agent`) VALUES
(9, 'Прохоровская зерновая компания', 'улица Центральная, д. 41, Призначное, Белгородская обл.', '8(472)424-01-15', 'Анисимова Валерия Дмитриевна'),
(10, 'Осколнефтеснаб', 'Приборостроитель, 54', '8-800-800-80-80', 'Менеджерова Алёна Ивановна'),
(11, 'ОАО &quot;Осколнефтеснаб&quot;', 'микрорайон Приборостроитель, 54, Старый Оскол', '8(123)456-78-90', '');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dogovor` int(11) NOT NULL,
  `kolvo` int(6) NOT NULL,
  `date_order` date NOT NULL,
  `date_post` date NOT NULL,
  `status` int(11) NOT NULL,
  `address_ship` int(11) NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `address_ship` (`address_ship`),
  KEY `dogovor` (`dogovor`,`status`,`address_ship`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `dogovor`, `kolvo`, `date_order`, `date_post`, `status`, `address_ship`) VALUES
(2, 2, 8300, '2017-05-06', '2017-05-17', 6, 6),
(3, 1, 7100, '2017-05-06', '2017-05-17', 6, 3),
(4, 3, 7250, '2017-05-13', '2017-05-24', 6, 5),
(5, 1, 8000, '2017-05-13', '2017-05-17', 6, 4),
(6, 3, 8400, '2017-05-14', '2017-05-17', 6, 5),
(7, 1, 7200, '2017-05-11', '2017-05-17', 6, 2),
(9, 4, 10000, '2017-05-29', '2017-05-31', 1, 7),
(10, 4, 16000, '2017-05-30', '2017-05-31', 1, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `resurs`
--

CREATE TABLE IF NOT EXISTS `resurs` (
  `id_resurs` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resurs_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_resurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `resurs`
--

INSERT INTO `resurs` (`id_resurs`, `resurs_name`) VALUES
(1, '92'),
(2, '95'),
(3, '98'),
(4, 'ДТ');

-- --------------------------------------------------------

--
-- Структура таблицы `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
  `id_auto` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `date_post_index` date NOT NULL,
  UNIQUE KEY `id_auto_2` (`id_auto`,`id_order`),
  KEY `id_auto` (`id_auto`,`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shipping`
--

INSERT INTO `shipping` (`id_auto`, `id_order`, `date_post_index`) VALUES
(8, 3, '2017-05-17'),
(8, 4, '2017-05-24'),
(8, 7, '2017-05-17'),
(9, 2, '2017-05-17'),
(9, 5, '2017-05-17'),
(9, 6, '2017-05-17');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `status_name`) VALUES
(1, 'Ожидает обработки'),
(2, 'Обработывается'),
(3, 'Отправлен'),
(4, 'Доставлен'),
(5, 'Обработан'),
(6, 'Заявка отправлена'),
(7, 'Отменен');

-- --------------------------------------------------------

--
-- Структура таблицы `status_auto`
--

CREATE TABLE IF NOT EXISTS `status_auto` (
  `id_status_auto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status_auto_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id_status_auto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `status_auto`
--

INSERT INTO `status_auto` (`id_status_auto`, `status_auto_name`) VALUES
(1, 'Готов'),
(2, 'Не готов'),
(3, 'В ремонте');

-- --------------------------------------------------------

--
-- Структура таблицы `trailers`
--

CREATE TABLE IF NOT EXISTS `trailers` (
  `id_trailer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number_tr` varchar(10) NOT NULL,
  `sections` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `auto` int(10) unsigned NOT NULL,
  `P` int(11) NOT NULL COMMENT 'Расчеты',
  PRIMARY KEY (`id_trailer`),
  KEY `auto` (`auto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `trailers`
--

INSERT INTO `trailers` (`id_trailer`, `number_tr`, `sections`, `volume`, `auto`, `P`) VALUES
(1, 'ан2801', 1, 8620, 5, 0),
(2, 'ан2802', 1, 8610, 6, 0),
(3, 'ан4759', 1, 9515, 10, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `role`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'samanthared@yandex.ru', 0),
(9, 'login1', '079323a49c300dcd8dffe1460dede02c', 'login@yandex.ru', 2),
(10, 'manager1', 'c240642ddef994358c96da82c0361a58', 'manager@yandex.ru', 1),
(11, 'login2@list.ru', '3b38c223cd0767c5e6f40a7fb86159b4', 'login2@list.ru', 2),
(12, 'manager2', '8df5127cd164b5bc2d2b78410a7eea0c', 'manager2@yandex.ru', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `uslovia`
--

CREATE TABLE IF NOT EXISTS `uslovia` (
  `ID_status_dogovor` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status_dogovor` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_status_dogovor`),
  UNIQUE KEY `ID_status_dogovor` (`ID_status_dogovor`),
  UNIQUE KEY `ID_status_dogovor_2` (`ID_status_dogovor`),
  KEY `status_dogovor` (`status_dogovor`),
  KEY `ID_status_dogovor_3` (`ID_status_dogovor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `uslovia`
--

INSERT INTO `uslovia` (`ID_status_dogovor`, `status_dogovor`) VALUES
(1, 'Активный'),
(2, 'Неактивный');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dogovors`
--
ALTER TABLE `dogovors`
  ADD CONSTRAINT `id_resurs_fk` FOREIGN KEY (`id_resurs`) REFERENCES `resurs` (`id_resurs`) ON UPDATE CASCADE,
  ADD CONSTRAINT `status_dogovor_fk` FOREIGN KEY (`status_dogovor`) REFERENCES `uslovia` (`ID_status_dogovor`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `trailers`
--
ALTER TABLE `trailers`
  ADD CONSTRAINT `auto_fk` FOREIGN KEY (`auto`) REFERENCES `auto` (`id_auto`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
