<?php
include ("inc/functions.php");
include ("inc/header.php");


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$selectedEntry=journal_entry($id);

?>

<!DOCTYPE html>
<html>
<section>
    <div class="container">
        <div class="entry-list single">
            <article>
<!-- Displays Selected Entry's Details -->
              <h1><?php echo $selectedEntry['title'];?></h1>
                  <?php  echo "<time datetime='".$selectedEntry['date']."'>".date("F d, Y",strtotime($selectedEntry['date']))."</time><br>"; ?>
                                <div class="entry">
                                    <h3>Time Spent: </h3>
                                    <p><?php echo $selectedEntry['time_spent'];?></p>
                                </div>
                                <div class="entry">
                                    <h3>What I Learned:</h3>
                                    <p><?php echo $selectedEntry['learned']?></p>
                                </div>
                                <div class="entry">
                                    <h3>Resources to Remember:</h3>
                                    <p><?php echo $selectedEntry['resources'];?></p>
                                </div>

            </article>
        </div>
    </div>





    <div class="edit">
<!-- Edit Entry Page Link -->
        <p><a href="edit.php?id=<?php echo $id;?>">Edit Entry</a></p>
<!-- Delete Entry Page Link -->
        <p><a href="delete.php?id=<?php echo $id;?>">Delete Entry</a></p>





    </div>
</section>
</html>
<?php include ("inc/footer.php");?>
