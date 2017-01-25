
CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imdbId` varchar(40) NOT NULL,
  `title` varchar(120) NOT NULL,
  `year` int(4) NOT NULL,
  `director` varchar(120) NOT NULL,
  `writer` varchar(120) NOT NULL,
  `cast` varchar(120) NOT NULL,
  `awards` varchar(120) NOT NULL,
  `runtime` varchar(20) NOT NULL,
  `country` varchar(60) NOT NULL,
  `genre` varchar(60) NOT NULL,
  `plot` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
