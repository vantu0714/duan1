<h2>DANH SÁCH SẢN PHẨM</h2>
<form action="index.php?act=listsp" method="post">
    <input type="text" name="kyw">
    <select name="iddm">
        <option value="0" selected>Tất cả</option>
        <?php
            foreach ($listdanhmuc as $danhmuc) {
                extract($danhmuc);
                echo '<option value='.$idpro.'>'.$name.'</option>';
            }
        ?>
    </select>
    <input type="submit" name="listok" value="Tìm">
</form>
<br>
<div class="formcontent">
    <div class="mb10 formdslh">
        <table>
            <tr>
                <th></th>
                <th>MÃ LOẠI</th>
                <th>TÊN SẢN PHẨM</th>
                <th>HÌNH ẢNH</th>
                <th>GIÁ</th>
                <th>GIÁ ƯU ĐÃI</th>
                <th></th>
            </tr>
            <?php
                foreach($listsanpham as $sanpham){
                    extract($sanpham);
                    $suasp = "index.php?act=suasp&id=".$idpro;
                    $xoasp = "index.php?act=xoasp&id=".$idpro;
                    $hinhpath = "../upload/".$img;
                    if(is_file($hinhpath)){
                        $hinh = "<img src='".$hinhpath."' height='80'>";
                    }else{
                        $hinh = "no photo";
                    }
                    echo '<tr align="center">
                            <td><input type="checkbox"></td>
                            <td>'.$idpro.'</td>
                            <td>'.$name.'</td>
                            <td>'.$hinh.'</td>
                            <td>'.$price.'</td>
                            <td>'.$priceud.'</td>
                            <td><a href="'.$suasp.'"><input type="button" value="Sửa"></a> <a href="'.$xoasp.'"><input type="button" value="Xoá"></a></td>
                        </tr>';
                }
            ?>
        </table>
    </div>
    <div class="mb10">
        <input type="button" value="Chọn tất cả">
        <input type="button" value="Bỏ chọn tất cả">
        <input type="button" value="Xoá các mục đã chọn">
        <a href="index.php?act=adddssp"><input type="button" value="Nhập thêm"></a>
    </div>
</div>