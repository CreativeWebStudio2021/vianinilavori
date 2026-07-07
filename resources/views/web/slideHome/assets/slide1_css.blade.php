<style>	
	#slide1 {
	  height: 100%;
	  z-index: 10;
	  transition: all 1s ease;
	  background:#fff;
	}

	#orizzontalSlideSlide1 {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  width: 100%;
	  height:100%;
	  object-fit: contain;
	  opacity: 1;
	  z-index: -1;
	  transition:all 1s ease;
	}
	#orizzontalSlideSlide2 {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  width: 100%;
	  height:100%;
	  object-fit: contain;
	  opacity: 0;
	  z-index: -2;
	  transition:all 1s ease;
	}
	#orizzontalSlideSlide3 {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  width: 100%;
	  height:100%;
	  object-fit: contain;
	  opacity: 0;
	  z-index: -3;
	  transition:all 1s ease;
	}
	#orizzontalSlideSlide4 {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  width: 100%;
	  height:100%;
	  object-fit: contain;
	  opacity: 0;
	  z-index: -4;
	  transition:all 1s ease;
	}
	#orizzontalSlideSlide5 {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  width: 100%;
	  height:100%;
	  object-fit: contain;
	  opacity: 0;
	  z-index: -5;
	  transition:all 1s ease;
	}
	
	
	#slide2Img1 {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  width: 100%;
	  height:100%;
	  object-fit: contain;
	  opacity: 1;
	  z-index: -1;
	  transition:all 1s ease;
	}
	#slide2Img2 {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  width: 100%;
	  height:100%;
	  object-fit: contain;
	  opacity: 0;
	  z-index: -2;
	  transition:all 1s ease;
	}
	
	#slide2Img1 img,
	#slide2Img2 img {
	  width: 100%;
	  height: 100%;
	  object-fit: cover;
	}

	.scopriProgetto{
		color:#fff; 
		padding:10px 5px;
	    transition: all 0.3s ease
	}
	
	.scopriProgetto::after{
	  content: '';
	  position: absolute;
	  left: 150px;
	  top: 2px;
	  width: 12px;
	  height: 12px;
	  border-right: 2px solid #E73338;
	  border-bottom: 2px solid #E73338;
	  transform: rotate(-45deg);
	  transition: all 0.3s ease
	}
	.scopriProgetto:hover{
		color:#000; 
		background:#fff;
		font-weight:700;
	}
	
	.scopriProgetto:hover.scopriProgetto::after{
		left: 160px;
	}
	
	.circleArrow{
		border:solid 1px #fff;
		cursor:pointer;
		transition: all 0.3s ease;
	}
	.circleArrow:hover{
		border:solid 1px #E30613;
		background:#E30613;
	}
	
	.navSlideContainer{
		position: absolute;
		left: 0px;
		bottom: 70px;
		width:calc(100% - 200px);
		height:50px;
	}
	
	.navSlide{
		position:absolute; top:0; 
		width:200px; 
		height:100%; 
		border-top:solid 2px #fff; 
		font-size:16px; 
		color:#fff; 
		padding-top:10px;  
		transition: all 0.3s ease;
	}
	.navSlide1{
		left:0;
		border-color:#E30613
	}
	.navSlide2{
		left:220px;
		opacity:0.6
	}
	.navSlide3{
		left:440px;
		opacity:0.6
	}
	.navSlide4{
		left:660px;
		opacity:0.6
	}
	.navSlide5{
		left:880px;
		opacity:0.6
	}
	
	.hidden {
		opacity: 0;
		transform: translateY(20px);
	  }

	  .fade-title {
		transition: all 0.6s ease;
	  }

	  .fade-subtitle {
		transition: all 1.2s ease;
	  }

	  .visible {
		opacity: 1;
		transform: translateY(0px);
	  }
	  
	  .navSlide.active {
		  border-color: #E30613 !important;
		  font-weight: bold;
		  opacity: 1 !important;
		}
		.navSlide:not(.active) {
		  border-color: #fff !important;
		  font-weight: normal;
		  opacity: 0.6;
		}
		
		.titleContainerSlide1{
			position: absolute;
			top: 200px;
			left: 200px;
			right: 200px;
			bottom: 50px;
			text-align:left;
		}
		
		.progettoBott{
			font-size:16px; 
			margin-top:180px; 
			position:relative;
		}
		.progettoBottContainer{
			position: absolute;
			top: 200px;
			left: 0px;
			right: 200px;
			bottom: 50px;
			text-align:left;
		}
		.buttMapSlide1{			
			position: absolute;
			right: 200px;
			bottom: 0px;
			width:220px;
			height:50px;
			background:#E30613;
			border-radius:26px;
			border:solid 1px #fff;
			cursor:pointer;
		}
		.nextBtnSlide1{
			position: absolute;
			right: 200px;
			bottom: 80px;
			width:68px;
			height:68px;
			border-radius:35px;
		}
		.prevBtnSlide1{
			position: absolute;
			right: 290px;
			bottom: 80px;
			width:68px;
			height:68px;
			border-radius:35px;
		}
		.navSlideContainer{
			position: absolute;
			left: 0px;
			bottom: 70px;
			width:calc(100% - 200px);
			height:50px;
		}
		#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
			font-size:85px; color:#fff; line-height:1;
		}
		#sottotitoloSlide1, #sottotitoloSlide2, #sottotitoloSlide3, #sottotitoloSlide4, #sottotitoloSlide5{
			font-size:20px; color:#fff; line-height:1; margin-left:5px;
		}
		
		.slideNextSlide1{
			position:absolute; 
			width: 30px; 
			height: 30px; 
			top:17px; 
			left:12px; 
			border-right: 2px solid #fff; 
			border-bottom: 2px solid #fff;
			transform: rotate(-45deg);
		}
		.slidePrevSlide1{
			position:absolute; 
			width: 30px; 
			height: 30px; 
			top:17px; 
			right:12px; 
			border-left: 2px solid #fff; 
			border-top: 2px solid #fff;
			transform: rotate(-45deg);
		}
		
		@media screen AND (max-width:1600px){
			.titleContainerSlide1{
				top: 200px;
				left: 100px;
				right: 100px;
				bottom: 50px;
			}
			.progettoBottContainer{
				top: 200px;
				left: 0px;
				right: 100px;
				bottom: 50px;
			}
			.buttMapSlide1{			
				right: 100px;
				bottom: 0px;
				height:50px;
			}
			.nextBtnSlide1{
				right: 100px;
				bottom: 80px;
			}
			.prevBtnSlide1{
				right: 190px;
				bottom: 80px;
			}
		}
		@media screen AND (max-width:1468px){
			
			.titleContainerSlide1{
				top: 200px;
				left: 50px;
				right: 50px;
				bottom: 50px;
			}
			.progettoBottContainer{
				top: 200px;
				left: 0px;
				right: 50px;
				bottom: 50px;
			}
			.buttMapSlide1{			
				right: 50px;
				bottom: 0px;
				height:50px;
			}
			.nextBtnSlide1{
				right: 50px;
				bottom: 80px;
			}
			.prevBtnSlide1{
				right: 140px;
				bottom: 80px;
			}
		}
		
		@media screen AND (max-width:1350px){
			.navSlide{
				width:130px; 
			}
			.navSlide2{
				left:145px;
			}
			.navSlide3{
				left:290px;
			}
			.navSlide4{
				left:435px;
			}
			.navSlide5{
				left:580px;
			}
		}
		
		@media screen AND (max-width:1024px){
			
			.titleContainerSlide1{
				top: 150px;
			}
			
			.navSlide{
				width:120px; 
				padding-top:10px; 
				font-size:12px; 				
			}
			.navSlide2{
				left:140px;
			}
			.navSlide3{
				left:280px;
			}
			.navSlide4{
				left:420px;
			}
			.navSlide5{
				left:560px;
			}
			
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
				font-size:70px;
			}
		}
		
		@media screen AND (max-width:960px){
			
			.navSlide{
				width:100px; 
				font-size:12px; 				
			}
			.navSlide2{
				left:110px;
			}
			.navSlide3{
				left:220px;
			}
			.navSlide4{
				left:330px;
			}
			.navSlide5{
				left:440px;
			}
		}
		@media screen AND (max-width:850px){
			
			.titleContainerSlide1{
				top: 150px;
			}
			
			.navSlide{
				width:200px; 
				padding-top:10px; 
				font-size:16px; 				
			}
			.navSlide1{
				top:-480%;
				left:0px;
			}
			.navSlide2{
				top:-360%;
				left:0px;
			}
			.navSlide3{
				top:-240%;
				left:0px;
			}
			.navSlide4{
				top:-120%;
				left:0px;
			}
			.navSlide5{
				top:0;
				left:0px;
			}
			.navSlide b{
				font-size:13px;
			}
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
				font-size:70px;
			}
		}
		@media screen AND (max-width:730px){
			
			.titleContainerSlide1{
				top: 150px;
			}
			
			.navSlide{
				width:200px; 
				padding-top:10px; 
				font-size:16px; 				
			}
			.navSlide1{
				top:-480%;
				left:0px;
			}
			.navSlide2{
				top:-360%;
				left:0px;
			}
			.navSlide3{
				top:-240%;
				left:0px;
			}
			.navSlide4{
				top:-120%;
				left:0px;
			}
			.navSlide5{
				top:0;
				left:0px;
			}
			.navSlide b{
				font-size:13px;
			}
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide, #titoloSlide5{
				font-size:70px;
			}
		}
		
		@media screen AND (max-width:500px){
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
				font-size:50px;
			}
			
			.navSlide{
				width:150px; 				
			}
			
			.titleContainerSlide1{
				top: 150px;
				left: 30px;
				right: 30px;
				bottom: 50px;
			}
			.progettoBottContainer{
				top: 130px;
				left: 0px;
				right: 30px;
				bottom: 30px;
			}
			.buttMapSlide1{			
				right: 30px;
				bottom: 0px;
				height:50px;
			}
			.nextBtnSlide1{
				right: 30px;
				bottom: 80px;
			}
			.prevBtnSlide1{
				right: 120px;
				bottom: 80px;
			}
		}
		
		@media screen AND (max-width:430px){
			.progettoBott{
				margin-top:190px;
			}
		}
		
		@media screen AND (max-width:400px){			
			.progettoBottContainer{
				top: 170px;
				left: 0px;
				right: 30px;
				bottom: 30px;
			}
			.navSlide{
				width:140px; 				
			}
			.navSlide b {
				font-size:12px;
			}
			.nextBtnSlide1{
				right: 30px;
				width:48px;
				height:48px;
			}
			.prevBtnSlide1{
				right: 90px;
				width:48px;
				height:48px;
			}
			.slideNextSlide1{
				width: 20px; 
				height: 20px; 
				top:14px; 
				left:10px; 
			}
			.slidePrevSlide1{
				position:absolute; 
				width: 20px; 
				height: 20px; 
				top:14px; 
				right:10px; 
			}
			.buttMapSlide1 b{
				font-size:15px !important;				
			}
			.buttMapSlide1{		
				width:180px;
				height:50px;
			}
		}
		
		@media screen and (max-height:820px){
			.titleContainerSlide1 {
				top:120px;
			}
			.progettoBott{
				margin-top:150px;
			}
			.navSlide{
				line-height:0.9; 				
			}
			.navSlideContainer{
				height:40px;
			}
		}
		@media screen and (max-height:780px){
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
				font-size:50px;
			}			
			.navSlideContainer{
				
			}
			#cookieButton{
				bottom:-50px !important
			}
			.buttMapSlide1{
				bottom:-50px !important
			}
			.prevBtnSlide1{
				bottom:30px;
			}
			.nextBtnSlide1{
				bottom:30px;
			}
		    .navSlideContainer {
				bottom:35px;
			}
			.navSlide{
				padding-top:5px;
			}
			.progettoBott{
				margin-top:130px;
			}
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
				line-height:0.75;
			}
			#sottotitoloSlide1, #sottotitoloSlide2, #sottotitoloSlide3, #sottotitoloSlide4, #sottotitoloSlide5 {
				margin-top:5px;
			}

		}
		@media screen and (max-height:780px){
			.progettoBott{
				margin-top:60px !important;
			}
		}
		@media screen and (max-height:780px) and (max-width:600px){
			.progettoBott{
				margin-top:105px !important;
			}
		}
		@media screen and (max-height:780px) and (max-width:850px){
			.progettoBottContainer {
				top:175px;
			}
			.progettoBott{
				margin-top:130px !important;
			}
		}
		@media screen and (max-height:780px) and (max-width:400px){
			.progettoBott{
				margin-top:105px !important;
			}
		}
		@media screen and (max-height:640px){
			.prevBtnSlide1{
				bottom:10px;
			}
			.nextBtnSlide1{
				bottom:10px;
			}
		    .navSlideContainer {
				bottom:15px;
			}
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
				font-size:33px;
			}
			.titleContainerSlide1 {
				top:105px;
			}
			#sottotitoloSlide1, #sottotitoloSlide2, #sottotitoloSlide3, #sottotitoloSlide4, #sottotitoloSlide5 {
				font-size:16px;
			}
			.progettoBott{
				margin-top:35px !important;
			}
		}
		
		@media screen and (max-width:350px){
			#titoloSlide1, #titoloSlide2, #titoloSlide3, #titoloSlide4, #titoloSlide5{
				font-size:28px;
				line-height:0.75;
			}
			#sottotitoloSlide1, #sottotitoloSlide2, #sottotitoloSlide3, #sottotitoloSlide4, #sottotitoloSlide5 {
				font-size:14px;
				line-height:0.9;
				margin-top:5px;
			}
		}
		@media screen and (max-height:550px) and (max-width:350px){
			.progettoBott{
				margin-top:10px !important;
			}
		}
		
</style>