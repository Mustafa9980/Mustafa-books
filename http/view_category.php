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

