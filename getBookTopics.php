<?php
  $dbconn = mysql_connect("localhost","bmraj_bmraj","krishna");
  if (!$dbconn) die (mysql_error());
  $bookTopics = array(); 
  mysql_select_db("bmraj_igokulam");
  $sql1 = "select BOOK_ID, BOOK_NAME, BOOK_AUTHOR, BOOK_IMG_URL from BOOK order by BOOK_NAME";
  $result1 = mysql_query($sql1) or die(mysql_error());
  while ($brow = mysql_fetch_assoc($result1)) {
     $bookId = $brow['BOOK_ID'];
     $sql2 = "select TOPIC_ID, TOPIC_NAME, TOPIC_IMG_URL from TOPIC where BOOK_ID = " . $brow['BOOK_ID'] . " order by TOPIC_NAME";
     $result2 = mysql_query($sql2) or die(mysql_error());
     $topics = array();
     while ($trow = mysql_fetch_assoc($result2)) {
        $topics[] = $trow;
     }
     $brow['Topics'] = $topics; 
     $bookTopics[] = $brow;
  }
  echo json_encode($bookTopics);
  mysql_close($dbconn);
?> 