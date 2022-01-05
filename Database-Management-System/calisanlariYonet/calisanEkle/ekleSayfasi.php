<?php
  include_once '../../includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-calisaneklemesayfasi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Çalışan Ekle</title>
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
          <li class="anasayfa" onclick=location.href='../../index.php'><a href="#">Ana Sayfa</a></li>
          <li class="geri" onclick=location.href='../Calisanlari-Yonet.php'><a href="#">Geri</a></li>
        </ul>
      </nav>
  </header>

    <br><br><br><br><br>
    <h2>Çalışan Ekle</h2>
    <br><br><br><br><br>

    <div class="form">
      <form action="../../includes/calisanlariYonet.inc.php" method="POST">
        <div class="inputs">
          <?php
            //TC no input
            if (isset($_GET['tcno'])) {
              $tcno = $_GET['tcno'];
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
            } else {
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz...">';
            }
            
            if (isset($_GET['firstname'])) {
              $firstname = $_GET['firstname'];
              echo '<label for="fname">Ad</label>';
              echo '<input type="text" id="fname" name="firstname" placeholder="Ad giriniz..." value="'.$firstname.'">';
            } else {
              echo '<label for="fname">Ad</label>';
              echo '<input type="text" id="fname" name="firstname" placeholder="Ad giriniz...">';
            }

            if (isset($_GET['lastname'])) {
              $lastname = $_GET['lastname'];
              echo '<label for="lname">Soyad</label>';
              echo '<input type="text" id="lname" name="lastname" placeholder="Soyad giriniz..." value="'.$lastname.'">';
            } else {
              echo '<label for="lname">Soyad</label>';
              echo '<input type="text" id="lname" name="lastname" placeholder="Soyad giriniz...">';
            }
          ?>

          <label for="bg">Kan grubu</label>
          <select class="input" name="bg" id="bg">
            <option value="default">Kan grubu seçiniz</option>
            <?php $res=mysqli_query($conn, "select * from bloodgroups");
            while($row=mysqli_fetch_assoc($res))
            echo"<option value=".$row['BLOODID'].">".$row['BLOODNAME']."</option>";?>
          </select>

          <label for="sehirler">Şehir</label>
          <select class="input" name="sehirler" id="sehirler">
            <option value="default">Şehir seçiniz</option>
            <?php $res=mysqli_query($conn, "select * from cities");
            while($row=mysqli_fetch_assoc($res))
            echo"<option value=".$row['CITYID'].">".$row['CITYNAME']."</option>";?>
          </select>
          

          <label for="positions">Pozisyon</label>
          <select class="input" name="positions" id="positions">
            <option value="default">Pozisyon seçiniz</option>
            <?php $res=mysqli_query($conn, "select * from positions");
            while($row=mysqli_fetch_assoc($res))
            echo"<option value=".$row['POSITIONID'].">".$row['POSITIONNAME']."</option>";?>
          </select>

          <?php


            if (isset($_GET['hobby'])) {
              $hobby = $_GET['hobby'];
              echo '<label for="hobby">Hobiler</label>';
              echo '<textarea class="texta" type="text" id="hobby" name="hobby" placeholder="Hobileri giriniz...">'.$hobby.'</textarea>';
            } else {
              echo '<label for="hobby">Hobiler</label>';
              echo '<textarea class="texta" type="text" id="hobby" name="hobby" placeholder="Hobileri giriniz..."></textarea>';
            }
          ?>

          <label for="ogrenimDurumu">Öğrenim Durumu</label>
          <select class="input" name="ogrenimDurumu" id="ogrenimDurumu">
            <option value="default">Öğrenim durumu seçiniz</option>
            <?php $res=mysqli_query($conn, "select * from educations");
            while($row=mysqli_fetch_assoc($res))
            echo"<option value=".$row['EDUCATIONID'].">".$row['EDUCATIONNAME']."</option>";?>
          </select>

          <!--Database'e göre eklenip ya da çıkarılacak-->
          <!--<label for="">Çalışma Günleri</label>
          <div>
            <input type="checkbox" name="d1">Pazartesi
            <input type="checkbox" name="d2">Salı
            <input type="checkbox" name="d3">Çarşamba
            <input type="checkbox" name="d4">Perşembe
            <input type="checkbox" name="d5">Cuma
            <input type="checkbox" name="d6">Cumartesi
            <input type="checkbox" name="d7">Pazar
          </div>-->
          
          <label for="calismaSekli">Çalışma Şekli</label>
          <select class="input" name="calismaSekli" id="calismaSekli">
            <option value="default">Çalışma şekli seçiniz</option>
            <?php $res=mysqli_query($conn, "select * from worktime");
            while($row=mysqli_fetch_assoc($res))
            echo"<option value=".$row['WORKTIMEID'].">".$row['WORKTYPE']."</option>";?>
          </select>

          <label for="calismagunu">Çalışma günleri</label>
          <select class="input" name="calismagunu" id="calismagunu">
            <option value="default">Çalışma günleri seçiniz</option>
            <?php $res=mysqli_query($conn, "select * from workdays");
            while($row=mysqli_fetch_assoc($res))
            echo"<option value=".$row['WORKDAYID'].">".$row['DAYNAME']."</option>";?>
          </select>

        </div>
        <br><br>
        <button name="add">Ekle</button>

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
            case "calismagunu";
            echo "<p class='error'>Çalışma günü seçmelisiniz!</p>";
            break;

              
          }
        }
    ?>

  </body>

</html>