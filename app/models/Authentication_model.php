<?php

namespace model;

class Authentication_model
{
    protected $table2 = "pelanggan";
    protected $table = "admin";
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function LoginAuthentiction($email, $password)
    {
        if (empty($_POST['email']) || empty($_POST['password'])):
            header("location:index.php");
        else:
            # Admin Login & Pelanggan Login
            $email = htmlspecialchars($_POST['email']);
            $password = md5($_POST['password'], false);
            $hasil = $_POST['angka1'] + $_POST['angka2'];
            $akses = htmlspecialchars($_POST['akses']);
            password_verify($password, PASSWORD_DEFAULT);
            # authentication selection
            $admin = $this->db->query("SELECT * FROM $this->table WHERE email_admin = '$email' and password = '$password'");
            $pelanggan = $this->db->query("SELECT * FROM $this->table2 WHERE email_pelanggan = '$email' and password = '$password'");
            if (mysqli_num_rows($admin) > 0) {
                $responseAdmin = array($email, $password);
                $respAdmin[$this->table] = $responseAdmin;
                if ($rowAdmin = $admin->fetch_assoc()) {
                    if ($akses == 'admin'):
                        $_SESSION['admin'] = $rowAdmin['id_admin'];
                        $_SESSION['email'] = $rowAdmin['email_admin'];
                        $_SESSION['username'] = $rowAdmin['username'];
                        $_SESSION['name'] = $rowAdmin['nama_lengkap'];
                        $_SESSION['akses'] = "admin";
                        if ($hasil == $_POST['hasil']) {
                            $_SESSION['status'] = true;
                            header("location:admin/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        } else {
                            $_SESSION['status'] = false;
                            unset($_POST['hasil']);
                            header("location:admin/error/error-msg.php?HttpStatus=401");
                            exit(0);
                        }
                    endif;
                    $_COOKIE['cookies'] = $email;
                    $_SERVER['HTTP_ACCEPT'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:admin/error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:admin/error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:admin/error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($responseAdmin[$this->table], $rowAdmin, time() + (86400 * 30), "/");
                    array_push($respAdmin[$this->table], $rowAdmin);
                    die;
                    exit(0);
                }
            } elseif (mysqli_num_rows($pelanggan) > 0) {
                $response = array($email, $password);
                $responsed[$this->table2] = $response;
                if ($row = $pelanggan->fetch_assoc()):
                    if ($akses == "pelanggan"):
                        $_SESSION['pelanggan'] = $row['id_pelanggan '];
                        $_SESSION['pelanggan_email'] = $row['email_pelanggan'];
                        $_SESSION['pelanggan_nama'] = $row['nama_pelanggan'];
                        $_SESSION['pelanggan_nama'] = $row['nama_pelanggan'];
                        $_SESSION['telepon'] = $row['telepon'];
                        $_SESSION['alamat'] = $row['alamat_pelanggan'];
                        $_SESSION['akses'] = "pelanggan";
                        if ($hasil == $_POST['hasil']) {
                            $_SESSION['status'] = true;
                            header("location:pelanggan/error/error-msg.php?HttpStatus=200");
                            exit(0);
                        } else {
                            $_SESSION['status'] = false;
                            unset($_POST['hasil']);
                            header("location:pelanggan/error/error-msg.php?HttpStatus=401");
                            exit(0);
                        }
                    endif;
                    $_COOKIE['cookies'] = $email;
                    $_SERVER['HTTP_ACCEPT'] = "on";
                    $HttpStatus = $_SERVER["REDIRECT_STATUS"];
                    if ($HttpStatus == 400) {
                        header("location:pelanggan/error/error-msg.php?HttpStatus=400");
                        exit(0);
                    }
                    if ($HttpStatus == 403) {
                        header("location:pelanggan/error/error-msg.php?HttpStatus=403");
                        exit(0);
                    }
                    if ($HttpStatus == 500) {
                        header("location:pelanggan/error/error-msg.php?HttpStatus=500");
                        exit(0);
                    }
                    setcookie($response[$this->table2], $row, time() + (86400 * 30), "/");
                    array_push($responsed[$this->table2], $row);
                    die;
                    exit(0);
                endif;
            } else {
                unset($_POST['hasil']);
                $_SESSION['status'] = false;
                $_SERVER['HTTPS'] = "off";
                header("location:pelanggan/error/error-msg.php?HttpStatus=401");
                exit(0);
            }
        endif;
    }
}