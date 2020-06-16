<?php
function get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
}
$var=json_decode(get("https://api.quran.sutanlab.id/surah/"),true);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Qur'an</title>
    <meta name="description" content="Qur'an">
    <meta name="keywords" content="qur'an">
    <meta name="author" content="Billy">
    <meta name="theme-color" content="aqua"/>
    <meta name="msapplication-navbutton-color" content="aqua"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="aqua"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
    .card:hover {
        box-shadow: 0px 2px 20px rgba(0,0,0,0.2);
    }
    </style>
  </head>
  <body class="container">
    <h1 class="text-center mt-5"> <i>Qur'an online</i> </h1>
    <div class="row row-cols-1 row-cols-md-3 mt-5">
      <?php
      for ($i=0;$i<count($var['data']);$i++) {
      ?>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><a href="baca.php?surat=<?php echo $var['data'][$i]['number']; ?>" class="text-dark"><?php echo $var['data'][$i]['name'] ?></a></h4>
            <h5 class="card-title"><a href="baca.php?surat=<?php echo $var['data'][$i]['number']; ?>"><?php echo $var["data"][$i]['englishName'] ?></a></h5>
            <p class="text-muted">
              Diturunkan di: <strong><?php echo $var['data'][$i]['idRevelationType']; ?>.</strong>
              <br>
              Artinya: <strong><?php echo $var['data'][$i]['idNameTranslation'] ?>.</strong>
              <br>
              Jumlah ayat: <strong><?php echo $var['data'][$i]['numberOfAyahs'] ?>.</strong>
            </p>
          </div>
        </div>
      </div>
      <?php
      }
       ?>
    </div>
    <br><br>
    <footer>
      <p class="text-center text-muted">Docs api: <a target="_blank" href="https://api.quran.sutanlab.id/">api.quran.sutanlab.id</a></p>
    </footer>
    <br><br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
