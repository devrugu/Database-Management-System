<?php
    session_start();
    include_once '../includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-sqlsorgulasayfasiikinci.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>SQL sorgula</title>
</head>
    <body>

    <div class="ciftgeri">
    <i class="fas fa-angle-double-left"></i>
    </div> 

    <header>
        <nav>
            <ul class="nav__links">
                <li class="anasayfa" onclick=location.href='../index.php'><a href="#">Ana Sayfa</a></li>
            </ul>
        </nav>
    </header>

    <div class="table">
        <?php
            $sql2 = $_SESSION['sql'];
            $result = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                $query = array();
                while($query[] = mysqli_fetch_assoc($result));
                array_pop($query);

                // SQL koduna göre dinamik tablo oluşturma
                echo '<div class = "table">';
                echo '<table border="1">';
                echo '<tr>';
                foreach($query[0] as $key => $value) {
                    echo '<td>';
                    echo $key;
                    echo '</td>';
                }
                echo '</tr>';
                foreach($query as $row) {
                    echo '<tr>';
                    foreach($row as $column) {
                        echo '<td>';
                        echo $column;
                        echo '</td>';
                    }
                    echo '</tr>';
                }   
                echo '</table>';
                echo '</div>';
            } else {
                header("Location: SqlSorgula-sayfasi2.php?signup=sqlhata");
            }
        ?>
    </div>



    <div class="form">
      <form action="../includes/SQLsorgulamaYonet.inc.php" method="POST">
        <div class="inputs">

          <?php
            if (isset($_GET['sqlsorgula'])) {
              $sqlsorgula = $_GET['sqlsorgula'];
              echo '<label for="sqlsorgula">SQL sorgula</label>';
              echo '<textarea  id="sqlsorgula" name="sqlsorgula" placeholder="Veritabanında sorgulama yapmak için SQL komutu (MariaDB syntax) giriniz..." rows="30" cols="30" value="'.$sqlsorgula.'"></textarea>';
              } else {
              echo '<label for="sqlsorgula">SQL sorgula</label>';
              echo '<textarea  id="sqlsorgula" name="sqlsorgula" placeholder="Veritabanında sorgulama yapmak için SQL komutu (MariaDB syntax) giriniz..." rows="30" cols="30"></textarea>';
            }
          ?>

        </div>
        <br><br>
        <div class="sorgulabutonu">
        <button name="sorgula2">Sorgula</button>
        </div>

      </form>
    </div>



    <?php
      if (!isset($_GET['signup'])) {
        exit();
      } else {
          $signupCheck = $_GET['signup'];

          switch ($signupCheck) {
            case "empty":
              echo "<p class='error'>Tüm boşlukları doldurmadınız!</p>";
              break;
            case "tcnokarakter":
              echo "<p class='error'>TC kimlik No kısmına sadece sayı girilebilir!</p>";
              break;
            case "tcnouzunluk":
              echo "<p class='error'>TC kimlik No eksik ya da fazla karakter girdiniz!</p>";
              break;
            case "sehirler":
              echo "<p class='error'>Bir şehir Seçiniz!</p>";
              break;
            case "positions":
              echo "<p class='error'>Bir pozisyon Seçiniz!</p>";
              break;
            case "salarymaxmin":
              echo "<p class='error'>Maaş 0-100000₺ arası olmalıdır!</p>";
              break;
            case "salarykarakter":
              echo "<p class='error'>Maaş kısmına sadece sayı girilebilir!</p>";
              break;
            case "successekleme":
              echo "<p class='success'>Veritabanına başarı ile eklendi.</p>";
              break;
            case "tcnobosgoruntuleme":
              echo "<p class='error'>Görüntüleme işlemi için TC no doldurunuz!</p>";
              break;
            case "tcnobossilme";
              echo "<p class='error'>Silme işlemi için TC no doldurunuz!</p>";
              break;
            case "successsilme";
              echo "<p class='success'>Silme işlemi başarı ile gerçekleşti.</p>";
            break;
            case "veritabanı";
              echo "<p class='error'>Veritabanında böyle bir kayıt bulunmamaktadır!</p>";
            break;
            case "tcnouzunlukgoruntuleme";
              echo "<p class='error'>TC kimlik No eksik ya da fazla karakter girdiniz!</p>";
            break;
            case "tcnobosguncelle";
              echo "<p class='error'>Güncelleme işlemi için TC No girilmelidir!</p>";
            break;
            case "tcnouzunlukguncelle";
              echo "<p class='error'>TC kimlik No eksik ya da fazla karakter girdiniz!</p>";
            break;
            case "emptyguncelle";
              echo "<p class='error'>Güncelleme yapmak için en az bir alanı doldurunuz!</p>";
            break;
            case "successguncelleme";
              echo "<p class='error'>Güncelleme işlemi başarılı bir şekilde gerçekleşti.</p>";
            break;
            case "guncelhastalikbos";
              echo "<p class='error'>Güncellenecek hastalığı seçiniz!</p>";
            break;
            case "yenihastalikbos";
              echo "<p class='error'>Yeni hastalığı seçiniz!</p>";
            break;
            case "successhastalik";
              echo "<p class='success'>Hastalık başarı ile güncellendi.</p>";
            break;
            case "successilac";
              echo "<p class='success'>İlaç başarı ile güncellendi.</p>";
            break;
            case "successsemptom";
              echo "<p class='success'>Semptom başarı ile güncellendi.</p>";
            break;
            case "successcovid";
              echo "<p class='success'>Covid bilgisi başarı ile eklendi.</p>";
            break;
            case "successcovidsemptom";
              echo "<p class='success'>Covid semptomu bilgisi başarı ile eklendi.</p>";
            break;
            case "temaslitcno";
              echo "<p class='error'>Temaslı TC no lardan biri yanlış uzunlukta!</p>";
            break;
            case "sqlbos";
              echo "<p class='error'>Sorgulama yapmak için bir SQL komutu (MariaDB syntax) giriniz!</p>";
            break;
            case "sqlhata";
              echo "<p class='error'>Yazdığınız sorgu veritabanında herhangi bir döngü ile sonuçlanmadı!</p>";
            break;

              
          }
      }
    ?>



    </body>
</html>