<html>
<head>
  <title>Gra</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<form action="result.php" method="post">
<?php
  session_start();
  session_id('myid');

  $_SESSION['player'] = $_POST['player'];
  $_SESSION['level'] = $_POST['level'];
  $player = $_SESSION['player'];
  $level = $_SESSION['level'];

  $levelToWords = array("Łatwy" => array('bank', 'obiad', 'krzyk', 'mysz', 'blok', 'rozum', 'wino', 'orzeł', 'kruk', 'arena'
  , 'przerwa', 'debata', 'występ', 'sobota', 'sejf', 'kraj', 'bomba', 'pożar', 'wiek', 'pająk'),
  "Średni" => array('choinka', 'telefon', 'podłoga', 'kraina', 'portfel', 'osiedle', 'szparag', 'spinacz', 'rodowód', 'optymista'
  , 'dochód', 'jabłko', 'dziennik', 'ekologia', 'geodeta', 'import', 'jogurt', 'szarlotka', 'prezent', 'prestiż'),
  "Trudny" => array('abażur', 'darowizna', 'gwizdek', 'dobrobyt', 'jaskółka', 'blondynka', 'edukacja', 'niespodzianka', 'czekolada', 'rewolwer'
  , 'gżegżółka', 'słownik', 'optymista', 'trywialny', 'jubileusz', 'poczęstunek', 'zgiełk', 'włóczęga', 'przekaźnik', 'korelacja'));
  // Wstęp
  echo '<div class="welcome">';
  echo "<h3>Witaj w grze ".htmlspecialchars($player).".</h3>";
  echo "<h4>Wybrany przez Ciebie poziom trudności to: <i>".htmlspecialchars($level)."</i> powodzenia!</h4><br />";
  echo '</div>';

  // funkcja mieszania liter, bo str_shuffle źle miesza wyrazy z polskimi literami
  function shuffleString($stringValue, $startWith = "") {
    $range = \range(0, \mb_strlen($stringValue));
    shuffle($range);
    foreach($range as $index) {
        $startWith .= \mb_substr($stringValue, $index, 1);
    }
    return $startWith;
  };
  echo "<h4><center>Maksymalna ilość punktów do zdobycia: 20</center></h4>";
  // WYGLAD
  echo '<div class="row">';
  echo '<div class="column1">';
  // DODWANIE
  for($i=1; $i<= 10; $i++)
  {
    $los = rand(1,3);
    if($level == "Łatwy")
    {
      $a = rand(1,10);
      $b = rand(1,10);
    }
    if($level == "Średni")
    {
      $a = rand(1,50);
      $b = rand(1,50);
    }
    if($level == "Trudny")
    {
      $a = rand(10,100);
      $b = rand(10,100);
    }
    switch ($los) {
      case 1: // DODWANIE
          $popr_wynik = $a + $b;
          echo "<br /><b>$i. </b>$a + $b = ";
        break;
      case 2: // ODEJMOWANIE
          $popr_wynik = $a - $b;
          echo "<br /><b>$i. </b>$a - $b = ";
        break;
      case 3: // MNOŻENIE
          $popr_wynik = $a * $b;
          echo "<br /><b>$i. </b>$a * $b = ";
        break;
    }
    echo '<input type="hidden" name="solution'.$i.'" value="'.$popr_wynik.'" />';
    echo '<input type="number" name="solution_user'.$i.'" min="-200" max="10000" maxsize="6" />';
  }
  echo '</div>'; // zamyka column1
  echo '<div class="column2">';
  // WYRAZY
  $words = $levelToWords[$level];
  $i = 1;
  foreach (array_rand($words, 10) as $index) {
      $wartosc = shuffleString($words[$index]);
      $dl = mb_strlen($wartosc, "UTF-8");
      echo "<br /><b>$i. </b>$wartosc";
      echo '<input type="hidden" name="answer'.$i.'" value="'.$words[$index].'"/>';
      echo '<label>';
      echo '<input type="text" name="answer_user'.$i.'" pattern="[a-ząćęłńóśźż]{0,'.$dl.'}" title="Należy wprowadzić tylko litery." style="margin-left:10px"/>';
      echo '</label>';
      $i++;
      // mb_strlen > strlen
  }
  echo '</div>'; //zamyka column2
  echo '</div>'; //zamyka row
  // POD KOLUMNAMI
  echo "<br />";
  echo '<hr color="#9eabb3"/>';
  echo '<input type="submit" value="Oceń" id="przycisk" />';
 ?>
</form>
</body>
</html>
