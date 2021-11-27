<?php
function get_authors($con)
{

    $sql = "SELECT * FROM author ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $authors = $stmt->fetchAll();
    } else {
        $authors = 0;
    }
    return $authors;
}
