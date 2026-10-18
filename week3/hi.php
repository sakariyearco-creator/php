<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $info=array(
        array("zaki",1999,"gubta","061766778"),
        array("cali",2008,"deyniile","061786886"),
        array("muusa",2004,"waaberi","061662644"),
        
    );
    echo "<br>";
    echo $info[0][0];
    foreach($info as $list){
        echo $list[0],$list[1];
    };
    echo "<table border=1> ";
    echo"<th>Name</th>";
    echo"<th>year of Birth</th>";
    echo"<th>Adress</th>";
    echo"<th>Phone</th>";
    foreach ($info as $list){
        echo "<tr>";
        foreach($list as $item){
            echo "<td>". $item."</td>";
        }
       echo "</tr>";
    }
    echo"</table>";
    if(is_array($info)){
        echo "this is an array";
    }else{
        echo "this is not an array";
    }
    echo "<br>";
    if(in_array("zaki",$info[0])){
        echo "this is in the array";
    }else{
        echo "this is not in the array";
    }
    echo "<br>";
    echo ("the size of the array is ".count($info));
    echo "<br>";
    echo "<h1>Function</h1>";
    function sum($number1=12,$number2=20){
        $result=$number1+$number2;
        echo $result;
    }
    sum(10,20);
    echo "<br>";
  
    ?>
</body>
</html>

    
</body>
</html>