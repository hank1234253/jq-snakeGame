<?php
    $dsn="mysql:host=localhost;charset=utf8;dbname=snake";
    $pdo=new PDO($dsn,"root","");

    if(!empty($_POST['point'])){
    $sql="select count(*) from `rank` where `point`>={$_POST['point']}";
    $check=$pdo->query($sql)->fetchColumn();
    if($check<10){
        $check++;
        $sql="INSERT INTO `rank`(`name`, `point`) VALUES ('{$_POST['name']}','{$_POST['point']}')";
        $pdo->exec($sql);
        $pdo->exec("DELETE FROM `rank` WHERE 1 ORDER BY point LIMIT 1");
    }
}


    $rows=$pdo->query("select * from `rank` order by `point` DESC limit 10")->fetchAll();
    foreach($rows as $row){
        $tmp[]=["name"=>$row['name'],"point"=>$row['point']];
    }


    echo json_encode($tmp);
?>