<?php 
    $tcno = $_POST['tcno'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $bg = $_POST['bg'];
    $sehirler = $_POST['sehirler'];
    $positions = $_POST['positions'];
    $calismagunu = $_POST['calismagunu'];
    $hobby = $_POST['hobby'];
    $ogrenimDurumu = $_POST['ogrenimDurumu'];
    $calismaSekli = $_POST['calismaSekli'];

    if (empty($tcno) || empty($firstname) || empty($lastname) || 
        $bg=="default" || $sehirler==0 || $positions==0 || empty($hobby) || 
        $ogrenimDurumu=="default" || $calismaSekli=="default") {
        
        header("Location: ../calisanlariYonet/calisanEkle/ekleSayfasi.php?signup=empty&tcno=$tcno&firstname=$firstname&lastname=$lastname&bg=$bg&sehirler=$sehirler&positions=$positions&hobby=$hobby&ogrenimDurumu=$ogrenimDurumu&calismaSekli=$calismaSekli&calismagunu=$calismagunu");
        exit();
    } else {
        if (!preg_match("/[0-9]/", $tcno)) {

            header("Location: ../calisanlariYonet/calisanEkle/ekleSayfasi.php?signup=tcnokarakter&tcno=$tcno&firstname=$firstname&lastname=$lastname&bg=$bg&sehirler=$sehirler&positions=$positions&hobby=$hobby&ogrenimDurumu=$ogrenimDurumu&calismaSekli=$calismaSekli&calismagunu=$calismagunu");
            exit();
        } else {
            if ((floor(log10($tcno) + 1) != 11)) {
                header("Location: ../calisanlariYonet/calisanEkle/ekleSayfasi.php?signup=tcnouzunluk&tcno=$tcno&firstname=$firstname&lastname=$lastname&bg=$bg&sehirler=$sehirler&positions=$positions&hobby=$hobby&ogrenimDurumu=$ogrenimDurumu&calismaSekli=$calismaSekli&calismagunu=$calismagunu");
                exit();
            } else {
                if ($sehirler == 0) {
                    header("Location: ../calisanlariYonet/calisanEkle/ekleSayfasi.php?signup=sehirler&tcno=$tcno&firstname=$firstname&lastname=$lastname&bg=$bg&sehirler=$sehirler&positions=$positions&hobby=$hobby&ogrenimDurumu=$ogrenimDurumu&calismaSekli=$calismaSekli&calismagunu=$calismagunu");
                    exit();
                } else {
                    if ($positions == 0) {
                        header("Location: ../calisanlariYonet/calisanEkle/ekleSayfasi.php?signup=positions&tcno=$tcno&firstname=$firstname&lastname=$lastname&bg=$bg&sehirler=$sehirler&positions=$positions&hobby=$hobby&ogrenimDurumu=$ogrenimDurumu&calismaSekli=$calismaSekli&calismagunu=$calismagunu");
                         exit();
                    } else {
                        if ($calismagunu == 'default') {
                            header("Location: ../calisanlariYonet/calisanEkle/ekleSayfasi.php?signup=calismagunu&tcno=$tcno&firstname=$firstname&lastname=$lastname&bg=$bg&sehirler=$sehirler&positions=$positions&hobby=$hobby&ogrenimDurumu=$ogrenimDurumu&calismaSekli=$calismaSekli&calismagunu=$calismagunu");
                             exit(); 
                        } else {
                            $sql = "INSERT INTO employers (IDENTITYNO, NAME, SURNAME, BLOODID, CITYID, POSITIONID, HOBBY, EDUCATIONID, WORKTIMEID, WORKDAYID) VALUES ('$tcno','$firstname','$lastname','$bg','$sehirler','$positions','$hobby','$ogrenimDurumu','$calismaSekli', '$calismagunu');";
                            mysqli_query($conn, $sql);
                    
                            header("Location: ../calisanlariYonet/calisanEkle/ekleSayfasi.php?signup=successekleme");
                        }
                    
                    }


                }
            }
        }
    }
?>