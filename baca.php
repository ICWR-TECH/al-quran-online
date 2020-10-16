<?php
error_reporting(0);
include("config.php");
function get($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
}
if(!$_GET['surat']){
  header("location:index.php");
}
$var=json_decode(get("https://api.quran.sutanlab.id/surah/".$_GET['surat']),true);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <?php if ($var['code']==404): ?>
      <?php header("HTTP/1.0 404 Not Found"); ?>
      <title>404 page not found</title>
    <?php endif; ?>
    <style>
        .responsive{
          max-width:100%;
        }
    </style>
    <?php if($var['code']!==404){ ?>
    <meta property="og:type" content="Al-qur'an digital" />
    <meta property="og:title" content="Surat || <?php echo $var['data']['name']['transliteration']['id'] ?>" />
    <meta property="og:description" content="<?php echo $var['data']['tafsir']['id'] ?>" />
    <meta property="og:url" content="<?php $site; ?>/baca.php?surat=<?php echo htmlentities($_GET['surat']) ?>" />
    <meta property="og:image" content="logo.png" />
    <meta name="theme-color" content="aqua"/>
    <meta name="msapplication-navbutton-color" content="aqua"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="aqua"/>
    <?php }else{ ?>
    <meta property="og:type" content="Al-qur'an digital" />
    <meta property="og:title" content="404 Page Not Found" />
    <meta property="og:description" content="404 Page Not Found" />
    <meta property="og:url" content="<?php $site; ?>/baca.php?surat=<?php echo htmlentities($_GET['surat']) ?>" />
    <meta property="og:image" content="logo.png" />
    <meta name="theme-color" content="aqua"/>
    <meta name="msapplication-navbutton-color" content="aqua"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="aqua"/>
    <?php } ?>
    <title>Surat | <?php echo $var['data']['name']['transliteration']['id']; ?></title>
  </head>
  <body class="container">
    <?php if ($var['code']==404){ ?>
      <h2 class="mt-5 text-center"><i><strong>404 page not found</strong></i></h1>
      <p class="text-center mt-3"><a href="index.php">Kembali ke halaman awal</a></p>
    <?php }else{ ?>
      <h1 class="display-4 mt-5 text-right"><?php echo $var['data']['name']['short'] ?></h1>
      <hr class="my-4">
      <div class="card">
        <div class="card-body">
          <h1 class="display-4 text-center"><?php echo $var['data']['name']['transliteration']['id'] ?></h1>
          <p class="text-muted">
            Arti surat: <strong><?php echo $var['data']['name']['translation']['id'] ?>.</strong>
            <br>
            Diturunkan di: <strong><?php echo $var['data']['revelation']['id'] ?>.</strong>
            <br>
            Jumlah ayat: <strong><?php echo $var['data']['numberOfVerses'] ?>.</strong>
            <br><br>
            Tafsir: <strong><?php echo $var['data']['tafsir']['id'] ?></strong>
          </p>
        </div>
      </div>
      <br>
      <p>
        <a href="index.php" class="btn btn-primary">Kembali ke halaman awal</a>
        <!-- <pre> -->
        <table class="table table-bordered table-hover mt-4">
          <thead>
            <tr>
              <th width="20px">No</th>
              <th width="150px">Arti(ID)</th>
              <th>Ayat</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=1;
          for ($i=0; $i < count($var['data']['verses']); $i++) {
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td style="width:10px">
              <strong>Artinya: </strong><?php echo $var['data']['verses'][$i]['translation']['id'] ?>
            </td>
            <td>
              <p class="text-right">
                <?php echo $var['data']['verses'][$i]["text"]['arab'] ?>
                <br><br>
                <strong>Latin: </strong> <?php echo $var['data']['verses'][$i]['text']['transliteration']['en'] ?>
                <br>
              </p>
              <audio class="responsive" controls>
                <source src="<?php echo $var['data']['verses'][$i]['audio']['primary'] ?>" type="audio/mpeg" >
              </audio>
            </td>
          </tr>
          <?php
          }
           ?>
         </tbody>
        </table>
        <!-- </pre> -->
      </p>
    <?php } ?>
    <br>
    <a href="index.php" class="btn btn-primary col-12">Kembali ke halaman awal</a>
    <?php if($_GET['surat']>113 || $var['code']==404){ ?>

    <?php }else{ ?>
      <a href="baca.php?surat=<?php echo htmlentities($_GET['surat'])+1; ?>" class="btn btn-success col-12 mt-3">Baca Surah selanjutnya...</a>
    <?php } ?>
    <br><br><br><br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
