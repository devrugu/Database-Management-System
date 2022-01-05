<?php 
    $tcno = $_POST['tcno'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $bg = $_POST['bg'];
    $sehirler = $_POST['sehirler'];
    $positions = $_POST['positions'];
    $hobby = $_POST['hobby'];
    $ogrenimDurumu = $_POST['ogrenimDurumu'];
    $calismaSekli = $_POST['calismaSekli'];
    $calismagunu = $_POST['calismagunu'];

    if (empty($tcno)) {
        header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/guncelleSil-sayfasi.php?signup=tcnobosguncelle");
        exit();
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/guncelleSil-sayfasi.php?signup=tcnouzunlukguncelle");
            exit();
        } else {
                $sql = "UPDATE employers SET IDENTITYNO = '$tcno' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            if (empty($firstname)) {
                //goto lastname;
            } else {
                $sql = "UPDATE employers SET NAME = '$firstname' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //lastname:
            if (empty($lastname)) {
                //goto bg;
            } else {
                $sql = "UPDATE employers SET SURNAME = '$lastname' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //bg:
            if ($bg == "default") {
                //goto sehirler;
            } else {
                $sql = "UPDATE employers SET BLOODID = '$bg' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //sehirler:
            if ($sehirler == "default") {
                //goto positions;
            } else {
                $sql = "UPDATE employers SET CITYID = '$sehirler' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //positions:
            if ($positions == "default") {
                //goto salary;
            } else {
                $sql = "UPDATE employers SET POSITIONID = '$positions' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //salary:
            /*if (empty($salary)) {
                //goto hobby;
            } else {
                if ($salary > 100000 || $salary < 0) {
                    header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/guncelleSil-sayfasi.php?signup=salarymaxmin&tcno=$tcno&firstname=$firstname&lastname=$lastname&bg=$bg&sehirler=$sehirler&positions=$positions&salary=$salary&hobby=$hobby&ogrenimDurumu=$ogrenimDurumu&calismaSekli=$calismaSekli");
                    exit();
                } else {
                    $sql = "UPDATE employers SET salary = '$salary' WHERE tc_kimlik_no = '$tcno';";
                    mysqli_query($conn, $sql);
                }
            }*/
            //hobby:
            if (empty($hobby)) {
                //goto ogrenimDurumu;
            } else {
                $sql = "UPDATE employers SET HOBBY = '$hobby' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //ogrenimDurumu:
            if ($ogrenimDurumu == "default") {
                //goto calismaSekli;
            } else {
                $sql = "UPDATE employers SET EDUCATIONID = '$ogrenimDurumu' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //calismaSekli:
            if ($calismaSekli == "default") {
                //goto success;
            } else {
                $sql = "UPDATE employers SET WORKTIMEID = '$calismaSekli' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            if ($calismagunu == "default") {
                //goto success;
            } else {
                $sql = "UPDATE employers SET WORKDAYID = '$calismagunu' WHERE IDENTITYNO = '$tcno';";
                mysqli_query($conn, $sql);
            }
            //success:
            //update basarili
            header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/GuncelleSil-sayfasi.php?signup=successguncelleme&tcno=$tcno&hobby=$hobby");
        }
    }
?>