CREATE TABLE movies (title VARCHAR NOT NULL,
                    movDate DATE,
                    poster VARCHAR,
                    synopsis VARCHAR(100));

INSERT INTO movies VALUES ('Shrek',
                           '2001-07-04',    --format YYYY-MM-DD
                           'shrek.jpg',
                           'Shrek, un ogre verdâtre et malicieux, vit dans un marécage qu''il croit être un havre de paix.');

