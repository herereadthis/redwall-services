CREATE TABLE IF NOT EXISTS `page_stats` (
    `page_id`       int(11) NOT NULL AUTO_INCREMENT,
    `url_path`      varchar(63) NOT NULL,
    `page_hits`     int(11) NOT NULL,
    PRIMARY KEY (`page_id`)
    UNIQUE (`url_path`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT IGNORE INTO `page_stats`
SET `url_path` = '/la/',
`page_hits` = 2;

