-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 27 2018 г., 00:26
-- Версия сервера: 5.7.20-19-beget-5.7.20-20-1-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `g96835hj_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL COMMENT 'Айди альбома',
  `aid` int(11) NOT NULL,
  `name` text NOT NULL COMMENT 'Название альбома',
  `note` text NOT NULL COMMENT 'Описание альбома',
  `date` int(11) NOT NULL COMMENT 'Дата создания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bgcomments`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `bgcomments`;
CREATE TABLE `bgcomments` (
  `id` int(11) NOT NULL,
  `idbug` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `blacklist`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE `blacklist` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL COMMENT 'кто',
  `id2` int(11) NOT NULL COMMENT 'кого',
  `about` text NOT NULL COMMENT 'причина'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(255) NOT NULL COMMENT 'Таки id создается сам, но сменить можно',
  `name` text NOT NULL COMMENT 'Название блога',
  `k_about` text NOT NULL,
  `text` text NOT NULL COMMENT 'Тест блога',
  `author` text NOT NULL COMMENT 'Автор, ибо Рита хуй <3',
  `idauthor` int(11) NOT NULL,
  `imgur` int(2) NOT NULL COMMENT 'Включаем "0" - если не хотим фотку в верху, а если хотим то "1".',
  `photo1` text NOT NULL COMMENT 'Прямую ссылку на фотку',
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bugreport`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `bugreport`;
CREATE TABLE `bugreport` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bugtracker`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `bugtracker`;
CREATE TABLE `bugtracker` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `about` text NOT NULL,
  `photo` text NOT NULL,
  `important` int(11) NOT NULL COMMENT '1 - ОЧЕНЬ ВАЖНО ; 2 - Средне ; 3 - Не очень важный ',
  `aid` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 - Открыт ; 2 - Закрыт ; 3 - На модерировании',
  `date` int(11) NOT NULL,
  `comment` text NOT NULL COMMENT 'Ответ модератора на отчет.',
  `admin` int(255) NOT NULL COMMENT 'Администатор данной темы (p.s кто отвечает/следит за темой)',
  `news` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `club`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(255) NOT NULL,
  `about` varchar(500) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL,
  `maturecontent` int(1) NOT NULL DEFAULT '0' COMMENT 'содержит ли группа порнографию (0 - нет, 1 - да)',
  `ban` int(1) NOT NULL,
  `comment_ban` varchar(255) NOT NULL,
  `authorid` int(11) NOT NULL,
  `wall` int(11) NOT NULL COMMENT '0 открыта 1 нихуя',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0 технологичная группа 1 блядская тусовка',
  `datestart` int(11) NOT NULL,
  `datefinish` int(11) NOT NULL,
  `place` text NOT NULL,
  `email` text NOT NULL,
  `closed` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clubsub`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `clubsub`;
CREATE TABLE `clubsub` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `clubsubrequest`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `clubsubrequest`;
CREATE TABLE `clubsubrequest` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT 'просто айди, чтобы был',
  `iduser` int(11) NOT NULL COMMENT 'айди пользователя',
  `idpost` int(11) NOT NULL COMMENT 'айди поста',
  `text` text NOT NULL COMMENT 'текст',
  `date` int(11) NOT NULL COMMENT 'дата'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `dialogs`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `dialogs`;
CREATE TABLE `dialogs` (
  `id` int(11) NOT NULL,
  `readit` int(1) NOT NULL DEFAULT '0',
  `id1` int(11) NOT NULL COMMENT 'айди отправителя',
  `id2` int(11) NOT NULL COMMENT 'айди получателя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL COMMENT 'просто айди, чтобы был',
  `id1` int(11) NOT NULL COMMENT 'какой айди дружит с ',
  `id2` int(11) NOT NULL COMMENT 'этим айди'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `galbums`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `galbums`;
CREATE TABLE `galbums` (
  `id` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `gcomments`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `gcomments`;
CREATE TABLE `gcomments` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `geousers`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `geousers`;
CREATE TABLE `geousers` (
  `id` int(9) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `regip` text NOT NULL,
  `color` text NOT NULL,
  `bodys` text NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gpost`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `gpost`;
CREATE TABLE `gpost` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idwall` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `bygroup` int(1) NOT NULL DEFAULT '0' COMMENT 'от имени группы? 1 - да, 0 - нет.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `info_site`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `info_site`;
CREATE TABLE `info_site` (
  `infotext` text NOT NULL,
  `infoonn` int(1) NOT NULL,
  `id` int(1) NOT NULL,
  `off_site` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `invitecodes`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 20 2018 г., 16:51
--

DROP TABLE IF EXISTS `invitecodes`;
CREATE TABLE `invitecodes` (
  `id` int(11) NOT NULL,
  `code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `createdby` int(11) NOT NULL,
  `usedby` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL COMMENT 'ёбаный в рот этого казино блять',
  `id1` int(11) NOT NULL COMMENT 'айди отправителя',
  `id2` int(11) NOT NULL COMMENT 'айди получателя',
  `topic` varchar(255) NOT NULL COMMENT 'тема',
  `text` varchar(500) NOT NULL COMMENT 'текст',
  `date` int(11) NOT NULL COMMENT 'время и дата',
  `readed` int(11) NOT NULL DEFAULT '0' COMMENT 'ПРОЧИТАЛ ЛИ ПОЛУЧАТЕЛЬ СООБЩЕНИЕ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ncomments`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 11 2018 г., 19:21
--

DROP TABLE IF EXISTS `ncomments`;
CREATE TABLE `ncomments` (
  `id` int(11) NOT NULL,
  `idnote` int(11) NOT NULL,
  `idauthor` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `note`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `text` text NOT NULL,
  `aid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `edited` int(11) NOT NULL DEFAULT '0' COMMENT '0 нет 1 да'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nyash`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `nyash`;
CREATE TABLE `nyash` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `opntwtr_posts`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `opntwtr_posts`;
CREATE TABLE `opntwtr_posts` (
  `id` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `opntwtr_users`
--
-- Создание: Дек 20 2017 г., 12:04
--

DROP TABLE IF EXISTS `opntwtr_users`;
CREATE TABLE `opntwtr_users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `passw0rd` varchar(32) NOT NULL,
  `realname` text NOT NULL,
  `date` date NOT NULL,
  `date_registr` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pcomments`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 11 2018 г., 19:23
--

DROP TABLE IF EXISTS `pcomments`;
CREATE TABLE `pcomments` (
  `id` int(11) NOT NULL COMMENT 'айди',
  `idphoto` int(11) NOT NULL COMMENT 'айди фото',
  `aid` int(11) NOT NULL COMMENT 'айди автора комментария',
  `date` int(11) NOT NULL COMMENT 'дата',
  `text` text NOT NULL COMMENT 'тест СУКА'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL COMMENT 'Айди фотографии',
  `aid` int(11) NOT NULL,
  `image` text NOT NULL COMMENT 'путь к фотографии',
  `note` text NOT NULL COMMENT 'Описание фотографии',
  `album` int(11) NOT NULL COMMENT 'Какому альбому пренадлежит эта фотография',
  `galbum` int(11) NOT NULL COMMENT 'какому альбому в группе эта фотография пренадлежит',
  `user` int(11) NOT NULL COMMENT 'какому пользователю пренадлежит фотография (если она в группе)',
  `date` int(11) NOT NULL COMMENT 'дата в unix'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `rule`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `rule`;
CREATE TABLE `rule` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `siteinfo`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `siteinfo`;
CREATE TABLE `siteinfo` (
  `oninfo` int(1) NOT NULL,
  `texted` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subs`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `subs`;
CREATE TABLE `subs` (
  `id` int(11) NOT NULL,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `userblog`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `userblog`;
CREATE TABLE `userblog` (
  `id` int(11) NOT NULL COMMENT 'айди записи',
  `authorid` int(11) NOT NULL COMMENT 'айди пиздюка блоговода',
  `text` text NOT NULL COMMENT 'что в школе было сегодня?',
  `authortext` text NOT NULL COMMENT 'подпись аФФФтора',
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 25 2018 г., 15:58
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'идентификатор юзера',
  `name` varchar(36) CHARACTER SET utf8 NOT NULL COMMENT 'имя',
  `surname` varchar(36) CHARACTER SET utf8 NOT NULL COMMENT 'фамилия',
  `gender` int(1) NOT NULL DEFAULT '0' COMMENT 'пол (1 - мужчина, 2 - женщина, а 3 - транс :D)',
  `login` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'имя пользователя',
  `password` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'пароль (md5-шифрование)',
  `groupu` int(1) NOT NULL DEFAULT '0',
  `verify` int(1) NOT NULL DEFAULT '0' COMMENT 'есть ли галочка у пользователя (0 - нет; 1 - да, обычная; 5 - да, админская; 3 - да, тестерская)',
  `closedwall` int(1) NOT NULL DEFAULT '0',
  `ban` int(1) NOT NULL DEFAULT '0' COMMENT 'ударили ли админы по голове юзера бан-хамером? (0 - нет, 1 - да)',
  `comment_ban` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'почему забанили пользователя',
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'аватарка',
  `nickname` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ник',
  `status` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'статус',
  `birthdate` int(11) NOT NULL DEFAULT '0',
  `aboutuser` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT 'о пользователе',
  `aboutuser2` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'о пользователе (для поиска)',
  `regdate` int(11) NOT NULL,
  `lastonline` int(11) NOT NULL DEFAULT '0',
  `cssstyle` int(1) NOT NULL DEFAULT '1' COMMENT 'стиль (1 - обычный, 2 - как в старом вк, 3 - современный собственной разработки)',
  `invitecode` varchar(15) CHARACTER SET utf8 NOT NULL COMMENT 'прост',
  `telephone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `telephone_settings` int(11) NOT NULL DEFAULT '0' COMMENT '0 - показывается друзьям, 1 - показывается всем',
  `email_settings` int(11) NOT NULL DEFAULT '0' COMMENT '0 - показывается друзьям, 1 - показывается всем',
  `advice_settings` int(11) NOT NULL DEFAULT '1',
  `ban_bugtracker` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `vcomments`
--
-- Создание: Фев 09 2018 г., 15:26
-- Последнее обновление: Фев 11 2018 г., 19:22
--

DROP TABLE IF EXISTS `vcomments`;
CREATE TABLE `vcomments` (
  `id` int(11) NOT NULL,
  `idvideo` int(11) NOT NULL COMMENT 'айди видео',
  `idauthor` int(11) NOT NULL COMMENT 'айди автора комментария',
  `date` int(11) NOT NULL,
  `text` text NOT NULL COMMENT 'текст СУКА'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `video`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_video` varchar(255) NOT NULL,
  `about` varchar(500) NOT NULL,
  `aid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `category` int(11) NOT NULL COMMENT '1 - Музыка',
  `ban` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `wall`
--
-- Создание: Фев 09 2018 г., 15:26
--

DROP TABLE IF EXISTS `wall`;
CREATE TABLE `wall` (
  `id` int(11) NOT NULL COMMENT 'айди поста',
  `iduser` int(11) NOT NULL COMMENT 'айди пользователя поста',
  `idwall` int(11) NOT NULL COMMENT 'айди стены',
  `text` text NOT NULL COMMENT 'текст ',
  `date` int(11) NOT NULL COMMENT 'дата',
  `image` varchar(255) NOT NULL,
  `edited` int(11) NOT NULL COMMENT '0 - нет, 1  - да'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bgcomments`
--
ALTER TABLE `bgcomments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bugreport`
--
ALTER TABLE `bugreport`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bugtracker`
--
ALTER TABLE `bugtracker`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clubsub`
--
ALTER TABLE `clubsub`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clubsubrequest`
--
ALTER TABLE `clubsubrequest`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dialogs`
--
ALTER TABLE `dialogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `galbums`
--
ALTER TABLE `galbums`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gcomments`
--
ALTER TABLE `gcomments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `geousers`
--
ALTER TABLE `geousers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gpost`
--
ALTER TABLE `gpost`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `info_site`
--
ALTER TABLE `info_site`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `invitecodes`
--
ALTER TABLE `invitecodes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ncomments`
--
ALTER TABLE `ncomments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nyash`
--
ALTER TABLE `nyash`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `opntwtr_posts`
--
ALTER TABLE `opntwtr_posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `opntwtr_users`
--
ALTER TABLE `opntwtr_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pcomments`
--
ALTER TABLE `pcomments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id1`);

--
-- Индексы таблицы `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vcomments`
--
ALTER TABLE `vcomments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wall`
--
ALTER TABLE `wall`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Айди альбома', AUTO_INCREMENT=89961;

--
-- AUTO_INCREMENT для таблицы `bgcomments`
--
ALTER TABLE `bgcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Таки id создается сам, но сменить можно', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `bugreport`
--
ALTER TABLE `bugreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=660;

--
-- AUTO_INCREMENT для таблицы `bugtracker`
--
ALTER TABLE `bugtracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT для таблицы `clubsub`
--
ALTER TABLE `clubsub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT для таблицы `clubsubrequest`
--
ALTER TABLE `clubsubrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'просто айди, чтобы был', AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT для таблицы `dialogs`
--
ALTER TABLE `dialogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'просто айди, чтобы был', AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT для таблицы `galbums`
--
ALTER TABLE `galbums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `gcomments`
--
ALTER TABLE `gcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT для таблицы `gpost`
--
ALTER TABLE `gpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT для таблицы `info_site`
--
ALTER TABLE `info_site`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `invitecodes`
--
ALTER TABLE `invitecodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ёбаный в рот этого казино блять', AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT для таблицы `ncomments`
--
ALTER TABLE `ncomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=572;

--
-- AUTO_INCREMENT для таблицы `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `nyash`
--
ALTER TABLE `nyash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `opntwtr_posts`
--
ALTER TABLE `opntwtr_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `opntwtr_users`
--
ALTER TABLE `opntwtr_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pcomments`
--
ALTER TABLE `pcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'айди', AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT для таблицы `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Айди фотографии', AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT для таблицы `rule`
--
ALTER TABLE `rule`
  MODIFY `id1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `subs`
--
ALTER TABLE `subs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'идентификатор юзера', AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT для таблицы `vcomments`
--
ALTER TABLE `vcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT для таблицы `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2525;

--
-- AUTO_INCREMENT для таблицы `wall`
--
ALTER TABLE `wall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'айди поста', AUTO_INCREMENT=244;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
