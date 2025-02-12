<?php
    function insert_sanpham($tensp,$giasp,$giaud,$hinh,$mota,$iddm){
        $sql = "insert into sanpham(name,price,priceud,img,mota,iddm) values ('$tensp','$giasp','$giaud','$hinh','$mota','$iddm')";
        pdo_execute($sql);
    }
    function delete_sanpham($idpro){
        $sql = "delete from sanpham where idpro=".$idpro;
        pdo_execute($sql);
    }
    function loadall_sanpham_home(){
        $sql= "select * from sanpham where 1 order by idpro desc";
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }
    function loadall_sanpham($kyw="",$iddm=0){
        $sql= "select * from sanpham where 1";
        if($kyw!=""){
            $sql.=" and name like '%".$kyw."%'";
        }
        if($iddm>0){
            $sql.=" and iddm ='".$iddm."'";
        }
        $sql.=" order by idpro";
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }
    function load_ten_dm($iddm){
        if($iddm>0){
            $sql = "select * from danhmuc where id=".$iddm;
            $dm = pdo_query_one($sql);
            extract($dm);
            return $name;
        }else{
            return "";
        }
    }
    function loadone_sanpham($idpro){
        $sql = "select * from sanpham where idpro=".$idpro;
        $sp = pdo_query_one($sql);
        return $sp;
    }
    function load_sanpham_cungloai($idpro,$iddm){
        $sql = "select * from sanpham where iddm=".$iddm." AND idpro <> ".$idpro;
        $listsanpham = pdo_query($sql);
        return $listsanpham;
    }
    function update_sanpham($idpro,$iddm,$tensp,$giasp,$giaud,$mota,$hinh){
        if($hinh!="")
            $sql = "update sanpham set iddm='".$iddm."',name='".$tensp."',price='".$giasp."',priceud='".$giaud."',mota='".$mota."',img='".$hinh."' where idpro=".$idpro;
        else
        $sql = "update sanpham set iddm='".$iddm."',name='".$tensp."',price='".$giasp."',priceud='".$giaud."',mota='".$mota."' where idpro=".$idpro;
        pdo_execute($sql);
    }
?>