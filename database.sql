--
-- MySQL 5.1.46
-- Wed, 05 Jan 2011 08:57:18 +0000
--

CREATE TABLE `class` (
   `id` int(2) not null auto_increment,
   `name` varchar(8) not null,
   `fullname` varchar(32),
   `mentor` varchar(16),
   UNIQUE KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE `file` (
   `id` int(8) not null,
   `path` varchar(64) not null,
   `size` int(32) not null,
   `fullname` varchar(64) not null,
   `owner` int(4) not null,
   UNIQUE KEY (`id`),
   UNIQUE KEY (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `role` (
   `id` int(2) not null auto_increment,
   `name` varchar(16) not null,
   `fullname` varchar(32),
   UNIQUE KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE `user` (
   `id` int(8) not null auto_increment,
   `role` int(2) not null default '1',
   `class` int(2),
   `username` varchar(32) not null,
   `password` varchar(128) not null,
   `lastlogin` timestamp not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
   `firstname` varchar(128) not null,
   `lastname` varchar(128) not null,
   `email` varchar(128) not null,
   `phone` varchar(128),
   `mobilephone` varchar(128),
   UNIQUE KEY (`id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;