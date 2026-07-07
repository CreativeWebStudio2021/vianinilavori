<?php 
$body = $body1 = "
<html><head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\"/>
<meta http-equiv=\"content-language\" content=\"IT\"/>

<style type=\"text/css\">
	body{ 
		padding: 30px 20px;
		margin:0px;
		width:800px;
		background-color:#ffffff;
		text-align:left;	
		font-family: arial;
		font-size: 12px;
		line-height:160%;
		color: black;
	}

	img{border:0px}
		
	a{text-decoration:none;}
	a:hover{color: ".config('app.color1')."; border-color:".config('app.color1')."}
	a.menu{text-decoration:none;color: ".config('app.color1').";}
	a.menu:hover{color: ".config('app.color1')."; border-color:".config('app.color1')."}

	.big{	font-size: 13px;}
</style>

</head>

<body class=\"testo\">

<div style=\"position:relative;top:0px;left:0px;\">
	<img src=\"".$logo_sito."\">
</div>";

$body .= "<div style=\"position:relative;left:0px;z-index:20;margin:0\">CONTENUTO_DA_SOSTITUIRE</div>
 
<div style=\"position:relative;left:0px\"><br/>";
	if(isset($intestazione_mail) && trim($intestazione_mail)!=""){
		$body .= $intestazione_mail;
	}else{
		$body .= "<b><span style=\"color:".config('app.color1')."\">Vianini Lavori</span></b>
				<br/>Via Barberini,11
				<br/>00187 Roma (RM)
				<br/><span>Tel:</span> (+39) 06.37.49.21
				<br/><a href=\"mailto:$mail_sito\" class=\"menu\">$mail_sito</a>
				<br/><a href=\"".config('app.url')."\" class=\"menu\">$ind_sito</a>
				";
	}
	$body .= "<br><br><p class=\"menu\" style=\"border-top:1px solid #c1c1c1;padding-top:20px;width:700px;\">
	Avviso di riservatezza - Il testo e gli eventuali documenti trasmessi contengono informazioni riservate al destinatario indicato. La seguente e-mail è confidenziale e la sua riservatezza è tutelata dal GDPR 679/16. La lettura, copia o altro uso non autorizzato o qualsiasi altra azione derivante dalla conoscenza di queste informazioni sono rigorosamente vietate. Qualora abbiate ricevuto questo documento per errore siete cortesemente pregati di darne immediata comunicazione al mittente, ai numeri qui indicati e/o all'indirizzo dello stesso e di provvedere immediatamente alla sua distruzione.
	</p>
</div>

</body>
</html>";

$body1 .= "<div style=\"position:relative;left:0px;z-index:20;margin:20px 0px 0px 0px\">CONTENUTO_DA_SOSTITUIRE</div>
 
</body>
</html>";
?>
