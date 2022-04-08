CREATE TABLE logins
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT=1,
    nickname VARCHAR(50),
    password VARCHAR(255),
    email VARCHAR (255)
);

INSERT INTO logins VALUES
('admin' , 'jevaisteban');