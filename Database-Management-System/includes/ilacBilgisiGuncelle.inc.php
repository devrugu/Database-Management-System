<?php 
    $tcno = $_POST['tcno'];
    $hastalik = $_POST['hastalik'];
    $guncelilac = $_POST['guncelilac'];
    $yeniilac = $_POST['yeniilac'];
    $doz = $_POST['doz'];



    if (empty($tcno) || empty($hastalik) || empty($guncelilac) || empty($yeniilac) || empty($doz)) {
        header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=tcnouzunlukguncelle&tcno=$tcno");
            exit();
        } else {
            $sql = "UPDATE match_d_drug SET match_d_drug.DISEASEDRUGID = '$yeniilac',match_d_drug.D_DRUGDOSE = '$doz' WHERE match_d_drug.IDENTITYNO = '$tcno' AND match_d_drug.DISEASEID = '$hastalik' AND match_d_drug.DISEASEDRUGID = '$guncelilac';";
            mysqli_query($conn, $sql);

            header("Location: ../hastalikBilgisiYonet/hastalikBilgisiGoruntule/hastalikGuncelleSil/hastalikGuncelleSil-sayfasi.php?signup=successilac&tcno=$tcno");
            exit(); 
        }
    }
?>