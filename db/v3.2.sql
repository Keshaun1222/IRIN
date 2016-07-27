CREATE TABLE IF NOT EXISTS `events` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user` int(3) NOT NULL,
  `type` int(1) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO pages VALUES (22, 'Event Logging', 'Event Logging', 'events', 'Event Logging', 0, 3, 31);