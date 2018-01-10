<html>
<head>
  <title>Podsumowanie</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="style2.css" />
</head>
<body>
<form action="game.php" method="post">
<?php
  session_id('myid');
  session_start();
  $player = $_SESSION['player'];
  $level = $_SESSION['level'];
  // Wstęp
  echo '<div class="welcome2">';
  echo "<h3>Podsumowanie</h3>";
  echo '</div>';
?>
<div class="row">
<div class="column1">
<?php // DZIAŁANIA
  $punkty_dod = 0;
  for($i=1; $i<=10; $i++)
  {
    $wynik = $_POST['solution'.$i];
    $odp = $_POST['solution_user'.$i];

    if($wynik == $odp)
    {
      echo "<b>$i. </b>Poprawna odp.<br />";
      $punkty_dod++;
    }
    else
    {
      echo "<b>$i. </b>Niepoprawna odp.<br />";
    }
  }
  echo "<b>Uzyskane punkty: $punkty_dod/10</b><br />";
 ?>
  </div>
  <div class="column2">
<?php // WYRAZY
  $punkty_wyr = 0;
  for($j=1; $j<=10; $j++)
  {
    $popr_odpowiedz = $_POST['answer'.$j];
    $uzyt_odpowiedz = $_POST['answer_user'.$j];
    if($popr_odpowiedz == $uzyt_odpowiedz)
    {
      echo "<b>$j. </b>Poprawny wyraz.<br />";
      $punkty_wyr++;
    }
    else
    {
      echo "<b>$j. </b>Niepoprawny wyraz.<br />";
    }
  }
  echo "<b>Uzyskane punkty: $punkty_wyr/10</b>";
  echo '</div>';
  //POD KOLUMNAMI
  // ŁĄCZNY WYNIK
  echo '<div class="end">';
  $wynik = $punkty_dod + $punkty_wyr;
  echo "<b>Twój wynik: $wynik/20</b><br />";
  echo '<input type="hidden" name="player" value="'.$player.'" />';
  echo '<input type="hidden" name="level" value="'.$level.'" />';
  echo '<input type="submit" id="przycisk" value="Spróbuj ponownie" />';
  // ify
  if($wynik == 0)
  {
    echo "Nie poszło Ci najlepiej, spróbuj ponownie!<br />";
    echo '<img src="https://images.unsplash.com/photo-1423958950820-4f2f1f44e075?auto=format&fit=crop&w=1350&q=80" width="450" height="300">';
  }
  elseif($wynik == 20)
  {
    echo "Zdobyłeś wszystkie możliwe punkty.<br />Jesteś geniuszem!<br />";
    echo '<img src="https://images.unsplash.com/photo-1483748231602-246e5b99359e?auto=format&fit=crop&w=967&q=80" width="450" height="300">';
  }
  elseif($punkty_dod > $punkty_wyr)
  {
    echo "Poradziłeś/łaś sobie lepiej z równaniami matematycznymi.<br />Jesteś umysłem ścisłym!<br />";
    echo '<img src="https://images.unsplash.com/photo-1509228627152-72ae9ae6848d?auto=format&fit=crop&w=1350&q=80" width="450" height="300">';
  }
  elseif($punkty_dod < $punkty_wyr)
  {
    echo "Poradziłeś/łaś sobie lepiej z odszyfrowaniem wyrazów.<br />Jesteś umysłem humanistycznym!<br />";
    echo '<img src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=1350&q=80" width="450" height="300">';
  }
  else
  {
    echo "Jesteś zarówno umysłem ścisłym jak i humanistycznym!<br />";
    echo '<img src="https://images.unsplash.com/photo-1503365070998-37e56a2606e2?auto=format&fit=crop&w=1350&q=80" width="450" height="300">';
  }
  echo '</div>';
 ?>
</form>
</body>
</html>
