/**
 * Pro Newsletter System
 * Author: Aman Virk
 * Version: 1.0 
 * Open Source Contribution :- mailchimp.com, tinyMce
 * InSite Contribution :- Andy Charles
 * 
**/

CREATE TABLE IF NOT EXISTS `campaign` (
  `campaign_id` int(11) NOT NULL auto_increment,
  `campaign_name` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `campaign_member` (
  `campaign_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `current_newsletter_id` int(11) DEFAULT NULL,
  `join_time` int(11) NOT NULL,
  PRIMARY KEY  (`campaign_id`,`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `campaign_newsletter` (
  `campaign_id` int(11) NOT NULL,
  `newsletter_id` int(11) NOT NULL,
  `send_time` int(11) NOT NULL,
  PRIMARY KEY  (`campaign_id`,`newsletter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL,
  `public` int(11) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `group` VALUES (1, 'Padrão', 1);


CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(11) NOT NULL auto_increment,
  `image_url` text NOT NULL,
  PRIMARY KEY  (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `link` (
  `link_id` int(11) NOT NULL auto_increment,
  `link_url` text NOT NULL,
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `link_open` (
  `link_open_id` int(11) NOT NULL auto_increment,
  `link_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `send_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY  (`link_open_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `join_date` date NOT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  `unsubscribe_date` date DEFAULT NULL,
  `unsubscribe_send_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `member_field` (
    `member_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) NOT NULL,
  `field_type` varchar(20) NOT NULL,
  `required` int(11) DEFAULT NULL,
  PRIMARY KEY (`member_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `member_field_value` (
  `member_id` int(11) NOT NULL,
  `member_field_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`member_id`,`member_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `member_group` (
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`member_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `newsletter` (
  `newsletter_id` int(11) NOT NULL auto_increment,
  `create_date` date NOT NULL,
  `template` varchar(100) collate utf8_bin NOT NULL,
  `subject` varchar(255) collate utf8_bin NOT NULL,
  `from_name` varchar(255) collate utf8_bin NOT NULL,
  `from_email` varchar(255) collate utf8_bin NOT NULL,
  `content` text collate utf8_bin NOT NULL,
  `bounce_email` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`newsletter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `newsletter_member` (
  `send_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `sent_time` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `open_time` int(11) DEFAULT NULL,
  `bounce_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`send_id`,`member_id`),
  KEY `open_time` (`open_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `send` (
  `send_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `finish_time` int(11) DEFAULT NULL,
  `newsletter_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `template_html` text,
  `full_html` text,
  PRIMARY KEY (`send_id`),
  KEY `newsletter_id` (`newsletter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `settings` (
  `key` varchar(255) NOT NULL,
  `val` varchar(255) NOT NULL,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `sync` (
  `sync_id` int(11) NOT NULL auto_increment,
  `sync_name` varchar(50) NOT NULL,
  `edit_url` varchar(255) NOT NULL,
  `db_username` varchar(40) NOT NULL,
  `db_password` varchar(40) NOT NULL,
  `db_host` varchar(40) NOT NULL,
  `db_name` varchar(40) NOT NULL,
  `db_table` varchar(40) NOT NULL,
  `db_table_key` varchar(40) NOT NULL,
  `db_table_email_key` varchar(40) NOT NULL,
  `db_table_fname_key` varchar(40) NOT NULL,
  `db_table_lname_key` varchar(40) NOT NULL,
  `last_sync` int(11) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`sync_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;



CREATE TABLE IF NOT EXISTS `sync_group` (
  `sync_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`sync_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sync_member` (
  `sync_id` int(11) NOT NULL,
  `sync_unique_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`sync_id`,`sync_unique_id`,`member_id`),
  KEY `sync_id` (`sync_id`),
  KEY `sync_unique_id` (`sync_unique_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `settings` VALUES ('bounce_email', 'seu@email.com');
INSERT IGNORE INTO `settings` VALUES ('default_template', 'Plain Newsletter');
INSERT IGNORE INTO `settings` VALUES ('from_email', 'seu@email.com');
INSERT IGNORE INTO `settings` VALUES ('from_name', 'Sua Campanha');
INSERT IGNORE INTO `settings` VALUES ('password', 'admin');
INSERT IGNORE INTO `settings` VALUES ('username', 'admin');