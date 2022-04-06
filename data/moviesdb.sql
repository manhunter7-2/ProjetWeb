CREATE TABLE IF NOT EXISTS Movies(title VARCHAR(100) NOT NULL, movDate DATE, poster VARCHAR(255), synopsis VARCHAR(2500));

INSERT IGNORE INTO Movies VALUES ('Shrek',
                           '2001-07-04',
                           'Pictures/Posters/shrek.jpg',
                           'Shrek, un ogre verdâtre, cynique et malicieux, a élu domicile dans un marécage qu''il croit être un havre de paix. Un matin, alors qu''il sort faire sa toilette, il découvre de petites créatures agaçantes qui errent dans son marais.Shrek se rend alors au château du seigneur Lord Farquaad, qui aurait soit-disant expulsé ces êtres de son royaume. Ce dernier souhaite épouser la princesse Fiona, mais celle-ci est retenue prisonnière par un abominable dragon.');

INSERT IGNORE INTO Movies VALUES ('Jackass',
                           '2002-10-25',
                           'Pictures/Posters/jackass.jpg',
                           'Jackass : the movie s''inspire d''une émission diffusée sur MTV et dans laquelle des personnes accomplissent des challenges et des cascades plus risqués les uns que les autres.');