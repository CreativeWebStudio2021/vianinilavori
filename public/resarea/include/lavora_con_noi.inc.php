<?php 
$table="lavora_con_noi";
$pagina="lavora_con_noi";

	
if($azione=="cancella")
{	
	if(!$id_canc) 
		$id_canc = $_POST['conferma']; /* dal $.post di ajax */
	
	$query_canc = "delete from $table where id='$id_canc'";
	$risu_canc = $open_connection->connection->query($query_canc);
	
?>
	<script language="javascript">		
		window.location="admin.php?cmd=<?php echo $pagina;?>";
	</script>
<?php 
} 
?>
<div class="mws-panel grid_8">
	<div style="height:50px;font-size:1.2em;padding-top:10px"><b>Candidature Ricevute</b></div>
	
	<div id="start" style="display:none"></div>
	<div id="end" style="display:none"></div>
	<div id="total" style="display:none"></div>
	
	<div class="mws-panel-header">
		<span><i class="icon-table"></i> Lista Candidature</span>
	</div>
	<div class="mws-panel-body no-padding">
		<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
					<th style="width:20px"></th>
					<th style="text-align:left">Data</th>
					<th style="text-align:left">Nome / Email</th>
					<th style="text-align:left">Ruolo Attuale / Mansione</th>
					<th style="text-align:left">Sede Lavorativa / Area di Interesse</th>
					<th style="text-align:center; width:80px;">CV</th>
					<th style="text-align:center; width:80px;">Lettera</th>
					<th style="text-align:left">Azioni</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query_ele = "select * from $table WHERE 1  order by id DESC";
				$risu_ele = $open_connection->connection->query($query_ele);
				
				$num_ele = 0;
				if($risu_ele)
					$num_ele = $risu_ele->rowCount();	
				
				if($num_ele>0)
				{		
					$query_ele = "SELECT * FROM $table WHERE 1 ORDER BY controllo DESC, id DESC";
					//echo $query_ele;
					$risu_ele = $open_connection->connection->query($query_ele);
					$num_item=$risu_ele->rowCount();
					
					for($x=0;$x<$num_item;$x++)
					{						
						$arr_ele = $risu_ele->fetch();
						$id_campo = $arr_ele['id'];
						$codice = $arr_ele['codice'];
						$nome = ucfirst($arr_ele['nome']);
						$cognome = ucfirst($arr_ele['cognome']);
						$email = $arr_ele['email'];
						$ruolo_attuale = $arr_ele['ruolo_attuale'];
						$mansione_specifica = $arr_ele['mansione_specifica'];
						$area_interesse = $arr_ele['area_interesse'];
						$sede_lavorativa = $arr_ele['sede_lavorativa'];
						$cv = $arr_ele['cv'];
						$lettera_presentazione = $arr_ele['lettera_presentazione'] ?? null;
						$created_at = $arr_ele['created_at'];
						$controllo = $arr_ele['controllo'];
						$color = ($x % 2 === 0) ? '#ffffff' : '#f2f2f2';
						
						if($controllo=="0"){
							if($color=="#ffffff") $color="#d4edda";
							else if($color=="#f2f2f2") $color="#b9dac1";
						}
						
			?>	
				<tr style="background:<?php echo $color;?>">
					<td align="center" valign="center">
						<?php  echo $x+1; ?>
					</td>
					<td align="left" valign="center">
						<?php  
							$temp = explode(" ",$created_at);
							$data_temp = $temp[0];
							$ora = $temp[1];
							$data_temp = explode("-",$data_temp);
							$data = $data_temp[2]."/".$data_temp[1]."/".$data_temp[0];
						echo $data; 
						?>
						<br/>
						<?php  echo $ora; ?>
					</td>
					<td align="left" valign="center">
						<?php  echo $nome; ?> <?php  echo $cognome; ?> <b>
						<br/>
						<span
						  id="copyEmailRow"
						  data-email="<?php echo ($email); ?>"
						  style="cursor: pointer; font-size: 0.9em; display: inline-flex; align-items: center;"
						>
						  <i><?php echo ($email); ?></i>
						  <i class="fa-solid fa-copy" style="margin-left: 0.5em;"></i>
						</span>
					</td>
					<td align="left" valign="center">
						<i>Ruolo</i>: <?php echo $ruolo_attuale; ?>
						<br/>
						<i>Mansione</i>: <?php  echo $mansione_specifica; ?>
					</td>
					<td align="left" valign="center">
						<i>Area di interesse</i>: <?php echo $area_interesse; ?>
						<br/>
						<i>Sede Lavorativa</i>: <?php  echo $sede_lavorativa; ?>
					</td>
					<td  align="center" valign="center">
						<?php if(!empty($cv)){?>
							<a style="cursor:pointer; color:#000" target="_blank" href="files/lavora_con_noi/<?php  echo $codice; ?>/<?php echo $cv; ?>" title="Curriculum <?php echo $nome; ?> <?php echo $cognome; ?>">
								<i class="fa-solid fa-file-pdf fa-2x"></i>
							</a>
						<?php }?>
					</td>
					<td  align="center" valign="center">
						<?php if(!empty($lettera_presentazione)){?>
							<a style="cursor:pointer; color:#000" target="_blank" href="files/lavora_con_noi/<?php  echo $codice; ?>/<?php echo $lettera_presentazione; ?>" title="Lettera di Presentazione <?php echo $nome; ?> <?php echo $cognome; ?>">
								<i class="fa-solid fa-file-pdf fa-2x"></i>
							</a>
						<?php }?>
					</td>
					<td style="width:10%; text-align:left">
						<span class="btn-group">
							<!-- Toggle controllo -->
							<a href="javascript:void(0);" 
							   class="btn btn-small toggle-controllo" 
							   data-id="<?php echo $id_campo; ?>" 
							   data-controllo="<?php echo $controllo; ?>">
								<?php if($controllo == "0"): ?>
									<i class="fa-regular fa-square"></i>
								<?php else: ?>
									<i class="fa-solid fa-square-check"></i>
								<?php endif; ?>
							</a>
							
							<!-- Bottone cancellazione -->
							<a onClick="return confirm('Cancellare gli elementi selezionati?')" 
							   href="admin.php?cmd=<?php echo $pagina;?>&azione=cancella&id_canc=<?php echo $id_campo; ?><?php echo $rif;?>&pag_att=<?php echo $pag_att;?>" 
							   class="btn btn-small">
								<i class="icon-trash"></i>
							</a>
						</span>

					</td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>
		
	</div>
</div>

<script>
  // Funzione per copiare negli appunti con fallback
  function copyToClipboard(text) {
    if (navigator.clipboard && window.isSecureContext) {
      // Chrome 66+ e contesti sicuri (https o localhost)
      return navigator.clipboard.writeText(text);
    } else {
      // Fallback più vecchio
      const textarea = document.createElement('textarea');
      textarea.value = text;
      textarea.style.position = 'fixed';  // evita scroll
      document.body.appendChild(textarea);
      textarea.focus();
      textarea.select();
      return new Promise((resolve, reject) => {
        document.execCommand('copy') ? resolve() : reject();
        textarea.remove();
      });
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('copyEmailRow');
    el.addEventListener('click', () => {
      const email = el.dataset.email;
      copyToClipboard(email)
        .then(() => {
          alert(`Email "${email}" copiata negli appunti!`);
        })
        .catch(() => {
          alert('Impossibile copiare l\'email.');
        });
    });
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.toggle-controllo').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.dataset.id;
      let controllo = parseInt(this.dataset.controllo);
      const newControllo = controllo === 1 ? 0 : 1;

      // ✅ Cambia subito icona
      this.innerHTML = newControllo === 1
        ? '<i class="fa-solid fa-square-check"></i>'
        : '<i class="fa-regular fa-square"></i>';
      this.dataset.controllo = newControllo;

      // ✅ Cambia colore riga
      const tr = this.closest('tr');
      if (tr) {
        const currentColor = tr.style.backgroundColor;
        if (newControllo === 1) {
          // da normale a evidenziato
          tr.style.backgroundColor = (currentColor === 'rgb(212, 237, 218)') 
            ? '#ffffff ' 
            : '#f2f2f2 ';
        } else {
          // da evidenziato a normale
		  console.log(currentColor);
          tr.style.backgroundColor = (currentColor === 'rgb(255, 255, 255)') 
            ? '#d4edda' 
            : '#b9dac1';
        }
      }

      // ✅ Aggiorna DB con AJAX
      fetch('ajax_update_controllo.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&controllo=${newControllo}`
      })
      .then(response => response.json())
      .then(data => {
        if (!data.success) {
          alert('Errore aggiornamento!');
          // Se errore torna allo stato precedente
          this.innerHTML = controllo === 1
            ? '<i class="fa-solid fa-square-check"></i>'
            : '<i class="fa-regular fa-square"></i>';
          this.dataset.controllo = controllo;
        }
      })
      .catch(() => alert('Errore di connessione.'));
    });
  });
});
</script>

