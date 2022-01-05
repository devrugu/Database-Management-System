<?php
    session_start();
    include_once '../../../includes/dbh.inc.php';
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style-covidGuncelleveSilSayfasiii.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>Covid Güncelle-Sil</title>

        <script>
            function clicked(e)
            {
              if(!confirm('Emin misiniz?')) {
              e.preventDefault();
              }
            }             
        </script>
    </head>

    <body>

    <div class="tekgeri">
    <i class="fas fa-angle-left"></i>
    </div>

    <div class="ciftgeri">
    <i class="fas fa-angle-double-left"></i>
    </div>

        <header>
            <nav>
                <ul class="nav__links">
                    <li class="anasayfa" onclick=location.href='../../../index.php'><a href="#">Ana Sayfa</a></li>
                    <li class="geri" onclick=location.href='../covidBilgisiGoruntule-sayfasi.php'><a href="#">Geri</a></li>
                </ul>
            </nav>
        </header>

    <!--covid bilgisi tablosu-->
    <div class="table1">
        <?php
            $sql3 = $_SESSION['sql2'];
            $result = mysqli_query($conn, $sql3);
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

                //header("Location: ../covidBilgisiGoruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            }
        ?>
    </div>
    
    <!--temaslı tablosu-->
    
    <div class="table2">
        <?php
        
            $sql5 = $_SESSION['sql4'];
            $result2 = mysqli_query($conn, $sql5);
            $resultCheck2 = mysqli_num_rows($result2);
            if ($resultCheck2 > 0) {
                $query2 = array();
                while($query2[] = mysqli_fetch_assoc($result2));
                array_pop($query2);

                // SQL koduna göre dinamik tablo oluşturma
                echo '<div class = "table">';
                echo '<table border="1">';
                echo '<tr>';
                foreach($query2[0] as $key2 => $value2) {
                    echo '<td>';
                    echo $key2;
                    echo '</td>';
                }
                echo '</tr>';
                foreach($query2 as $row) {
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
                  echo "<p class='warning'>Uyarı: Bu kişiye ait temaslı bilgisi bulunmamaktadır.</p>";
              }
        ?>
    </div>
            
          
     <div class="form">
     <form action="../../../includes/covidBilgisiYonet.inc.php" method="POST" class="sil">
         <div class="inputs">
        <?php
            

            $tcno = $_SESSION['tcno4'];
            echo '<label for="tc_no">TC No</label>';
            echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
           /* if (isset($_GET['tcno'])) {
              $tcno = $_GET['tcno'];
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
            } else {
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz...">';
            }*/
        ?>

            <label for="kacinci">Kaçıncı covid</label>
            <input type="number" id="kacinci" name="kacinci" placeholder="Kaçıncı covid?">

            </div>
             <div class="hastaliksil">
             <button  name="delete" onclick="clicked(event)">Covid bilgisi sil</button>
             </div>
        </div>
    </form>
     <div class="form">
        <form action="../../../includes/covidBilgisiYonet.inc.php" method="POST" class="hastalik">
        <div class="inputs">

            <?php

                $tcno = $_SESSION['tcno4'];
                echo '<label for="tc_no">TC No</label>';
                echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
            /*if (isset($_GET['tcno'])) {
              $tcno = $_GET['tcno'];
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
            } else {
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz...">';
            }*/
            ?>
      
            <label for="asi">Aşı tipi</label>
            <select class="input" name="asi" id="asi">
                <option value="default">Aşı seçiniz</option>
                <?php $res=mysqli_query($conn, "select * from vaccines");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['VACCINEID'].">".$row['VACCINENAME']."</option>";?>
            </select>

            <label for="covidbaslangictarihi">Yakalandığı tarih</label>
            <input type="date" id="covidbaslangictarihi" name="covidbaslangictarihi">

            <label for="covidbitistarihi">Bittiği tarih</label>
            <input type="date" id="covidbitistarihi" name="covidbitistarihi">

            <!--<label for="kacgunsurdu">Kaç gün sürdü?</label>
            <input type="number" id="kacgunsurdu" name="kacgunsurdu" placeholder="Kaç gün sürdü?">-->

            

            <label for="kacinci">Kaçıncı covid</label>
            <input type="number" id="kacinci" name="kacinci" placeholder="Kaçıncı covid?">
            
        </div>
          <div class="update1">
           <button name="update" onclick="clicked(event)">Covid bilgisi güncelle</button>
          </div>
    </form>
     </div>
     <div class="form">
      <form action="../../../includes/covidBilgisiYonet.inc.php" method="POST" class="ilac">
        <div class="inputs">

            <?php

              $tcno = $_SESSION['tcno4'];
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
            /*if (isset($_GET['tcno'])) {
              $tcno = $_GET['tcno'];
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
            } else {
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz...">';
            }*/
            ?>

            <label for="guncelcovidsemptom">Güncellenecek covid semptomu</label>
            <select class="input" name="guncelcovidsemptom" id="guncelcovidsemptom">
              <option value="default">Güncellenecek covid semptomunu seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM covidsymptoms");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['COVIDSYMPTOMID'].">".$row['COVIDSYMPTOM']."</option>";?>
            </select>

            <label for="yenicovidsemptom">Yeni covid semptomu</label>
            <select class="input" name="yenicovidsemptom" id="yenicovidsemptom">
              <option value="default">Yeni covid semptomunu seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM covidsymptoms");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['COVIDSYMPTOMID'].">".$row['COVIDSYMPTOM']."</option>";?>
            </select>

            <label for="kacinci">Kaçıncı covid</label>
            <input type="number" id="kacinci" name="kacinci" placeholder="Kaçıncı covid?">


        </div>
           <div class="update2">
          <button name="update2" onclick="clicked(event)">Covid semptom güncelle</button>
           </div>
      </div>
    </form>
        <div class="form">
          <form action="../../../includes/covidBilgisiYonet.inc.php" method="POST" class="semptom">
          <div class="inputs">

          <?php

                    $tcno = $_SESSION['tcno4'];
                    echo '<label for="tc_no">TC No</label>';
                    echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
                /*if (isset($_GET['tcno'])) {
                $tcno = $_GET['tcno'];
                echo '<label for="tc_no">TC No</label>';
                echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
                } else {
                echo '<label for="tc_no">TC No</label>';
                echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz...">';
                }*/
            ?>

            <label for="eskitemaslitcno">Güncellenecek temaslı TC no</label>
            <select class="input" name="eskitemaslitcno" id="eskitemaslitcno">
                <option value="default">Güncellenecek temaslı TC no seçiniz</option>
                <?php $res=mysqli_query($conn, "SELECT employers.NAME,employers.SURNAME,employers.IDENTITYNO FROM employers");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['IDENTITYNO'].">".$row['NAME']." ".$row['SURNAME']." ".$row['IDENTITYNO']."</option>";?>
            </select>

            <label for="yenitemaslitcno">Yeni temaslı TC no</label>
            <select class="input" name="yenitemaslitcno" id="yenitemaslitcno">
                <option value="default">Yeni temaslı TC no seçiniz</option>
                <?php $res=mysqli_query($conn, "SELECT employers.NAME,employers.SURNAME,employers.IDENTITYNO FROM employers");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['IDENTITYNO'].">".$row['NAME']." ".$row['SURNAME']." ".$row['IDENTITYNO']."</option>";?>
            </select>

          </div>
            <div class="update3">
          <button name="update3" onclick="clicked(event)">Temaslı güncelle</button>
            </div> 
       </div>
    </form>

        


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
            case "successguncellemecovid";
              echo "<p class='success'>Covid bilgisi başarı ile güncellendi.</p>";
            break;
            case "successcovidtemasli";
            echo "<p class='success'>Covid temaslı bilgisi başarı ile güncellendi.</p>";
            break;
            case "successcovidsilme";
            echo "<p class='success'>Covid bilgileri başarı ile silindi.</p>";
            break;
            case "veritabanıtcno";
            echo "<p class='error'>Tablodaki kişinin TC no bilgisini giriniz!</p>";
            break;
            case "kacincibos";
            echo "<p class='error'>Kaçıncı covid kısmını doldurunuz!</p>";
            break;
            

              
          }
      }
    ?>

          
        
    </body>

</html>