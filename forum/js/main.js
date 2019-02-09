var bgbox=document.getElementById('regbg');
var regbox=document.getElementById('reg');
var close=document.getElementById('close');
window.addEventListener('click',function (e){
	if(e.target==bgbox)
	bgbox.style.display='none';
});
close.addEventListener('click',function (){
	bgbox.style.display='none';
});
regbox.addEventListener('click',function (){
	bgbox.style.display='block';
});