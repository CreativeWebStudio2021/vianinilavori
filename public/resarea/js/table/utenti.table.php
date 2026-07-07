<script language="javascript">		
    $(document).ready(function() {

        // Data Tables
        if( $.fn.dataTable ) {
            $(".mws-datatable").dataTable();
            var uTable = $(".mws-datatable-fn").dataTable({
                sPaginationType: "full_numbers",
				bFilter: false,
				aoColumns: [
					null, 
					null,
					null, 
					null, 
					{ bSortable: false }
				]
            });
			
			<? if($azione=="cancella" && $id_canc) { ?>
			var r = confirm('Sei sicuro di voler cancellare questo record?');
			if (r) {
				var nexturl = "admin.php?cmd=<?=$cmd?>&id_rife=<?=$id_rife?>&id_riferimento=<?=$id_riferimento?>&pag_att=<?=$pag_att?>";
				var thisid = "<?=$id_canc?>";
				/* perchè non funziona sempre il post di ajax ?? 
				$.post( nexturl, {conferma: thisid} ) ;*/
				window.location= nexturl+"&id_canc="+thisid+"&conferma=yes";
			}	
			<? } elseif ($id_canc=="") { ?>
			uTable.fnPageChange('first',true);
			<? } ?>
        }

    });
</script>