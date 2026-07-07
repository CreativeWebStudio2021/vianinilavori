<?
	if(isset($_POST['rag_sociale'])) {
		$rag_sociale = $_POST['rag_sociale'];
	} else{
		$rag_sociale = "";
	}
	
	if(isset($_POST['nome'])) {
		$nome = $_POST['nome'];
	} else{
		$nome = "";
	}
	
	if(isset($_POST['cognome'])) {
		$cognome = $_POST['cognome'];
	} else{
		$cognome = "";
	}
			
	if(isset($_POST['telefono'])) {
		$telefono = $_POST['telefono'];
	} else{
		$telefono = "";
	}
	
	if(isset($_POST['indirizzo'])) {
		$indirizzo = $_POST['indirizzo'];
	} else{
		$indirizzo = "";
	}
		
	if(isset($_POST['cap'])) {
		$cap = $_POST['cap'];
	} else{
		$cap = "";
	}
	
	if(isset($_POST['citta'])) {
		$citta = $_POST['citta'];
	} else{
		$citta = "";
	}
	
	if(isset($_POST['provincia'])) {
		$provincia = $_POST['provincia'];
	} else{
		$provincia = "";
	}
	
	/*if(isset($_POST['regione'])) {
		$regione = $_POST['regione'];
	} else{
		$regione = "";
	}*/
		
	if(isset($_POST['nazione'])) {
		$nazione = $_POST['nazione'];
	} else{
		$nazione = "Italia";
	}
				
	if(isset($_POST['email'])) {
		$email = $_POST['email'];
	} else{
		$email = "";
	}
		
	if(isset($_POST['cod_fiscale'])) {
		$cod_fiscale = trim($_POST['cod_fiscale']);
	} else{
		$cod_fiscale = "";
	}
	
	if(isset($_POST['partita_iva'])) {
		$partita_iva = trim($_POST['partita_iva']);
	} else{
		$partita_iva = "";
	}		
	
	if(isset($_POST['password'])) $password=$_POST['password']; else $password="";
	if(isset($_POST['password1'])) $password1=$_POST['password1']; else $password1="";
					
	if(isset($_POST['privacy'])) $privacy=$_POST['privacy']; else $privacy="0";
	if(isset($_POST['news'])) $news=$_POST['news']; else $news="1";
	
	if(isset($_POST['stato_recupera'])) $stato_recupera=$_POST['stato_recupera'];
		else $stato_recupera="";
	
	if(isset($_POST['recupera'])) $recupera=$_POST['recupera']; 
		elseif(isset($_GET['recupera'])) $recupera=$_GET['recupera']; 
			else $recupera=0;
	
	if(isset($_POST['email_rec'])) {
		$email_rec = $_POST['email_rec'];
	} else{
		$email_rec = "";
	}
	
	$pagTitle = "REGISTRAZIONE";
	$pagSubTitle = "";
	include("fissi/page_title.inc.php");
