 <?php if(isset($test) && $test==1){
	 $admin = 0;
	 $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
	$url .= "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	// Verifica se contiene "resarea"
	if (strpos($url, 'resarea') !== false) {
		$admin=1;
	}
	 ?>
 <style>
    #dragBox {
      width: 220px;
      height: 80px;
      background-color: #3498db;
      color: white;
      text-align: center;
      line-height: 80px;
      position: fixed;
      bottom: 25px;
      <?php if($admin==1){?>
		right: 25px;
	  <?php }else{?>
		left: 25px;
	  <?php }?>
      cursor: move;
      z-index: 9999;
	  font-size:20px; 
	  font-weight:20px;
	  border:solid 2px #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      user-select: none;
    }
  </style>
  
  <div id="dragBox">
	VERSIONE DI TEST
  </div>
  
  <script>
  const dragBox = document.getElementById("dragBox");
  let isDragging = false;
  let offsetX = 0, offsetY = 0;

  dragBox.addEventListener("mousedown", function(e) {
    isDragging = true;
    offsetX = e.clientX - dragBox.offsetLeft;
    offsetY = e.clientY - dragBox.offsetTop;
    dragBox.style.transition = "none"; // Disabilita transizioni durante il drag
  });

  document.addEventListener("mousemove", function(e) {
    if (isDragging) {
      dragBox.style.left = (e.clientX - offsetX) + "px";
      dragBox.style.top = (e.clientY - offsetY) + "px";
    }
  });

  document.addEventListener("mouseup", function() {
    isDragging = false;
  });
</script>
 <?php }?>