<style>
@if(isset($cmd) && $cmd=="home")
	body, html {
	  margin: 0;
	  padding: 0;
	  overflow: hidden;
	  height: 100%;
	  font-family: 'Arial', sans-serif;
	}

	.container {
	  width: 100%;
	  height: 100%;
	  position: relative;
	}
@else
	body, html {
	  margin: 0;
	  padding: 0;
	  font-family: 'Arial', sans-serif;
	}

	.container {
	  width: 100%;
	  position: relative;
	}
@endif

a{
	text-decoration:none;
	color:#000;
}

#footer a{
	color:#fff;
}

p, span, li {
	font-family:Arial;
	font-size:20px;
	color:#000;
	font-weight:400;
}

.iso-content span, .expand-block__title span{
	font-size:40px;
}

button {
  font-size: 1.5rem;
  padding: 1rem 2rem;
  margin-top: 20px;
  border: none;
  background-color: #ffffff;
  color: #333;
  border-radius: 10px;
  cursor: pointer;
}

.slide {
  position: absolute;
  width: 100vw;
  left: 0;
  display: flex;
  flex-direction: column;
   gap: 0;
  justify-content: center;
  align-items: center;
  font-size: 3rem;
  color: white;
  top: 0;
  text-align: center;
  transition: transform 1s ease;
}
	
.slide > * {
  margin: 0;
}

.slide-2-content {
  visibility: hidden;
}
.slide2-active .slide-2-content {
  visibility: visible;
}


.anim-step {
  opacity: 0;
  transition: all 1s ease-out;
  will-change: opacity, transform;
}

.anim-step.slide-up {
  transform: translateY(30px);
}

.anim-step.slide-down {
  transform: translateY(-100px);
}
.anim-step.slide-left {
  transform: translateX(-30px);
}
.anim-step.zoom {
  transform: scale(2.5);
}
.anim-step.fade {
  transform: none;
}

.anim-step.visible {
  opacity: 1;
}
.anim-step.disappear {
  opacity: 0;
}

.anim-step.slide-down-out {
  transform: translateY(100px);
  opacity: 0;
}

.anim-step.zoom-slide-down-out {
  transform: scale(2);
  transform: translateY(300px);
  opacity: 0;
}

.anim-step.zoom-fade {
  transform: scale(4);
  opacity: 0;
}

.anim-step.static-start {
  opacity: 1;
  transform: none;
}

.slide.slow-transition {
  transition: transform 3s ease !important;
}

.mainTextContainer {
	width:calc(100% - 400px) !important; 
	margin:0 auto;
}
@media screen AND (max-width:1600px){
	.mainTextContainer {	width:calc(100% - 200px) !important; }
}
@media screen AND (max-width:1468px){
	.mainTextContainer {	width:calc(100% - 100px) !important; }
}
@media screen AND (max-width:500px){
	.mainTextContainer {	width:calc(100% - 60px) !important; }
}

.gclose {
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 10px;
  width: 40px;
  height: 40px;
}

.gclose svg {
  width: 100%;
  height: 100%;
  fill: #000;
  transition: fill 0.3s;
}

.gclose:hover svg {
  fill: #E30613;
}

.expand-block__header {
	border-bottom: 2px solid {{config('app.rosso')}} !important;
}

//.mainTextContainer p strong{color:{{config('app.color1')}}}
//.mainTextContainer  ul li strong{color:{{config('app.color1')}}}

ul {
  list-style: none;
  list-style-type: none !important;
  padding-left: 1.5em;
  margin: 1em 0;
}

ul li {
  position: relative;
  list-style-type: none !important;
  padding-left: 1em;
  margin-bottom: 0.5em;
}

ul li::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0.3em;
  width: 8px;
  height: 8px;
  border-right: 2px solid #000;
  border-bottom: 2px solid #000;
  transform: rotate(-45deg);
}/**/


.expand-block__content {
  display: block;
  text-align:justify !important;
  padding: 20px 0;
}

@media screen AND (max-width:650px){
	.expand-block__content{text-align:left !important}
}
</style>