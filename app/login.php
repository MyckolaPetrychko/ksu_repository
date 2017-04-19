<?php
  namespace ksu\controllers;

 use \PDO;

 function closetags ( $html )
       {
       #put all opened tags into an array
       preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
       $openedtags = $result[1];
       #put all closed tags into an array
       preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
       $closedtags = $result[1];
       $len_opened = count ( $openedtags );
       # all tags are closed
       if( count ( $closedtags ) == $len_opened )
       {
       return $html;
       }
       $openedtags = array_reverse ( $openedtags );
       # close tags
       for( $i = 0; $i < $len_opened; $i++ )
       {
           if ( !in_array ( $openedtags[$i], $closedtags ) )
           {
           $html .= "</" . $openedtags[$i] . ">";
           }
           else
           {
           unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
           }
       }
       return $html;
   }
  $host = "localhost";
  $db = "ksu";
  $user = "homestead";
  $pass = "secret";
  $charset = "utf8";

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $opt = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $pdo = new PDO($dsn, $user, $pass, $opt);
  $res = $pdo->query("select * from `repo`");
  while($row = $res->fetch()){
    $author = addslashes(closetags($row['author']));
    $title = addslashes(closetags($row['title']));
    $info = addslashes(closetags($row['info']));
    $download = addslashes(closetags($row['download']));
    $speciality = addslashes(closetags($row['speciality']));
    $year = closetags($row['year']);
    $stm = $pdo->query("update `repo` set author='$author', title='$title', info='$info', download='$download', speciality='$speciality', year='$year' where id = $row[id]");
  }
  echo 1;
  exit;
  $admin = 'admin';
  $type = 6;
  $date = date("Y-m-d H:i:s");
  while($s = $res->fetch()){
    $stm = $pdo->prepare("insert into `repo` (id, author, title, speciality, year, info, download, added, type, date)
    values(null, :author, :title, :speciality, :year, :info, :download, (select id from `users` where type = (select id from role where type = :added)), (select id from allList where id = :type), :date)");
    $stm->bindParam(':author', $s['author']);
    $stm->bindParam(':title', $s['title']);
    $stm->bindParam(':speciality', $s['speciality']);
    $stm->bindParam(':year', $s['year']);
    $stm->bindParam(':info', $s['info']);
    $stm->bindParam(':download', $s['download']);
    $stm->bindParam(':added', $admin);
    $stm->bindParam(':type', $type);
    $stm->bindParam(':date',  $date);
    $stm->execute();
  }
