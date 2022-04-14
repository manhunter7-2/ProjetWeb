CREATE TABLE logins
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nickname VARCHAR(50),
    email VARCHAR (255)
);

INSERT INTO logins (nickname, email) VALUES
('admin' , 'slayer@doom.net');