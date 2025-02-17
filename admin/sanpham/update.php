<?php
    if(is_array($sanpham)){
        extract($sanpham);
    }
    $hinhpath = "../upload/".$img;
    if(is_file($hinhpath)){
        $hinh = "<img src='".$hinhpath."' height='80'>";
    }else{
        $hinh = "no photo";
    }
?>
<h2>CẬP NHẬT SẢN PHẨM</h2>
<div class="formcontent">
    <form action="index.php?act=updatesp" method="post" enctype="multipart/form-data">
        <div class="mb10">
            <select name="iddm">
                <option value="0" selected>Tất cả</option>
                <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        if($iddm==$id) $s="selected"; else $s="";
                        echo '<option value="'.$idpro.'" '.$s.'>'.$name.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="mb10">
            Tên sản phẩm <br>
            <input type="text" name="tensp" value="<?=$name?>">
        </div>
        <div class="mb10">
            Giá <br>
            <input type="text" name="giasp" value="<?=$price?>">
        </div>
        <div class="mb10">
            Giá ưu đãi <br>
            <input type="text" name="giaud" value="<?=$priceud?>">
        </div>
        <div class="mb10">
            Hình <br>
            <input type="file" name="hinh">
            <?=$hinh?>
        </div>
        <div class="mb10">
            Mô tả <br>
            <textarea name="mota" cols="30" rows="10"><?=$mota?></textarea>
        </div>
        <div class="mb10">
            <input type="hidden" name="id" value="<?=$idpro?>">
            <input type="submit" name="capnhat" value="Cập nhật">
            <input type="reset" value="Nhập lại">
            <a href="index.php?act=listsp"><input type="button" value="Danh sách"></a>
        </div>
        <?php
            if(isset($thongbao)&&($thongbao!="")) echo $thongbao;
        ?>
    </form>
</div>