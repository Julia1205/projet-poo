CREATE DATABASE IF NOT EXISTS projetPoo;
CREATE TABLE 'rank'(
    rank_id INT(11) AUTO_INCREMENT NOT NULL,
    rank_name CHAR(14) NOT NULL,
    PRIMARY KEY (rank_id),
    INDEX (rank_id)
)ENGINE=INNODB DEFAULT CHARSET=utf8;
CREATE TABLE 'user'(
    user_id INT(11) AUTO_INCREMENT NOT NULL,
    user_pseudo CHAR(14) NOT NULL,
    user_pwd VARCHAR(255) NOT NULL,
    user_mail VARCHAR(255) NOT NULL,
    user_rank INT(11) NOT NULL,
    PRIMARY KEY (user_id),
    INDEX (user_id),
    FOREIGN KEY (user_rank) REFERENCES rank(rank_id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
)ENGINE=INNODB DEFAULT CHARSET=utf8;