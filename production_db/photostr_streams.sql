/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.1.73-cll : Database - photostr_streams
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`photostr_streams` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `photostr_streams`;

/*Table structure for table `image_tag` */

DROP TABLE IF EXISTS `image_tag`;

CREATE TABLE `image_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pic_x` int(11) NOT NULL,
  `pic_y` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `photo_MemberNotifications` */

DROP TABLE IF EXISTS `photo_MemberNotifications`;

CREATE TABLE `photo_MemberNotifications` (
  `member_notification_id` int(155) NOT NULL AUTO_INCREMENT,
  `notification_id` int(155) DEFAULT NULL,
  `userid` int(155) DEFAULT NULL,
  `date_notified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_notif` int(155) DEFAULT NULL,
  PRIMARY KEY (`member_notification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_Notifications` */

DROP TABLE IF EXISTS `photo_Notifications`;

CREATE TABLE `photo_Notifications` (
  `notification_id` int(155) NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sender_id` int(155) NOT NULL,
  `photo_id` int(155) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_activity` */

DROP TABLE IF EXISTS `photo_activity`;

CREATE TABLE `photo_activity` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` text,
  `userid` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `photo_attributes` */

DROP TABLE IF EXISTS `photo_attributes`;

CREATE TABLE `photo_attributes` (
  `attribute_id` int(155) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(255) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_challenge` */

DROP TABLE IF EXISTS `photo_challenge`;

CREATE TABLE `photo_challenge` (
  `challenge_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `date_posted` datetime DEFAULT NULL,
  `is_closed` tinyint(1) DEFAULT '0',
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`challenge_id`),
  KEY `fk_photo_challenge_photo_users1_idx` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_challenge_submissions` */

DROP TABLE IF EXISTS `photo_challenge_submissions`;

CREATE TABLE `photo_challenge_submissions` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) NOT NULL,
  `date_submitted` datetime DEFAULT NULL,
  `is_winner` tinyint(1) DEFAULT '0',
  `challenge_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `description` text,
  `caption` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`entry_id`,`challenge_id`,`userid`),
  KEY `fk_photo_challenge_submissions_photo_challenge1_idx` (`challenge_id`),
  KEY `fk_photo_challenge_submissions_photo_users1_idx` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_country` */

DROP TABLE IF EXISTS `photo_country`;

CREATE TABLE `photo_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_follow` */

DROP TABLE IF EXISTS `photo_follow`;

CREATE TABLE `photo_follow` (
  `photo_follow_id` int(155) NOT NULL AUTO_INCREMENT,
  `userid` int(155) NOT NULL,
  `photo_id` int(155) NOT NULL,
  PRIMARY KEY (`photo_follow_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_followers` */

DROP TABLE IF EXISTS `photo_followers`;

CREATE TABLE `photo_followers` (
  `f_id` int(155) NOT NULL AUTO_INCREMENT,
  `user_id` int(155) NOT NULL,
  `followed_id` int(155) NOT NULL,
  `date_followed` date NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_friends` */

DROP TABLE IF EXISTS `photo_friends`;

CREATE TABLE `photo_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_id` int(11) NOT NULL,
  `userid_id` int(11) NOT NULL,
  `accept` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`friend_id`,`userid_id`),
  KEY `fk_photo_friends_photo_users1_idx` (`friend_id`),
  KEY `fk_photo_friends_photo_users2_idx` (`userid_id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_invoice` */

DROP TABLE IF EXISTS `photo_invoice`;

CREATE TABLE `photo_invoice` (
  `invoice_id` int(155) NOT NULL,
  `invoice` int(155) NOT NULL,
  `userid` int(155) NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `photo_pic_comments` */

DROP TABLE IF EXISTS `photo_pic_comments`;

CREATE TABLE `photo_pic_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `date_posted` datetime DEFAULT NULL,
  `photo_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`,`photo_id`),
  KEY `fk_photo_pic_comments_photo_pics1_idx` (`photo_id`),
  KEY `fk_photo_pic_comments_photo_users1_idx` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_pics` */

DROP TABLE IF EXISTS `photo_pics`;

CREATE TABLE `photo_pics` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `date_uploaded` datetime DEFAULT NULL,
  `stream_id` int(11) NOT NULL,
  `social_id` int(11) NOT NULL,
  `attribute_id` int(155) NOT NULL,
  PRIMARY KEY (`photo_id`,`social_id`),
  KEY `fk_photo_pics_photo_stream1_idx` (`stream_id`),
  KEY `fk_photo_pics_photo_socials1_idx` (`social_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1722 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_pics_likes` */

DROP TABLE IF EXISTS `photo_pics_likes`;

CREATE TABLE `photo_pics_likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`like_id`,`photo_id`,`userid`),
  KEY `fk_photo_pics_likes_photo_pics1_idx` (`photo_id`),
  KEY `fk_photo_pics_likes_photo_users1_idx` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=450 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_pics_shares` */

DROP TABLE IF EXISTS `photo_pics_shares`;

CREATE TABLE `photo_pics_shares` (
  `share_id` int(155) NOT NULL AUTO_INCREMENT,
  `photo_id` int(155) NOT NULL,
  `userid` int(155) NOT NULL,
  PRIMARY KEY (`share_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_socials` */

DROP TABLE IF EXISTS `photo_socials`;

CREATE TABLE `photo_socials` (
  `social_id` int(11) NOT NULL AUTO_INCREMENT,
  `social_media` varchar(100) NOT NULL,
  `icon` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`social_id`,`social_media`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_stream` */

DROP TABLE IF EXISTS `photo_stream`;

CREATE TABLE `photo_stream` (
  `stream_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `is_public` tinyint(1) DEFAULT '1',
  `date_created` datetime DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `cover_pic` int(11) DEFAULT '2',
  PRIMARY KEY (`stream_id`,`userid`),
  KEY `fk_photo_stream_photo_users1_idx` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=738 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_stream_comments` */

DROP TABLE IF EXISTS `photo_stream_comments`;

CREATE TABLE `photo_stream_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `date_posted` datetime DEFAULT NULL,
  `stream_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`,`stream_id`,`userid`),
  KEY `fk_photo_stream_comments_photo_stream1_idx` (`stream_id`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `photo_stream_likes` */

DROP TABLE IF EXISTS `photo_stream_likes`;

CREATE TABLE `photo_stream_likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `stream_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `fk_photo_stream_likes_photo_stream1_idx` (`stream_id`),
  KEY `fk_photo_stream_likes_photo_users1_idx` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `photo_updates` */

DROP TABLE IF EXISTS `photo_updates`;

CREATE TABLE `photo_updates` (
  `update_id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `link` varchar(255) NOT NULL,
  `stream_id` int(255) NOT NULL,
  `photo_count` int(155) NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=MyISAM AUTO_INCREMENT=463 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_user_invoice` */

DROP TABLE IF EXISTS `photo_user_invoice`;

CREATE TABLE `photo_user_invoice` (
  `user_invoice_id` int(155) NOT NULL AUTO_INCREMENT,
  `invoice` int(155) NOT NULL,
  `user_id` int(155) NOT NULL,
  PRIMARY KEY (`user_invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_user_socials` */

DROP TABLE IF EXISTS `photo_user_socials`;

CREATE TABLE `photo_user_socials` (
  `social_id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_userid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `photo_users_country_id` int(11) NOT NULL,
  `twitter_userid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`social_id`,`userid`,`photo_users_country_id`),
  KEY `fk_photo_user_socials_photo_users1_idx` (`userid`,`photo_users_country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=323 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_user_type` */

DROP TABLE IF EXISTS `photo_user_type`;

CREATE TABLE `photo_user_type` (
  `user_type_id` int(155) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_users` */

DROP TABLE IF EXISTS `photo_users`;

CREATE TABLE `photo_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_signedup` datetime DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `avatar_id` int(11) DEFAULT '1' COMMENT 'profile pic id',
  `admin` int(11) DEFAULT NULL,
  `user_type` int(155) NOT NULL,
  PRIMARY KEY (`userid`,`country_id`),
  KEY `fk_photo_users_photo_country_idx` (`country_id`),
  FULLTEXT KEY `firstname` (`firstname`),
  FULLTEXT KEY `lastname` (`lastname`),
  FULLTEXT KEY `username` (`username`),
  FULLTEXT KEY `firstname_2` (`firstname`),
  FULLTEXT KEY `lastname_2` (`lastname`),
  FULLTEXT KEY `email` (`email`),
  FULLTEXT KEY `username_2` (`username`),
  FULLTEXT KEY `fulltext_index` (`firstname`,`lastname`,`email`,`username`)
) ENGINE=MyISAM AUTO_INCREMENT=605 DEFAULT CHARSET=latin1;

/*Table structure for table `photo_view_count` */

DROP TABLE IF EXISTS `photo_view_count`;

CREATE TABLE `photo_view_count` (
  `photo_view_count_id` int(155) NOT NULL AUTO_INCREMENT,
  `photo_id` int(155) NOT NULL,
  `user_id` int(155) NOT NULL,
  PRIMARY KEY (`photo_view_count_id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

/*Table structure for table `picture` */

DROP TABLE IF EXISTS `picture`;

CREATE TABLE `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `coordx` int(155) NOT NULL,
  `coordy` int(155) NOT NULL,
  `userid` int(155) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Table structure for table `premium_ads` */

DROP TABLE IF EXISTS `premium_ads`;

CREATE TABLE `premium_ads` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `script_html` text NOT NULL,
  `hide` enum('0','1') DEFAULT '0',
  `approved` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `view_onboarding` */

DROP TABLE IF EXISTS `view_onboarding`;

CREATE TABLE `view_onboarding` (
  `view_id` int(155) NOT NULL AUTO_INCREMENT,
  `userid` int(155) NOT NULL,
  `viewed` int(100) NOT NULL DEFAULT '1',
  PRIMARY KEY (`view_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
