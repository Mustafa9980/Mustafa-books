<?php
function get_categorys($con)
{

    $sql = "SELECT * FROM categorys ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $categorys = $stmt->fetchAll();
    } else {
        $categorys = 0;
    }
    return $categorys;
}

?>
<?php

function get_up_categorys($con,$id){

    $sql  = "SELECT * FROM categorys WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
 
    if ($stmt->rowCount() > 0) {
          $category = $stmt->fetch();
    }else {
       $category = 0;
    }
 
    return $category;
 }