@extends('master')

@section('head-title')
    Hjälp
@stop

@section('body')
    <h1>Hjälp</h1>
    <p>Vad ska du göra?</p>
    <div id="left" class="sidehelp">
            <h2>Konto & Lösenord</h2>
        <ul>
            <li><a href="">Hur hittar jag mina uppgifter?</a></li>
            <li><a href="">Jag vill ändra min information</a></li>
            <li><a href="">Vad är roller för något?</a></li>
            <li><a href="">Hur registrerar man ett konto?</a></li>
                <li><a href="">Hur blir jag verifierad?</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
        </ul>
    </div>
    <div id="right" class="sidehelp">
        <h2>PM hantering</h2>
        <ul>
            <li><a href="">Jag ska skriva ett PM</a></li>
            <ul>
                <li><a href="">Vad gör en PM-Upprättare?</a></li>
                <li><a href="">Vad gör en PM-Inläggare?</a></li>
                <li><a href="">Vad gör en PM-Granskare?</a></li>
                <li><a href="">Vad gör en PM-Slutgranskare?</a></li>
                <li><a href="">Vad gör en PM-Påminnare?</a></li>
            </ul>
            <li><a href="">Jag ska söka efter ett PM</a></li>
            <ul>
                <li><a href="">Hur laddar man ner ett PM?</a></li>
                <li><a href="">Hur skriver man ut ett PM?</a></li>
            </ul>
            <li><a href="">Jag ska verifiera ett PM</a></li>
            <li><a href="">Jag vill favoritmarkera ett PM</a></li>
            <li><a href="">Hur hittar jag mina pågående uppgifter?</a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
            <li><a href=""></a></li>
        </ul>
    </div>
    <div class="sidehelp">
        <h2>Sidor</h2>
        <ul>
            <li><a href="">Hem</a></li>
            <li><a href="">Din sida</a></li>
            <li><a href="">Kategorier</a></li>
            <li><a href="">Dina favorit-PM</a></li>
            <li><a href="">Dina anteckningar</a></li>
            <li><a href="">Senast uppdaterade-PM</a></li>
            <li><a href="">PM</a></li>
            <li><a href="">Logga ut</a></li>
        </ul>
    </div>
        <!--infoWindow-->   
    <div id="infoWindow" style="display:none;"><h3>
    <button onclick="hide('infoWindow')">X</button> Hjälp :: Hjälp</h3>
        <p>Det här är hjälp.</p>
    </div>  
<!-- end of infoWindow--> 
@stop