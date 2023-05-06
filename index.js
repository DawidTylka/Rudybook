
function off(x){
	document.getElementById("hover_info").style.display = "none";
	x.style.display = "none";
}

function hoverInfoOn(){
	document.getElementById("hover_info").style.display = "block";
	document.getElementById("off").style.display = "block";
	
}
function foto(x){
	document.getElementById("offfoto").style.display = "block";
	document.getElementById("hoverfoto").src = x.src;
}
function cleard(x){
	setTimeout(() => {
	x.parentElement.querySelector('textarea').value = "";
	}, 1);
}
function hujwpost(x){
	setTimeout(() => {
	document.getElementById('polenaftowe').remove();
	}, 1);
}