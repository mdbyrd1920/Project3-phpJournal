<?php

//Reading Journal Data
function get_journal_entries() {
    include ("connection.php");
try{
 return $db->query('SELECT * FROM entries ORDER BY date DESC');
  } catch (Exception $e) {
  echo "Unable to retrieve results" . $e->getMessage() . "</br>";
    return $results->fetch();
  }
}


// Prepare Statements to Edit journal entries
function journal_entry($id){
    include ("connection.php");
$sql = 'SELECT * FROM entries WHERE id = ?';
try{
    $results = $db->prepare($sql);
    $results->bindValue(1, $id, PDO::PARAM_INT);
    $results->execute();
} catch (Exception $e) {
      echo "Unable to retrieve results" . $e->getMessage() . "<br />";
      return false;
    }
  return $results->fetch();
}

// Prepare Statements to Add journal entries
function add_entry($title, $date, $time_spent, $learned, $resources, $id = null){
    include ("connection.php");


  $sql = 'INSERT INTO
          entries(title, date, time_spent, learned, resources)
          VALUES(?, ?, ?, ?, ?, ?)';

          if ($id){
          $sql = 'UPDATE entries SET title=?, date =?, time_spent=?,learned=?,resources=? WHERE id = ?';
          }else{
          $sql = 'INSERT INTO entries(title, date, time_spent, learned, resources) VALUES(?,?,?,?,?)';
          }
          try{
              $results = $db->prepare($sql);
              $results->bindValue(1, $title, PDO::PARAM_STR);
              $results->bindValue(2, $date, PDO::PARAM_STR);
              $results->bindValue(3, $time_spent, PDO::PARAM_STR);
              $results->bindValue(4, $learned, PDO::PARAM_STR);
              $results->bindValue(5, $resources, PDO::PARAM_STR);
              if ($id){
                $results->bindValue(6, $id, PDO::PARAM_INT);
              }
              $results->execute();
          } catch (Exception $e) {
              echo "Unable to retrieve results" . $e->getMessage() . "<br />";
              return false;
          }
            return true;
          }



// Prepare Statements to Delete journal entries
function delete_entry($id){
                include 'connection.php';
          $sql = 'DELETE FROM entries WHERE id = ?';
            try{
                $results = $db->prepare($sql);
                $results->bindValue(1, $id, PDO::PARAM_INT);
                $results->execute();
            } catch (Exception $e) {
                echo "Unable to retrieve results" . $e->getMessage() . "<br />";
                return false;
              }
          return true;
          }
