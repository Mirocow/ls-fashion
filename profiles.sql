/* Базовая инициализация таблицы */

CREATE TABLE `prefix_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL, /* TODO: Сделать поле Enum */
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
