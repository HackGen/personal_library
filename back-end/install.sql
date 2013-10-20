CREATE TABLE `members` (
	`email` CHAR(40) NOT NULL
  , `password` CHAR(40) NOT NULL
  , `identity` CHAR(32) NOT NULL
  , `nickname` VARCHAR(255) NOT NULL
  , `access` int unsigned NOT NULL DEFAULT 0
  , `lastact` int unsigned NOT NULL DEFAULT 0
  , PRIMARY KEY (`email`)
  , UNIQUE `identity` (`identity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
