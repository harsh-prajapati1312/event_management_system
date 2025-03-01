<?php
    include_once 'conn.php';
    function search_emp($email,$pass)
    {
        $conn=connection();
        $sql ="select * from signup where email='$email' and password='$pass'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
?>
<?php
    include_once 'conn.php';
    function search_emp1($username)
    {
        $conn=connection();
        $sql ="select * from signup where username='$username'";
        $result1 = $conn->query($sql);
        $conn->close();
        return $result1;

    }
?>
