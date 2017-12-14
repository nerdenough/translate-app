-- Get rid of everything.
DROP TABLE IF EXISTS phrases;

-- Translations table to record the source and translation language and word.
CREATE TABLE phrases (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  phrase TEXT NOT NULL,
  translation TEXT NOT NULL
);

-- Some initial data to get the ball rolling.
INSERT INTO phrases (phrase, translation)
  VALUES
    ('i am home', 'ただいま'),
    ('let us eat', 'いただきます'),
    ('how are you', 'お元気ですか'),
    ('what is the time now', '今何時ですか'),
    ('hello', 'こんにちわ'),
    ('goodbye', 'さようなら');
