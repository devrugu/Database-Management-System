<?php
    session_start();
?>

<?php
    $tcno = $_POST['tcno'];
    $_SESSION['tcno'] = $tcno;
    $_SESSION['tcno2'] = $tcno;

    if (empty($tcno)) {
        header("Location: ../calisanlariYonet/calisanlariGoruntule/Goruntule-sayfasi.php?signup=tcnobosgoruntuleme&tcno=$tcno");
    } else {
        if ((floor(log10($tcno) + 1) != 11)) {
            header("Location: ../calisanlariYonet/calisanlariGoruntule/Goruntule-sayfasi.php?signup=tcnouzunlukgoruntuleme&tcno=$tcno");
        } else {
            
            $sql = "SELECT IDENTITYNO,NAME,SURNAME,HOBBY,EDUCATIONNAME,POSITIONNAME, CITYNAME, DAYNAME, WORKTYPE,worktime.WORKHOUR AS WORKHOUR, BLOODNAME FROM employers,educations,workdays,bloodgroups,positions,worktime,cities WHERE educations.EDUCATIONID = employers.EDUCATIONID and CITIES.CITYID = employers.CITYID AND workdays.WORKDAYID = employers.WORKDAYID AND worktime.WORKTIMEID = employers.WORKTIMEID AND bloodgroups.BLOODID = employers.BLOODID AND positions.POSITIONID = employers.POSITIONID AND employers.IDENTITYNO = '$tcno';";
            $_SESSION['sql'] = $sql;

            header("Location: ../calisanlariYonet/calisanlariGoruntule/GuncelleSilTablo/guncelleSil-sayfasi.php");
        }
    }
?>