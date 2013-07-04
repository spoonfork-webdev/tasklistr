CREATE TABLE IF NOT EXISTS `#__tasklistr_tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `urgent` tinyint(2) DEFAULT 0,
  `completed` tinyint(2) DEFAULT 0,
  PRIMARY KEY (`task_id`)
);