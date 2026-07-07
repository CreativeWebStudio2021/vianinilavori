<style>
	.panel-columns-ajax{
	  display: flex;
	  opacity: 1;
	  transform: translateY(-20px);
	  transition: all 0.5s ease;
	  position:relative;
	}

	/* Colonne */
	.panel-left {
	  flex: 0 0 30%;
	}

	.panel-right {
	  flex: 0 0 70%;
	}
	.boxPartner1 {
	  flex: 0 0 50%;
	}
	.boxPartner2 {
	  flex: 0 0 50%;
	}
	
	/* Il paragrafo rimane normale: impilato uno sotto l'altro */
	.panel-left p {
	  font-weight: 400;	  
	  cursor: pointer;
	  margin: 10px 0;
	  position:relative;
	  font-size:28px;
	  opacity: 1;
	}
	
	#boxPartners {
	  display: flex;
	  opacity: 0;
	  transform: translateX(250px);
	  transition: all 1.5s cubic-bezier(.28,.71,.17,.94);
	  padding-left:100px;
	}

	/* Lo span dentro controlla solo l'interno (testo + freccia) */
	.panel-left-text {
	  align-items: center;
	  height:10px; width:10px;
	  gap: 20px; /* spazio tra testo e freccia */
	  position: relative;
	  background:#fff;
	  padding:0 5px;
	  transition: all 0.3s ease;
	}

	/* Hover sul p (intero) */
	.panel-left p:hover {
	  font-weight: 700;
	}

	/* La freccia */
	.panel-left-text::after {
	  content: '';
	  position: absolute;
	  right: -10px;
	  top: 10px;
	  transform: translateY(-50%);
	  width: 12px;
	  height: 12px;
	  border-right: 2px solid #E73338;
	  border-bottom: 2px solid #E73338;
	  transform: rotate(-45deg);
	  opacity: 0;
	  transition: all 1.5s cubic-bezier(.28,.71,.17,.94);
	}

	/* Hover mostra la freccia */
	.panel-left p:hover .panel-left-text {
	  background:#d9d9d9;		
	}
	.panel-left p:hover .panel-left-text::after {
	  opacity: 1;
	  right: -30px;
	}
	
	#panel-left-text-1, #panel-left-text-2, #panel-left-text-3{		
	  transform: translateX(-200px);
	  opacity:0;
	  transition: transform 1.5s cubic-bezier(.28,.71,.17,.94), opacity 1.5s cubic-bezier(.28,.71,.17,.94);		
	}
	
	.partnersLink{
		cursor:pointer;
		display:flex;
		margin-left:10px;
	}
	.partnersLinkText{
		padding:5px 10px 5px 8px;
		transition: all 0.3s ease;
	}
	.partnersLinkArrow{
		margin-top:7px; 
		width: 12px; height: 12px; 
		border-right: 2px solid #000; 
		border-bottom: 2px solid #000; 
		transform: rotate(-45deg);
		transition: all 0.3s ease;
	}
	.partnersLink:hover .partnersLinkText{
		font-weight:700;
		background:#d9d9d9;
	}
	.partnersLink:hover .partnersLinkArrow{
		border-right: 2px solid #E73338; 
		border-bottom: 2px solid #E73338; 
		margin-left:10px;
	}
	
	/* Primo livello */
	.panel-left > p .panel-left-text {
	  font-size: 28px;
	}

	/* Secondo e terzo livello */
	.sub-items .panel-left-text,
	.sub-sub-items .panel-left-text {
	  font-size: 20px;
	}
	
	.boxPartnerFlex{
		display:flex;
		
	}
	
	.boxPartnersText1{
		padding-left:20px; padding-right:20px; text-align:justify;
	}
	.boxPartnersText2{
		padding-left:20px; padding-right:60px;
	}
	
	.boxPartnersText1,.boxPartnersText2{
		height:130px;
	}
	.boxPartnersText1 b:first-of-type {
		display: block;
		text-align: left;
	  }
	.boxPartnersText2 b:first-of-type {
		display: block;
		text-align: left;
	  }
	
	.boxPartner1a{flex: 0 0 25%;}
	.boxPartner1b{flex: 0 0 75%;}
	.boxPartner2a{flex: 0 0 15%;}
	.boxPartner2b{flex: 0 0 85%;}
	
	@media screen AND (max-width:1630px) {
		.panel-left {
		  flex: 0 0 20%;
		}

		.panel-right {
		  flex: 0 0 80%;
		
	}
	@media screen AND (max-width:1330px) {
		.panel-left {
		  flex: 0 0 20%;
		}

		.panel-right {
		  flex: 0 0 80%;
		}
		.boxPartnersText1,.boxPartnersText2{
			height:165px;
		}
	}
	
	
	@media screen AND (max-width:1024px) {
	.panel-columns-ajax{
	  height:630px;
	}
	
   	 panel-left{
		  padding-bottom:150px;	  }
	  .panel-columns-ajax {
		flex-direction: column;
	  }
	  #boxPartners{
		flex-direction: column;
		padding-left:0;
	  }
	  .boxPartnerFlex{
			flex-direction: column;;
		}
		
	  .panel-right img{
		  width:50% !important;
		  margin-bottom:10px;
	  }
	  .boxPartner1 {
		  flex: 0 0 100%;
		}
		.boxPartner2 {
		  flex: 0 0 100%;
		  margin-top:20px;
		}
	  
	  .boxPartnersText1{
			height:115px; 
		}
	  
	  .boxPartnersText2{
			height:135px; 
		}
	  
	  .panel-left,
	  .panel-right {
		flex: 0 0 auto;
		width: 100%;
	  }
		
	  .panel-left-text {		  
		  background:rgba(255,255,255,0);
		  margin-bottom:20px;
		}
		
	  .panel-left-text::after {
		  top: 4px;
		}
		
	   .panel-left p {
		  margin: 5px 0 20px 0;
		}
		
	  .panel-right img {
		margin-top: 0px;
		width: 100%;
		height: auto;
	  }
		
		.panel-left-text.first{
			font-size:18px !important;
			font-weight:700;
		}
		.panel-left-text.first span{
			font-size:18px !important;
		}
		
	  /* RIDUZIONE FONT E PADDING */
	  .panel-left > p .panel-left-text {
		font-size: 20px;
		padding: 0 3px;
	  }
	  
	  .panel-left p:hover .panel-left-text::after {
	  opacity: 1;
		  right: -20px;
		}
		
	  
	  .sub-items .panel-left-text,
	  .sub-sub-items .panel-left-text {
		font-size: 17px;
		padding: 0 3px;
	  }

	  /* RIENTRI RIDOTTI */
	  .sub-items,
	  .sub-sub-items {
		margin-left: 8px;
	  }
	  
	  #inEvidenzaTxt{
			padding-left:0px; 
		}
	  
	  .boxPartnersText1{
			padding-left:0; padding-right:0; text-align:justify;
		}
		.boxPartnersText2{
			padding-left:0; padding-right:0; text-align:justify;
		}
	    .boxPartnersText2 b:first-of-type {
			display: block;
			text-align: left;
		  }
		
		.panel-left-text::after{
			opacity:1;
			right:-20px;
		}
		
		.partnersLink{margin-left:0}
		.partnersLinkText{
			padding:5px 10px 5px 0px;
		}
	}
	.gapEtica{display:none}
	@media screen AND (max-width:1280px){
		.gapEtica{display:inline}
	}
	
