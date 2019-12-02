<?php
include ("inc/functions.php");
include ("inc/header.php");

//Remebering Data


$title = $date = $time_spent = $learned = $resources = $tag = " ";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Edit entry
if(isset($_GET['id'])){
    list($id,$title,$date,$time_spent,$learned,$resources) = journal_entry(filter_input(INPUT_GET, 'id',
    FILTER_SANITIZE_NUMBER_INT));
}

//Accepting user data & filtering input
if($_SERVER['REQUEST_METHOD'] =='POST'){
    $id= trim(filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT));
    $title= trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
    $date= trim(filter_input(INPUT_POST,'date',FILTER_SANITIZE_STRING));
    $time_spent= trim(filter_input(INPUT_POST,'timeSpent',FILTER_SANITIZE_STRING));
    $learned= trim(filter_input(INPUT_POST,'whatILearned',FILTER_SANITIZE_STRING));
    $resources= trim(filter_input(INPUT_POST,'ResourcesToRemember',FILTER_SANITIZE_STRING));

//Validating Dates
    $dateMatch= explode('-',$date);

 if (empty($title)||empty($date)||empty($id)) {
      echo 'Please fill in required fields: Title, Date';
  }elseif(count($dateMatch) != 3
         ||strlen($dateMatch[0])!= 4
         ||strlen($dateMatch[1])!= 2
         ||strlen($dateMatch[2])!= 2
         ||!checkdate($dateMatch[1],$dateMatch[2],$dateMatch[0])){
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

<section>
    <div class="container">
        <div class="edit-entry">
              <form class="form-container form-add" method="POST" action="edit.php">
                  <!-- Escape output when using output user data-->
                  <label for="title">Title</label>
                  <input id="title" type="text" name="title" value= "<?php echo htmlspecialchars($title); ?>"><br>
                  <label for="date">Date</label>
                  <input id="date" type="date" name="date" value= "<?php echo htmlspecialchars($date); ?>"><br>
                  <label for="time-spent"> Time Spent</label>
                  <input id="time-spent" type="text" name="timeSpent" value= "<?php echo htmlspecialchars($time_spent); ?>" ><br>
                  <label for="what-i-learned">What I Learned</label>
                  <textarea id="what-i-learned" rows="5" name="whatILearned" value = ""><?php echo htmlspecialchars($learned); ?></textarea>
                  <label for="resources-to-remember">Resources to Remember</label>
                  <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember" value = ""><?php echo htmlspecialchars($resources); ?> </textarea>
                  <input type="submit" value="Publish Entry" class="button">
                  <a href="index.php" class="button button-secondary">Cancel</a>
                  <?php
                  if (!empty($id)){
                  echo "<input type='hidden' name = 'id' value='".$id."' />";
                    }
                  ?>
              </form>
        </div>
    </div>
</section>
</html>
<?php include 'inc/footer.php'; ?>
