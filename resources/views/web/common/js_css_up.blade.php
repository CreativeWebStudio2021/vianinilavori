<style>
	.center {
		text-align: center;
	}

	.justify {
		text-align: justify;
	}

	.left {
		text-align: left;
	}
</style>

<script>
	function applyDynamicTextAlign(el) {
		const lineHeight = parseFloat(getComputedStyle(el).lineHeight);
		const lines = Math.round(el.offsetHeight / lineHeight);
		if (lines > 2) {
		  el.classList.remove('center');
		  
		  if(window.innerWidth>650){
			el.classList.remove('justify');
		    el.classList.remove('left');
		    el.classList.add('center');
			el.classList.add('justify');			  
		  }else{
			el.classList.remove('justify');
		    el.classList.remove('left');
		    el.classList.add('center');
			el.classList.add('left');
		  }
		} else {
		  el.classList.remove('justify');
		  el.classList.remove('left');
		  el.classList.add('center');
		}
	}
</script>