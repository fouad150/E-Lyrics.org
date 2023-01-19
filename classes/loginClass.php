<?php
class login
{

    public function checkEmpty($email, $password)
    {
        if (empty($email) || empty($password)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkExist($email, $password)
    {
        global $pdo;
        $sql = "SELECT * from admins WHERE email=?and password=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $password]);
        $admin = $stmt->fetch();

        if ($stmt->rowcount() > 0) {
            $_SESSION['profil'] = $admin['username'];
            return true;
        } else {
            return false;
        }
    }
}
