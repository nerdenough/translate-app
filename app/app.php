<?php
/**
 * Establish a connection to the database.
 */
function connect() {
  $db_host = $_ENV['DB_HOST'];
  $db_user = $_ENV['DB_USER'];
  $db_pass = $_ENV['DB_PASS'];
  $db_database = $_ENV['DB_DATABASE'];

  $db = new PDO("mysql:host=$db_host;dbname=$db_database", $db_user, $db_pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
}

/**
 * Find suggested translations similar to the specified phrase.
 */
function findSuggestions($phrase) {
  try {
    $db = connect();
    $query = $db->prepare("SELECT phrase, translation FROM phrases WHERE LOWER(phrase) LIKE ?");
    $query->execute(array("%$phrase%"));

    // Add all suggestions to an array
    $results = [];
    while ($result = $query->fetch(PDO::FETCH_OBJ)) {
      array_push($results, $result);
    }

    return json_encode($results);
  } catch (PDOException $err) {
    return "PDO Error: " . $err->getMessage();
  }
}

/**
 * Adds a translation for the given phrase.
 */
function addTranslation($phrase, $translation) {
  try {
    $db = connect();
    $query = $db->prepare("INSERT INTO phrases (phrase, translation) VALUES (?, ?)");
    $query->bindParam(1, $phrase);
    $query->bindParam(2, $translation);
    $query->execute();

    return 'success';
  } catch (PDOException $err) {
    return "PDO Error: " . $err->getMessage();
  }
}

// Our GET endpoint where we search for translations
if ($_GET['phrase']) {
  $phrase = $_GET['phrase'];
  $str = preg_replace('/[^A-Za-z0-9 ]/', '', $phrase);
  echo findSuggestions($str);
}

// Our POST endpoint where we add a translation
if ($_POST['phrase'] && $_POST['translation']) {
  $phrase = $_POST['phrase'];
  $translation = $_POST['translation'];
  echo addTranslation($phrase, $translation);
}
