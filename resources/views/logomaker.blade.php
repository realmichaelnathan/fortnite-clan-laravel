@extends('layout') 
@section('title', 'Fortnite Clan Logo Maker')
@section('ogtitle', 'Fortnite Clan Logo Maker')
@section('ogimage', asset("images/fnclogomaker.png"))
@section('ogdesc', 'Do you need help making a nice logo or image for your Fortnite Clan or Team? Use this easy tool to help you create something great to represent your clan or team!')

@section('headers')
<link href=/css/app.16d2742a.css rel=preload as=style>
<link href=/css/chunk-vendors.98a34d8d.css rel=preload as=style><link href=/js/app.0a9b6818.js rel=preload as=script>
<link href=/js/chunk-vendors.c93fc5b9.js rel=preload as=script><link href=/css/chunk-vendors.98a34d8d.css rel=stylesheet>
<link href=/css/app.16d2742a.css rel=stylesheet>
@endsection
@section('content')

<div id=app></div>
<script src=https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js></script>

<script>document.addEventListener('DOMContentLoaded', (event) => {
    var canvas = document.getElementById('canvas');
    var downloadImageButton = document.createElement("button");
    downloadImageButton.innerText = "Download Image";
    downloadImageButton.style.bottom = "75px"; 
    downloadImageButton.style.position = "absolute";
    downloadImageButton.classList.add("btn", "btn-lg", "btn-primary");
    canvas.appendChild(downloadImageButton);
    downloadImageButton.addEventListener('click', downloadImage);
  });
          

  function downloadImage() {
    var logo = document.getElementById('logo');
    var fnc = document.createElement("span");               
    fnc.innerText = "FORTNITECLAN.COM LOGOMAKER";  
    fnc.style.position = "absolute";
    fnc.style.bottom = "5px"; 
    fnc.style.fontSize = "10px";
    fnc.style.fontWeight = "bold";
    fnc.style.fontFamily = "Open Sans";
    fnc.style.color = "#fff";
    fnc.style.textShadow = "0px 0px 5px #000000";             
    logo.appendChild(fnc); 

    var node = document.getElementById('logoImage');
    domtoimage.toPng(node)
      .then(function (dataUrl) {
          saveAs(dataUrl, 'mylogo.png');
          logo.removeChild(fnc); 
      })
      .catch(function (error) {
          console.error('oops, something went wrong!', error);
      });

      
  }

  function saveAs(uri, filename) {

    var link = document.createElement('a');

    if (typeof link.download === 'string') {

        link.href = uri;
        link.download = filename;

        //Firefox requires the link to be in the body
        document.body.appendChild(link);

        //simulate click
        link.click();

        //remove the link when done
        document.body.removeChild(link);

    } else {

        window.open(uri);

    }
  }
  
  </script>
  
  <script src=/js/chunk-vendors.c93fc5b9.js></script>
  <script src=/js/app.0a9b6818.js></script>
@endsection