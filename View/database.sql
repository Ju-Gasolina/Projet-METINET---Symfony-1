CREATE TABLE `artists` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`idSpotify` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'latin1_swedish_ci',
`name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`followers` INT(11) NOT NULL,
`genders` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`link` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`picture` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
PRIMARY KEY (`id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=9
;

CREATE TABLE `albums` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`idSpotify` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`releaseDate` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`totalTracks` INT(11) NOT NULL,
`link` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`picture` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`artistIdSpotify` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
PRIMARY KEY (`id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;

CREATE TABLE `tracks` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`idSpotify` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`trackNumber` INT(11) NOT NULL,
`duration` INT(11) NOT NULL,
`link` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`albumIdSpotify` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`albumName` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
`albumPicture` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
PRIMARY KEY (`id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;
