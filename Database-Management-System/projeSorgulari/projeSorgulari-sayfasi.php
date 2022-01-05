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
        <title>Proje Sorguları</title>
        <link rel="stylesheet" href="styleProjeSorguSayfasi.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <!--Eğitim durumu ile covid geçirme arasındaki istatistiksel bilgi tablosu-->
    <div class="tam1">
        <p class="baslik1" >Eğitim Durumu İle Covid Geçirme Arasındaki İstatistiksel Bilgi</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            <label for="ogrenimDurumu">Öğrenim Durumu</label>
            <select class="input" name="ogrenimDurumu" id="ogrenimDurumu">
                <option value="default">Öğrenim durumu seçiniz</option>
                <?php $res=mysqli_query($conn, "select * from educations");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['EDUCATIONID'].">".$row['EDUCATIONNAME']."</option>";?>
            </select>
            <button name="goster1">Göster</button>
        </form>
       <div class="tablo1">
        <?php
            if (isset($_POST['goster1'])) {      
                $ogrenimDurumu = $_POST['ogrenimDurumu'];
                $sqlsorgu1 = "SELECT (SELECT educations.EDUCATIONNAME FROM employers,educations WHERE employers.EDUCATIONID = educations.EDUCATIONID 
                AND educations.EDUCATIONID = '$ogrenimDurumu' GROUP BY educations.EDUCATIONID) AS EĞİTİM_DURUMU, (SELECT COUNT(covidpatience.IDENTITYNO) 
                FROM covidpatience) AS TOPLAM_HASTA , (SELECT COUNT(employers.EDUCATIONID) FROM employers 
                WHERE employers.EDUCATIONID = '$ogrenimDurumu' )as EĞİTİM_DURUMUNA_GÖRE_HASTA,(SELECT ( SELECT COUNT(employers.EDUCATIONID) 
                FROM employers,educations WHERE employers.EDUCATIONID = educations.EDUCATIONID 
                AND employers.EDUCATIONID ='$ogrenimDurumu') *100 / ( SELECT COUNT(covidpatience.IDENTITYNO) FROM employers,covidpatience 
                WHERE employers.IDENTITYNO = covidpatience.IDENTITYNO))as YÜZDELİK_DEĞERİ;";
                $result1 = mysqli_query($conn, $sqlsorgu1);
                $resultCheck1 = mysqli_num_rows($result1);
                if ($resultCheck1 > 0) {
                    $query1 = array();
                    while($query1[] = mysqli_fetch_assoc($result1));
                        array_pop($query1);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query1[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query1 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
       </div>
    </div>

    <!--Elemanlar arasında görülen en yaygın üç hastalık türü ve bu hastalığa sahip olan elemanlar-->
    <div class="tam2">
        <p class="baslik2" >Elemanlar arasında görülen en yaygın üç hastalık türü ve bu hastalığa sahip olan elemanlar</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster2">Göster</button>
        </form>
     <div class="tablo2">
        <?php
            if (isset($_POST['goster2'])) {      
                $sqlsorgu2 = "CREATE TEMPORARY TABLE tempdisease SELECT COUNT(matchdisease.DISEASEID) as ADET,matchdisease.DISEASEID as HASTALIKID 
                FROM matchdisease GROUP by matchdisease.DISEASEID ORDER BY COUNT(matchdisease.DISEASEID) DESC LIMIT 3;";
                mysqli_query($conn, $sqlsorgu2);
                $sql25 = "SELECT employers.NAME, employers.SURNAME, diseases.DISEASENAME,tempdisease.ADET FROM matchdisease 
                INNER JOIN diseases on matchdisease.DISEASEID = diseases.DISEASEID INNER JOIN tempdisease on matchdisease.DISEASEID = tempdisease.HASTALIKID 
                INNER JOIN employers ON matchdisease.IDENTITYNO = employers.IDENTITYNO GROUP BY matchdisease.DISEASEID,employers.NAME,employers.SURNAME 
                ORDER by tempdisease.ADET DESC;";
                $result2 = mysqli_query($conn, $sql25);
                
                $resultCheck2 = mysqli_num_rows($result2);
                if ($resultCheck2 > 0) {
                    $query2 = array();
                    while($query2[] = mysqli_fetch_assoc($result2));
                        array_pop($query2);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query2[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
       </div>
    </div>

    <!--Belirli Şehirde Doğan Elemanlar Arasında En Sık Görülen İlk Üç Hastalık-->
    <div class="tam3">
        <p class="baslik3" >Belirli Şehirde Doğan Elemanlar Arasında En Sık Görülen İlk Üç Hastalık</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            <label for="sehirler">Şehir</label>
            <select class="input" name="sehirler" id="sehirler">
                <option value="default">Şehir seçiniz</option>
                <?php $res=mysqli_query($conn, "select * from cities");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['CITYID'].">".$row['CITYNAME']."</option>";?>
          </select>
            <button name="goster3">Göster</button>
        </form>
      <div class="tablo3">
        <?php
            if (isset($_POST['goster3'])) {      
                $sehirler = $_POST['sehirler'];
                $sqlsorgu3 = "SELECT cities.CITYNAME AS ŞEHİR_İSMİ, COUNT(matchdisease.DISEASEID) AS HASTALIK_SAYISI, diseases.DISEASENAME AS HASTALIK_İSMİ 
                FROM employers,cities,matchdisease,diseases WHERE employers.IDENTITYNO = matchdisease.IDENTITYNO AND employers.CITYID = cities.CITYID 
                AND matchdisease.DISEASEID = diseases.DISEASEID AND employers.CITYID = '$sehirler' GROUP BY matchdisease.DISEASEID 
                ORDER BY COUNT(matchdisease.DISEASEID) DESC LIMIT 3;";
                $result3 = mysqli_query($conn, $sqlsorgu3);
                $resultCheck3 = mysqli_num_rows($result3);
                if ($resultCheck3 > 0) {
                    $query3 = array();
                    while($query3[] = mysqli_fetch_assoc($result3));
                        array_pop($query3);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query3[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query3 as $row) {
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
                echo "<p>Şirkette çalışanlardan hiçkimse bu şehirde doğmamış.</p>";
            }
            }
        ?>
       </div>
    </div>

    <!--En yaygın kullanılan ilk üç ilacı kullanan elemanların COVID geçirme durumu-->
    <div class="tam4">
        <p class="baslik4" >En yaygın kullanılan ilk üç ilacı kullanan elemanların COVID geçirme durumu</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster4">Göster</button>
        </form>
        <div class="tablo4">
        <?php
            if (isset($_POST['goster4'])) {      
                $sqlsorgu4 = "CREATE TEMPORARY TABLE tempdisease SELECT COUNT(match_d_drug.DISEASEDRUGID) as ADET,match_d_drug.DISEASEDRUGID as ILACID 
                FROM match_d_drug WHERE match_d_drug.DISEASEDRUGID NOT IN(52) GROUP by match_d_drug.DISEASEDRUGID 
                ORDER BY COUNT(match_d_drug.DISEASEDRUGID) DESC LIMIT 3;";
                mysqli_query($conn, $sqlsorgu4);
                $sql45 = "SELECT employers.NAME,employers.SURNAME,tempdisease.ILACID,tempdisease.ADET , diseasedrugs.DRUGNAME,match_d_drug.D_DRUGDOSE 
                as DRUG_DOZ,covidpatience.CATCHCOVID,covidpatience.ENDCOVID,vaccines.VACCINENAME,covidpatience.HOWMANYCOVID
                FROM match_d_drug
                INNER JOIN employers ON employers.IDENTITYNO = match_d_drug.IDENTITYNO
                INNER JOIN diseasedrugs ON match_d_drug.DISEASEDRUGID = diseasedrugs.DISEASEDRUGID
                INNER JOIN covidpatience ON covidpatience.IDENTITYNO = employers.IDENTITYNO
                INNER JOIN vaccines ON vaccines.VACCINEID = covidpatience.VACCINEID
                INNER JOIN tempdisease on tempdisease.ILACID = match_d_drug.DISEASEDRUGID
                GROUP BY employers.NAME,employers.SURNAME,covidpatience.CATCHCOVID,covidpatience.ENDCOVID,vaccines.VACCINENAME,covidpatience.HOWMANYCOVID,match_d_drug.D_DRUGDOSE 
                ORDER BY tempdisease.adet DESC;";
                $result4 = mysqli_query($conn, $sql45);
                
                $resultCheck4 = mysqli_num_rows($result4);
                if ($resultCheck4 > 0) {
                    $query4 = array();
                    while($query4[] = mysqli_fetch_assoc($result4));
                        array_pop($query4);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query4[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query4 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
       </div>
    </div>

    <!--Belirli bir ilacı kullanan çalışanların COVID geçirme durumu-->
    <div class="tam5">
        <p class="baslik5" >Belirli bir ilacı kullanan çalışanların COVID geçirme durumu</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
                <label for="ilac">İlaç ismi</label>
                <select class="input" name="ilac" id="ilac">
                  <option value="default">İlaç seçiniz</option>
                  <?php $res=mysqli_query($conn, "SELECT * FROM diseasedrugs;");
                  while($row=mysqli_fetch_assoc($res))
                  echo"<option value=".$row['DISEASEDRUGID'].">".$row['DRUGNAME']."</option>";?>
                </select>
            <button name="goster5">Göster</button>
        </form>
        <div class="tablo5">
        <?php
            if (isset($_POST['goster5'])) {      
                $ilac = $_POST['ilac'];
                $sqlsorgu5 = "SELECT employers.IDENTITYNO AS TCNO,employers.NAME AS AD,employers.SURNAME AS SOYAD, diseasedrugs.DRUGNAME 
                AS İLAÇ_ADI,match_d_drug.D_DRUGDOSE AS İLAÇ_DOZU,covidpatience.CATCHCOVID AS COVİDE_YAKALANMA_TARİHİ,covidpatience.ENDCOVID 
                AS COVİDİN_BİTİŞ_TARİHİ,covidpatience.HOWMANYCOVID AS KAÇ_DEFA_COVİD_GEÇİRDİ FROM employers
                INNER JOIN covidpatience ON covidpatience.IDENTITYNO = employers.IDENTITYNO
                INNER JOIN match_d_drug ON match_d_drug.IDENTITYNO = employers.IDENTITYNO
                INNER JOIN diseasedrugs ON match_d_drug.DISEASEDRUGID = diseasedrugs.DISEASEDRUGID
                WHERE match_d_drug.DISEASEDRUGID = '$ilac';";
                $result5 = mysqli_query($conn, $sqlsorgu5);
                $resultCheck5 = mysqli_num_rows($result5);
                if ($resultCheck5 > 0) {
                    $query5 = array();
                    while($query5[] = mysqli_fetch_assoc($result5));
                        array_pop($query5);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query5[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query5 as $row) {
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
                echo "<p>Şirkette bu ilacı kullanan hiçkimse yok.</p>";
                }
            }
        ?>
       </div>
    </div>

    <!--Biontech Aşısı Olan Ve Belirli Bir Hastalığı Önceden Geçirmiş Olan Çalışanlardan Covıd’e Yakalananlar-->
    <div class="tam6">
        <p class="baslik6" >Biontech Aşısı Olan Ve Belirli Bir Hastalığı Önceden Geçirmiş Olan Çalışanlardan Covıd’e Yakalananlar</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            <label for="hastaliklar">Hastalık ismi</label>
                <select class="input" name="hastaliklar" id="hastaliklar">
                    <option value="default">Hastalık seçiniz</option>
                    <?php $res=mysqli_query($conn, "SELECT * FROM diseases");
                    while($row=mysqli_fetch_assoc($res))
                    echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
                </select>
            <button name="goster6">Göster</button>
        </form>
        <div class="tablo6">
        <?php
            if (isset($_POST['goster6'])) {      
                $hastaliklar = $_POST['hastaliklar'];
                $sqlsorgu6 = "SELECT employers.NAME AS AD, employers.SURNAME AS SOYAD, covidpatience.HOWMANYCOVID AS KAÇINCI_COVİD, vaccines.VACCINENAME 
                AS AŞI_ADI , diseases.DISEASENAME AS HASTALIK_ADI FROM employers
                INNER JOIN covidpatience on employers.IDENTITYNO = covidpatience.IDENTITYNO
                INNER JOIN matchdisease on employers.IDENTITYNO = matchdisease.IDENTITYNO
                INNER JOIN diseases ON matchdisease.DISEASEID = diseases.DISEASEID
                INNER JOIN vaccines ON covidpatience.VACCINEID = vaccines.VACCINEID
                WHERE matchdisease.DISEASEID = '$hastaliklar' AND covidpatience.VACCINEID = 2 AND covidpatience.HOWMANYCOVID IS NOT NULL;";
                $result6 = mysqli_query($conn, $sqlsorgu6);
                $resultCheck6 = mysqli_num_rows($result6);
                if ($resultCheck6 > 0) {
                    $query6 = array();
                    while($query6[] = mysqli_fetch_assoc($result6));
                        array_pop($query6);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query6[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query6 as $row) {
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
                echo "<p>Bu hastalığı önceden geçirmiş olan hiçkimse Biontech aşısını olmamış.</p>";
            }
            }
        ?>
       </div>
    </div>

    <!--Aşı vurulma durumuna göre COVID hastalığına yakalanma oranı-->
    <div class="tam7">
        <p class="baslik7" >Aşı vurulma durumuna göre COVID hastalığına yakalanma oranı</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster7">Göster</button>
        </form>
        <div class="tablo7">
        <?php
            if (isset($_POST['goster7'])) {      
                $sqlsorgu7 = "SELECT COUNT(covidpatience.HOWMANYCOVID) AS ASI_VURULAN_SAYISI, COUNT(employers.IDENTITYNO) 
                AS TOPLAM_KISI_SAYISI, COUNT(covidpatience.HOWMANYCOVID)*100/COUNT(employers.IDENTITYNO) AS COVID_YAKALANMA_ORANI FROM employers
                INNER JOIN covidpatience on employers.IDENTITYNO = covidpatience.IDENTITYNO
                WHERE covidpatience.VACCINEID IN(SELECT covidpatience.VACCINEID FROM covidpatience 
                WHERE covidpatience.VACCINEID = 2 OR covidpatience.VACCINEID = 3);";
                $result7 = mysqli_query($conn, $sqlsorgu7);
                $resultCheck7 = mysqli_num_rows($result7);
                if ($resultCheck7 > 0) {
                    $query7 = array();
                    while($query7[] = mysqli_fetch_assoc($result7));
                        array_pop($query7);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query7[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query7 as $row) {
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
                
                }
            }
        ?>
       </div>
    </div>

    <!--Belirli bir kronik hastalığa göre, çalışanların COVID testinin negatife dönmesi için geçen süre rapor edilebilmelidir.-->
    <div class="tam8">
        <p class="baslik8" >Belirli bir kronik hastalığa göre, çalışanların COVID testinin negatife dönmesi için geçen süre</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            <label for="kronik">Kronik hastalık ismi</label>
                <select class="input" name="kronik" id="kronik">
                    <option value="default">Kronik hastalık seçiniz</option>
                    <?php $res=mysqli_query($conn, "SELECT diseases.DISEASENAME,matchdisease.DISEASEID FROM matchdisease INNER JOIN diseases ON diseases.DISEASEID = matchdisease.DISEASEID WHERE matchdisease.DISEASEID IN (1,2,3,4,5,9,12,14,16,17) GROUP BY matchdisease.DISEASEID;");
                    while($row=mysqli_fetch_assoc($res))
                    echo"<option value=".$row['DISEASEID'].">".$row['DISEASENAME']."</option>";?>
                </select>
            <button name="goster8">Göster</button>
        </form>
        <div class="tablo8">
        <?php
            if (isset($_POST['goster8'])) {      
                $kronik = $_POST['kronik'];
                $sqlsorgu8 = "SELECT employers.NAME AS AD,employers.SURNAME AS SOYAD,diseases.DISEASENAME 
                AS HASTALIK_ADI, DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID) AS KAÇ_GÜN_SÜRDÜ FROM covidpatience 
                INNER JOIN employers ON employers.IDENTITYNO = covidpatience.IDENTITYNO
                INNER JOIN matchdisease ON covidpatience.IDENTITYNO = matchdisease.IDENTITYNO 
                INNER JOIN diseases ON matchdisease.DISEASEID = diseases.DISEASEID 
                WHERE matchdisease.DISEASEID = '$kronik' AND DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID) IS NOT NULL;";
                $result8 = mysqli_query($conn, $sqlsorgu8);
                $resultCheck8 = mysqli_num_rows($result8);
                if ($resultCheck8 > 0) {
                    $query8 = array();
                    while($query8[] = mysqli_fetch_assoc($result8));
                        array_pop($query8);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query8[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query8 as $row) {
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
                echo "<p>Bu hastalığı önceden geçirmiş olan hiçkimse Biontech aşısını olmamış.</p>";
            }
            }
        ?>
       </div>
    </div>

    <!--Kan grubuna göre COVID’e yakalanma sıklığı-->
    <div class="tam9">
        <p class="baslik9" >Kan grubuna göre COVID’e yakalanma sıklığı</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            <label for="bg">Kan grubu</label>
                <select class="input" name="bg" id="bg">
                <option value="default">Kan grubu seçiniz</option>
                <?php $res=mysqli_query($conn, "select * from bloodgroups");
                while($row=mysqli_fetch_assoc($res))
                echo"<option value=".$row['BLOODID'].">".$row['BLOODNAME']."</option>";?>
                </select>
            <button name="goster9">Göster</button>
        </form>
        <div class="tablo9">
        <?php
            if (isset($_POST['goster9'])) {      
                $bg = $_POST['bg'];
                $sqlsorgu9 = "SELECT employers.IDENTITYNO AS TCNO, employers.NAME AS AD,employers.SURNAME AS SOYAD, bloodgroups.BLOODNAME 
                AS KAN_GRUBU, covidpatience.HOWMANYCOVID AS KAÇ_DEFA_COVİD_GEÇİRDİ FROM employers
                INNER JOIN covidpatience on employers.IDENTITYNO = covidpatience.IDENTITYNO
                INNER JOIN bloodgroups ON employers.BLOODID = bloodgroups.BLOODID
                WHERE employers.BLOODID IN (SELECT employers.BLOODID from employers WHERE employers.BLOODID = '$bg' 
                AND covidpatience.HOWMANYCOVID IS NOT NULL);";
                $result9 = mysqli_query($conn, $sqlsorgu9);
                $resultCheck9 = mysqli_num_rows($result9);
                if ($resultCheck9 > 0) {
                    $query9 = array();
                    while($query9[] = mysqli_fetch_assoc($result9));
                        array_pop($query9);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query9[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query9 as $row) {
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
                echo "<p>Şirkette bu kan grubuna ait hiçkimse yok.</p>";
            }
            }
        ?>
       </div>
    </div>

   

    <!--Toplam çalışma süresi ile COVID’e yakalanma arasındaki istatistiki bilgi-->
    <div class="tam10">
        <p class="baslik10" >Toplam çalışma süresi ile COVID’e yakalanma arasındaki istatistiki bilgi</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster11">Göster</button>
        </form>
        <div class="tablo10">
        <?php
            if (isset($_POST['goster11'])) {      
                $sqlsorgu11 = "SELECT employers.NAME AS AD,employers.SURNAME AS SOYAD,workdays.DAYNAME AS ÇALIŞMA_GÜNÜ,worktime.WORKTYPE 
                AS ÇALIŞMA_STİLİ,covidpatience.HOWMANYCOVID AS KAÇDEFA_COVID_GEÇİRDİ,(worktime.WORKHOUR*workdays.DAYCOUNT*4) 
                AS AYLIKÇALIŞMA_SAATİ, MAX(covidpatience.HOWMANYCOVID)/(worktime.WORKHOUR*workdays.DAYCOUNT*4)AS ÇALIŞMA_SAATİNİN_COVID_GEÇİRMEYE_ORANI  FROM employers
                INNER JOIN worktime ON worktime.WORKTIMEID = employers.WORKTIMEID
                INNER JOIN workdays ON workdays.WORKDAYID = employers.WORKDAYID
                INNER JOIN covidpatience ON covidpatience.IDENTITYNO = employers.IDENTITYNO
                GROUP BY employers.NAME,employers.SURNAME";
                $result11 = mysqli_query($conn, $sqlsorgu11);
                $resultCheck11 = mysqli_num_rows($result11);
                if ($resultCheck11 > 0) {
                    $query11 = array();
                    while($query11[] = mysqli_fetch_assoc($result11));
                        array_pop($query11);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query11[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query11 as $row) {
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
                
                }
            }
        ?>
       </div>
    </div>

    <!--En fazla temasta bulunmuş ilk 3 çalışan listelenebilmelidir.-->
    <div class="tam11">
        <p class="baslik11" >En fazla temasta bulunmuş ilk 3 çalışan listelenebilmelidir</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster12">Göster</button>
        </form>
        <div class="tablo11">
        <?php
            if (isset($_POST['goster12'])) {      
                
                $sqlsorgu12 = "SELECT employers.NAME AS AD,employers.SURNAME AS SOYAD, COUNT(contactemployer.IDENTITYNO) AS TEMASLIETTİĞİHASTASAYISI FROM employers
                INNER JOIN contactemployer ON employers.IDENTITYNO = contactemployer.IDENTITYNO
                GROUP BY contactemployer.IDENTITYNO ORDER BY COUNT(contactemployer.IDENTITYNO) DESC LIMIT 3";
                $result12 = mysqli_query($conn, $sqlsorgu12);
                $resultCheck12 = mysqli_num_rows($result12);
                if ($resultCheck12 > 0) {
                    $query12 = array();
                    while($query12[] = mysqli_fetch_assoc($result12));
                        array_pop($query12);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query12[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query12 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
      </div>
    </div>

    <!-- Biontech ve sinovac aşılarının etkinliği, COVID geçirme süresi göz önüne alınarak kıyaslanabilmelidir.-->
    <div class="tam12">
        <p class="baslik12" >Biontech ve sinovac aşılarının etkinliğinin, COVID geçirme süresi göz önüne alınarak kıyaslanması</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster13">Göster</button>
        </form>
        <div class="tablo12">
        <?php
            if (isset($_POST['goster13'])) {      
                
                $sqlsorgu13 = "SELECT (SELECT CAST(AVG(DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID))AS DECIMAL(3,1)) FROM covidpatience 
                WHERE covidpatience.VACCINEID = 2 AND covidpatience.CATCHCOVID IS NOT NULL AND covidpatience.ENDCOVID IS NOT NULL) 
                AS BIONTECH_ORTALAMA ,(SELECT CAST(AVG(DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID)) AS DECIMAL (3,1)) 
                FROM covidpatience WHERE covidpatience.VACCINEID = 3 AND covidpatience.CATCHCOVID IS NOT NULL AND covidpatience.ENDCOVID IS NOT NULL) 
                AS SINOVAC_ORTALAMA, (SELECT CAST(AVG(DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID)) AS DECIMAL (3,1)) FROM covidpatience 
                WHERE covidpatience.VACCINEID = 1 AND covidpatience.CATCHCOVID IS NOT NULL AND covidpatience.ENDCOVID IS NOT NULL) AS AŞI_OLMAYANLAR_ORTALAMA;";
                $result13 = mysqli_query($conn, $sqlsorgu13);
                $resultCheck13 = mysqli_num_rows($result13);
                if ($resultCheck13 > 0) {
                    $query13 = array();
                    while($query13[] = mysqli_fetch_assoc($result13));
                        array_pop($query13);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query13[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query13 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
      </div>
    </div>


    <!--Haftasonu çalışan kişiler arasında COVID gözükme miktarı.-->
    <div class="tam13">
        <p class="baslik13" >Haftasonu çalışan kişiler arasında COVID gözükme miktarı</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster14">Göster</button>
        </form>
        <div class="tablo13">
        <?php
            if (isset($_POST['goster14'])) {      
                
                $sqlsorgu14 = "SELECT workdays.DAYNAME AS ÇALIŞTIĞI_ZAMAN , COUNT(covidpatience.IDENTITYNO) 
                AS COVID_GEÇİREN_KİŞİ_SAYISI FROM employers
                INNER JOIN covidpatience ON employers.IDENTITYNO = covidpatience.IDENTITYNO
                INNER JOIN workdays ON employers.WORKDAYID = workdays.WORKDAYID
                WHERE workdays.WORKDAYID = 2;";
                $result14 = mysqli_query($conn, $sqlsorgu14);
                $resultCheck14 = mysqli_num_rows($result14);
                if ($resultCheck14 > 0) {
                    $query14 = array();
                    while($query14[] = mysqli_fetch_assoc($result14));
                        array_pop($query14);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query14[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query14 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
      </div>
    </div>

    <!--En sık hasta olan ilk 10 kişinin son bir ay içerisinde COVID’e yakalanma durumları-->
    <div class="tam14">
        <p class="baslik14" >En sık hasta olan ilk 10 kişinin son bir ay içerisinde COVID’e yakalanma durumları</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster15">Göster</button>
        </form>
        <div class="tablo14">
        <?php
            if (isset($_POST['goster15'])) {      
                
                $sqlsorgu15 = "SELECT employers.NAME AS İSİM,employers.SURNAME AS SOYİSİM,COUNT(matchdisease.DISEASEID) 
                AS KAÇ_DEFA_HASTA_OLDUĞU,MAX(covidpatience.HOWMANYCOVID) AS KAÇ_DEFA_COVID_OLDUĞU FROM employers
                INNER JOIN matchdisease ON employers.IDENTITYNO = matchdisease.IDENTITYNO
                INNER JOIN covidpatience ON employers.IDENTITYNO = covidpatience.IDENTITYNO
                WHERE covidpatience.CATCHCOVID BETWEEN '2021-01-31' AND '2021-02-31' 
                GROUP BY employers.NAME, employers.SURNAME ORDER BY COUNT(matchdisease.DISEASEID) DESC LIMIT 10;";
                $result15 = mysqli_query($conn, $sqlsorgu15);
                $resultCheck15 = mysqli_num_rows($result15);
                if ($resultCheck15 > 0) {
                    $query15 = array();
                    while($query15[] = mysqli_fetch_assoc($result15));
                        array_pop($query15);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query15[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query15 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
      </div>
    </div>

    <!--Aşı vurulmayanlar arasında, en uzun süre covıd geçiren kişinin, son 1 yılda geçirmiş olduğu hastalıklar ve verilen reçeteler-->
    <div class="tam15">
        <p class="baslik15" >Aşı vurulmayanlar arasında, en uzun süre covıd geçiren kişinin, son 1 yılda geçirmiş olduğu hastalıklar ve verilen reçeteler</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster16">Göster</button>
        </form>
        <div class="tablo15">
        <?php
            if (isset($_POST['goster16'])) {      
                
                $sqlsorgu16 = "SELECT employers.NAME AS AD,employers.SURNAME AS SOYAD, diseases.DISEASENAME AS HASTALIK_ADI,diseasedrugs.DRUGNAME 
                AS İLAÇ_ADI,match_d_drug.D_DRUGDOSE AS İLAÇ_DOZU FROM employers 
                INNER JOIN matchdisease ON employers.IDENTITYNO=matchdisease.IDENTITYNO 
                INNER JOIN diseases ON matchdisease.DISEASEID = matchdisease.DISEASEID 
                INNER JOIN match_d_drug ON employers.IDENTITYNO = match_d_drug.IDENTITYNO AND match_d_drug.DISEASEID = diseases.DISEASEID
                INNER JOIN diseasedrugs ON match_d_drug.DISEASEDRUGID = diseasedrugs.DISEASEDRUGID 
                INNER JOIN covidpatience ON employers.IDENTITYNO = covidpatience.IDENTITYNO
                INNER JOIN vaccines ON covidpatience.VACCINEID= vaccines.VACCINEID
                WHERE covidpatience.VACCINEID = 1 AND covidpatience.CATCHCOVID BETWEEN '2021-01-01' AND '2021-12-12' 
                AND DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID) = (SELECT MAX(DATEDIFF(covidpatience.ENDCOVID,covidpatience.CATCHCOVID)) 
                FROM covidpatience);";
                $result16 = mysqli_query($conn, $sqlsorgu16);
                $resultCheck16 = mysqli_num_rows($result16);
                if ($resultCheck16 > 0) {
                    $query16 = array();
                    while($query16[] = mysqli_fetch_assoc($result16));
                        array_pop($query16);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query16[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query16 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
      </div>
    </div>


    <div class="tam17">
        <p class="baslik17" >COVID’e yakalananlar arasında görülen en sık karşılaşılan ilk 3 belirti listelenebilmelidir.</p>
        <form action="projeSorgulari-sayfasi.php" method="POST">
            
            <button name="goster17">Göster</button>
        </form>
     <div class="tablo17">
        <?php
            if (isset($_POST['goster17'])) {      
                $sqlsorgu175 = "SELECT COUNT(matchcovidsymptom.COVIDSYMPTOMID) AS KAÇTANE , covidsymptoms.COVIDSYMPTOM AS SEMPTOM FROM matchcovidsymptom
                INNER JOIN covidsymptoms ON matchcovidsymptom.COVIDSYMPTOMID = covidsymptoms.COVIDSYMPTOMID
                GROUP BY matchcovidsymptom.COVIDSYMPTOMID ORDER BY COUNT(matchcovidsymptom.COVIDSYMPTOMID) DESC LIMIT 3;";
                $result17 = mysqli_query($conn, $sqlsorgu175);
                
                $resultCheck17 = mysqli_num_rows($result17);
                if ($resultCheck17 > 0) {
                    $query17 = array();
                    while($query17[] = mysqli_fetch_assoc($result17));
                        array_pop($query17);

                        // SQL koduna göre veritabanı ile entegre tablo oluşturma
                        echo '<div class = "table">';
                        echo '<table border="1">';
                        echo '<tr>';
                    foreach($query17[0] as $key => $value) {
                        echo '<td>';
                        echo $key;
                        echo '</td>';
                    }
                    echo '</tr>';
                    foreach($query17 as $row) {
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
            } //else {
                //header("Location: ../Goruntule-sayfasi.php?signup=veritabanı&tcno=$tcno");
            //}
            }
        ?>
       </div>
    </div>
    
    
    </body>

</html>