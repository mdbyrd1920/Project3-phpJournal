<?php
require ("inc/functions.php");
include ("inc/header.php");

$title = $date = $time_spent = $learned = $resources = '';

//Accepting user data & filtering input
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = trim (filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
  $date = trim (filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
  $time_spent = trim (filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
  $learned = trim (filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
  $resources = trim (filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));

//Validating Dates in correct format
  $dateMatch= explode('-', $date);

if (empty($title)||empty($date)) {
  }elseif(count($dateMatch) != 3
         ||strlen($dateMatch[0])!= 4
         ||strlen($dateMatch[1])!= 2
         ||strlen($dateMatch[2])!= 2
         ||!checkdate($dateMatch[1],$dateMatch[2],$dateMatch[0])){
  echo 'Please fill in required fields: Title, Date';
}else{
  if (add_entry($title,$date,$time_spent,$learned,$resources,$id)){
  header('Location: index.php');
  exit;
}
}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MyJournal</title>
        <link href="https://fonts.googleapis.com/css?family=Cousine:400" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/site.css">
    </head>
    <body>
        <header>
            <div class="container">

            </div>
        </header>
        <section>
            <div class="container">
                <div class="new-entry">
                    <h2>New Entry</h2>
                    <form method="post" action="new.php">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"></textarea>
                        <input type="submit" value="Publish Entry" class="button">
                        <a href="index.php" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>

<?php include ("inc/footer.php");?>
