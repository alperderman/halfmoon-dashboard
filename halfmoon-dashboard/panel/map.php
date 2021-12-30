<?php
$uas=require('../uas/controller.php');
$username = $uas->confirmSession([
  'fail'=>function($username){
    exit(header('Location: '.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].'/halfmoon-dashboard/login.html'));
  }
]);

$checkRank = $uas->checkRank([
    'username'=>$username,
    'ranks'=>'admin',
    'success'=>function(){
        //$rank = "Administrator";
    }
]);
if ($checkRank) {
    $rank = "Administrator";
}else {
    $rank = "Normal User";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/halfmoon-dashboard/" />
    <title>Dashboard | Map</title>
  </head>
  <body style="display:none;">

    <div dcg-obj="credentials" dcg-json>
      {
        "username": "<?php echo $username;?>",
        "type": "<?php echo $rank;?>"
      }
    </div>

    <script src="assets/js/dcg.js"></script>
    <script>
      document.body.style.display = "none";
      dcg.render({
        designSrc: "layouts/map.html",
        options: {
          cacheRender: false,
          removeCss: true,
          showLogs: true
        },
        after: function() {
          document.body.style.display = "block";
        }
      });
    </script>
  </body>
</html>