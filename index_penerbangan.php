<html>  
    <head>
        <title>Daftar Penerbangan</title>
        <style>
            /* MENAMPILKAN BORDER PADA TABLE */
            table,td,tr,th { border: 1px solid black}
        </style>
    </head>
    <body>
        <?php
            //MENDEFINISIKAN KONEKSI DATABASE
            $username = "root";
            $password = "";
            $server_name = "localhost";
            $database_name = "penerbangan"; 
        
            $connection = new mysqli($server_name, $username, $password, $database_name);
            if($connection->connect_error)
                echo "Error, konfigurasi DB salah";
            else
                echo "Database berhasil dikoneksikan";
            echo "<br/>";
            $keyword = "";
            if(count($_GET)>0){
                $keyword = $_GET['keyword'];
            }
        ?>
        <b>Daftar Penerbangan</b>
        <a href="insert_penerbangan.php">Tambah Penerbangan</a>
        <a href="index.php">Daftar Bandara</a>

        <form action="" method="GET">
            <input type="text" name="keyword" value="<?php echo $keyword; ?>">
            <button type="submit">SEARCH</button>
        </form>

        <table>
            <tr>
                <td>Nomor</td>
                <td>ID Pesawat</td>
                <td>Bandara Asal</td>
                <td>Bandara Tujuan</td>
                <td>Waktu Penerbangan</td>
                <td>Status Penerbangan</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
            <?php
                $sql_penerbangan = "SELECT * FROM penerbangan";
                if($keyword!=""){
                    $sql_penerbangan = "SELECT * FROM penerbangan WHERE 
                        status_penerbangan LIKE '%".$keyword."%' OR 
                        waktu_penerbangan LIKE '%".$keyword."%'";
                }

                $result_penerbangan = $connection->query($sql_penerbangan);
                //MENGECEK APAKAH HASIL DATANYA ADA
                if($result_penerbangan->num_rows>0){
                    $i = 1;
                    //PERULANGAN UNTUK MENGAMBIL DATA HASIL QUERY
                    while($row = $result_penerbangan->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['id_pesawat']."</td>";
                        echo "<td>".$row['id_bandara_dari']."</td>";
                        echo "<td>".$row['id_bandara_tujuan']."</td>";
                        echo "<td>".$row['waktu_penerbangan']."</td>";
                        echo "<td>".$row['status_penerbangan']."</td>";
                        echo "<td><a href='update_customer.php?id=".$row['id']."'>Update</a></td>";
                        echo "<td><a href='delete_customer.php?id=".$row['id']."'>Delete</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                }else{
                    echo "<tr><td colspan='7'>Tidak ada data yang ditampilkan</td></tr>";
                }
            ?>
        </table>
    </body>
</html>