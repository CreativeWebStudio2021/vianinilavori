<?php
$PS = DIRECTORY_SEPARATOR;
require_once dirname(dirname(__FILE__))."{$PS}config{$PS}config.php";

/* File per la connessione al database e l'inizializzazione delle globals */
//echo $_SERVER["HTTP_HOST"];
class db extends Config {
	
	private $connection;
	protected $local = false;
	protected $cws = false;
	protected $testenv = false;
	
	/* connessione al db */
	public function connect() {
		$this->connection = mysql_connect($this->host_db,$this->user_db,$this->pass_db) or die('Error: '.mysql_error);
		mysql_select_db($this->db_name) or die('Error: '.mysql_error);
	}
	
	/* esecuzione query */
	public function query($query) {
		$res = mysql_query($query,$this->connection);
		return $res;
	}
		
	public function __construct() {
		if ($_SERVER["HTTP_HOST"]=="3.64.237.177") $this->cws = true;
		
		if ($this->cws) {
			$this->dir_up = "resarea/img_up";
			$this->host_db = "localhost";
			$this->user_db = "root";
			$this->pass_db = "3efg1IUbfhJR";
			$this->db_name = "yccs";
			$this->ind_sito = $_SERVER["HTTP_HOST"]."/yccs";
			$this->mail_sito = "f.denegri@cwstudio.it";
			$this->user_login_paypal = "s.depersio@cwstudio.it";
			$this->pass_login_paypal = "prova2013";
			$this->http = "http";
		}  else {
			$this->dir_up = "resarea/img_up";
			$this->host_db = "sql.yccs.it.cloud.seeweb.it";
			$this->user_db = "admin";
			$this->pass_db = "ichaith5";
			$this->db_name = "yccs";
			$this->user_login_paypal = "amministrazione@yccs.it";
			$this->pass_login_paypal = "Pssppyccs2013!";
			$this->ind_sito = "www.yccs.it";
			$this->mail_sito = "info@yccs.it";
			$this->http = "https";
		}
		$this->nome_sito = "Yacht Club Costa Smeralda";
		
		$this->connect();
	}
	
	public function get_Var($nome) {
		return $this->$nome;
	}
	
}

/* apretura connessione db + inizializzazione variabili globali */
$open_connection_old = new db();
$nome_del_sito = $open_connection_old->get_Var('nome_sito');
$mail_sito = $open_connection_old->get_Var('mail_sito');
$ind_sito = $open_connection_old->get_Var('ind_sito');
$dir_up = $open_connection_old->get_Var('dir_up');
$cws = $open_connection_old->get_Var('cws');
$http = $open_connection_old->get_Var('http');
$user_login_paypal = $open_connection_old->get_Var('user_login_paypal');

$ind_logo="http://$ind_sito/images/logo.png";
$email_sotto ="
	<br><br>
	Cordiali saluti<br>
	<b>$nome_del_sito</b><br>
	Via della marina<br>
	07021 Porto Cervo (OT)<br>
	Tel: +39 0789 902200<br>
	Fax: +39 0789 91257<br><br>
	Sito web: <a class=\"rosso\" href=\"http://$ind_sito\">$ind_sito</a><br>
	E-mail: <a class=\"rosso\" href=\"mailto:$mail_sito\">$mail_sito</a><br>
	
	<br><br>
	P.S.	questa email e' stata spedita automaticamente dal nostro sistema informatico.
					
	<div align=\"justify\">
	
	<p class=\"testo\" style=\"border-top:1px solid #9e9f91;padding-top:20px;color:#9e9f91;font-size:11px\">
	Avviso di riservatezza - Il testo e gli eventuali documenti trasmessi contengono informazioni riservate al destinatario indicato. La seguente e-mail è confidenziale e la sua riservatezza è tutelata dal Dlgs 196/2003. La lettura, copia o altro uso non autorizzato o qualsiasi altra azione derivante dalla conoscenza di queste informazioni sono rigorosamente vietate. Qualora abbiate ricevuto questo documento per errore siete cortesemente pregati di darne immediata comunicazione al mittente, ai numeri qui indicati e/o all'indirizzo dello stesso e di provvedere immediatamente alla sua distruzione.
	</p>

	</div></div>
	</body></HTML>";
$email_sotto_crew_board ="
	<br><br>
	Cordiali saluti<br>
	<b>$nome_del_sito</b><br>
	Via della marina<br>
	07021 Porto Cervo (OT)<br>
	Tel: +39 0789 902200<br>
	Fax: +39 0789 91213<br><br>
	Sito web: <a class=\"rosso\" href=\"http://$ind_sito\">$ind_sito</a><br>
	E-mail: <a class=\"rosso\" href=\"mailto:secretariat@yccs.it\">secretariat@yccs.it</a><br>
	
	<br><br>
	P.S.	questa email e' stata spedita automaticamente dal nostro sistema informatico.
					
	<div align=\"justify\">
	
	<p class=\"testo\" style=\"border-top:1px solid #9e9f91;padding-top:20px;color:#9e9f91;font-size:11px\">
	Avviso di riservatezza - Il testo e gli eventuali documenti trasmessi contengono informazioni riservate al destinatario indicato. La seguente e-mail è confidenziale e la sua riservatezza è tutelata dal Dlgs 196/2003. La lettura, copia o altro uso non autorizzato o qualsiasi altra azione derivante dalla conoscenza di queste informazioni sono rigorosamente vietate. Qualora abbiate ricevuto questo documento per errore siete cortesemente pregati di darne immediata comunicazione al mittente, ai numeri qui indicati e/o all'indirizzo dello stesso e di provvedere immediatamente alla sua distruzione.
	</p>

	</div></div>
	</body></HTML>";
?>