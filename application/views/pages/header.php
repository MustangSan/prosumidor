<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <?php $base = $this->config->item('base_url'); ?>

  


  
        <!-- Hammer reload -->
          <script>
            setInterval(function(){
              try {
                if(typeof ws != 'undefined' && ws.readyState == 1){return true;}
                ws = new WebSocket('ws://'+(location.host || 'localhost').split(':')[0]+':35353')
                ws.onopen = function(){ws.onclose = function(){document.location.reload()}}
                ws.onmessage = function(){
                  var links = document.getElementsByTagName('link'); 
                    for (var i = 0; i < links.length;i++) { 
                    var link = links[i]; 
                    if (link.rel === 'stylesheet' && !link.href.match(/typekit/)) { 
                      href = link.href.replace(/((&|\?)hammer=)[^&]+/,''); 
                      link.href = href + (href.indexOf('?')>=0?'&':'?') + 'hammer='+(new Date().valueOf());
                    }
                  }
                }
              }catch(e){}
            }, 1000)
          </script>
        <!-- /Hammer reload -->
      

  <link rel='stylesheet' href='<?php echo $base; ?>assets/css/fullcalendar.css'>
  <link rel='stylesheet' href='<?php echo $base; ?>assets/css/datatables/datatables.css'>
  <link rel='stylesheet' href='<?php echo $base; ?>assets/css/datatables/bootstrap.datatables.css'>
  <link rel='stylesheet' href='<?php echo $base; ?>assets/scss/chosen.css'>
  <link rel='stylesheet' href='<?php echo $base; ?>assets/scss/font-awesome/font-awesome.css'>
  <link rel='stylesheet' href='<?php echo $base; ?>assets/css/app.css'>
  <link rel='stylesheet' href='<?php echo $base; ?>assets/css/datepicker.css'>

  <link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

  <link href="<?php echo $base; ?>assets/favicon.ico" rel="shortcut icon">
  <link href="<?php echo $base; ?>assets/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    @javascript html5shiv respond.min
  <![endif]-->

  <title>Prosumidor</title>

</head>

<body>