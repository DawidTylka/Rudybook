window.onload = ajax;
window.onload = scrollHandler;
let ilestron = 1;
let poprzednio = 0;
let teraz = 1;
function ajax(){
  var XHR = null;
  try
  {
    XHR = new XMLHttpRequest();
  }
  catch(e)
  {
      try
    {
      XHR = new  ActiveXObject("Msxm12.XMLHTTP");
    }catch(e2)
    {
        try
      {
        XHR = new  ActiveXObject("Microsoft.XMLHTTP");
      }catch(e3)
      {
        window.alert('błąd');
      }
    }
  }
  return XHR;
}



function addfoto(link)

{

XHR= ajax();

  if ( XHR != null ){



    XHR.open("GET", link, true)

    

    XHR.onreadystatechange = function()

    {

      if (XHR.readyState == 4)

      {
        ilestron ++ ; 
        document.getElementById('posty').innerHTML += XHR.responseText;
      }

    }

    XHR.send(null);

} 

setTimeout(scrollHandler, 3000);

}

function scrollHandler()
{
    var txt = $("#cialo").height() - window.screen.height - 2000;
	 
      var div = window.scrollY ;
      if( txt <= div )
      {
    teraz = txt;
	 if(teraz != poprzednio){
      var link = "posty.php?page=";
        link += ilestron ;
        setTimeout(addfoto(link), 9);
		poprzednio = teraz;
	 }
      }else{
        setTimeout(scrollHandler, 3000);
        scrolls = 'resize' ;
      }
}
function szukaj()
{

      var link = "szukaj.php?down=";

	  var tekst = document.getElementById('search').value;

        link += tekst;

        setTimeout(addszukaj(link), 9);

}

function addszukaj(link)

{

XHR= ajax();

  if ( XHR != null ){



    XHR.open("GET", link, true)

    

    XHR.onreadystatechange = function()

    {

      if (XHR.readyState == 4)

      { 

        document.getElementById('mainleft').innerHTML = XHR.responseText;

      }

    }

    XHR.send(null);

} 

}





function addkom(y)

{

      var link = "komentarze.php?down=";

	  var tekst = "kom"+y;

        link += y;

        setTimeout(dodaj(link, tekst), 9);

}





function dodaj(link, y)

{

	console.log(y);

XHR= ajax();

  if ( XHR != null ){



    XHR.open("GET", link, true)

    

    XHR.onreadystatechange = function()

    {

      if (XHR.readyState == 4)

      { 

        document.getElementById(y).innerHTML = XHR.responseText;

      }

    }

    XHR.send(null);

} 
}

function reakcje(x,s,g,id){
	x = x.parentElement;
	x.innerHTML= "";
	var link = 'reakcje.php?serce='+s+'&gwiazdka='+g+'&postid='+id;
	var link2 = 'reakcjerepair.php?serce='+s+'&gwiazdka='+g+'&postid='+id;
	dodaj_reakcje(link);
	setTimeout(function(){
			XHR= ajax();

			  if ( XHR != null ){



				XHR.open("GET", link2, true)

				

				XHR.onreadystatechange = function()

				{

				  if (XHR.readyState == 4)

				  { 

					x.innerHTML = XHR.responseText;

				  }

				}

				XHR.send(null);

		} 
	}, 100);
}

function dodaj_reakcje(link){

XHR= ajax();

  if ( XHR != null ){
    XHR.open("GET", link, true)
    XHR.send(null);
} 
}











