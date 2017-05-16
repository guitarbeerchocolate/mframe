SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `responseid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `draftpages` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `layout` int(11) NOT NULL,
  `secondarycontent` text NOT NULL,
  `issubpage` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `datestart` date NOT NULL,
  `dateend` date NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `externalfeeds` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `navigation` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `layout` int(11) NOT NULL,
  `secondarycontent` text NOT NULL,
  `issubpage` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `photo` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`id`,`name`(50),`content`(1024));

ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content` (`name`(50),`value`(50));

ALTER TABLE `draftpages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`name`(50),`content`(1024));

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`name`(50),`content`(1024));

ALTER TABLE `externalfeeds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`name`(50),`location`(50));

ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`id`,`name`(50),`location`(50));

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`name`(50),`content`(1024)) USING BTREE;

ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`name`(50),`content`(1024));

ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`name`(50),`content`(1024));

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`username`(50),`password`(50));

ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `draftpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `externalfeeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `navigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;