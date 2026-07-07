<?php
namespace App\Http\Controllers\Web;

use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\News;
use App\Models\Web\Order;
use App\Models\Web\Products;
use Auth;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Lang;
use View;
use DB;
use Cookie;
use Session;
use Config;
use App;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\AdminControllers\AdminCustomController;

class InvioMailController extends Controller
{	
	public function postmail_registrazione_provv($id_cliente, $lingua="it"){
		$mail_sito = env('APP_EMAIL');
		$ind_sito = env('APP_URL');
		$nome_del_sito = env('APP_NAME');
		$logo_sito = $ind_sito."/".env('APP_LOGO');
		
		include("resources/views/web/common/body_mail.css.php");
		
		$query_acc = DB::table('iscritti');
		$query_acc = $query_acc->select('*');
		$query_acc = $query_acc->where('id','=',$id_cliente);
		$query_acc = $query_acc->get();
		
		foreach($query_acc[0] AS $key=>$value){
			$$key = $value;
		}
		
		$ragione_sociale = stripslashes($ragione_sociale);
		$via = stripslashes($via);
		$citta = stripslashes($citta);
		$email = stripslashes($email);
		$pec = stripslashes($pec);
		
		$dati = "<span class=\"testo\"><b>Rag. sociale:&nbsp;</b>$ragione_sociale<br />";
		$dati_eng = "<span class=\"testo\"><b>Company name:&nbsp;</b>$ragione_sociale<br />";
	
		if(isset($codice_cliente) && $codice_cliente!="") {
			$dati .= "<span class=\"testo\"><b>Cod. cliente:&nbsp;</b>$codice_cliente<br />";
			$dati_eng .= "<span class=\"testo\"><b>Customer id:&nbsp;</b>$codice_cliente<br />";
		}
		if(isset($partiva_iva) && $partiva_iva!="") {
			$dati .= "<span class=\"testo\"><b>Partita IVA:&nbsp;</b>$partiva_iva<br />";
			$dati_eng .= "<span class=\"testo\"><b>VAT number:&nbsp;</b>$partiva_iva<br />";
		}
		
		$dati .= "<span class=\"testo\"><b>Indirizzo:&nbsp;</b>$via<br />";
		$dati_eng .= "<span class=\"testo\"><b>Address:&nbsp;</b>$via<br />";
			
		$dati .= "<span class=\"testo\"><b>CAP:&nbsp;</b>$cap<br />";
		$dati_eng .= "<span class=\"testo\"><b>Postal code:&nbsp;</b>$cap<br />";
			
		$dati .= "<span class=\"testo\"><b>Città:&nbsp;</b>$citta<br />";
		$dati_eng .= "<span class=\"testo\"><b>City:&nbsp;</b>$citta<br />";
		
		if(isset($regione) && $regione!="") {		
			$regione = stripslashes($regione);
			$dati .= "<span class=\"testo\"><b>Regione:&nbsp;</b>$regione<br />";
			$dati_eng .= "<span class=\"testo\"><b>Region:&nbsp;</b>$regione<br />";
		}
		if(isset($provincia) && $provincia!="") {	
			$provincia = stripslashes($provincia);			
			$dati .= "<span class=\"testo\"><b>Provincia:&nbsp;</b>$provincia<br />";
			$dati_eng .= "<span class=\"testo\"><b>State:&nbsp;</b>$provincia<br />";
		}
			
		$dati .= "<span class=\"testo\"><b>Nazione:&nbsp;</b>$paese<br />";
		$dati_eng .= "<span class=\"testo\"><b>Country:&nbsp;</b>$paese<br />";
		
		$dati .= "<span class=\"testo\"><b>Telefono:&nbsp;</b>$telefono<br />";
		$dati_eng .= "<span class=\"testo\"><b>Phone:&nbsp;</b>$telefono<br />";
			
		if(isset($fax) && $fax!="") {
			$dati .= "<span class=\"testo\"><b>Fax:&nbsp;</b>$fax<br />";
			$dati_eng .= "<span class=\"testo\"><b>Fax:&nbsp;</b>$fax<br />";
		}
											
		$dati .= "<span class=\"testo\"><b>Email:&nbsp;</b><a href=\"mailto:$email\" class=\"menu\" style=\"text-decoration:underline\">$email</a><br />";
		$dati_eng .= "<span class=\"testo\"><b>Email:&nbsp;</b><a href=\"mailto:$email\" class=\"menu\" style=\"text-decoration:underline\">$email</a><br />";
		
		if(isset($pec) && $pec!="") {
			$dati .= "<span class=\"testo\"><b>PEC:&nbsp;</b><a href=\"mailto:$pec\" class=\"menu\" style=\"text-decoration:underline\">$pec</a><br />";
			$dati_eng .= "<span class=\"testo\"><b>PEC:&nbsp;</b><a href=\"mailto:$pec\" class=\"menu\" style=\"text-decoration:underline\">$pec</a><br />";
		}
		
		if(isset($codice_sdi) && $codice_sdi!="") {
			$dati .= "<span class=\"testo\"><b>Codice SDI:&nbsp;</b>$codice_sdi<br />";
			$dati_eng .= "<span class=\"testo\"><b>SDI code:&nbsp;</b>$codice_sdi<br />";
		}
		
		$dati .= "<b>Consenso ad un'eventuale pubblicazione sul sito come 'Punto vendita':&nbsp;</b>S&igrave;<br />";
		$dati_eng .= "<b>Consenso ad un'eventuale pubblicazione sul sito come 'Punto vendita':&nbsp;</b>Yes<br />";
			
		$CustomController = new CustomController();
		$data_iscrizione =$CustomController->date_to_data($data_iscrizione);
		
		$testo_azi ="<p class=\"menu\">
			Report di Notifica del sito Web - Un nuovo cliente (<b>$ragione_sociale</b>) si è registrato sul sito il $data_iscrizione:<br /><br />
			$dati
		</p>";
		if($lingua=="en")
			$testo_azi ="<p class=\"menu\">
				Report di Notifica del sito Web - Un nuovo cliente (<b>$ragione_sociale</b>) si è registrato sul sito (versione inglese) il $data_iscrizione:<br /><br />
				$dati
			</p>";
		
		$testo_ag ="<p class=\"menu\">
					Report di Notifica del sito Web - Un nuovo cliente (<b>$ragione_sociale</b>), proveniente da una regione di sua competenza, si è registrato sul sito il $data_iscrizione senza codice cliente:<br /><br />
					$dati";
		if($lingua=="en")
			$testo_ag ="<p class=\"menu\">
						Report di Notifica del sito Web - Un nuovo cliente (<b>$ragione_sociale</b>), proveniente da una regione di sua competenza, si è registrato sul sito il $data_iscrizione senza codice cliente:<br /><br />
						$dati";
					
		$testo_cli ="<p class=\"menu\">
					<span class=\"testo\">Gentile&nbsp;<b>$ragione_sociale</b>,<br />
					Ti confermiamo l'avvenuta registrazione al nostro sito internet.<br/>
					Qui di seguito ti riportiamo le tue credenziali di accesso:<br/><br/>
					Username: $email<br/>
					Password: $password<br/><br/>
					Non appena attivate ti permetteranno di accedere temporaneamente* alla tua area riservata ed acquistare i nostri prodotti.<br/><br/>
					<i>(*) Se entro 10 giorni dalla data di registrazione effettuerai almeno un ordine la tua registrazione verrà confermata e diventerà definitiva, altrimenti il tuo account verrà automaticamente disattivato.</i><br/><br/>
					Qui di seguito ti riportiamo i dati che abbiamo ricevuto:
					<br/><br/>$dati
					<br/><br/>La ringraziamo per la preferenza accordataci.
					<br/><br/>Distinti saluti,";					
		if($lingua=="en")
			$testo_cli ="<p class=\"menu\">
						<span class=\"testo\">Dear&nbsp;<b>$ragione_sociale</b>,<br />
						We confirm the successful registration on our website.<br/>
						Below you can find your login credentials:<br/><br/>
						Username: $email<br/>
						Password: $password<br/><br/>
						As soon as they are activated, they will allow you to temporarily* access your reserved area and purchase our products..<br/><br/>
						<i>(*) If within 10 days from the registration date you will make at least one order your registration will be confirmed and will become final, otherwise your account will be automatically deactivated.</i><br/><br/>
						Below you can find the data we have received:
						<br/><br/>$dati_eng
						<br/><br/>Thank you for your preference.
						<br/><br/>Best regards,";
		
		$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
		$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);
		$body_ag = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_ag, $body);
		
		$oggetto_azi = "Iscrizione nuovo cliente (Registrazione provvisoria)";
		if($lingua=="it") {
			$oggetto_ut = "Conferma registrazione provvisoria";
		}else{
			$oggetto_ut = "Temporary sign up confirmation";
		}
		
		$MailController = new MailController();
		//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
		$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,$mail_sito,$nome_del_sito, $oggetto_azi, $body_azi); 
		$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_ut, $body_cli); 
		
		if ($codice_cliente=="" && $provincia!="") {
			
			$reg_ag = "";
			$query_reg = DB::table('regioni AS r');
			$query_reg = $query_reg->select('r.regione');
			$query_reg = $query_reg->join('province AS p','p.id_regione','=','r.id_regione' )
								->where(function($query_reg) use ($provincia) {
									$query_reg->where('p.sigla', '=', $provincia)
										->orWhere('p.provincia', '=', $provincia);
								});
			//dd($query_reg->toSql(), $query_reg->getBindings());
			$query_reg = $query_reg->get();
			if($query_reg->count()>0){
				$reg_ag = $query_reg[0]->regione;
				
				$nome_ag = $email_ag = "";
				
				$query_ag = DB::table('agenti');
				$query_ag = $query_ag->select('nome','cognome','email');
				$query_ag = $query_ag->where('regioni','like','%'.$reg_ag.'%');
				//dd($query_ag->toSql(), $query_ag->getBindings());
				$query_ag = $query_ag->get();
				if($query_ag->count()>0){
					$nome_ag = $query_ag[0]->nome;
					$cognome_ag = $query_ag[0]->cognome;
					$email_ag = $query_ag[0]->email;
					$email_ag = "f.denegri@cwstudio.it";
					$invioMail_ag = $MailController->sendMail($mail_sito,$nome_del_sito,$email_ag,$nome_del_sito, $oggetto_azi, $body_ag); 
				}	
			}
		}		
	}
	
	public function postmail_recupera_dati($id_cliente, $lingua="it"){
		$mail_sito = env('APP_EMAIL');
		$ind_sito = env('APP_URL');
		$nome_del_sito = env('APP_NAME');
		$logo_sito = $ind_sito."/".env('APP_LOGO');
		
		include("resources/views/web/common/body_mail.css.php");
		
		$query_acc = DB::table('iscritti');
		$query_acc = $query_acc->select('*');
		$query_acc = $query_acc->where('id','=',$id_cliente);
		$query_acc = $query_acc->get();
		
		foreach($query_acc[0] AS $key=>$value){
			$$key = $value;
		}		
					
		$testo_cli ="<br><br><br>Gentile <b>$ragione_sociale</b>,<br>
			qui di seguito ti riportiamo i dati che gi&agrave; ti permettono di accedere alla tua area riservata ed acquistare i nostri prodotti.<br/><br/>
			Username: $username<br/>
			Password: $password
			<br/><br/>";					
		if($lingua=="en")
			$testo_cli ="<br><br><br>Dear <b>$ragione_sociale</b>,<br>
			below you can find the credentials that already allow you to access your reserved area and buy our products.<br/><br/>
			Username: $username<br/>
			Password: $password
			<br/><br/>";		
		
		$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);
		
		
		if($lingua=="it") {
			$oggetto_ut = "Recupera dati";
		}else{
			$oggetto_ut = "Forgot your password?";
		}
		
		$MailController = new MailController();
		//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
		$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_ut, $body_cli); 		
	}
	
	public function postmail_registrazione2($id_cliente, $lingua="it"){
		$mail_sito = env('APP_EMAIL');
		$ind_sito = env('APP_URL');
		$nome_del_sito = env('APP_NAME');
		$logo_sito = $ind_sito."/".env('APP_LOGO');
		
		include("resources/views/web/common/body_mail.css.php");
		
		$query_acc = DB::table('iscritti');
		$query_acc = $query_acc->select('*');
		$query_acc = $query_acc->where('id','=',$id_cliente);
		$query_acc = $query_acc->get();
		
		foreach($query_acc[0] AS $key=>$value){
			$$key = $value;
		}
		
		$ragione_sociale = stripslashes($ragione_sociale);
		$email = stripslashes($email);
		
		$dati = "<span class=\"testo\"><b>Rag. sociale:&nbsp;</b>$ragione_sociale<br />";
		$dati_eng = "<span class=\"testo\"><b>Company name:&nbsp;</b>$ragione_sociale<br />";
	
		if(isset($codice_cliente) && $codice_cliente!="") {
			$dati .= "<span class=\"testo\"><b>Cod. cliente:&nbsp;</b>$codice_cliente<br />";
			$dati_eng .= "<span class=\"testo\"><b>Customer id:&nbsp;</b>$codice_cliente<br />";
		}
		if(isset($partiva_iva) && $partiva_iva!="") {
			$dati .= "<span class=\"testo\"><b>Partita IVA:&nbsp;</b>$partiva_iva<br />";
			$dati_eng .= "<span class=\"testo\"><b>VAT number:&nbsp;</b>$partiva_iva<br />";
		}	
											
		$dati .= "<span class=\"testo\"><b>Email:&nbsp;</b><a href=\"mailto:$email\" class=\"menu\" style=\"text-decoration:underline\">$email</a><br />";
		$dati_eng .= "<span class=\"testo\"><b>Email:&nbsp;</b><a href=\"mailto:$email\" class=\"menu\" style=\"text-decoration:underline\">$email</a><br />";
			
		$CustomController = new CustomController();
		$data_iscrizione =$CustomController->date_to_data($data_iscrizione);
		
		$testo_azi ="<p class=\"menu\">
			Report di Notifica del sito Web - Un nuovo cliente (<b>$ragione_sociale</b>) si è registrato sul sito il $data_iscrizione:<br /><br />
			$dati
		</p>";
		
		$testo_cli ="<p class=\"menu\">
					<span class=\"testo\">Gentile&nbsp;<b>$ragione_sociale</b>,<br />
					qui di seguito ti riportiamo i dati che ti permetteranno di accedere alla tua area riservata ed acquistare i nostri prodotti.<br/><br/>
					Username: $email<br/>
					Password: $password
					<br/><br/>e una copia dei tuoi principali dati:
					<br/><br/>$dati
					<br/><br/>La ringraziamo per la preferenza accordataci.
					<br/><br/>Distinti saluti,";					
		if($lingua=="en")
			$testo_cli ="<p class=\"menu\">
						<span class=\"testo\">Dear&nbsp;<b>$ragione_sociale</b>,<br />
						below you can find the credentials that will allow you to access your reserved area and buy our products.<br/><br/>
						Username: $email<br/>
						Password: $password
						<br/><br/>and a copy of your main data:
						<br/><br/>$dati_eng
						<br/><br/>Thank you for your preference.
						<br/><br/>Best regards,";
		
		$body_azi = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_azi , $body);
		$body_cli = str_replace("CONTENUTO_DA_SOSTITUIRE", $testo_cli, $body);
		
		if($lingua=="it") {
			$oggetto_azi = "Iscrizione nuovo cliente";
			$oggetto_ut = "Conferma registrazione provvisoria";
		}else{
			$oggetto_azi = "Iscrizione nuovo cliente (versione inglese)";
			$oggetto_ut = "Temporary sign up confirmation";
		}
		
		$MailController = new MailController();
		//sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $file="")
		$invioMail_azi = $MailController->sendMail($mail_sito,$nome_del_sito,$mail_sito,$nome_del_sito, $oggetto_azi, $body_azi); 
		$invioMail_cli = $MailController->sendMail($mail_sito,$nome_del_sito,$email,$nome_del_sito, $oggetto_ut, $body_cli); 		
	}
}