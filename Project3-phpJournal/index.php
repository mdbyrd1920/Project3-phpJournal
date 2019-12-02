<?php
require ("inc/functions.php");
include ("inc/header.php");

$title = "My Learning Journal";
echo "<center>";
  echo "<h1>$title</h1>";
echo "</center>";


//Delete entry from list on index page
//Pass data through delete_entry function
if(isset($_POST['delete'])){
    if(delete_entry(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
    header('location: index.php?');
    exit;
  }
    }
?>

        <section>
            <div class="container">
                <div class="entry-list">
                    <article>
                    <?php
//Displays list of journal entries (titles) and dates on index page
                    foreach(get_journal_entries() as $item) {
                          echo "<h2><a href='detail.php?id=".$item['id']."'>".$item['title']."</a></h2>";
                          echo "<time datetime='".$item['date']."'>".date("F d, Y",strtotime($item['date']))."</time><br>";
                          }
                    ?>
                    </article>
                </div>
<!-- link to delete journal entry page -->
                <div class="delete">
        <center>
          <p><a href="delete.php">Delete Entry</a></p>
        </center>
        </div>
            </div>

        </section>
  <?php include ("inc/footer.php");?>
