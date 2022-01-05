<?php
  include_once '../../includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-hastalikBilgisiEklesayfasii.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Hastalık Bilgisi Ekle</title>
  </head>

  <body>

  <header>
      <nav>
        <ul class="nav__links">
          <li class="anasayfa"onclick=location.href='../../index.php'><a href="#">Ana Sayfa</a></li>
          <li class="geri"onclick=location.href='../hastalikBilgisiYonet-sayfasi.php'><a href="#">Geri</a></li>
        </ul>
      </nav>
  </header>

    <br><br><br><br><br>
    <h2>Hastalık Bilgisi Ekle</h2>
    <br><br><br><br><br>

    <div class="tekgeri">
    <i class="fas fa-angle-left"></i>
    </div>

    <div class="ciftgeri">
    <i class="fas fa-angle-double-left"></i>
    </div>

    <div class="form">
        <form action="../../includes/hastalikBilgisiYonet.inc.php" method="POST">
            <div class="inputs">


            <label for="tcno">TC no</label>
            <select class="input" name="tcno" id="tcno">
                <option value="default">Hastalık bilgisi eklemek için TC no seçiniz</option>
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

                <label for="kronik">Hastalık Türü</label>
                <select class="input" name="kronik" id="kronik">
                    <option value="default">Hastalık Türü Seçiniz</option>
                    <option value="1">Kronik hastalık</option>
                    <option value="0">Akut hastalık</option>
                </select>

                <label for="hastaliklar">Hastalık ismi</label>
                <select class="input" name="hastaliklar" id="hastaliklar">
                  <option value="default">Hastalık seçiniz</option>
                  <?php $res=mysqli_query($conn, "SELECT * FROM diseases");
                  while($row=mysqli_fetch_assoc($res))
                  echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
                </select>

                <label for="semptomlar">Semptomlar</label>
                <select id="semptomlar"  class="chosen-select" multiple="multiple" name="semptomlar[]">
                  <?php $res=mysqli_query($conn, "SELECT * FROM diseasesymptoms");
                  while($row=mysqli_fetch_assoc($res))
                  echo"<option value=".$row['DISEASESYMPTOMID'].">".$row['DISEASESYMPTOM']."</option>";?>
                </select>
                

                    
                <label for="hastatarih">Hasta olduğu tarih</label>
                <input type="date" id="hastatarih" name="hastatarih">
                    
                

                <!--covid tablosuna gidebilir-->
                <!--<label for="covid">Covid Durumu</label>
                <select class="input" name="covid" id="covid">
                    <option value="default">Covid durumu seçiniz</option>
                    <option value="1">Covid</option>
                    <option value="0">Covid değil</option>
                </select>-->



            </div>
            <br><br>
            <div class="ekle">
            <button name="add">Ekle</button>
            </div>

        </form>
    </div>


      <!--ilaç kısmı-->
    <div class="ilac">
        <form action="ilacBilgisiEkleme/ilacBilgisiEkle-sayfasi.php">

            <br><br>
            <div class="ilacbutonu">
            <button name="view">İlaç bilgisi ekle</button>
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
            case "semptombos";
              echo "<p class='error'>Semptom giriniz!</p>";
            break;
            case "kronikbos";
              echo "<p class='error'>Kronik veya akut seçiniz!</p>";
            break;
            case "hastatarihbos";
              echo "<p class='error'>Tarih kısmını giriniz!</p>";
            break;
            case "covidbos";
              echo "<p class='error'>Covid durumu seçiniz!</p>";
            break;
            case "ilacdozbos";
              echo "<p class='error'>İlaç dozu seçiniz!</p>";
            break;
          }
        }
    ?>

  </body>

</html>