</style>

<div style="width:100%;" class="panel-columns-ajax">
	<div class="panel-left" id="panel-left">
		<p id="panel-left-text-1">
			<a href="il-gruppo.html" title="Il Gruppo - {{ config('app.name') }}">
				<span class="panel-left-text">Il Gruppo</span>
			</a>
		</p>
	</div>
	
    <div class="panel-right" id="panel-right">
      <div id="boxPartners">
			<div class="boxPartner1">
				<div  class="boxPartnerFlex">
					<div class="boxPartner1a">
						<img src="{{ asset('web/images/logo-caltagirone.png') }}" alt="Gruppo Caltagirone" style="width:100%;"/>
					</div>
					<div class="boxPartner1b">
						<div class="boxPartnersText1">
							<b>LA CONTROLLANTE</b>
							<br/>
							Caltagirone è la holding quotata alla Borsa di Milano di uno dei principali gruppi industriali privati italiani.
						</div>
						<div class="partnersLink">
							<div style="width:110px;">
								<div class="partnersLinkText">
									<a href="https://www.caltagironespa.it/" target="_blank">Visita il sito</a>
								</div>
							</div>
							<div style="width:calc(100% - 110px);">
								<div class="partnersLinkArrow"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="boxPartner2">
				<div class="boxPartnerFlex">
					<div class="boxPartner2a">
						<img src="{{ asset('web/images/LOGO_Eteria.png') }}" alt="Eteria" style="width:80px;"/>
					</div>
					<div class="boxPartner2b">
						<div class="boxPartnersText2">
							<b>PRINCIPALE SOCIETÀ CONTROLLATA</b>
							<br/>
							Il Consorzio Stabile Eteria è il grande polo italiano delle grandi opere, in grado di sviluppare importanti progetti infrastrutturali.<br/>
						</div>
						<div style="display:flex;" class="partnersLink">
							<div style="width:110px;">
								<div class="partnersLinkText">
									<a href="https://www.consorzioeteria.it/" target="_blank">Visita il sito</a>
								</div>
							</div>
							<div style="width:calc(100% - 110px);">
								<div class="partnersLinkArrow"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>