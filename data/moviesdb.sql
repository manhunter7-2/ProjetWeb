CREATE TABLE Movies(
    id       INT NOT NULL AUTO_INCREMENT,
    title    VARCHAR(100) NOT NULL,
    movDate  DATE,
    poster   VARCHAR(255),
    synopsis VARCHAR(2500),
    PRIMARY KEY (id, title)
);

INSERT INTO Movies (title, movDate, poster, synopsis) VALUES
('Jackass', '2002-10-25', 'jackass.jpg', 'Jackass : the movie s\'inspire d\'une émission diffusée sur MTV et dans laquelle des personnes accomplissent des challenges et des cascades plus risqués les uns que les autres.'),
('Shrek', '2001-07-04', 'shrek.jpg', 'Shrek, un ogre verdâtre, cynique et malicieux, a élu domicile dans un marécage qu\'il croit être un havre de paix. Un matin, alors qu\'il sort faire sa toilette, il découvre de petites créatures agaçantes qui errent dans son marais.Shrek se rend alors au château du seigneur Lord Farquaad, qui aurait soit-disant expulsé ces êtres de son royaume. Ce dernier souhaite épouser la princesse Fiona, mais celle-ci est retenue prisonnière par un abominable dragon.');
