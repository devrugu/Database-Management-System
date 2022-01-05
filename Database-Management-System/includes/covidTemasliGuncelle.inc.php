<?php
    $tcno = $_POST['tcno'];
    $eskitemaslitcno = $_POST['eskitemaslitcno'];
    $yenitemaslitcno = $_POST['yenitemaslitcno'];
    
    if (empty($tcno) || $eskitemaslitcno == "default" || $yenitemaslitcno == "default") {
        header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=empty&tcno=$tcno");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=tcnouzunluk&tcno=$tcno");
            exit();
        } else {
            //covid temaslı güncelleme SQL kodu gelecek

            $sql = "UPDATE contactemployer SET contactemployer.CONTACTIDENTITYNO = '$yenitemaslitcno' WHERE contactemployer.CONTACTIDENTITYNO = '$eskitemaslitcno' AND contactemployer.IDENTITYNO = '$tcno';";
            mysqli_query($conn,$sql);

           

            

            header("Location: ../covidBilgisiYonet/covidBilgisiGoruntule/covidGuncelleSil/covidGuncelleSil-sayfasi.php?signup=successcovidtemasli&tcno=$tcno");
            exit();
        }
    }

?>