?>
<!-- Section -->
<section>
	<div class="container">
		<div class="row">
			<? if(isset($_POST['cf-turnstile-response']) && $_POST['cf-turnstile-response']!=""){
				$captcha=$_POST['cf-turnstile-response'];
				$secretKey = $cloudeflare_secret_key;
				$ip = $_SERVER['REMOTE_ADDR'];

				$url_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
				$data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);
				
				$options = array(
					'http' => array(
						'method' => 'POST',
						'header' => 'Content-type:application/x-www-form-urlencoded',
						'content' => http_build_query($data)
					)
				);
				
				$stream = stream_context_create($options);	
				$result = file_get_contents($url_path, false, $stream);	
				$response =  $result;   
				$responseKeys = json_decode($response,true);
				
				if(intval($responseKeys["success"]) == 1) {
					$query_email="SELECT id FROM ".$prec_db."clienti WHERE email='".trim($email)."'";
					$resu_email=$open_connection->connection->query($query_email);
					$num_email=$resu_email->rowCount();
					
					if($num_email>0){?>
						<div class="col-lg-12">							
							<div role="alert" class="alert alert-success text-center" style="background:#F4524D; border:none"> ATTENZIONE! Email già presente nei nostri database!</div>
							
							<script language="javascript" type="text/JavaScript"> 
								function loc(){
									<?if($lingua=="ita"){?>
										window.location = "registrazione.html";
									<?}else{?>
										window.location = "eng/register.html";
									<?}?>
								}
								window.setTimeout('loc()' , 8000);
							</script>
						</div>
					<?}else{
						$data_iscr=date("Y-m-d");
						
						$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$codice = '';
						for ($i = 0; $i < 15; $i++) {
							$codice .= $characters[rand(0, (strlen($characters)-1))];
						}
						$password = crypt($password,$password); 
						
						$query_ins="INSERT INTO ".$prec_db."clienti (codice,nome,cognome,email,password,news,data_iscr) VALUES ('$codice',:nome,:cognome,'$email',:password,'$news','$data_iscr')";
						$risu_ins=$open_connection->connection->prepare($query_ins);
						$risu_ins->execute(array(':nome'=>trim($nome),':cognome'=>trim($cognome),':password'=>trim($password)));
						
						$lastId = $open_connection->connection->lastInsertId();
						
						$link = $http."://$ind_sito/conferma-registrazione_".$codice."_".$lastId.".html";
						$link_eng = $http."://$ind_sito/eng/confirm-registration_".$codice."_".$lastId.".html";
						
						include("fissi/mail_registrazione_link.inc.php");
						?>
						<div class="col-lg-12">
							<div role="alert" class="alert alert-success text-center" style="background:green"> 
								<?if($lingua=="ita"){?>
									Grazie per la sua richiesta di iscrizione<br/>
									A breve riceverà una mail con un link che dovrà seguire per completare la richiesta<br/>
									Se non dovesse ricevere l’email, la invitiamo a <b>controllare nella cartella spam</b> o a scrivere a <a href="mailto:<?=$mail_sito;?>" style="color:#fff"><b><?=$mail_sito;?></b></a>
								<?}else{?>
									Thanks for your request<br/>
									Shortly you will receive an email with a link that will have to follow to complete the request<br/>
									If you do not receive an email, <b>check your spam folder</b> or contact <a href="mailto:<?=$mail_sito;?>" style="color:#fff"><b><?=$mail_sito;?></b></a>
								<?}?>
							</div>
							<script language="javascript" type="text/JavaScript"> 
								function loc(){
									//window.location = "home.html";
								}
								window.setTimeout('loc()' , 10000);
							</script>
						</div>
					<?}
				} else { ?>
					<div class="col-lg-12">							
						<div role="alert" class="alert alert-success text-center" style="background:#F4524D; border:none"> 
							Verifica Fallita!
						</div>
					</div>
					<form name="formNoRis" method="post" action="registrazione.html#inizio">
						<input type="hidden" name="nome" value="<?=$nome;?>"/>
						<input type="hidden" name="cognome" value="<?=$cognome;?>"/>
						<input type="hidden" name="email" value="<?=$email;?>"/>
						<input type="hidden" name="password" value="<?=$password;?>"/>
						<input type="hidden" name="password1" value="<?=$password1;?>"/>
						<!--<input type="hidden" name="privacy" value="<?=$privacy;?>"/>-->
					</form>
					<script language="javascript" type="text/JavaScript"> 
						function loc(){
							document.formNoRis.submit();
						}
						window.setTimeout('loc()' , 3000);
					</script>
				<?} 
			} else { ?>
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
					<div class="row">
						<div class="col-lg-12">
							<h3><?if($lingua=="ita"){?>Sei già Registrato?<?}else{?>Are you already registered?<?}?></h3>
						</div>	
						<div class="col-lg-12" style="margin:20px 0;">
							<a data-bs-target="#modal-login" data-bs-toggle="modal" href="#" title="Area Riservata - <?=$nome_del_sito;?>"><button type="button" class="btn btnEat" style="background:<?=$color;?>; border:none; color:#fff;"><?if($lingua=="ita"){?>ACCEDI<?}else{?>SIGN IN<?}?></button></a>								
						</div>	
						<div class="col-lg-12" style="margin-bottom:20px;">
							<?if($lingua=="ita"){?>oppure<?}else{?>or<?}?>
						</div>	
					</div>	
					<div class="panel">
						<div class="panel-body" style="padding-right:2%">
							<h3><?=traduci("Registrati");?></h3>
				
							<!--<p>Compila il seguente form per registrarti al nostro sito:</p>-->
							<form name="regForm" id="regForm" action="<?=traduci("registrazione-conferma.html");?>" method="post">
								<input type="hidden" name="stato_reg" value="inviata" />
								<input type="hidden" name="privacy" value="0"/>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group m-b-10">
											<label for="nome"><?=traduci("Nome");?> *</label>
											<input type="text" name="nome" id="nome" placeholder="" class="form-control" value="<?=$nome;?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-b-10">
											<label for="cognome"><?=traduci("Cognome");?> *</label>
											<input type="text" name="cognome" id="cognome" placeholder="" class="form-control" value="<?=$cognome;?>">
										</div>
									</div>
									
									<div class="col-lg-12">
										<div class="form-group m-b-10">
											<label for="email">Email *</label>
											<input type="text" name="email" id="email" placeholder="" class="form-control required email" value="<?=$email;?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-b-10">
											<label for="password">Password *</label>
											<input type="password" name="password" id="password" placeholder="" class="form-control required password" value="<?=$password;?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group m-b-10">
											<label for="password1"><?=traduci("Conferma");?> Password *</label>
											<input type="password" name="password1" id="password1" placeholder="" class="form-control required password1" value="<?=$password1;?>">
										</div>
									</div>
								</div>
															
								<div class="form-group">
									<div class="custom-control custom-checkbox" style="float:left;  width:15px;">
										<input type="checkbox" class="custom-control-input" id="prv" name="prv" onclick="check_privacy()" <?if($privacy=="1"){?>checked="checked"<?}?>>
									</div>
									<div style="float:left; width:calc(100% - 15px);">
										<label class="custom-control-label" for="prv">
											<div style="float:left; padding-left:10px;">
											<a href="<?=traduci("Privacy_link");?>" style="color:<?=$color1;?>" title="Privacy Policy" target="_blank">Privacy Policy</a>
										</div>
										<div style="float:left;margin-bottom:10px">
											: <?=traduci("Autorizzo al trattamento dei dati personali");?> *
										</div>
										</label>
									</div>
									<div style="clear:both;height:0px"></div>
									<script type="text/javascript">
										var pr=0;
										function check_privacy(){
											if(pr==0) pr=1;
											else pr=0;
											document.regForm.privacy.value=pr;
										}
									</script>
								</div>
								<div class="form-group">
									<div class="cf-turnstile" data-sitekey="<?=$cloudeflare_site_key;?>" data-callback="javascriptCallback"></div>
								</div>
								<div style="clear:both;height:20px"></div>
								<p class="small" style="font-size:0.9em !important">
									(* <?=traduci("campi obbligatori");?>)<br />
									(** <?=traduci("uno dei due campi è obbligatorio");?>)
								</p>
								<div class="btn" id="form-submit" onclick="checkForm()"><?=traduci("Registrati");?></div>
							</form>
							<script>	
								
								function checkForm(){
									Filtro_reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;
									if (document.regForm.nome.value=="") alert(<?if($ita){?>'"Nome"  obbigatorio'<?}else{?>'"Name" field is mandatory'<?}?>);
									else if (document.regForm.cognome.value=="") alert(<?if($ita){?>'"Cognome" obbigatorio'<?}else{?>'"Surname" field is mandatory'<?}?>);
									else if (document.regForm.email.value=="") alert(<?if($ita){?>'Campo "Email" obbigatorio'<?}else{?>'"Email" field is mandatory'<?}?>);
									else if (Filtro_reg.test(document.regForm.email.value)==false) alert(<?if($ita){?>"Inserire un indirizzo email corretto"<?}else{?>'Please enter a correct email address'<?}?>);								
									else if (document.regForm.password.value=="") alert(<?if($ita){?>'Campo "Password" obbigatorio'<?}else{?>'"Password" field is mandatory'<?}?>);
									else if (document.regForm.password1.value=="") alert(<?if($ita){?>'Campo "Conferma Password" obbigatorio'<?}else{?>'"Confirm Password" field is mandatory'<?}?>);
									else if (document.regForm.password.value!=document.regForm.password1.value) alert(<?if($ita){?>'Il Campo "Password" e "Conferma Password" non coincidono'<?}else{?>'The "Password" and "Confirm Password" fields do not match'<?}?>);
									else if (document.regForm.privacy.value=="0") alert(<?if($ita){?>'Autorizzazione della privacy obbligatoria'<?}else{?>'Mandatory privacy authorization'<?}?>);
									else document.regForm.submit();
								}
							</script>
						</div>
						<div style="clear:both; height:60px;"></div>
					</div>
				</div>			
			<? } ?>
		</div>
	</div>
</section>