<?php
  $dbconn = mysql_connect("localhost","bmraj_bmraj","krishna");
  if (!$dbconn) die (mysql_error());
  $topics = array(); 
  mysql_select_db("bmraj_igokulam");
  $sql = "select * from TOPIC order by TOPIC_NAME";
  $result = mysql_query($sql) or die(mysql_error());
  while ($row = mysql_fetch_assoc($result)) $topics[] = $row;
  echo json_encode($topics);
  mysql_close($dbconn);
?> 