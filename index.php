<? session_start();
   require_once("classes/troomguest.inc.php"); 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--<meta charset="utf-8">-->
<meta http-equiv="cache-control" content="max-age=10" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="10" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="fb:app_id" content="1547140692231372" />
<meta name="description" content="New Generation Free Online tuition room">
<meta name="keywords" content="tuitionroom">
<meta name="author" content="tuitionroom">
<title>Online Tuition and Coaching for School and Competitive Exams.</title>
<?php include("header_ajax.html"); ?>
<link rel="stylesheet" href="https://www.tuitionroom.com/css/Owl-carousel.min.css">
<link href="https://fonts.googleapis.com/css?family=Cagliostro|Gloria+Hallelujah" rel="stylesheet">
<style type="text/css">
@media screen and (max-width: 480px) {.img-responsive { max-width:120px; margin:0px auto;}}
.myinverse {background-color:rgba(30,136,229,0.2);
border:none;
-webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.img-responsive { margin:0px auto !important;}
.textoverflow {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis; 
}

.owl-nav, .owl-dots, .owl-controls {
	display: none
}
.owl-stage:hover, .owl-stage a:hover {    
	cursor: move;
	cursor: grab;
    cursor: -moz-grab;
    cursor: -webkit-grab;
	}
.owl-stage:active, .owl-stage a:active { 
    cursor: grabbing;
    cursor: -moz-grabbing;
    cursor: -webkit-grabbing;
}	

#fteacher.owl-carousel .owl-stage-outer {height:185px;}
#courses img {width:200px; margin:0px auto;background: white; padding: 10px 20px; border-radius:2px;border:3px solid #d7d7d7;}
.person-text a { font-size:14px;}
.textoverflow {
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
	text-transform: capitalize
}
hr.separetor {
    margin: 5px auto;
    width: 100px;
    border-top: 2px solid #cecece;
}
/* Video overlay and content */
.video-overlay {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  pointer-events: none;
  /* Allows right click menu on the video */
  background: url("img/black-small-checks.png") left top repeat;
  opacity: 0.5;
  background-color:rgba(158,158,158,0.2);
}

.video-hero--content {
  position: relative;
  text-align: center;
  color: #FFF;
  margin:140px 0px 180px 0px;  
  font-family: Raleway,Verdana,Geneva,sans-serif;
}

.video-hero--content h2 {  
    font-family:'Cagliostro', sans-serif;
    font-style: normal;
  font-size: 7vmin;
  margin: 0 0 10px;
}

.video-hero--content p {
  font-family:'Gloria Hallelujah', cursive; 
  font-size: 3.5vmin;
  /*text-align: left;
   width: 450px;*/
   margin: 0 auto;
}
/*@media screen and (max-width: 480px) {.video-hero--content p {   width: 230px;}	}*/
.video-hero--content ul {    margin: 10px auto;}
/* CSS from jQuery Background Video plugin */
/**
 * Set default positioning as a fallback for if the plugin fails
 */
.jquery-background-video-wrapper {
  position: relative;
  overflow: hidden;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
}

.jquery-background-video {
  position: absolute;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  top: 50%;
  left: 50%;
  -o-object-fit: contain;
  object-fit: contain;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

/**
 * Fade in videos
 * Note the .js class - so non js users still
 * see the video
 */
.js .jquery-background-video {
  opacity: 0;
  -webkit-transition: opacity 300ms linear;
  transition: opacity 300ms linear;
}

.js .jquery-background-video.is-visible {
  opacity: 1;
}

/**
 * Pause/play button
 */
.jquery-background-video-pauseplay {
  position: absolute;
  background: transparent;
  border: none;
  box-shadow: none;
  width: 20px;
  height: 20px;
  top: 15px;
  right: 15px;
  padding: 0;
  cursor: pointer;
  outline: none !important;
}

.jquery-background-video-pauseplay span {
  display: none;
}

.jquery-background-video-pauseplay:after,
.jquery-background-video-pauseplay:before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  -webkit-transition: all .3s ease;
  transition: all .3s ease;
}

.jquery-background-video-pauseplay.play:before {
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-left: 15px solid #FFF;
}

.jquery-background-video-pauseplay.pause:before,
.jquery-background-video-pauseplay.pause:after {
  border-top: 10px solid #FFF;
  border-bottom: 10px solid #FFF;
  border-left: 5px solid #FFF;
}

.jquery-background-video-pauseplay.pause:after {
  left: 10px;
}

/*MY STYLES*/
/*.btn-Trial {border-radius:25px;opacity: 1;min-width: 202px;padding: 1rem 2em;line-height: 1.5;font-weight:600; margin:10px auto;}
.btn-Trial2 { border-radius:0px;}
.bt2 {
    color: #fff;
    background-color:#fe9d68;
    border-color:#fe9d68;
	}
.bt1 {color: #fff;
    background-color: #2196f3;
    border-color: #2196f3;}
.bt2:hover, .below-footer .btn3:hover, .bt1:hover { opacity:0.7; transition:300ms linear; color:white;}	*/
/* Course Search Bar */
/*.course-search {
	position: relative;
	background: #fff;
}
*//*.course-search:before {
	content: 'OR';
    font: normal normal normal 16px/1 'Open Sans',sans-serif; 
    display: block;
    background: #fff;
    width: 80px;
    height: 30px;
    position: absolute;
    left: 50%;
    top: -30px;
    z-index: 20;
    line-height: 36px;
    margin-left: -40px;
    color: #a9abb0;
    text-align: center;
    border-radius: 2px 2px 0 0;
}
*/
.fancy-shadow {
	box-shadow: 0 1px 1px rgba(0, 0, 0, .1);
	position: relative;
}

.ib {
    display: inline-block;
}

.p0 { padding:0px !important;}
.p5 { padding:5px !important;}
.p10 {padding:10px !important;} 
.ptb10 { padding-top:10px; padding-bottom:10px;}
@media screen and (max-width: 480px) {
.p10 {padding:20px 0px !important;} 
}
.pt30 {padding-top: 30px !important;}
.pt20 {padding-top: 20px !important;}
.pb20 {padding-bottom: 20px !important;}
.pt10 {padding-top: 10px !important;}
.p30 {padding: 30px!important;}
.p10-0 {padding: 10px 0px !important;}
.p15-0 {padding: 15px 0px !important;}

.m0 { margin:0px !important;}
.mt0 {margin-top: 0 !important;}
.mt30 {margin-top: 30px !important;}
.m10 {margin: 10px auto !important;}

.w50 { width:45px;}
.w150 {width: 150px;}
.w180 {width: 180px;}

.pl50 p {letter-spacing:0.5px;}
.pl50 {padding:0;padding-left:40px;}
.pb30 {padding-bottom: 30px;}
.pb10 {padding-bottom: 10px;}
.ls05 {letter-spacing: 0.5px;}
.ls15 {letter-spacing: 1.5px;}
.ls1 {letter-spacing: 1px;}
.f16 {font-size: 16px;}
.f18 {font-size: 18px;}
.f20 {font-size: 20px;}
.lh20 {line-height: 20px;}
.lh25 {line-height: 25px;}

.z10 {z-index:10}
.image300 { width:300px;}
.h60 {height:60px}
.h40 {height:40px}
/*DROPDOWN CSS*/
/*select {
  display: none;
}

.dropdown {
  background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40FFFFFF', endColorstr='#00FFFFFF', GradientType=0);
  background-color: #fff;
  border-radius: 1px;
  border: solid 1px #fe9d68;
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.0075);
  box-sizing: border-box;
  cursor: pointer;
  display: block;
  float: left;
  font-size: 12px;
  font-weight:bold;
  height: 42px;
  line-height: 40px;
  outline: none;
  padding-left: 18px;
  padding-right: 30px;
  position: relative;
  text-align: left !important;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  white-space: nowrap;
  width: 100%;
  color:#fe9d68;
}
.dropdown:focus {
  background-color: #fff;
}
.dropdown:hover {
  background-color: #fff;
}
.dropdown:active, .dropdown.open {
  background-color:#f7cab1 !important;
  border-color: #fff;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;
}
 
  
  .dropdown .carat:after {
    font-family: 'FontAwesome';
    content: '\f107';
    position: absolute;
    left: 5px;
    top: 0;
    color: #fff;
    line-height: 1.5;
} 
   
  .carat {
	  position:absolute;
	   right: 9px;
    top: 14px;
    width: 18px;
    height: 18px;
    margin-top: -5px;
    z-index: 1;
    background: #fe9d68;
    border-radius: 2px;
    -webkit-transform-origin: 50% 20%;
    -moz-transform-origin: 50% 20%;
    -ms-transform-origin: 50% 20%;
    transform-origin: 50% 20%;
}
.dropdown.open:after {
  -webkit-transform: rotate(-180deg);
          transform: rotate(-180deg);
}
.dropdown.open .list {
  -webkit-transform: scale(1);
          transform: scale(1);
  opacity: 1;
  pointer-events: auto;
}
.dropdown.open .option:hover { background-color:#fbe7dc !important; transition:300ms linear;}
.dropdown.open .option {
  cursor: pointer;
}
.dropdown.wide {
  width: 100%;
}

.dropdown.wide .list {
  left: 0 !important;
  right: 0 !important;
}
.dropdown .list {
	width:100%;
  box-sizing: border-box;
  -webkit-transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
  transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
  -webkit-transform: scale(0.75);
          transform: scale(0.75);
  -webkit-transform-origin: 50% 0;
          transform-origin: 50% 0;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);
  background-color: #fff;
  border-radius: 1px;
  margin-top: 4px;
  padding: 3px 0;
  opacity: 0;
  overflow: hidden;
  pointer-events: none;
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 999;
}
.dropdown .list:hover .option:not(:hover) {
  background-color: transparent !important;
}

.dropdown .list ul { height:180px; overflow-x:auto;}

.dropdown .option {
  cursor: default;
  font-weight: 400;
  line-height: 40px;
  outline: none;
  padding-left: 18px;
  padding-right: 29px;
  text-align: left;
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}
.dropdown .option:hover, .dropdown .option:focus {
  background-color: #f6f6f6 !important;
}
.dropdown .option.selected {
  font-weight: 600;
}
.dropdown .option.selected:focus {
  background: #f6f6f6;
}

.course-name {
	width: 100%;
	height: 40px;
	border-radius: 1px;
	font-style: italic;
	font-size: 13px;
	padding-left: 9px;
	margin-right: 10px;
	border: 1px solid #fe9d68;
	outline:none;
}*/
.btn-search, .btn-search:active, .btn-search:focus {background-color:#fe9d68 ; color:white; width:120px; outline:none;}
.btn-search:hover {background-color: #03a9f4; color:white; transition:250ms linear;}
.bghiw {background:#f9f9f9;}
.hiw {text-align:center;padding: 10px 0px 30px 0px;}
h3.section-title {font-size: 24px;color: #fe9d68;font-family:'Cagliostro', sans-serif;}
h3.section-title span { border-bottom: 1px;
    border-style: dotted;
    border-top: none;
    border-right: none;
    border-left: none;}
.hiw p { font-size:13px;}
.hiw img { max-width:75px;margin:0 auto !important;}
.hiw h4 {color: #f06922;}
#featuredteachers { text-align:center;background: none;background-color: whitesmoke;box-shadow: 0px 1px 5px 0px #d2d1d1;} 
/*#featuredteachers .img-thumbnail {
	-webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: none;
	-webkit-filter: grayscale(0%);  
    filter: grayscale(0%);}
#featuredteachers .img-thumbnail:hover { -webkit-filter: grayscale(10%); filter: grayscale(10%); transition:300ms linear;}	*/
.btn-teacher {background-color:#fe9d68 ; color:white; width:250px;}
.btn-teacher:hover {background-color: #383c4b; color:white; transition:250ms linear;}

.features {padding-top:50px;}
.featured-item.myfeatured{
	padding-top: 0;
    min-height: auto;
    padding-bottom: 0;
    height: 30px;
		}
	
.myfeatured.featured-item .icon {
  display: inline-block;
  width: 48px;
  height: 48px;
  top: 0px;
}	

.featured-item {
  position: relative;
  padding-top: 15px;
  padding-bottom: 15px;
  padding-left: 50px;
}
.featured-item h4 {
  margin: 0;
}
.featured-item p {
  margin-top: 5px;
}
.featured-item .icon {
  display: inline-block;
  width: 50px;
  height: 50px;
  position: absolute;
  top: 15px;
  left: -10px;
}
.featured-item .icon-featured-1 {
  background: url('https://www.tuitionroom.com/img/24-hours.svg') no-repeat;
}
.featured-item .icon-featured-2 {
  background: url('https://www.tuitionroom.com/img/teacher.svg') no-repeat;
}
.featured-item .icon-featured-3 {
  background: url('https://www.tuitionroom.com/img/video-conference.svg') no-repeat;
}
.featured-item .icon-featured-4 {
  background: url('https://www.tuitionroom.com/img/wallet.svg') no-repeat;
}
.featured-item .icon-featured-5 {
  background: url('https://www.tuitionroom.com/img/Courses-48.png') no-repeat;
}
.featured-item .icon-featured-6 {
  background: url('https://www.tuitionroom.com/img/classroom-48.png') no-repeat;
}
.featured-item .icon-featured-7 {
  background: url('https://www.tuitionroom.com/img/Students-48.png') no-repeat;
}
/* SECTION 1 */
.mc-section-1 {
  padding: 68px 0;
}
.mc-section-1-content-1 .big {
	font-family:'Cagliostro', sans-serif;
  margin-bottom: 15px;
      font-size: 30px;
    line-height: 1em;
    color: #666;	
}
@media screen and (max-width: 480px) {
.mc-section-1-content-1 .big{text-align:center;}
}
.mc-text {
  font-family: 'Raleway', sans-serif;
  font-size: 16px;
  line-height: 1.7em;
  color: #666;
  margin-bottom: 25px;
}

.below-footer {
	color:#8b898a;
    background-color:#efefef;
    background-image: url(img/pattern-s.png);
    background-position: top center;
    background-repeat: repeat;
    background-attachment: scroll;
    background-size: auto; 
	height:80px;
} 
.below-footer .col-md-4 { padding: 15px 0;}
@media screen and (max-width: 480px) {.below-footer { text-align:center;}}
.below-footer ul { margin-top:10px;}
.below-footer h4{font-size: 30px;font-weight: 700;line-height:1;margin: 0;}
.below-footer p{font-size:20px; line-height:0.5;font-family: 'Cagliostro', sans-serif;    padding-left: 4px;}
.below-footer .btn3 { background-color:#2196f3; border-color:#2196f3; color:white;}
.timer {color:orange;}
.timer1 {color:#00acc2}
.timer2 {color:#d055f1}
.cbg {background: #f0f0f0 url(img/lined_paper.png);}
.counselling { padding-top:10px;}
@media screen and (max-width: 480px) {.counselling {text-align:center;}}
.counselling h2 {font-style: normal; font-weight:300;font-family:'Cagliostro', sans-serif; font-size:6vmin;}
.counselling h2 small { font-size:50%;}
.counselling p,.languaguecourse p {font-family:'Raleway', cursive;font-size:14px;line-height:2;color: #3c3c3c;letter-spacing: 0.5px; padding-top:15px; }
.counselling .btn-appointment {background-color: #fe9d68;color: white; text-decoration:none; margin-bottom:20px;}
.counselling .btn-appointment:hover {background-color:#2196F3;color:#fff; transition:300ms linear;}
.counselling .btn-appointment a:hover {color:white;}
#featuredteachers{
    background-color:#efefef;
    background-image: url(img/pattern-s.png);
    background-position: top center;
    background-repeat: repeat;
    background-attachment: scroll;
    background-size: auto;    
	}
.languaguecourse { padding:20px 0px 0px 0px; background-color:#03A9F4; color:white; background-image: url(img/pattern_school.png);
    background-repeat: repeat;
    background-size: auto;
    background-attachment: fixed;
}
.languaguecourse h2 {font-style: normal;    font-weight: 300;    font-family:'Cagliostro', sans-serif;  font-size:6vmin;}
.languaguecourse h2 small { font-size:65%; color:white;}	
.languaguecourse p, .languaguecourse .heading {color:white}
/*--header--*/
.bottom-head {
	text-align: center;
  	border-right:1px solid #cecece;
  	padding: 0; 
  	float: left;
  	/*width: 14.285%;*/
	width:16.66666666666667%;
}
.bottom-head:nth-child(7) {
	border-right: none;
}
.bottom-head a {
  	text-decoration: none;  	
  	display: block;	
  	height: 120px;
    position: relative;
}

.buy-media{
	position: absolute;
  bottom: 0;
  height: 120px;
  overflow: hidden;
  padding: 30px;
    width: 100%;
  background-color: #fff;
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  -webkit-transition: -webkit-transform .2s ease,height .2s ease;
  -moz-transition: -moz-transform .2s ease,height .2s ease;
  -o-transition: -o-transform .2s ease,height .2s ease;
  transition: transform .2s ease,height .2s ease;
}
.bottom-head  h6{
	font-size: 1em;
	color:#919090;
	margin: 0.5em 0 0;
}

.bottom-header{
	position: relative;
}
.header-bottom {  	
    position: absolute;
  	z-index: 999;
    top: -135px;
  	width: 100%;
}
.buy-media i { 
display: block;
	margin: 0 auto;
	width: 32px;
	height: 32px;
}
i.buy{	
	background: url(https://www.tuitionroom.com/svg/cbse.svg);	
}
i.rent{
	 background: url(https://www.tuitionroom.com/svg/icse.svg);
}
i.pg{
	background: url(https://www.tuitionroom.com/svg/igcse.svg);
}

i.sell{
	background: url(https://www.tuitionroom.com/svg/iit-jee.svg);
}
i.loan{
	background: url(https://www.tuitionroom.com/svg/neet.svg);
}
i.apart{
	/*background: url(https://www.tuitionroom.com/svg/languages.svg);*/
	background: url('svg/music/more.svg') no-repeat;
}
i.deal{
	background: url(https://www.tuitionroom.com/svg/hobby.svg);
}
.bottom-head a:hover .buy-media {
  height: 140px;
  -webkit-box-shadow: 0 0 40px rgba(255,255,255,.6), inset 0 0 40px rgba(255,255,255,1);
  -moz-box-shadow: 0 0 40px rgba(255,255,255,.6), inset 0 0 40px rgba(255,255,255,1);
  box-shadow: 0 0 40px rgba(255,255,255,.6), inset 0 0 40px rgba(255,255,255,1);

}
@media(max-width:768px){	
 
.buy-media {
  height: 104px;
  padding: 25px 10px;
}
.bottom-head a {
  height: 104px;
}
.bottom-head a:hover .buy-media {
  height: 140px;
}
}
@media(max-width:640px){
 
.bottom-head h6 {
  font-size: 0.75em;
}
.buy-media {
  padding: 25px 2px;
}}
@media(max-width:480px){

.buy-media {
  padding: 15px 2px;
  height: 80px;
}
.bottom-head { width:33%;}
.bottom-head a {
  height: 70px;
}
.bottom-head a:hover .buy-media {
  height: 100px;
}
.bottom-head:nth-child(7) {display:none;}

}
@media(max-width:320px){
.container {
  padding-right: 0px;
  padding-left: 0px;
}

.buy-media {
  	height: 60px;
  	padding: 14px 2px;
}
.bottom-head a {
  	height: 60px;
}
.bottom-head a:hover .buy-media {
  	height: 100px;
}
}
 
#quote-carousel .carousel img {width:50px;}
#quote-carousel {
    padding: 0 10px 30px 10px;
    margin-top: 60px;
}
#quote-carousel .carousel-control {
    background: none;
    color: #CACACA;
    font-size: 2.3em;
    text-shadow: none;
    margin-top: 30px;
}
#quote-carousel .carousel-indicators {
    position: relative;
    right: 50%;
    top: auto;
    bottom: 0px;
    margin-top: 20px;
    margin-right: -19px;
}
#quote-carousel .carousel-indicators li {
    width: 50px;
    height: 50px;
    cursor: pointer;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    opacity: 0.2;
    overflow: hidden;
    transition: all .4s ease-in;
    vertical-align: middle;
}
#quote-carousel .carousel-indicators .active {
    opacity: 1;
    transition: 300ms linear;
    border-radius: 50%;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4);
    position: relative;
}
.item blockquote {
    border-left: none;
    margin: 0;
}
.item blockquote p:before {
    content: "\f10d";
    font-family: 'Fontawesome';
    float: left;
    margin-right: 10px;
}
 .bghiw, .testimonials { padding-top:20px;background: #f0f0f0 url(img/map.png) center center no-repeat fixed;    background-size: cover;}
.heading {font-size: 24px;    color: #fe9d68;    font-family: 'Cagliostro', sans-serif; text-align:center;}
.heading span {border-bottom: 1px;
    border-style: dotted;
    border-top: none;
    border-right: none;
    border-left: none;}
 

.number {
    width: 80px;
    height: 80px;
    background: yellowgreen;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    border-radius: 50px;
    float: left;
    line-height: 80px;
    font-size: 6vmin;
	font-weight:bold;
	text-align: center;
    color: white;
    text-shadow:1px 2px 2px #696868;
	}
.blue  {background-color: #03a9f4;}
.elo    {background-color:#FF9800;}
.voilet {background-color:#814fda;}
.redish {background-color:#e6574c;}
.mybtn1 {
    font-size:2.3vmin;
    text-align: center;
    color: white;
	width:auto;
	}
.smilbtn {padding: 1rem 2em; font-weight:bold; border-radius:2px; width:auto;}

 .team-area {
    padding: 10px 0px 30px 0px;
	color: white;
    background-color: rgb(43, 125, 178);
    background-image: url(img/pattern_school.png);
    background-repeat: repeat;
    background-size: auto;
    background-attachment: fixed;
}   
 
.team-area .heading {color:white;padding-bottom:00px;text-align:center;font-size:4vmin;}
.team-area .heading strong {color:yellow;}
 
.team-area .mybtn { width:auto; text-align:center;}

.team-area.cbg, .team-area.cbg .heading {color:#5d5c5c;}
.team-area.cbg .heading strong {color:#fe9d68;}	

.leftsec h4 {font-family: 'Cagliostro', sans-serif;font-size:22px;}
/* // Custom autocomplete UI Jquery // */
ul.ui-autocomplete {
  position:absolute !important;
  top:0 !important;
  z-index:98; 
}
ul.ui-autocomplete li.ui-menu-item {  
  list-style:none;
  background-color:#fefefe;
  border:0; 
  padding:6px 8px;
  font-size:12px;
  overflow:hidden;
  text-transform:capitalize;  
  font-style:italic;
  border-bottom:1px solid #e0e0e0;
}
ul.ui-autocomplete li.ui-menu-item a {
    color:#000;cursor:pointer;
}
ul.ui-autocomplete li.ui-menu-item strong {
    font-weight:inherit
}
ul.ui-autocomplete li.ui-menu-item:first-child {
   margin-top:40px;
}
ul.ui-autocomplete li.ui-menu-item:last-child {
   margin-bottom:25px;
}
ul.ui-autocomplete li.ui-menu-item strong {
  color:gray;
}
ul.ui-autocomplete li.ui-menu-item:hover , ul.ui-autocomplete li.ui-menu-item:focus,
ul.ui-autocomplete li.ui-menu-item.ui-state-focus {
   background-color:lightgray; cursor:pointer;
}
.ui-helper-hidden-accessible {
  display:none;
}
.typed-cursor {display:none;}
/*IIT FOUNDATION CSS*/
.iit-foundation {
    	padding:5px 0px 25px 0px;
        background-color:#f5f7fa;
	    background-attachment: fixed;
        position:relative;
        overflow:hidden;		
        }
@media screen and (min-width: 480px) {
.iit-foundation:after{
        width:50%;
        position:absolute;
        right:0;
        top:0;
        content:"";
        display:block;
        height:100%;
        background-color:#e6e9ed;
	    background-attachment: fixed;
        z-index:1;}
}
.iit-foundation h3 { margin-top:0;    font-family: 'Cagliostro', sans-serif; font-size:4vmin;}
.iit-foundation, .iit-foundation h3 small {color:#3c3d48;}
.iit-foundation h4 {color:gray; font-style:italic; font-size: 3vmin;}
.iit-foundation	p {font-size: 2.2vmin;}
.ptext {	
    font-size: 15px;
    margin-bottom: 25px;
    font-style: italic;
	}
</style>
<style type="text/css">
.hobby {    
    background: url(img/music-bg.png);
	background-size: contain;
    padding:30px 0px 40px 0px;
}   
.hobby.overlay-bg {
    position: relative;
}
.hobby.overlay-bg::after {
    background: #171717 none repeat scroll 0 0;
    content: "";
    height: 100%;
    left: 0;
    opacity:0.4;
    position: absolute;
    top: 0;
    width: 100%;
}
.hobby-wrap {
    position: relative;
    z-index: 5;
}

.hobby .heading {color: white;font-size: 28px;}
.hobby h2 small{color:white; font-size:60%;}
.hobby .icon {display: block;
    margin: 0 auto;
    width:80px;
    height:80px;}

.hobbybox {
	border:1px solid #bfbfbf; 
    padding-top: 20px;
    border-radius: 2px;
	background-color:#fff;    
}	
.hobbybox:hover {
	cursor:pointer;
	-webkit-box-shadow: 0 0 40px rgba(255,255,255,.6), inset 0 0 40px rgba(255,255,255,1);
    -moz-box-shadow: 0 0 40px rgba(255,255,255,.6), inset 0 0 40px rgba(255,255,255,1);
    box-shadow: 0 0 40px rgba(255,255,255,.6), inset 0 0 40px rgba(255,255,255,1);
	transition:300ms linear;
	}
.hobbybox p { font-style:italic;}
.synthesizer {background: url('svg/music/synthesizer.svg') no-repeat;}
.guitar {background: url('svg/music/guitar.svg') no-repeat;}
.violin {background: url('svg/music/violin.svg') no-repeat;}
.drum {background: url('svg/music/drum.svg') no-repeat;}
.jazz {background: url('svg/music/jazz.svg') no-repeat;}
.dance {background: url('img/dance-b.png') no-repeat;}

.wrapper {background: url('svg/music/wrapper.svg') no-repeat;}
.crochet {background: url('svg/music/crochet.svg') no-repeat;}
.sewing {background: url('svg/music/sewing-machine.svg') no-repeat;}
.painting {background: url('svg/music/painting.svg') no-repeat;}

.craft {background: url('svg/music/water-craft.svg') no-repeat;}
.cooking {background: url('svg/music/cooking.svg') no-repeat;}
.fitness {background: url('svg/music/fitness.svg') no-repeat;}
.gardening {background: url('svg/music/plants.svg') no-repeat;}
.homedecor {background: url('svg/music/chandelier.svg') no-repeat;}
.yoga {background: url('svg/music/yoga.svg') no-repeat;}
.more {background: url('svg/music/more.svg') no-repeat;}

.hobby .big {font-family: 'Cagliostro', sans-serif;
    margin-bottom: 25px;
    font-size: 30px;
    line-height: 1em;
    color: #fff;
}
.hobby .mc-text {font-family: 'Raleway', sans-serif;  font-size: 16px;  line-height: 1.7em;color: #fff;}
</style>
<style type="text/css">
/*ZoomIn Hover Effect*/
    .rel a {
      display: block;
      position: relative;
      overflow: hidden;
    }
    .rel img {
      width: 100%;
      height: auto;
      -webkit-transition: all 0.5s ease-in-out;
      -moz-transition: all 0.5s ease-in-out;
      -o-transition: all 0.5s ease-in-out;
      -ms-transition: all 0.5s ease-in-out;
      transition: all 0.5s ease-in-out;
    }
    .rel:hover img {
      -webkit-transform: scale(1.2);
      -moz-transform: scale(1.2);
      -o-transform: scale(1.2);
      -ms-transform: scale(1.2);
      transform: scale(1.2);
    }
</style>
</head>
<body>
<section id="videoheight">
 
<div class="video-hero jquery-background-video-wrapper demo-video-wrapper">
  <video class="jquery-background-video" autoplay muted loop poster="https://www.tuitionroom.com/img/bg.png" id="video">
    <source src="https://www.tuitionroom.com/bg.mp4" type="video/mp4" />
  </video>
	  <div class="video-overlay"></div>
  	<div class="page-width">
		    <div class="video-hero--content">
			      <h2>Study Online in Friendly Way</h2>
			      <p>With real teachers in live Online classes</p>
              
    		</div>
  	</div>
</div>
 
</section>
<style>
.arrow:before {
   position: absolute;
    content: " ";
    width: auto;
    height: auto;
    left: 50%;
    border-width: 15px;
	bottom:-30px;
    border-style: solid;
    border-color: #fff rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
	z-index:9999;
	}
</style>
<div class="banner-bottom-top">
			<div class="container">
			<div class="bottom-header">
				<div class="header-bottom">
					<div class=" bottom-head ">
						<a href="index.php" class="smoothscroll" onClick="getBoardDetails('CBSE','cbselist');return false;" id="cbselist">
                        <div class="arrow">
							<div class="buy-media">
								<i class="buy"> </i>
								<h6>CBSE Syllabus</h6>
							</div>
                            </div>
						</a>
					</div>
					<div class="bottom-head">
						<a href="index.php" class="smoothscroll" onClick="getBoardDetails('ICSE','icselist');return false;" id="icselist">
                         <div class="arrow">
							<div class="buy-media">
							<i class="rent"> </i>
							<h6>ICSE Syllabus</h6>
							</div>
                            </div>
						</a>
					</div>
					<div class="bottom-head">
						<a href="index.php" class="smoothscroll" onClick="getBoardDetails('IGCSE','igcselist');return false;" id="igcselist">
                         <div class="arrow">
							<div class="buy-media">
							<i class="pg"> </i>
							<h6>IGCSE Syllabus</h6>
							</div>
                            </div>
						</a>
					</div>
					<div class=" bottom-head">
						<a href="index.php" class="smoothscroll" onClick="getBoardDetails('IIT','iitlist');return false;" id="iitlist">
                         <div class="arrow">
							<div class="buy-media">
							<i class="sell"> </i>
							<h6>IIT-JEE Preparation</h6>
							</div>
                            </div>
						</a>
					</div>
					<div class="bottom-head">
						<a href="javascript:" class="smoothscroll">
							<div class="buy-media">
							<i class="loan"> </i>
							<h6>NEET-Preparation</h6>
							</div>
						</a>
					</div>
					<div class=" bottom-head">
						<a href="#languaguecourse" class="smoothscroll">
							<div class="buy-media">
							<i class="apart"> </i>
							<h6>More</h6>
							</div>
						</a>
					</div>
					<!--<div class=" bottom-head">
						<a href="#hobbie" class="smoothscroll">
							<div class="buy-media">
							<i class="deal"> </i>
							<h6>Hobby Courses</h6>
							</div>
						</a>
					</div>-->
					<div class="clearfix"> </div>
				</div>
			</div>
	</div>
	</div>
<section class="advancesearch" id="advancedsearch">
</section>



<section class="below-footer">
<div class="container">
<div class="row">
<div class="col-md-offset-2 col-md-8 col-sm-offset-0 col-sm-12 col-xs-12">

<div class="col-md-4 col-sm-4 col-xs-4" onClick="notify();">
<div class="featured-item myfeatured">
<i class="icon icon-featured-5"></i>
<h4 class="title-box text-uppercase timer"></h4>

<p>Courses</p>
</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-4">
<div class="featured-item myfeatured">
<i class="icon icon-featured-6"></i>
<h4 class="title-box text-uppercase timer1"></h4>
<p>Teachers</p>
</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-4">
<div class="featured-item myfeatured">
<i class="icon icon-featured-7"></i>
<h4 class="title-box text-uppercase timer2"></h4>
<p>Students</p>
</div>
</div>
</div>

<!--<div class="col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12">
<ul>
<li class="btn btn-Trial btn-Trial2 btn3">Become A Member</li>
<li class="btn btn-Trial btn-Trial2 bt2">Become A Teacher</li>
</ul>
</div>
-->
</div>

 
</div> 
</section>



<section class="team-area" id="cbsetuition">
<div class="container">
<div class="row">
<h3 class="heading"><span><strong>Online Live School Tuition</strong> with real teachers</span></h3>
<p class="text-center ls15 lh20">The teachers at tuitionroom are specially selected and trained for our program.<br> They work with both the children and the parents to assure a positive school experience.</p>
<div class="ls15 h3 pt20 text-center mt0 col-md-12">Monthly &amp; Hourly Tuitions available for </div> 
<div class="row pt10">
 
<div class="col-md-12 pt20" id="courses">
<div class="item"><a href="search-new.php?board=cbse"><img src="img/cbse.png" alt="Owl Image"></a></div>
<div class="item"><a href="search-new.php?board=icse"><img src="img/icse.png" alt="Owl Image"></a></div>
<div class="item"><a href="search-new.php?board=igcse"><img src="img/igcse.png" alt="Owl Image"></a></div>
<!--<div class="item"><img src="img/Olympiad.png" alt="Owl Image"></div>-->
</div>
</div>
<p class="ls15 f16 pt10 pt10 lh25 col-md-12 text-center">For all subjects <br> <strong>Math, Science, English, Commerce, Computers, Hindi, Sanskrit, Etc.. upto Grade 12.</strong></p>
<div class="clearfix"></div>
<div class="col-xs-12 text-center">
<a href="search-new.php">
<div class="btn btn-search mybtn smilbtn"><i class="fa fa-smile-o fa-lg"></i> Schedule Free Trial class</div>
</a>
</div>

 </div>
 </div>
</section> 

<section id="featuredteachers">
  <h4>Featured Teachers for School Tuition</h4>
  <hr class="separetor">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <div class="owl-carousel" id="fteacher">
      </div>
      <a href="search-new.php">
      <div class="btn btn-teacher">SELECT TEACHER</div>
      </a>
  </div>
    </div>
  </div>
</section>

<section class="iit-foundation" id="iitjee">
<div class="container-fluid">
<div class="row">
<div class="col-md-12 z10">
<h2 class="heading pb30"><span>IIT-JEE, FOUNDATION COURSES.</span></h2>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 p0 z10">
<h3 class="text-center pb20">IIT JEE Preparation Courses <br><small>by India's Famous and Experienced IITian Teachers.</small></h3>

<div class="col-md-12 pb20">
<div class="col-md-3 col-md-offset-0 col-sm-offset-0 col-sm-4 text-center">
<img src="img/rajan_khare.jpg" alt="rajan" class="img-responsive img-thumbnail" draggable="false" />
</div>
<div class="col-md-9 col-sm-8">
<h3>Mr.Rajan Khare <small>(IIT-Kanpur)</small></h3>
<h4>Expert in Chemistry</h4>
<p><i class="fa fa-smile-o" aria-hidden="true"></i> Former HOD Chemistry at Bansal Classes, Kota</p>
<p><i class="fa fa-smile-o" aria-hidden="true"></i> More than 15+ Years of Experience</p>
</div>
</div>
<div class="clearfix"></div>
<div class="col-md-12 pb20">
<div class="col-md-3 col-md-offset-0 col-sm-offset-0 col-sm-4 text-center">
<img src="img/akhlak.jpg" alt="akhlak" class="img-responsive img-thumbnail" draggable="false" />
</div>
<div class="col-md-9 col-sm-8">
<h3>Er. Akhlak Ahmad <small>(IIT-BHU)</small></h3>
<h4>Expert in Mathematics &amp; Physics</h4>
<P><i class="fa fa-smile-o" aria-hidden="true"></i> A well known mathemagician in the arena of IIT-JEE.</p>
<p><i class="fa fa-smile-o" aria-hidden="true"></i> More Than 2000+ Selection and 15+ Years of Experience</p>
</div>
</div> 
</div>

<div class="col-md-6 col-md-offset-0 col-sm-offset-1 col-sm-10 col-xs-12 p0 z10">
<h3 class="text-center">Foundation program <br><small>by Hyderabad's Institute.</small></h3>
<img src="img/btopper-Logo.png" alt="btopper" class="img-responsive image300 pb20" />
<div class="col-md-offset-1 col-md-10">
<p class="ptext">BToppers is a virtual learning space. It consists of comprehensive modules that explain, in an interactive way, the syllabus of CBSE, ICSE, and the State Boards, in Mathematics, Physics, and Chemistry. We provide a virtual learning space for students by delivering comprehensive teaching modules in Mathematics, Physics and Chemistry via Recorded Sessions and Live Sessions.</p>
<h4 class="text-center">Supporting more than<strong> 200 </strong>Schools for Foundation courses.</h4>
</div>

</div>
<div class="col-xs-12 text-center pt30 z10 pt10">
<a href="IIT-Teachers">
<div class="btn btn-search mybtn smilbtn"><i class="fa fa-smile-o fa-lg"></i> 
Apply for one week Trial class</div></a>
</div>
</div>
</div>
</section>

<!--<section class="cbg">
<div class="container-fluid">
<div class="row">
<h3 class="heading"><span>Student Counseling</span></h3>
<div class="col-md-3 col-md-offset-0 col-sm-offset-4 col-sm-4 col-xs-12 p0 col-md-push-9">
 <img class="img-responsive" alt="nisha" src="img/nisha-jain.png" draggable="false">
 </div> 
<div class="col-md-offset-1 col-md-8 col-sm-offset-1 col-sm-10 col-xs-12 counselling col-md-pull-3">
<h2>Mrs. Nisha Jain
<br>
<small><i>Psychologist</i></small>
</h2>
<p><strong class="myfontsize">Nisha Jain</strong> a practicing psychologist since 10 yrs, holding a degree in Msc. (Clinical Psychology) and Diploma in Counselling. I have varied experience in dealing with children, adolescents and adults, I have worked extensively as a consultant in schools and hospitals. Delivering lectures has also been one of the mediums to provide help and create awareness in the public.</p>
<div class="btn btn-appointment"><a href="nisha.html">MAKE AN APPOINTMENT</a></div>
</div>

</div>
</div>
</section>
<section class="languaguecourse" id="languaguecourse">
<div class="container">
<div class="row">
<h3 class="heading"><span>Language Courses</span></h3>
<div class="col-md-4 p0">
<img src="img/foreign.png" class="img-responsive" alt="demo" draggable="false">
</div>

<div class="col-md-offset-1 col-md-7 pt20">
<h2>Studying Foreign Languages
<br>
<small>Every foreign language has its own momentum.</small>
</h2>
<p>The more you learn, the more you want to learn. Say you love Italian food and decide to study Italian. At first it's hard. But one day you meet some Italian tourists on the bus and you understand enough to point them towards their hotel. Before you part ways, they give you their e-mail address. Now you can easily communicate with them and study some more.</p>

</div>
<div class="col-md-12 pb10 text-center">
<div class="btn btn-search" data-toggle="modal" data-target="#signup">Register Now</div>
</div>
</div>
</div>
</section>

<section class="hobby overlay-bg" id="hobbie">
<div class="container hobby-wrap">
<div class="row">
<div class=" heading text-center pb30"><span>Hobby Classes</span></div>
<div class="col-md-3">
<h2 class="big">Hobbie Classes <br><small> Now Available Live Online.</small></h2>
<p class="pt10 pb20 mc-text">
Learn With unique tips, lessons and inspiration from Creative teachers. Whether you prefer Music, dance, kids’ crafts, knitting, crocheting, sewing or painting, you’ll love our super-fun hobby classes.
</p>
</div>
<div class="col-md-9">
<div class="row">
<div class="col-md-offset-1 col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon wrapper"></div>
<p class="text-center">Kids' crafts</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon dance"></div>
<p class="text-center">Dance</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon violin"></div>
<p class="text-center">Music</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon crochet"></div>
<p class="text-center">Crocheting</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon sewing"></div>
<p class="text-center">Sewing</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon cooking"></div>
<p class="text-center">Cooking</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon painting"></div>
<p class="text-center">Painting</p>
</div>
</div>
</div>

<div class="row">

<div class="col-md-offset-1 col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon fitness"></div>
<p class="text-center">Fitness</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon gardening"></div>
<p class="text-center">Gardening</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon homedecor"></div>
<p class="text-center">Home Decoration</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon yoga"></div>
<p class="text-center">Yoga</p>
</div>
</div>
<div class="col-md-2 col-sm-2 col-xs-4 p5">
<div class="hobbybox">
<div class="icon more"></div>
<p class="text-center">More Courses</p>
</div>
</div>
</div>
</div>

</div>
</div>
</section>-->

<section class="features">
<div class="container">

<div class="row">
                
                <div class="col-md-4">
                    <div class="mc-section-1-content-1"> 
                        <h2 class="big">Online Tuition Highlights</h2>
                        <p class="mc-text">"Tuitionroom.com" is a powerful engine to Study Online in a Friendly Way connecting students with experienced teachers through hassle free schedules of live Online classes. TuitionRoom Slots can be booked based on your comfort.</p>                        
                    </div>
                </div>
    
                <div class="col-md-7 col-lg-offset-1">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-1"></i>
                                <h4 class="title-box text-uppercase">24/7 Elearning</h4>
                                <p> Learn anywhere and anytime according to your feasibility</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-2"></i>
                                <h4 class="title-box text-uppercase">Expert &amp; Talented Tutors</h4>
                                <p> Our expert and talented tutors helps in redefining your skills</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-3"></i>
                                <h4 class="title-box text-uppercase">Comfort and Safety</h4>
                                <p> Online tutoring through tuitionroom is comfortable &amp; safe.</p>
                            </div>
                        </div>
    
                        <div class="col-sm-6">
                            <div class="featured-item">
                                <i class="icon icon-featured-4"></i>
                                <h4 class="title-box text-uppercase">Easy Payment Options</h4>
                                <p> You can pay as per number of slots required.</p>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>

</div>
</section>
<section class="bghiw p0">
<div class="container">
    <div class="row hiw">
    <h3 class="section-title"><span>How it Works</span></h3>     
    <div class="col-md-4 col-sm-4 col-xs-4">    
    <img src="svg/customer-service.svg" alt="dummy" class="img-responsive" draggable="false" />
    <h4 class="text-center"> Tell us Your Requirement</h4>
    <p>Let us know your subject, Grade,Board to provide <br>the best teacher for you.</p>
    <a href="search-new.php"><div class="btn btn-search">Choose</div> </a>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
    <img src="svg/team.svg" alt="dummy" class="img-responsive" draggable="false" />
    <h4 class="text-center"> Choose Teacher</h4>
    <p>Easily select teachers to schedule personalized classes <br>as per your requirement</p>
    <a href="search-new.php"><div class="btn btn-search">View Teachers</div></a>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
    <img src="svg/devices.svg" alt="dummy" class="img-responsive" draggable="false" />
    <h4 class="text-center">Study Online Live Class</h4>
    <p>Take Live online sessions with your selected teacher<br> at your convenient place and time.</p>
    <div class="btn btn-search">Schedule Demo</div>
    </div>
    </div>
  </div>
</section>



<!--<section class="testimonials">
<div class="container">
        <div class="row">
            <div class="col-md-12">
            <h3 class="heading"><span>Testimonials</span></h3>
                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                   
                    <div class="carousel-inner text-center">
                        
                        <div class="item active">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. !</p>
                                        <small>Someone famous</small>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        
                        <div class="item">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                                        <small>Someone famous</small>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                         
                        <div class="item">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. .</p>
                                        <small>Someone famous</small>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                    
                    <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0" class="active"><img class="img-responsive " src="https://www.tuitionroom.com/img/nisha-jain.png" alt="">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="1"><img class="img-responsive" src="https://www.tuitionroom.com/img/nisha-jain.png" alt="">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="2"><img class="img-responsive" src="https://www.tuitionroom.com/img/nisha-jain.png" alt="">
                        </li>
                    </ol>

                   
                    <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                    <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
         
    </div>
</section>-->
<style>
#burst-12 {
    background: yellow;
    width: 80px;
    height: 80px;
    position: fixed;
    text-align: center;
	z-index:9999;
	left:20px;
	bottom:50px;
	display:none;
}
#burst-12:before, #burst-12:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 80px;
    width: 80px;
    background: yellow;
}
#burst-12:before {
    -webkit-transform: rotate(30deg);
       -moz-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
         -o-transform: rotate(30deg);
}
#burst-12:after {
    -webkit-transform: rotate(60deg);
       -moz-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
         -o-transform: rotate(60deg);
}
#burst-12 p {position: absolute;
    z-index: 9999;
    color: #272727;
    top: 0px;
	line-height:12px;}
#burst-12 span { display:block}	
#burst-12 a { color:#272727; text-decoration:none; outline:none;}
.f10 { font-size:10px;}
.f12 { font-size:12px;}
.pt5 { padding-top:5px;}
.p5 {padding:5px;}

</style>
<div id="burst-12"><p class="p5"><a href="nisha.html" target="_blank"><span class="f10">Want to improve learning ability of your kid</span><span class="f12 pt5">Click here</span></a></p></div>

</body>
<?php include("footer_ajax.html"); ?>                  
<script src="js/jquery.background-video.js"></script>  
<script type="text/javascript">
$('.jquery-background-video').bgVideo({ fadeIn: 500});
/*//DROPDOWN SCRIPT
function create_custom_dropdowns() {
  $('select').each(function(i, select) {
    if (!$(this).next().hasClass('dropdown')) {
      $(this).after('<div class="dropdown m10' + ($(this).attr('class') || '') + '" tabindex="0"><span class="carat"></span><span class="current"></span><div class="list"><ul></ul></div></div>');
      var dropdown = $(this).next();
      var options = $(select).find('option');
      var selected = $(this).find('option:selected');
      dropdown.find('.current').html(selected.data('display-text') || selected.text());
      options.each(function(j, o) {
        var display = $(o).data('display-text') || '';
        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
      });
    }
  });
}
// Event listeners
// Open/close
$(document).on('click', '.dropdown', function(event) {
  $('.dropdown').not($(this)).removeClass('open');
  $(this).toggleClass('open');
  if ($(this).hasClass('open')) {
    $(this).find('.option').attr('tabindex', 0);
    $(this).find('.selected').focus();
  } else {
    $(this).find('.option').removeAttr('tabindex');
    $(this).focus();
  }
});
// Close when clicking outside
$(document).on('click', function(event) {
  if ($(event.target).closest('.dropdown').length === 0) {
    $('.dropdown').removeClass('open');
    $('.dropdown .option').removeAttr('tabindex');
  }
  event.stopPropagation();
});
// Option click
$(document).on('click', '.dropdown .option', function(event) {
  $(this).closest('.list').find('.selected').removeClass('selected');
  $(this).addClass('selected');
  var text = $(this).data('display-text') || $(this).text();
  $(this).closest('.dropdown').find('.current').text(text);
  $(this).closest('.dropdown').prev('select').val($(this).data('value')).trigger('change');
});

// Keyboard events
$(document).on('keydown', '.dropdown', function(event) {
  var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
  // Space or Enter
  if (event.keyCode == 32 || event.keyCode == 13) {
    if ($(this).hasClass('open')) {
      focused_option.trigger('click');
    } else {
      $(this).trigger('click');
    }
    return false;
    // Down
  } else if (event.keyCode == 40) {
    if (!$(this).hasClass('open')) {
      $(this).trigger('click');
    } else {
      focused_option.next().focus();
    }
    return false;
    // Up
  } else if (event.keyCode == 38) {
    if (!$(this).hasClass('open')) {
      $(this).trigger('click');
    } else {
      var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
      focused_option.prev().focus();
    }
    return false;
  // Esc
  } else if (event.keyCode == 27) {
    if ($(this).hasClass('open')) {
      $(this).trigger('click');
    }
    return false;
  }
});

$(document).ready(function() {
  create_custom_dropdowns();
});*/
</script>
<script type="text/javascript">
///////////////////TIMER//////////////
(function($) {
    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
    	onComplete: null,  // callback method for when the element finishes updating
    };
})(jQuery);
$.fn.is_on_screen = function(){
     
    var win = $(window);
     
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
     
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
     
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
     
};
var timerstart = false;
if( $('.below-footer').length > 0 ) { // if target element exists in DOM
	if( $('.below-footer').is_on_screen() ) { // if target element is visible on screen after DOM loaded
        if  (timerstart == false){
			$('.timer').countTo({
            from: 50,
            to: 500,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {$('.timer').html(value+"+")}
        });
		$('.timer1').countTo({
            from: 50,
            to: 3000,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {$('.timer1').html(value+"+")}
        });
		$('.timer2').countTo({
            from: 50,
            to: 4500,
            speed: 3000,
            refreshInterval: 50,
            onComplete:function(value) {$('.timer2').html(value+"+")}
        });	
			timerstart = true;}
	} 
}
$(window).scroll(function(){ // bind window scroll event
	if( $('.below-footer').length > 0 ) { // if target element exists in DOM
		if( $('.below-footer').is_on_screen() ) { // if target element is visible on screen after DOM loaded
			if  (timerstart == false){
		$('.timer').countTo({
            from: 50,
            to: 450,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {$('.timer').html(value+"+")}
        });
		$('.timer1').countTo({
            from: 50,
            to: 3000,
            speed: 3000,
            refreshInterval: 50,
            onComplete: function(value) {$('.timer1').html(value+"+")}
        });
		$('.timer2').countTo({
            from: 50,
            to: 4500,
            speed: 3000,
            refreshInterval: 50,
            onComplete:function(value) {$('.timer2').html(value+"+")}
        });		
		timerstart = true;}		
		} 
	}
	
	
});
window.onload=trans;
$( window ).scroll(trans);
function trans() {
if ($( window ).scrollTop() > $("#videoheight").height() -150 )
{
$( "header" ).removeClass("myinverse");
document.getElementById("video").pause();
} 
else
if ($( window ).scrollTop() < $("#videoheight").height()-150  )
{
$( "header" ).addClass("myinverse");
document.getElementById("video").play();
}
}
//Smooth Scroll
$(function() {
  // This will select everything with the class smoothScroll
  // This should prevent problems with carousel, scrollspy, etc...
  $('.smoothscroll').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 50
        }, 1000); // The number here represents the speed of the scroll in milliseconds
        return false;
      }
    }
  });
});
</script>
<script src="https://www.tuitionroom.com/iit/dist/js/owl.carousel.min.js"></script> 
<script type="text/javascript">
setTimeout(function() {$.get("ajax_featured_teachers-1.php", null, function(t) {
            $("#fteacher").html(t), owl();
			$("#featuredteachers").show();
        });} ,1000); 
function owl() {
    $(".owl-carousel").owlCarousel({
        loop: !0,
        nav: !0,
        autoplay: !0,
        autoplayTimeout: 1500,
        autoplayHoverPause: !0,
        responsiveClass: !0,
        responsive: {
            0: {
                items: 3
            },
            480: {
                items: 4
            },
            678: {
                items: 6,
                center: !0
            },
            960: {
                items: 8,
                margin: 20,
                center: !1
            },
            1200: {
                items: 12,
                loop: !0
            }
        }
    })
}
//owl carosel
$(document).ready(function() {
              $('#courses').owlCarousel({
                items: 3,
                merge: true,
                loop: true,                
                responsive: {
                  480: {
                    items: 3
                  },
                  768: {
                    items: 3
                  }
                }
              })
            })
</script>
<script type="text/javascript" src="js/jquery-ui.js"></script>                  
<script type="text/javascript">
var list = [
"Mathematics","Science","English","Social","Biology","Physics","Chemistry","Algebra","Commerce","Economics","Business studies","Accountancy","Class 1","Class 2","Class 3","Class 4","Class 5","Class 6","Class 7","Class 8","Class 9","Class 10","Class 11","Class 12","IIT","JEE","IIT ADVANCE"
];
$( "#search_field" ).autocomplete({
     source: function(request, response) {
         var results = $.ui.autocomplete.filter(list, request.term);
         response(results.slice(0, 6));
    },
      appendTo: ".search",
      autoFocus: false,
      minLength: 1,
});
$.ui.autocomplete.prototype._renderItem = function (ul, item) {
    item.label = item.label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(this.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
    return $("<li></li>")
            .data("item.autocomplete", item)
            .append("<a>" + item.label + "</a>")
            .appendTo(ul);
};
//Nice scroll starts		
$(function(){	
$(".dropdown .list ul").niceScroll({
        mousescrollstep:120,
        cursorcolor: "#c1c1c1",
        cursorwidth: "8px",
        cursorborderradius: "1px",
        cursorborder: "none",
        zindex: 99999,
        scrollspeed: 80,
        autohidemode: false
    });	
	
getBoardDetails('CBSE','cbselist');	
});
//Nice scroll ends	
</script>

<script type="text/javascript">
var boardclass=boardsubj='',url='search-new.php';
function getBoardDetails(board,id)
{
	$.get("ajax_get_boardinfo.php",{"board":board},function(resp){		
		$("#advancedsearch").hide().fadeIn(1000);
		$("#advancedsearch").html(resp);
		
		// Save selected values
		boardclass=$("div.bgrdlist span.active").attr("data-bclass");
		boardsubj=$("div.bsubjlist span.active").attr("data-bsubj");
		
		$("div.arrow").toggleClass("arrow");
		
		$("#"+id+">div").addClass("arrow");
		$("#advancedsearch span.boardclass").bind('click',function()
														  { 
														  	$("#advancedsearch span.boardclass").removeClass('active');
															$(this).addClass('active');
															boardclass=$(this).attr('data-bclass');
															url="search-new.php?subject="+boardsubj+"&board="+board+"&stdclass="+boardclass;
															$("#search-new").attr("href",url);
														  });
		$("#advancedsearch span.boardsubject").bind('click',function()
														  { 
														  	$("#advancedsearch span.boardsubject").removeClass('active');
															$(this).addClass('active');
															boardsubj=$(this).attr('data-bsubj');
															url="search-new.php?subject="+boardsubj+"&board="+board+"&stdclass="+boardclass;
															$("#search-new").attr("href",url);
														  });
	});	
}

/*window.onload = function(){		
  if (!('Notification' in window)) {
    alert('Web Notification is not supported');
    return;
  }	

  Notification.requestPermission(function(permission) { 
    var tuitionroomIcon = 'https://www.tuitionroom.com/img/apple-touch-icon-iphone.png';
    var notification = new Notification('Welcome to Tuitionroom!', {body: 'Enjoy Learning Experience in Friendly Way.', icon: tuitionroomIcon});
   // notification.onclick = function() {
//      window.open('https://www.tuitionroom.com');
//    }
  });
};*/

/*function notify (){
	
	 Notification.requestPermission(function(permission) { 
    var tuitionroomIcon = 'https://www.tuitionroom.com/img/apple-touch-icon-iphone.png';
    var notification = new Notification('Welcome to Tuitionroom!', {body: 'Enjoy Learning Experience in Friendly Way.', icon: tuitionroomIcon});
   // notification.onclick = function() {
//      window.open('https://www.tuitionroom.com');
//    }
  });
  
	};*/

function showHideMore(opt)
{
	if(opt=='s')
	{
		$("span.smore,a.showless").removeClass("hide").show();
		$("a.showmore").hide();
	}else
	{
		$("span.smore,a.showless").hide();
		$("a.showmore").removeClass("hide").show();		
	}
}

</script>

<!--<script src="https://cdn.rawgit.com/mattboldt/typed.js/master/dist/typed.min.js"></script>
<script type="text/javascript">
$(function() {
	$("#typed").typed({
		strings: ["live Online classes.", "worldwide."],
		typeSpeed: 15,
    	backDelay: 3000,
		loop: true,
		callback: function(){}
	});
});
</script>-->
</html>