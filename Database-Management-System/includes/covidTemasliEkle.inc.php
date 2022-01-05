<?php
    $tcno = $_POST['tcno'];
    $temaslitcno = $_POST['temaslitcno'];
    

    if (empty($tcno) || empty($temaslitcno)) {
        header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidTemasliEkle/covidTemasliEkle-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidTemasliEkle/covidTemasliEkle-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
            exit();
        } else {
            //temaslı tclerini ekleyen SQL kodu lazım
            $sql = "INSERT INTO contactemployer (IDENTITYNO,CONTACTIDENTITYNO) VALUES('$tcno', '$temaslitcno');";
            mysqli_query($conn, $sql);

            header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidTemasliEkle/covidTemasliEkle-sayfasi.php?signup=successtemasli&tcno=$tcno");

        }
    }


    /*foreach ($temaslitcnoarr as $value) {
                $value2 = (int)$value;
                if ((floor(log10($value2) + 1) != 11)) {
                    header("Location: ../covidBilgisiYonet/covidBilgisiEkleme/covidTemasliEkle/covidTemasliEkle-sayfasi.php?signup=temaslitcno&tcno=$tcno&temaslitcno=$temaslitcno");
                    exit();
                }
                //temaslı tclerini ekleyen SQL kodu lazım
                $sql = "INSERT INTO contactemployer(IDENTITYNO,CONTACTIDENTITYNO) VALUES('$tcno', '$temaslitcno');";
                mysqli_query($conn, $sql);
            }*/

?>