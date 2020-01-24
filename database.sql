CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `datetime` text NOT NULL,
  `airport` text NOT NULL,
  `partners` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `config` (`id`, `name`, `datetime`, `airport`, `partners`) VALUES
(1, 'My Great Event', 'DDTTTTZMMMYY ', 'XXXX', '');

CREATE TABLE IF NOT EXISTS `pilots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ifcname` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arr` varchar(4) NOT NULL,
  `aircraft` varchar(10) NOT NULL,
  `airline` varchar(14) NOT NULL,
  `dep_slot` text NOT NULL,
  `booked` int(11) NOT NULL DEFAULT '0',
  `pilot` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;