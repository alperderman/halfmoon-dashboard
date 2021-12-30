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
    <title>Dashboard | Home</title>
  </head>
  <body style="display:none;">

    <div dcg-obj="credentials" dcg-json>
      {
        "username": "<?php echo $username;?>",
        "type": "<?php echo $rank;?>"
      }
    </div>

    <div dcg-obj="stats" dcg-json>
      [
        {"type": "inc", "title": "Budget", "value": "750,90$", "perc": "30"},
        {"type": "dec", "title": "Total Hours", "value": "1400", "perc": "5"},
        {"type": "inc", "title": "Work Load", "value": "87%", "perc": "10"},
        {"type": "inc", "title": "New projects", "value": "155", "perc": "17"}
      ]
    </div>

    <script src="assets/js/dcg.js"></script>
    <script>
      document.body.style.display = "none";
      dcg.render({
        designSrc: "layouts/index.html",
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