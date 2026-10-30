CREATE DATABASE IF NOT EXISTS games CHARSET UTF8MB4;

USE games;

CREATE TABLE IF NOT EXISTS console(
    id int AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    manufacturer VARCHAR(50) NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS video_game(
    id int AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    publish_at Datetime DEFAULT now(),
    id_console INT,
    CONSTRAINT fk_video_game_console
        FOREIGN KEY (id_console)
        REFERENCES console(id)
)ENGINE=INNODB;

INSERT INTO console(`name`, manufacturer) VALUES
	("PlayStation 5", "Sony"),
	("Switch", "Nintendo"),
	("Xbox Series X", "Microsoft"),
	("Steam Deck", "Valve");
	