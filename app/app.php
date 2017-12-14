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
 * Attempt to translate a given phrase by checking for similar entries in
 * the database.
 */
function translate($phrase) {
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
    echo "PDO Error: " . $err->getMessage();
  }
}

// Our GET endpoint where we search for translations
if ($_GET['phrase']) {
  $phrase = $_GET['phrase'];
  $str = preg_replace('/[^A-Za-z0-9 ]/', '', $phrase);
  $res = translate($str);

  // Echo needed to send a 200 with a body
  echo $res;
}
