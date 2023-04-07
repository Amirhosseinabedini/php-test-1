<?php
//welcome to my test for job application
//amirhosseinabedini.dev@gmail.com
//www.amirabedini.net

//Zuerst schreibe ich den finalen Code in Form einer Funktion (mit der gewünschten Zeitkomplexität : O(n)) : get_time_overlab
//dann schreibe ich den Code mit der Einzelheiten in Form einer Funktion (mit der gewünschten Zeitkomplexität : O(n)) : get_time_overlab_trace
//danach schreibe ich den Code in Form einer Funktion mit foreach (mit der Zeitkomplexität : O(n^2)) : get_time_overlab_2

//Funktion mit der gewünschten Zeitkomplexität  @ Linie 22
//Zuerst definieren wir eine leere Array-Variable, um das Ergebnis zurückzugeben @ Linie 23
//Wir definieren zwei numerische Variablen, um die Zeitintervalle jedes Benutzers zu zählen @ Linie 24
//Wir erstellen eine Schleife, um durch Zeitintervalle zu navigieren @ Linie 25
//Wir konvertieren die Zeitpunkte zum richtigen Vergleich in timestamp @ Linie 26-29
//Wenn sich zwei Intervalle überschneiden, erhalten wir das gemeinsame Intervall der beiden Intervalle und speichern es in der Ergebnisvariablen @ Linie 30
//Bei der richtigen Navigation beider Zeiträume:
//Wenn die erste Periode des ersten Benutzers kürzer ist als die erste Periode des zweiten Benutzers, kann sich die erste Periode des zweiten Benutzers mit anderen Perioden des ersten Benutzers überschneiden.
//Also überprüfen wir den nächsten Zeitraum vom ersten Benutzer mit dem gleichen Zeitraum wie der zweite Benutzer -> i++ @ Linie 35,36
//Anderenfalls :
//Wir prüfen das nächste Zeitintervall vom zweiten Benutzer mit dem gleichen Zeitintervall vom ersten Benutzer ->j++ @ Linie 37,38
//Abschließend geben wir das Ergebnis zurück @ Linie 41
function get_time_overlab(array $user_olinetime_A, array $user_olinetime_B) {
    $result = [];
    $i = $j = 0;
    while ($i < count($user_olinetime_A) && $j < count($user_olinetime_B)) {
        $start_A = strtotime($user_olinetime_A[$i][0]);
        $end_A = strtotime($user_olinetime_A[$i][1]);
        $start_B = strtotime($user_olinetime_B[$j][0]);
        $end_B = strtotime($user_olinetime_B[$j][1]);
        if ($start_A <= $end_B && $start_B <= $end_A) {
            $start = max($start_A, $start_B);
            $end = min($end_A, $end_B);
            $result[] = [date("H:i", $start), date("H:i", $end)];
        }
        if ($end_A < $end_B) {
            $i++;
        } else {
            $j++;
        }
    }
    return $result;
}




//Function mit der Einzelheiten

function get_time_overlab_trace(array $user_olinetime_A, array $user_olinetime_B) {
    $result = [];
    $i = $j = 0;
    while ($i < count($user_olinetime_A) && $j < count($user_olinetime_B)) {
        $start_A = strtotime($user_olinetime_A[$i][0]);
        $end_A = strtotime($user_olinetime_A[$i][1]);
        $start_B = strtotime($user_olinetime_B[$j][0]);
        $end_B = strtotime($user_olinetime_B[$j][1]);
        echo "start_A : " . $user_olinetime_A[$i][0] . "<Br>";
        echo "end_A : " . $user_olinetime_A[$i][1] . "<Br>";
        echo "start_B : " . $user_olinetime_B[$j][0] . "<Br>";
        echo "end_B : " . $user_olinetime_B[$j][1] . "<Br>";
        echo $user_olinetime_A[$i][0] . " <= " . $user_olinetime_B[$j][1] ."&&". $user_olinetime_B[$j][0] ." <= ". $user_olinetime_A[$i][1] . "<Br>". ($start_A <= $end_B && $start_B <= $end_A) . "<Br>";
        if ($start_A <= $end_B && $start_B <= $end_A) {
            $start = max($start_A, $start_B);
            $end = min($end_A, $end_B);
            $result[] = [date("H:i", $start), date("H:i", $end)];
            var_dump(date("H:i", $start), date("H:i", $end));
        }
        echo $user_olinetime_A[$i][1] ." < ".$user_olinetime_B[$j][1] . ($end_A < $end_B) . "<Br>";
        if ($end_A < $end_B) {
            $i++;
            echo "i++ <hr>";
        } else {
            $j++;
            echo "j++ <hr>";
        }
    }
    return $result;
}


//Funktion mit foreach
function get_time_overlab_2($user_olinetime_A, $user_olinetime_B)
{
    $result = array();
    foreach ($user_olinetime_A as $value_A) {
        foreach ($user_olinetime_B as $value_B) {
            $start = max([strtotime($value_A[0]), strtotime($value_B[0])]);
            $end = min([strtotime($value_A[1]), strtotime($value_B[1])]);
                if ($start <= $end
                ) {
                    $result[] = array(date("H:i", $start),date("H:i", $end));
                }
        }
    }
    return $result;
}
$user_olinetime_A = [['8:30', '12:00'] , ['17:00', '22:00']];
$user_olinetime_B = [['5:00', '11:15'] , ['14:25', '20:05']];

//Zur Überprüfung ist es besser, mit Eingängen mit unterschiedlicher Anzahl von Zeitintervallen zu experimentieren
// $user_olinetime_A = [['8:30', '12:00'] , ['17:00', '22:00']];
// $user_olinetime_B = [['5:00', '11:15'] , ['14:25', '20:05'], ['21:25', '23:00']];


$result = get_time_overlab($user_olinetime_A, $user_olinetime_B);
var_dump($result);
?>