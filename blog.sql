CREATE TABLE IF NOT EXISTS `cat` (
	`cat_id` int(100) unsigned not null auto_increment,
	`catname` char(30) not null default '',
	`num` smallint(5) unsigned not null default '0',
	PRIMARY KEY (`cat_id`)
) DEFAULT CHARSET=utf8;



INSERT INTO cat (cat_id, catname, num) VALUES
(1, '人生', 0),
(2, '哲学', 0),
(3, '技术', 0);


CREATE TABLE IF NOT EXISTS `art` (
	`art_id` int(100) unsigned NOT NULL auto_increment,
	`cat_id` smallint(5) unsigned DEFAULT '0',
	`user_id` int(10) unsigned DEFAULT '0',
	`nick` varchar(45) DEFAULT '',
	`title` varchar(45) default '',
	`content` text,
	`pubtime` int(10) unsigned not null default '0',
	`lastup` int(10) unsigned default '0',
	`comm` smallint(5) unsigned not null default '0',
	PRIMARY KEY (art_id)
) DEFAULT CHARSET=utf8 COMMENT='文章表';



CREATE TABLE IF NOT EXISTS tag(
	tag_id int unsigned auto_increment primary key,
	art_id int(10) unsigned not null DEFAULT '0',
	tag int(10) not null DEFAULT '0',
	KEY at (art_id, tag),
	KEY ta (tag, art_id)
) DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS comment (
	comment_id int unsigned NOT NULL auto_increment ,
	art_id int(10) unsigned not null,
	user_id int(10) unsigned not null DEFAULT '0',
	nick varchar(45) not null DEFAULT '',
	content varchar(1000) not null default '',
	ip int(10) unsigned not null default '0',
	pubtime int(10) unsigned not null default '0',
	PRIMARY KEY (comment_id)
) DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS user (
	user_id int unsigned not null auto_increment,
	name char(28) not null DEFAULT '',
	nick char(28) not null DEFAULT '',
	email char(38) not null DEFAULT '',
	password char(38) not null DEFAULT '',
	lastlogin int(10) unsigned not null default '0',
	primary key (user_id),
	unique key (name)
) DEFAULT CHARSET=utf8;