-- Get rid of everything.
DROP TABLE IF EXISTS translations;
DROP TABLE IF EXISTS languages;

-- Having a languages table makes it easier to expand to more languages later on.
CREATE TABLE languages (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(20) NOT NULL
);

-- Translations table to record the source and translation language and word.
CREATE TABLE translations (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  lang_from INT NOT NULL,
  lang_to INT NOT NULL,
  phrase TEXT NOT NULL,
  translation TEXT NOT NULL,
  FOREIGN KEY (lang_from) REFERENCES languages(id),
  FOREIGN KEY (lang_to) REFERENCES languages(id)
);

-- Some initial data to get the ball rolling.
INSERT INTO languages (id, name)
  VALUES
    (1, 'English'),
    (2, 'Japanese');

INSERT INTO translations (lang_from, lang_to, phrase, translation)
  VALUES
    (1, 2, 'hello', 'こんにちわ'),
    (1, 2, 'goodbye', 'さようなら');
