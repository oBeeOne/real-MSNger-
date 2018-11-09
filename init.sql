DROP DATABASE IF EXISTS realmsnger;
CREATE DATABASE realmsnger;
USE realmsnger;

CREATE TABLE users( 
	id INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	email VARCHAR(255) NOT NULL, 
	pseudo VARCHAR(20) NOT NULL, 
	mdp VARCHAR(64) NOT NULL, 
	logged BOOLEAN DEFAULT False, 
	PRIMARY KEY(id) );

CREATE TABLE buffer( 
	f_id INT UNSIGNED NOT NULL, 
	msg TEXT NOT NULL, 
	posted TIMESTAMP NOT NULL, 
	FOREIGN KEY (f_id) REFERENCES users(id) );

CREATE TABLE hist(
	f_id INT UNSIGNED,
	msg TEXT NOT NULL,
	posted TIMESTAMP NOT NULL,
	FOREIGN KEY (f_id) REFERENCES users(id) );


CREATE VIEW live_feed AS 
SELECT h.posted, h.msg, u.pseudo FROM hist AS h
INNER JOIN users AS u 
ON h.f_id = u.id
ORDER BY h.posted desc
LIMIT 10;

CREATE INDEX idx_time ON hist(posted);


DELIMITER //
CREATE TRIGGER add_2_hist AFTER INSERT ON buffer 
FOR EACH ROW
    BEGIN
    	INSERT INTO hist(f_id,msg,posted) VALUES(NEW.f_id, NEW.msg, NOW());
	    DELETE FROM buffer WHERE posted = NEW.posted;
    END;//
DELIMITER ;


CREATE USER IF NOT EXISTS  'realmsnger'@'localhost' IDENTIFIED BY 'R3VLmud3l';
GRANT ALL PRIVILEGES ON realmsnger.users TO 'realmsnger'@'localhost';
GRANT INSERT ON realmsnger.buffer TO 'realmsnger'@'localhost';
GRANT SELECT ON realmsnger.live_feed TO 'realmsnger'@'localhost';
FLUSH PRIVILEGES;



