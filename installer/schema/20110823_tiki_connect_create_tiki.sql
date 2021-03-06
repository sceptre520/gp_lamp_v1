CREATE TABLE IF NOT EXISTS `tiki_connect` (
    `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `type` VARCHAR(64) NOT NULL DEFAULT '',
    `data` TEXT,
    `guid` VARCHAR(32) DEFAULT NULL,
    `server` TINYINT(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `server` (`server`)
) ENGINE=MyISAM;
