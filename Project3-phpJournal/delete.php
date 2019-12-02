<?php

//Delete Journal Entry List Page

include ("inc/functions.php");
include ("inc/header.php");


foreach(get_journal_entries() as $item) {
          echo "<h3><a href='detail.php?id=".$item['id']."'>".$item['title']."</a></h3>";
          echo "<time datetime='".$item['date']."'>".date("F d, Y",strtotime($item['date']))."</time>";


          echo "<form method='post' action='index.php' onclick=\"return confirm('WARNING! You are permanently deleting this entry. Click OK to delete.');\">";
          echo "<input type='hidden' value='".$item['id']."'  name='delete' />\n";
          echo "<input type='submit' class='button--delete' value='Delete Entry' />\n";
          echo "</form>";

}

 include ("inc/footer.php"); ?>
