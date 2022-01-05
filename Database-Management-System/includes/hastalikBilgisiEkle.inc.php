<?php
    $tcno = $_POST['tcno'];
    $kronik = $_POST['kronik'];
    $hastaliklar = $_POST['hastaliklar'];
    $semptomlar = $_POST['semptomlar'];
    $hastatarih = $_POST['hastatarih'];


    $datahastalik = 0;
    $datatarih = 0;

    if (empty($tcno) || $kronik=="default" || $hastaliklar=="default" || 
        empty($semptomlar) || empty($hastatarih)) {
        
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if (!preg_match("/[0-9]/", $tcno)) {

            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=tcnokarakter&tcno=$tcno");
            exit();
        } else {
            if ((floor(log10($tcno) + 1) != 11)) {
                header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
                exit();
            } else {
                $sql = "INSERT INTO matchdisease (IDENTITYNO, DISEASEID, DISEASEDATE, CHRONICSTATUS) VALUES ($tcno, $hastaliklar, '$hastatarih', $kronik);";
                mysqli_query($conn, $sql);

                foreach ($semptomlar as $value) {
                    $sql = "INSERT INTO match_d_symptom (IDENTITYNO, DISEASESYMPTOMID, DISEASEID) VALUES ($tcno, $value, $hastaliklar);";
                    mysqli_query($conn, $sql);
                }

                header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=successekleme&tcno=$tcno");
            }
        }
    }

    









    /*if ($hastaliklar = "default") {
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=hastalikbos&tcno=$tcno&ilacdoz=$ilacdoz");
        exit();
    } else {
        if (empty($hastatarih)) {
            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=hastatarihbos&tcno=$tcno&ilacdoz=$ilacdoz");
            exit();
        } else {
            if ($kronik == "default") {
                header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=kronikbos&tcno=$tcno&ilacdoz=$ilacdoz");
                exit();
            } else {
                if (empty($semptomlar)) {
                    header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=semptombos&tcno=$tcno&ilacdoz=$ilacdoz");
                    exit();
                } else {
                    if ($covid == "default") {
                        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=covidbos&tcno=$tcno&ilacdoz=$ilacdoz");
                        exit();
                    } else {


                    }
                }
            }
        }
    }*/


    //ilaç kısmı
    /*if ($ilac == "default") {
        //devam et (ahmete sor -->ilaç seçmeden devam edilebiliyor mu? şimdilik devam edilebiliyor yapıldı)
    } else {
        if (empty($ilacdoz)) {
            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=ilacdozbos&tcno=$tcno&ilacdoz=$ilacdoz");
            exit();
        } else {
            $sql = "INSERT INTO match_d_drug (IDENTITYNO, DISEASEDRUGID) VALUES ($tcno, $ilac);";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO match_c_drug (IDENTITYNO, CHRONICDRUGID) VALUES ($tcno, $ilac);";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO healthstatus (DRUGDOSE) VALUES ($ilacdoz);";
            mysqli_query($conn, $sql);
        }
    }*/





    //kronik sorgusu
    /*if ($kronik == 1) {
        //kroniğe ekle


        foreach ($semptomlar as $value) {
            $sql = "INSERT INTO match_c_symptom (IDENTITYNO, CHRONICSYMPTOMID) VALUES ($tcno, $value);";
            mysqli_query($conn, $sql);
        }
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=successekleme");
    
    } elseif ($kronik == 0) {
        //akuta ekle
        $sql = "INSERT INTO matchdisease (IDENTITYNO, DISEASEID) VALUES ($tcno, $hastaliklar);";
        mysqli_query($conn, $sql);

        $sql = "INSERT INTO healthstatus (DISEASEDATE, IDENTITYNO, COVIDSTATUS) VALUES ($hastatarih, $tcno, $covid);";
        mysqli_query($conn, $sql);

        foreach ($semptomlar as $value) {
            $sql = "INSERT INTO match_d_symptom (IDENTITYNO, DISEASESYMPTOMID) VALUES ($tcno, $value);";
            mysqli_query($conn, $sql);
        }
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiEkleme/hastalikBilgisiEkle-sayfasi.php?signup=successekleme");
    }*/
?>