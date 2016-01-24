-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 24 2016 г., 19:47
-- Версия сервера: 5.5.44-log
-- Версия PHP: 5.4.41

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_image`
--

CREATE TABLE IF NOT EXISTS `gallery_image` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `ownerId` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery_image`
--

INSERT INTO `gallery_image` (`id`, `type`, `ownerId`, `rank`, `name`, `description`) VALUES
(1, 'posts', '1', 2, 'картинка1', 'картинка1'),
(2, 'posts', '1', 1, 'Картинка2', 'Большая картинка 2'),
(6, 'posts', '3', 6, 'ttttt', ''),
(5, 'posts', '2', 5, 'cs', ''),
(4, 'posts', '1', 4, 'Картинки 4', 'Картинки 4');

-- --------------------------------------------------------

--
-- Структура таблицы `kscd_categories`
--

CREATE TABLE IF NOT EXISTS `kscd_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'publish',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user` int(11) NOT NULL DEFAULT '0',
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `kscd_categories`
--

INSERT INTO `kscd_categories` (`id`, `name`, `slug`, `status`, `created_date`, `created_user`, `updated_date`, `updated_user`) VALUES
(1, 'Вышивание', 'embroidery', 'publish', '2016-01-09 15:00:38', 1, '2016-01-09 15:00:38', 1),
(2, 'Вязание', 'knitting', 'publish', '2016-01-10 18:17:33', 1, '2016-01-10 18:17:33', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `kscd_comments`
--

CREATE TABLE IF NOT EXISTS `kscd_comments` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `author_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `author_ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `karma` int(11) NOT NULL DEFAULT '0',
  `approved` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `kscd_comments`
--

INSERT INTO `kscd_comments` (`id`, `post_id`, `author`, `author_email`, `author_url`, `author_ip`, `agent`, `content`, `karma`, `approved`, `parent`, `created_date`, `created_user`) VALUES
(1, 2, 'admin', 'admin@yii.su', '', '127.0.0.1', 'Mozilla Firefox', 'Тестовый комментарий для записи #2', 0, '1', 0, '2016-01-16 18:10:00', 1),
(2, 2, 'olga', 'olga@yii.su', '', '127.0.0.1', 'Mozilla', '<p>Не следует, однако забывать, что начало повседневной работы по формированию позиции влечет за собой процесс внедрения и модернизации новых предложений. Разнообразный и богатый опыт рамки и место обучения кадров играет важную роль в формировании форм развития. Не следует, однако забывать, что постоянное информационно-пропагандистское обеспечение нашей деятельности обеспечивает широкому кругу (специалистов) участие в формировании дальнейших направлений развития.</p>\r\n<p>Равным образом укрепление и развитие структуры в значительной степени обуславливает создание новых предложений. Таким образом постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки систем массового участия. Значимость этих проблем настолько очевидна, что консультация с широким активом в значительной степени обуславливает создание форм развития. Идейные соображения высшего порядка, а также сложившаяся структура организации требуют от нас анализа дальнейших направлений развития.</p>\r\n<p>Повседневная практика показывает, что дальнейшее развитие различных форм деятельности требуют определения и уточнения модели развития. Повседневная практика показывает, что начало повседневной работы по формированию позиции позволяет выполнять важные задания по разработке дальнейших направлений развития. Не следует, однако забывать, что реализация намеченных плановых заданий позволяет оценить значение соответствующий условий активизации. С другой стороны начало повседневной работы по формированию позиции влечет за собой процесс внедрения и модернизации существенных финансовых и административных условий. Повседневная практика показывает, что консультация с широким активом представляет собой интересный эксперимент проверки систем массового участия.</p>', 0, '1', 1, '2016-01-16 21:01:40', 2),
(3, 2, 'admin', 'admin@yii2.su', '', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1; rv:43.0) Gecko/20100101 Firefox/43.0', 'test123', 0, '2', 2, '2016-01-23 15:48:19', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `kscd_posts`
--

CREATE TABLE IF NOT EXISTS `kscd_posts` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user` int(11) NOT NULL DEFAULT '0',
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `kscd_posts`
--

INSERT INTO `kscd_posts` (`id`, `category_id`, `title`, `content`, `tags`, `status`, `comment_status`, `comment_count`, `created_date`, `created_user`, `updated_date`, `updated_user`) VALUES
(1, 1, 'Test post 1', '<p>Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, мой друг, так упоен ощущением покоя, что искусство мое страдает от этого. Ни одного штриха не мог бы я сделать, а никогда не был таким большим художником, как в эти минуты. Когда от милой моей долины поднимается пар и полдневное солнце стоит над непроницаемой чащей темного леса и лишь редкий луч проскальзывает в его святая святых, а я лежу в высокой траве у быстрого ручья и, прильнув к земле, вижу тысячи всевозможных былинок и чувствую, как близок моему сердцу крошечный мирок, что снует между стебельками, наблюдаю эти неисчислимые, непостижимые разновидности червяков и мошек и чувствую близость всемогущего, создавшего нас по своему подобию, веяние вселюбящего, судившего нам парить в вечном блаженстве, когда взор мой туманится и все вокруг меня и небо надо мной запечатлены в моей душе, точно образ возлюбленной, - тогда, дорогой друг, меня часто томит мысль: "Ах! Как бы выразить, как бы вдохнуть в рисунок то, что так полно, так трепетно живет во мне, запечатлеть отражение моей души, как душа моя - отражение предвечного бога!" Друг</p>', 'test', 'publish', 'open', 0, '2016-01-09 15:38:20', 1, '2016-01-09 20:15:30', 1),
(2, 1, 'Test post 2', '<p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни.</p>\r\n<p>Однажды одна маленькая строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики. Великий Оксмокс предупреждал ее о злых запятых, диких знаках вопроса и коварных точках с запятой, но текст не дал сбить себя с толку. Он собрал семь своих заглавных букв, подпоясал инициал за пояс и пустился в дорогу.</p>\r\n<p>Взобравшись на первую вершину курсивных гор, бросил он последний взгляд назад, на силуэт своего родного города Буквоград, на заголовок деревни Алфавит и на подзаголовок своего переулка Строчка. Грустный реторический вопрос скатился по его щеке и он продолжил свой путь.</p>\r\n<p>По дороге встретил текст рукопись. Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель</p>', '', 'publish', 'close', 0, '2016-01-09 18:00:39', 1, '2016-01-09 18:00:39', 1),
(3, 2, 'Test post 1', '<p>Проснувшись однажды утром после беспокойного сна, Грегор Замза обнаружил, что он у себя в постели превратился в страшное насекомое. Лежа на панцирнотвердой спине, он видел, стоило ему приподнять голову, свой коричневый, выпуклый, разделенный дугообразными чешуйками живот, на верхушке которого еле держалось готовое вот-вот окончательно сползти одеяло. Его многочисленные, убого тонкие по сравнению с остальным телом ножки беспомощно копошились у него перед глазами. «Что со мной случилось?» – подумал он. Это не было сном. Его комната, настоящая, разве что слишком маленькая, но обычная комната, мирно покоилась в своих четырех хорошо знакомых стенах. Над столом, где были разложены распакованные образцы сукон – Замза был коммивояжером, – висел портрет, который он недавно вырезал из иллюстрированного журнала и вставил в красивую золоченую рамку. На портрете была изображена дама в меховой шляпе и боа, она сидела очень прямо и протягивала зрителю тяжелую меховую муфту, в которой целиком исчезала ее рука. Затем взгляд Грегора устремился в окно, и пасмурная погода – слышно было, как по жести подоконника стучат капли дождя – привела его и вовсе в грустное настроение. «Хорошо бы еще немного поспать и забыть всю эту чепуху», – подумал он, но это было совершенно неосуществимо, он привык спать на правом боку, а в теперешнем своем</p>', '', 'publish', 'open', 0, '2016-01-10 18:18:40', 1, '2016-01-10 18:18:40', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `kscd_tags`
--

CREATE TABLE IF NOT EXISTS `kscd_tags` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1452090378),
('m140209_132017_init', 1452092731),
('m140403_174025_create_account_table', 1452092732),
('m140504_113157_update_tables', 1452092736),
('m140504_130429_create_token_table', 1452092736),
('m140830_171933_fix_ip_field', 1452092737),
('m140830_172703_change_account_table_name', 1452092737),
('m141222_110026_update_ip_field', 1452092737),
('m141222_135246_alter_username_length', 1452092738),
('m150614_103145_update_social_account_table', 1452092739),
('m150623_212711_fix_username_notnull', 1452092739),
('m140506_102106_rbac_init', 1452094729),
('m150318_154933_gallery_ext', 1452255444),
('m160107_110021_create_kscd_tables', 1452337182);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`) VALUES
(1, 'admin', 'admin@yii2.su', '$2y$10$kvDcGs5X.FdeN.BNAKhu8uE55eUWlhwuSZQLZfqXzeS22pbWWGXim', 'hNYPwo8y42s2lC8C95rYIwQ1xiIFUjDv', 1452093478, NULL, NULL, '127.0.0.1', 1452093448, 1452093448, 0),
(2, 'olga', 'olga@yii2.su', '$2y$10$ifNwylQBrJNa/cBCy.aGzO4NmsnrRYgrL/F6tckFQvb9hgPFDfhHO', '8GtQobkbnrgc4CyBlFtzqNAsKM3WbfiC', 1452098788, NULL, NULL, '127.0.0.1', 1452098788, 1452098788, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `gallery_image`
--
ALTER TABLE `gallery_image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `kscd_categories`
--
ALTER TABLE `kscd_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kscd_categories_unique_name` (`name`),
  ADD UNIQUE KEY `kscd_categories_unique_slug` (`slug`),
  ADD KEY `fk_created_user_kscd_categories` (`created_user`),
  ADD KEY `fk_updated_user_kscd_categories` (`updated_user`);

--
-- Индексы таблицы `kscd_comments`
--
ALTER TABLE `kscd_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kscd_comments_approved_created_date` (`approved`,`created_date`),
  ADD KEY `kscd_comments_author_email` (`author_email`),
  ADD KEY `kscd_comments_created_date` (`created_date`),
  ADD KEY `kscd_comments_parent` (`parent`),
  ADD KEY `kscd_comments_post_id` (`post_id`),
  ADD KEY `fk_created_user_kscd_comments` (`created_user`);

--
-- Индексы таблицы `kscd_posts`
--
ALTER TABLE `kscd_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kscd_posts_category_id` (`category_id`),
  ADD KEY `kscd_posts_category_id_created_date` (`category_id`,`created_date`),
  ADD KEY `fk_created_user_kscd_posts` (`created_user`),
  ADD KEY `fk_updated_user_kscd_posts` (`updated_user`);

--
-- Индексы таблицы `kscd_tags`
--
ALTER TABLE `kscd_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kscd_tags_unique_name` (`name`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Индексы таблицы `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_email` (`email`),
  ADD UNIQUE KEY `user_unique_username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `kscd_categories`
--
ALTER TABLE `kscd_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `kscd_comments`
--
ALTER TABLE `kscd_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `kscd_posts`
--
ALTER TABLE `kscd_posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `kscd_tags`
--
ALTER TABLE `kscd_tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `kscd_categories`
--
ALTER TABLE `kscd_categories`
  ADD CONSTRAINT `fk_created_user_kscd_categories` FOREIGN KEY (`created_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_updated_user_kscd_categories` FOREIGN KEY (`updated_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `kscd_comments`
--
ALTER TABLE `kscd_comments`
  ADD CONSTRAINT `fk_created_user_kscd_comments` FOREIGN KEY (`created_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_id_kscd_comments` FOREIGN KEY (`post_id`) REFERENCES `kscd_posts` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `kscd_posts`
--
ALTER TABLE `kscd_posts`
  ADD CONSTRAINT `fk_category_id_kscd_posts` FOREIGN KEY (`category_id`) REFERENCES `kscd_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_created_user_kscd_posts` FOREIGN KEY (`created_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_updated_user_kscd_posts` FOREIGN KEY (`updated_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
