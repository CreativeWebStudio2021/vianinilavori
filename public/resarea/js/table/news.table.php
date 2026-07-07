<script language="javascript">		
	$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
	 {
		return {
		  "iStart":         oSettings._iDisplayStart,
		  "iEnd":           oSettings.fnDisplayEnd(),
		  "iLength":        oSettings._iDisplayLength,
		  "iTotal":         oSettings.fnRecordsTotal(),
		  "iFilteredTotal": oSettings.fnRecordsDisplay(),
		  "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		  "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
		};
	};
	
	$(document).ready(function() {
		
		/* Data Tables */
		if( $.fn.dataTable ) {
							
			$(".mws-datatable").dataTable();
			var eTable = $(".mws-datatable-fn").dataTable({
				sPaginationType: "full_numbers",
				bFilter: false,
				bSort: false,
				bLengthChange : false,
				bPaginate: false,
				bInfo:false,
				bStateSave: true
				/*fnDrawCallback: function (oSettings) {
					alert( 'Now on page'+ this.fnPagingInfo().iPage +' aggiorna: '+aggiorna+' cancella: '+cancella);
				}*/
			});
							
			<? if($azione=="cancella" && $id_canc) { ?>
			var r = confirm('Sei sicuro di voler cancellare questo record?');
			if (r) {
				var nexturl = "admin.php?cmd=<?=$cmd?>&pag_att=<?=$pag_att?>";
				var thisid = "<?=$id_canc?>";
				/* perchè non funziona sempre il post di ajax ?? 
				$.post( nexturl, {conferma: thisid} ) ;*/
				window.location= nexturl+"&id_canc="+thisid+"&conferma=yes";
			}	
			<? } elseif ($id_canc=="") { ?>
			eTable.fnPageChange('first',true);
			<? } ?>
			
		}				
	});
</script>