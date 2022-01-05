<?php
    //session_start();
    include_once '../../../includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid temaslı Ekle</title>
    <link rel="stylesheet" href="style-covidTemasliEklemek.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="ciftgeri">
    <i class="fas fa-angle-double-left"></i>
    </div>

    <div class="tekgeri">
    <i class="fas fa-angle-left"></i>
    </div>

    <header>
        <nav>
            <ul class="nav__links">
                <li class="anasayfa" onclick=location.href='../../../index.php'><a href="#">Ana Sayfa</a></li>
                <li class="geri" onclick=location.href='../covidBilgisiEkle-sayfasi.php'><a href="#">Geri</a></li>
            </ul>
        </nav>
    </header>

    <h2>Covid Temaslı Bilgisi Ekle</h2>

    <div class="form">
      <form action="../../../includes/covidBilgisiYonet.inc.php" method="POST">
        <div class="inputs">

            <label for="tcno">TC no</label>
            <select class="input" name="tcno" id="tcno">
                <option value="default">Covid temaslı eklemek için TC no seçiniz</option>
                <?php $res=mysqli_query($conn, "SELECT employers.NAME,employers.SURNAME,employers.IDENTITYNO FROM employers");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['IDENTITYNO'].">".$row['NAME']." ".$row['SURNAME']." ".$row['IDENTITYNO']."</option>";?>
            </select>
            <?php
                /*if (isset($_GET['tcno'])) {
                $tcno = $_GET['tcno'];
                echo '<label for="tc_no">TC No</label>';
                echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
                } else {
                echo '<label for="tc_no">TC No</label>';
                echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz...">';
                }*/
            ?>

            <label for="temaslitcno">Temaslı TC no</label>
            <select class="input" name="temaslitcno" id="temaslitcno">
                <option value="default">Temaslı TC no seçiniz</option>
                <?php $res=mysqli_query($conn, "SELECT employers.NAME,employers.SURNAME,employers.IDENTITYNO FROM employers");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['IDENTITYNO'].">".$row['NAME']." ".$row['SURNAME']." ".$row['IDENTITYNO']."</option>";?>
            </select>
            


            

        </div>
        <br><br>
        <button name="add3">Ekle</button>

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
            case "successtemasli";
              echo "<p class='success'>Temaslı TC no başarı ile eklendi.</p>";
            break;

              
          }
      }
    ?>
    
    
</body>
</html>