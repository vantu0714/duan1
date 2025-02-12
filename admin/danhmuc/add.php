<h2>THÊM MỚI DANH MỤC</h2>
<div class="formcontent">
    <form action="index.php?act=adddm" method="post">
        <div class="mb10">
            Mã danh mục <br>
            <input type="text" name="maloai" disabled placeholder="Auto number">
        </div>
        <div class="mb10">
            Tên danh mục <br>
            <input type="text" name="tenloai">
        </div>
        <div class="mb10">
            <input type="submit" name="themmoi" value="Thêm mới">
            <input type="reset" value="Nhập lại">
            <a href="index.php?act=listdm"><input type="button" value="Danh sách"></a>
        </div>
        <?php
            if(isset($thongbao)&&($thongbao!="")) echo $thongbao;
        ?>
    </form>
</div>