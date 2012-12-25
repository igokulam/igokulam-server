<?php
  
  $DEF_LVL     = 1;
  $DEF_CNT     = 15;
  $MAX_CHOICES = 5;
  
  function makeChoice($ch, $ans) {
    $newChoice  = array();
    if (!empty($ch) > 0) {
        $newChoice['TEXT'] = $ch;
        if ($ans > 0)
             $newChoice['ANSWER'] = 'YES';
        else $newChoice['ANSWER'] = 'NO';
     }
     return $newChoice;
  }
  
  function processQuestion($qn) {
     $newQn = array();
     $newQn['QN_ID']       = $qn['QN_ID'];
     $newQn['QN_TITLE']    = $qn['QN_TITLE'];
     $newQn['QN_TEXT']     = $qn['QN_TEXT'];
     $newQn['LEVEL']       = $qn['LEVEL'];
     
     $choices = array();
     $theChoice = makeChoice($qn['CH1'], $qn['CH1_IS_ANS']);
     if (!empty($theChoice)) $choices[] = $theChoice;
     $theChoice = makeChoice($qn['CH2'], $qn['CH2_IS_ANS']);
     if (!empty($theChoice)) $choices[] = $theChoice;
     $theChoice = makeChoice($qn['CH3'], $qn['CH3_IS_ANS']);
     if (!empty($theChoice)) $choices[] = $theChoice;
     $theChoice = makeChoice($qn['CH4'], $qn['CH4_IS_ANS']);
     if (!empty($theChoice)) $choices[] = $theChoice;
     $theChoice = makeChoice($qn['CH5'], $qn['CH5_IS_ANS']);
     if (!empty($theChoice)) $choices[] = $theChoice;
     
     shuffle($choices);
     $newQn['Choices'] = $choices; 
     return $newQn;
  }
  
  $dbconn = mysql_connect("localhost","bmraj_bmraj","krishna");
  if (!$dbconn) die (mysql_error());
  $allQuestions = array(); 
  $selQuestions = array();
  mysql_select_db("bmraj_igokulam");
  $level = $_GET['level'];
  if (!$level) $level = $DEF_LVL;
  $count = $_GET['count'];
  if (!$count) $count = $DEF_CNT;
  
  $sql = "select * from QUESTION where TOPIC_ID = " . $_GET['topicId'] . " and LEVEL = " . $level;
         
  $result = mysql_query($sql) or die(mysql_error());
  while ($row = mysql_fetch_assoc($result)) {
    $allQuestions[] = $row;
    shuffle($allQuestions);
  }
  for ($i=0; $i < min($count, sizeof($allQuestions)); $i++) {
      $selQuestions[$i] = processQuestion($allQuestions[$i]);
  }
  echo json_encode($selQuestions);
  mysql_close($dbconn);
?> 