<?php
    session_start();
    include "global.php";
    include "model/pdo.php";
    include "model/danhmuc.php";
    include "model/sanpham.php";
    include "model/taikhoan.php";
    include "model/cart.php";
    include "view/header.php";
    
    if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];

    $spnew = loadall_sanpham_home();
    $dsdm = loadall_danhmuc();

    if((isset($_GET['act']))&&($_GET['act']!="")){
        $act = $_GET['act'];
        switch ($act) {
            /* controller sản phẩm */
            case 'sanpham':
                if(isset($_POST['kyw'])&&($_POST['kyw']!="")){
                    $kyw = $_POST['kyw'];
                }else{
                    $kyw = "";
                }
                if(isset($_GET['iddm'])&&($_GET['iddm']>0)){
                    $iddm = $_GET['iddm'];
                    
                }else{
                    $iddm = 0;
                }
                $dssp = loadall_sanpham($kyw,$iddm);
                $tendm = load_ten_dm($iddm);
                include "view/sanpham.php";
                break;
            case 'sanphamct':
                if(isset($_GET['idsp'])&&($_GET['idsp']>0)){
                    $id = $_GET['idsp'];
                    $onesp = loadone_sanpham($id);
                    extract($onesp);
                    $sp_cung_loai = load_sanpham_cungloai($id,$iddm);
                    include "view/spct.php";
                }else{
                    include "view/home.php";
                }
                break;
            case 'dssp':
                include "view/dssp.php";
                break;
            
            /* controller đăng ký/đăng nhập */
            case 'dangky':
                if(isset($_POST['dangky'])&&($_POST['dangky'])){
                    $email = $_POST['email'];
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $repass = $_POST['repass'];
                    if($pass == $repass){
                        insert_taikhoan($email,$user,$pass,$repass);
                        $thongbao = "Đăng ký thành công!";
                    }else{
                        $thongbao = "Nhập sai mật khẩu. Mời nhập lại!";
                    }
                }
                include "view/taikhoan/dangky.php";
                break;
            case 'login':
                if(isset($_POST['login'])&&($_POST['login'])){
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $kq = getuserinfo($user,$pass);
                    if($kq && count($kq) > 0) {
                        $role = $kq[0]['role'];
                        if($role==1){
                            $_SESSION['role'] = $role;
                            header('Location: admin/index.php');
                        }else{
                            $_SESSION['role'] = $role;
                            $_SESSION['iduser'] = $kq[0]['id'];
                            $_SESSION['user'] = $kq[0]['user'];
                            header('Location: index.php');
                        }
                    }else{
                        $error_message = "Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại.";
                        $_SESSION['error_message'] = $error_message;
                    }
                }
            case 'dangnhap':
                include "view/dangnhap.php";
                break;  
            case 'thoat':
                session_unset();
                header('Location: index.php');
                break;

            /* controller giỏ hàng, thanh toán */
            case 'cart':
                if(isset($_POST['addtocart'])&&($_POST['addtocart'])){
                    $img=$_POST['img'];
                    $name=$_POST['name'];
                    $price=$_POST['price'];
                    $soluong=$_POST['soluong'];
            
                    //kiem tra sp co trong gio hang hay khong?
            
                    $fl=0; //kiem tra sp co trung trong gio hang khong?
                    for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) { 
                        if($_SESSION['giohang'][$i][1]==$name){
                            $fl=1;
                            $soluongnew=$soluong+$_SESSION['giohang'][$i][3];
                            $_SESSION['giohang'][$i][3]=$soluongnew;
                            break;
                        }
                    }
                    //neu khong trung sp trong gio hang thi them moi
                    if($fl==0){
                        //them moi sp vao gio hang
                        $sp=[$img,$name,$price,$soluong];
                        $_SESSION['giohang'][]=$sp;
                    }
                }
                include "view/cart.php";
                break;
            case 'delcart':
                if(isset($_GET['id'])){
                    array_slice($_SESSION['giohang'],$_GET['id'],1);
                }else{
                    $_SESSION['giohang'] = [];
                }
                header('Location: index.php?act=cart');
                break;
            case 'delid':
                if(isset($_GET['id'])){
                    array_slice($_SESSION['giohang'],$_GET['id'],1);
                }else{
                    $_SESSION['giohang'] = [];
                }
                header('Location: index.php?act=cart');
                break;
            case 'bill':
                include "view/bill.php";
                break;
            case "success":
                if (isset($_SESSION['success'])) {
                    include 'view/success.php';
                } else {
                    header("Location: index.php");
                }
                break;

            case 'gioithieu':
                include "view/gioithieu.php";
                break;
            case 'lienhe':
                include "view/lienhe.php";
                break;
            default:
                include "view/home.php";
                break;
        }
    }else{
        include "view/home.php";
    }
    include "view/footer.php";
?>