<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Web Verify</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<style>
		.thumbnailclear {
		  display: inline-block;
		  display: block;
		  height: auto;
		  max-width: 100%;
		  padding: 4px;
		  line-height: 1.428571429;
		  background-color: #ffffff;
		  -webkit-transition: all 0.2s ease-in-out;
				  transition: all 0.2s ease-in-out;
		}

		.thumbnailclear > img {
		  display: block;
		  height: auto;
		  max-width: 100%;
		  margin-right: auto;
		  margin-left: auto;
		}

		a.thumbnailclear:hover,
		a.thumbnailclear:focus,
		a.thumbnailclear.active {
		  opacity: 0.6;
		}
		
		.navbar-brand-img {
		  height: 50px;
		  margin: 0px 10px;
		  -webkit-transition: all 0.2s ease-in-out;
				  transition: all 0.2s ease-in-out;
		}
		
		.navbar-brand-img:hover,
		.navbar-brand-img:focus,
		.navbar-brand-img.active {
		  opacity: 0.5;
		}
		
		.btn-primary {
		  color: #ffffff;
		  background-color: #BC0200;
		  border-color: #920100;
		}

		.btn-primary:hover,
		.btn-primary:focus,
		.btn-primary:active,
		.btn-primary.active,
		.open .dropdown-toggle.btn-primary {
		  color: #ffffff;
		  background-color: #920100;
		  border-color: #680100;
		}
	</style>
<!--
            ,:/+/-                      
            /M/              .,-=;//;-  
       .:/= ;MH/,    ,=/+%$XH@MM#@:     
      -$KB@+$KB#@H@MMMKBKBKB#H:.    -/H#
 .,H@H@ XKBKBKB@ -HKBKB#@+-     -+HKB#@X
  .,@KBH;      +XMKBM/,     =%@KB#@X;-  
X%-  :MKBKBKBKBKB$.    .:%MKB#@%:       
MKBH,   +H@@@$/-.  ,;$MKB#@%,          -
MKBKBM=,,---,.-%%HKBKBM$:          ,+@KB
@KBKBKBKBKBKBKBKBKB@/.         :%HKB@$- 
MKBKBKBKBKBKBKB#H,         ;HMKBM$=     
KBKBKBKBKBKBKBKB#.    .=$MKBM$=         
KBKBKBKBKBKBKBKBH..;XMKBM$=          .:+
MKBKBKBKBKBKBKBKBKB#@%=           =+@MH%
@KBKBKBKBKBKBKBKBM/.          =+H#X%=   
=+MKBKBKBKBKBKBKBM,       -/X#X+;.      
  .;XMKBKBKBKBKBH=    ,/X#H+:,          
     .=+HMKBKBKBM+/+HM@+=.              
         ,:/%XMKBKBH/.                  
              ,.:=-.                    
-->
</head>
<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<br>
			<h3>Web Services Verification Tool</h3>
			<p>
				Lorem ipsum dolor sit amet. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.
			</p>
			<br>
			<?php
			// 1. Grab information about visitor
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
				$EXT_IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
				$proxy = $_SERVER["REMOTE_ADDR"];
				$host = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
			} else {
				$EXT_IP = $_SERVER["REMOTE_ADDR"];
				$host = @gethostbyaddr($_SERVER["REMOTE_ADDR"]);
			} ?>
			<ul>
			<?php
				// 2. Check if visitor's source IP is within specified subnet(s)
				// source code here: https://gist.github.com/tott/7684443
				function ip_in_range( $ip, $range ) {
					if ( strpos( $range, '/' ) == false ) {
						$range .= '/32';
					}
					list( $range, $netmask ) = explode( '/', $range, 2 );
					$range_decimal = ip2long( $range );
					$ip_decimal = ip2long( $ip );
					$wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
					$netmask_decimal = ~ $wildcard_decimal;
					return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
				}
				// Set acceptable IP range here:
				$on_currect_platform = ip_in_range($EXT_IP,"209.165.134.0/24");
				// 3. Display visitor's source IP, show error if out of subnet
				echo '<li><strong>External IP:</strong> <span>'.$EXT_IP.'</span>&nbsp;&nbsp;';
					if (empty($on_currect_platform)) {
						echo '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span><span class="text-danger"><em> IP is not an acceptable address - check your connection</em></span></li>';
					} else {
						echo '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span></li>';
					}
				//
				// Uncomment this line to demo port checking:
				//$_SERVER["REMOTE_PORT"] = "80";
				//
				// 4. Display visitor's source port, show error if matching unwanted port
				echo '<li><strong>External Port:</strong> <span>'.$_SERVER["REMOTE_PORT"].'</span>&nbsp;&nbsp;';
					if ($_SERVER["REMOTE_PORT"] != "80") {
						echo '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span></li>';
					} else {
						echo '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span><span class="text-danger"><em> PAT is not working - check the router</em></span></li>';
					}
				if (isset($proxy)) echo '<li><strong>Proxy: <span>'.($proxy) ? $proxy : ''.'</span></li>';
				echo '<li><strong>User Agent:</strong> <span>'.$_SERVER["HTTP_USER_AGENT"].'</span></li>';
			?>
			<li><b>Port Scan</b>&nbsp;&nbsp;<img id="loading" src="/img/ajax-loader.gif">
				<ul>
				<?php
					// 5. Scan visitor's source IP for open ports as specified
					//
					// Uncomment this line to demo port scanning:
					//$EXT_IP = "8.8.8.8";
					//
					if(isset($EXT_IP)) {	
						// List of port numbers to scan
						$ports = array(80, 443, 53, 5060, 21, 22, 23, 25, 110);
						$results = array();
						foreach($ports as $port) {
							if($pf = @fsockopen($EXT_IP, $port, $err, $err_string, 1)) {
								$results[$port] = true;
								fclose($pf);
							} else {
								$results[$port] = false;
							}
						}
						foreach($results as $port=>$val)	{
							$port_detail = getservbyport($port,"tcp");
									echo '<li>Port '.$port.' ('.$port_detail.'):&nbsp;&nbsp;';
							if($val) {
								echo '<span class="glyphicon glyphicon-info-sign text-warning" aria-hidden="true"></span>';
								echo '<em> open</em></li>';
							}
							else {
								echo '<span class="glyphicon glyphicon glyphicon-remove-sign text-success" aria-hidden="true"></span>';
								echo '<em> blocked</em></li>';
							}
						}
					}
					?>
				</ul>
			</ul>
			<br>
		</div>
	</div>
	<!--<div id="content" onload="func_done();">-->
	<!-- Web, Video, Speed test, and FTP test sections are loaded here from verifycontent.html -->
	</div>
</div>
<script type="text/javascript">
// These change the background color of each content well as it finishes loading
function func_web() {
    document.getElementById("web").className += " alert-success";
}
function func_video() {
    document.getElementById("video").className += " alert-success";
}
function func_speed() {
    document.getElementById("speed").className += " alert-success";
}
function func_ftp() {
    document.getElementById("ftp").className += " alert-success";
}
// Fades out the spinning loading icon and pulls in content wells once the page finishes loading
$(window).load(function(){
	$('#loading').fadeOut(250);
	$("#content").load("verifycontent.html");
});
</script>
</body>
</html>