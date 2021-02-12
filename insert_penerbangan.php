<html>
    <head>
        <title>Insert PENERBANGAN</title>
    </head>
    <body>
        <b>Form Penerbangan</b><br/>
        <form method="POST" action="">
            Pesawat: <input type="text" name="id_pesawat"><br/>
            Bandara Asal: <input type="text" name="id_bandara_dari"><br/>
            Bandara Tujuan: <input type="text" name="id_bandara_tujuan"><br/>
            Nama Pesawat: <input type="text" name="nama_pesawat"><br/>
            Nama Maskapai: <input type="text" name="nama_maskapai"><br/>
            <button type="submit">SIMPAN</button>
        </form>
        <?php
            //JIKA ADA VARIBEL POST, MAKA JALANKAN KODE INI
            //VARIABEL POST DIDAPATKAN DARI PROSES KETIKA SIMPAN DATA
            //ATAU KLIK SUBMIT
            if(count($_POST)>1){
                $username = "root";
                $password = "";
                $server_name = "localhost";
                $database_name = "penerbangan"; 
            
                $connection = new mysqli($server_name, $username, $password, $database_name);
                if(!$connection->connect_error){
                    $sql_bandara = "INSERT INTO pesawat (kode_pesawat, 
                        tahun_pembuatan, nama_pesawat, nama_maskapai, 
                        created_at, updated_at) VALUE(
                        '".$_POST['kode_pesawat']."',
                        '".$_POST['tahun_pembuatan']."', 
                        '".$_POST['nama_pesawat']."', 
                        '".$_POST['nama_maskapai']."', 
                        '".date('Y-m-d h:i:s')."', 
                        '".date('Y-m-d h:i:s')."')";

                    if($connection->query($sql_bandara) === TRUE){
                        header('Location: index_pesawat.php');
                    }
                    else{
                        echo "Data gagal dimasukkan:".$connection->error;
                    }
                }
            }
        ?>
    </body>
</html>