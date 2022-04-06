CREATE TABLE IF NOT EXISTS Movies(title VARCHAR(100) NOT NULL, movDate DATE, poster VARCHAR(255), synopsis VARCHAR(2500));

INSERT IGNORE INTO Movies VALUES ('Shrek',
                           '2001-07-04',
                           'Pictures/Posters/shrek.jpg',
                           'Shrek, un ogre verdâtre et malicieux, vit dans un marécage qu''il croit être un havre de paix.');

INSERT IGNORE INTO Movies VALUES ('Jackass',
                           '2002-10-25',
                           'Pictures/Posters/jackass.jpg',
                           'Jackass s''inspire d''une série sur MTV où des personnes effectuent des cascades extrêmement risquées');