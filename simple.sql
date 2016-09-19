CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'url', 'http://localhost/git/mframe/'),
(2, 'managerids', '1'),
(3, 'name', 'mframe'),
(4, 'twitter_oauth_access_token', '13859682-j29GFY9ON7JpEPr166mOvgYdIG06188elj61nwrNm'),
(5, 'twitter_oauth_access_token_secret', 'iGoCDo6jrVJEueTPGeWtRq5NdpnPnGp0ygczM851ZA'),
(6, 'twitter_consumer_key', 'Pl6RZJ6bSPGfN1HmRw5mw'),
(7, 'twitter_consumer_secret', '5kPfcHODGtbeEdp6E9j1SoAfXzkwgtjAUrOGbz5On8'),
(8, 'flickr_api_key', 'fe443f8f5b84ad3f50ac9a650d1ae909'),
(9, 'flickr_api_secret', '9f24889a814af514'),
(10, 'templatedir', 'templates/'),
(11, 'font_awesome_id', '78dedbeda4'),
(12, 'meta_description', ''),
(13, 'meta_keywords', ''),
(14, 'https_url', '');

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

ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content` (`name`(50),`value`(50));

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content` (`name`(50),`content`(1024));

ALTER TABLE `externalfeeds`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`name`(50),`content`(1024)) USING BTREE;

ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content` (`name`(50),`content`(1024));

ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content` (`name`(50),`content`(1024));

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content` (`username`(50),`password`(50));

ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `externalfeeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT1;
