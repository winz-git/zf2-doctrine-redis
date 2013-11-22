CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(20) NOT NULL, password VARCHAR(50) NOT NULL, createDate datetime, last_login DATETIME DEFAULT NULL, is_deleted boolean default false, is_disabled boolean default false, UNIQUE INDEX UNIQ_1483A5E924A232CF (user_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

