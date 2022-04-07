CREATE TABLE logins
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nickname VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO logins VALUES
(1, 'admin' , 'jevaisteban');