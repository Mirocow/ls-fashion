/* Базовая инициализация таблицы */
/*CREATE TABLE `prefix_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/

/*
   Временное создание полей в бд, впоследствии они будут создаваться автоматически чере экшен
   http://site.com/fashion/update
*/
CREATE TABLE `prefix_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `profile_firstname` varchar(255) DEFAULT NULL,
  `profile_secondname` varchar(255) DEFAULT NULL,
  `profile_experience` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
