<h2>DANH SÁCH DANH MỤC</h2>
<div class="formcontent">
    <div class="mb10 formdslh">
        <table>
            <tr>
                <th></th>
                <th>MÃ LOẠI</th>
                <th>TÊN LOẠI</th>
                <th></th>
            </tr>
            <?php
                foreach($listdanhmuc as $danhmuc){
                    extract($danhmuc);
                    $suadm = "index.php?act=suadm&id=".$id;
                    $xoadm = "index.php?act=xoadm&id=".$id;
                    echo '<tr align="center">
                            <td><input type="checkbox" name="" id=""></td>
                            <td>'.$id.'</td>
                            <td>'.$name.'</td>
                            <td><a href="'.$suadm.'"><input type="button" value="Sửa"></a> <a href="'.$xoadm.'"><input type="button" value="Xoá"></a></td>
                        </tr>';
                }
            ?>
        </table>
    </div>
    <div class="mb10">
        <input type="button" value="Chọn tất cả">
        <input type="button" value="Bỏ chọn tất cả">
        <input type="button" value="Xoá các mục đã chọn">
        <a href="index.php?act=adddm"><input type="button" value="Nhập thêm"></a>
    </div>
</div>