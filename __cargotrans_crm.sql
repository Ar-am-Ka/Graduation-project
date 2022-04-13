-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2021 г., 22:12
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
-- База данных: `cargotrans_crm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id_appl` int(11) UNSIGNED ZEROFILL NOT NULL,
  `status` enum('pending','execution','completed') NOT NULL DEFAULT 'pending',
  `id_emp` smallint(5) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'manager',
  `id_client` int(11) UNSIGNED ZEROFILL NOT NULL COMMENT 'counterparty',
  `consignor` varchar(50) DEFAULT NULL,
  `consignor_phone` varchar(10) NOT NULL,
  `dispatch` varchar(255) DEFAULT NULL,
  `recipient` varchar(50) DEFAULT NULL,
  `recipient_phone` varchar(10) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `type` enum('CC','TT','CT','TC') NOT NULL,
  `preliminary_cost` decimal(9,2) DEFAULT NULL,
  `total_cost` decimal(9,2) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_finish` datetime NOT NULL,
  `date_complete` datetime DEFAULT NULL,
  `archive` enum('no','yes') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) UNSIGNED ZEROFILL NOT NULL,
  `description` varchar(20) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `length` decimal(6,2) DEFAULT NULL,
  `width` decimal(6,2) DEFAULT NULL,
  `height` decimal(6,2) DEFAULT NULL,
  `volume` decimal(6,2) DEFAULT NULL,
  `charact` set('''liquid''','''fragile''','''notflip''','''notwet''') DEFAULT NULL,
  `declared_value` mediumint(8) UNSIGNED DEFAULT NULL,
  `number` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `id_appl` int(11) UNSIGNED ZEROFILL NOT NULL COMMENT 'application',
  `id_transp` int(11) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'transportation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id_client` int(11) UNSIGNED ZEROFILL NOT NULL,
  `name_client` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `legal_address` varchar(255) DEFAULT NULL COMMENT 'юридический',
  `inn` varchar(12) DEFAULT NULL COMMENT 'инн',
  `kpp` varchar(9) DEFAULT NULL COMMENT 'кпп',
  `bank` varchar(50) DEFAULT NULL,
  `bic` varchar(9) DEFAULT NULL COMMENT 'бик',
  `acc` varchar(20) DEFAULT NULL COMMENT 'расчётный счёт',
  `corr` varchar(20) DEFAULT NULL COMMENT 'корреспондентский счёт'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id_client`, `name_client`, `phone`, `email`, `address`, `legal_address`, `inn`, `kpp`, `bank`, `bic`, `acc`, `corr`) VALUES
(00000000001, 'АО \"Соединённые города\"', '9786517372', 'contactus@unitedcities.ru', '612157 РК, город Симферополь, улица Будапештсткая, 40', '612157 РК, город Симферополь, улица Будапештсткая, 40', '5608394950', '207801388', 'РНКБ Банк (ПАО)', '043510607', '4085722789854328526', '3087634366256277293'),
(00000000002, 'Арам', '9780462048', 'Jamsa', '612432 РК, город Симферополь, улица Будапештсткая, 40', '612432 РК, город Симферополь, улица Будапештсткая, 40', '123456789012', '123456789', 'ПАО', '000000000', '40800000000000000000', '30800000000000000000'),
(00000000003, 'Юрик', '1451514565', 'JUSTIC', 'JUSTIC', 'JUSTIC', '324235327467', '651651651', 'bakl', '000000000', '40800000000000000000', '12452415245425433526'),
(00000000004, 'Юрик', '3134134133', 'JU31STIC', 'JUSTIC', 'JU333IC', '131341344314', '651651651', '13413rfe2r31', '134314133', '40800023232434300000', '12452415245425433526'),
(00100000000, 'Лебедев Глеб Давидович', '9788365254', 'glebed@mail.ru', '612597 РК, город Алушта, улица Ладыгина, 05', NULL, '750662874788', '487244731', 'РНКБ Банк (ПАО)', '043510607', '4087227898256277293', '3085727729354328526'),
(00100000001, 'Николаев Роман Викторович  ', '9786168945', 'romanv@mirolla.com', 'РК, город Ялта, улица Ленинградская, 34', '', '563847956763', '246589873', 'РНКБ Банк (ПАО)', '981345728', '40825179658756487567', '30819576839457197459');

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE `department` (
  `indx` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `type` enum('central','hub','point') NOT NULL,
  `place` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`indx`, `type`, `place`) VALUES
(00001, 'central', 'Симферополь');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `id_emp` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `name_emp` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `indx` smallint(5) UNSIGNED NOT NULL COMMENT 'department',
  `position` varchar(20) DEFAULT NULL,
  `lgn` varchar(16) NOT NULL,
  `psw` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id_emp`, `name_emp`, `email`, `phone`, `indx`, `position`, `lgn`, `psw`) VALUES
(00001, 'Иванов Иван Иванович', 'TEST@TEST.TEST', '9009000909', 1, '', 'sysadmin_ctcrm', 'admin299');

-- --------------------------------------------------------

--
-- Структура таблицы `transportation`
--

CREATE TABLE `transportation` (
  `id_transp` int(11) UNSIGNED ZEROFILL NOT NULL,
  `description` varchar(20) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_finish` datetime NOT NULL,
  `date_complete` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id_appl`),
  ADD KEY `id_emp` (`id_emp`),
  ADD KEY `id_client` (`id_client`);

--
-- Индексы таблицы `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`),
  ADD KEY `id_transp` (`id_transp`),
  ADD KEY `id_appl` (`id_appl`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Индексы таблицы `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`indx`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_emp`),
  ADD KEY `department` (`indx`);

--
-- Индексы таблицы `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`id_transp`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id_appl` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `department`
--
ALTER TABLE `department`
  MODIFY `indx` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id_emp` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `transportation`
--
ALTER TABLE `transportation`
  MODIFY `id_transp` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`id_emp`) REFERENCES `employee` (`id_emp`) ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cargo_ibfk_1` FOREIGN KEY (`id_transp`) REFERENCES `transportation` (`id_transp`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cargo_ibfk_2` FOREIGN KEY (`id_appl`) REFERENCES `application` (`id_appl`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`indx`) REFERENCES `department` (`indx`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
