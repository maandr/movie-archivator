CREATE TABLE `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `plot` float(3) NOT NULL,
  `dialog` float(3) NOT NULL,
  `cinematography` float(3) NOT NULL,
  `tention` float(3) NOT NULL,
  `sound` float(3) NOT NULL,
  `editing` float(3) NOT NULL,
  `meaning` float(3) NOT NULL,
  `acting` float(3) NOT NULL,
  `fun` float(3) NOT NULL,
  `rewatch` float(3) NOT NULL,
  `score` float(3) NOT NULL,
  `look` float(3) NOT NULL,
  `characters` float(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
