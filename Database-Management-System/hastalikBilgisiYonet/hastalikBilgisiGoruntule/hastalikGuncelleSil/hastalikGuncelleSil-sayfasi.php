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
        <link rel="stylesheet" href="style-hastalikGuncellemeSilmeSayfasi.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>Hastalık Güncelle-Sil</title>
    </head>

    <body>

    <div class="tekgeri">
    <i class="fas fa-angle-left"></i>
    </div>

    <div class="ciftgeri">
    <i class="fas fa-angle-double-left"></i>
    </div>

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
              
                header("Location: ../hastalikBilgisiGoruntule-sayfasi.php?signup=veritabanı1&tcno=$tcno");
            }
        ?>
    </div>
    
    <div class="table2">
        <?php
            $sql5 = $_SESSION['sql4'];
            $result2 = mysqli_query($conn, $sql5);
            //$resultCheck2 = mysqli_num_rows($result2);
             
                $query = array();
                while($query[] = mysqli_fetch_assoc($result2));
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
            
                //header("Location: ../hastalikBilgisiGoruntule-sayfasi.php?signup=veritabanı2&tcno=$tcno");
            
        ?>
    </div>
          
     <div class="form">
     <form action="../../../includes/hastalikBilgisiYonet.inc.php" method="POST" class="sil">
         <div class="inputs">
        
        <?php


                $tcno = $_SESSION['tcno3'];
                echo '<label for="tc_no">TC No</label>';
                echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
        /*
            if (isset($_GET['tcno'])) {
              $tcno = $_GET['tcno'];
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz..." value="'.$tcno.'">';
            } else {
              echo '<label for="tc_no">TC No</label>';
              echo '<input type="number" id="tc_no" name="tcno" placeholder="TC Kimlik no giriniz...">';
            }*/

        ?>

            <label for="hastalik">Silinecek hastalık</label>
            <select class="input" name="hastalik" id="hastalik">
              <option value="default">Hastalık seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseases");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
            </select>
            </div>
             <div class="hastaliksil">
             <button  name="delete" onclick="clicked(event)">Hastalık sil</button>
             </div>
        </div>
    </form>
     <div class="form">
        <form action="../../../includes/hastalikBilgisiYonet.inc.php" method="POST" class="hastalik">
        <div class="inputs">

            <?php

                $tcno = $_SESSION['tcno3'];
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
      
            <label for="guncelhastalik">Güncellenecek hastalık</label>
            <select class="input" name="guncelhastalik" id="guncelhastalik">
              <option value="default">Hastalık seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseases");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
            </select>

            <label for="yenihastalik">Yeni hastalık</label>
            <select class="input" name="yenihastalik" id="yenihastalik">
              <option value="default">Hastalık seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseases");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
            </select>
            
        </div>
          <div class="update1">
           <button name="update1" onclick="clicked(event)">Hastalık güncelle</button>
          </div>
        </form>
     </div>
     <div class="form">
      <form action="../../../includes/hastalikBilgisiYonet.inc.php" method="POST" class="ilac">
        <div class="inputs">

            <?php

              $tcno = $_SESSION['tcno3'];
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
      
            <label for="hastalik">Hastalık</label>
            <select class="input" name="hastalik" id="hastalik">
              <option value="default">Hastalık seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseases");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
            </select>

            <label for="guncelilac">Güncellenecek ilacı seçiniz</label>
            <select class="input" name="guncelilac" id="guncelilac">
              <option value="default">İlaç seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseasedrugs");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASEDRUGID'].">".$row['DRUGNAME']."</option>";?>
            </select>

            <label for="yeniilac">Yeni ilacı seçiniz</label>
            <select class="input" name="yeniilac" id="yeniilac">
              <option value="default">İlaç seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseasedrugs");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASEDRUGID'].">".$row['DRUGNAME']."</option>";?>
            </select>

            <label for="doz">Günde kaç doz</label>
            <input type="number" id="doz" name="doz" placeholder="Doz miktarını giriniz...">

        </div>
           <div class="update2">
          <button name="update2" onclick="clicked(event)">İlaç güncelle</button>
           </div>
      </div>
    </form>
        <div class="form">
          <form action="../../../includes/hastalikBilgisiYonet.inc.php" method="POST" class="semptom">
          <div class="inputs">

            <?php

                $tcno = $_SESSION['tcno3'];
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
      
            <label for="hastalik">Hastalık</label>
            <select class="input" name="hastalik" id="hastalik">
              <option value="default">Hastalık seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseases");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
            </select>

            <label for="guncelsemptom">Güncellenecek semptom</label>
            <select class="input" name="guncelsemptom" id="guncelsemptom">
              <option value="default">Güncellenecek semptomu seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseasesymptoms");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASESYMPTOMID'].">".$row['DISEASESYMPTOM']."</option>";?>
            </select>

            <label for="yenisemptom">Yeni semptom</label>
            <select class="input" name="yenisemptom" id="yenisemptom">
              <option value="default">Yeni semptomu seçiniz</option>
              <?php $res=mysqli_query($conn, "SELECT * FROM diseasesymptoms");
              while($row=mysqli_fetch_assoc($res))
              echo"<option value=".$row['DISEASESYMPTOMID'].">".$row['DISEASESYMPTOM']."</option>";?>
            </select>

          </div>
            <div class="update3">
          <button name="update3" onclick="clicked(event)">Semptom güncelle</button>
            </div> 
       </div>
    </form>

        <header>
            <nav>
                <ul class="nav__links">
                    <li class="anasayfa" onclick=location.href='../../../index.php'><a href="#">Ana Sayfa</a></li>
                    <li class="geri" onclick=location.href='../hastalikBilgisiGoruntule-sayfasi.php'><a href="#">Geri</a></li>
                </ul>
            </nav>
        </header>


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

              
          }
      }
    ?>

          <script>
            function clicked(e)
            {
              if(!confirm('Are you sure?')) {
              e.preventDefault();
              }
            }             
          </script>
        
    </body>

</html>