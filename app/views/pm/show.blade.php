@extends('master')

@section('head-title')
    Visa PM med token: {{ $token }}
@stop

@section('head-extra')
    <script type="text/javascript">

    	function changeSize(divT, diff, valSpan) {
    		var divToChange = document.getElementById(divT);
    		var valueSpan = document.getElementById(valSpan);
    		var value = parseInt(valueSpan.innerHTML) + diff;
    		if (value < 0)
    			value = 0;
    		if (value > 500)
    			value = 500;
    		valueSpan.innerHTML = value;
    		divToChange.style.fontSize = value/100 + 'em';
    	}

    </script>
@stop

@section('body')
    <h1>{{ ucfirst(str_replace("-", " ", $token)) }}</h1>
    <a class="action" href="{{ URL::route('pm-download', $token) }}">Ladda ner PM (.pdf)</a>
    <a class="action" href="{{ URL::route('pm-download', $token) }}">Skriv ut</a>
    <span class="meter">
    	<a href="javascript:void()" onclick="changeSize('pmc', -10, 'size')" class="first">Minska</a>
    	<span class="middle">
    		Textstorlek: 
    		<span id="size">120</span>
    		%
    	</span>
    	<a href="javascript:void()" onclick="changeSize('pmc', 10, 'size')" class="last">Öka</a>
    </span>
    <div id="pmc" class="pm-content">
	    <ul>
	    	<li>Av säkerhetsmässiga skäl ska alla patienter som vistas på akutmottagningen för en konsultinsats av akutens 
	    		personal registreras i akutliggaren på aktuell klinik. En orange lapp lämnas ut till receptionen med ikryssad ruta 
	    		”Endast konsult ssk/usk”. Denna konsultation registreras med kombikakod <i>11010 046 M30</i> i kassan.</li>
	    	<li>Genomförd konsultåtgärd dokumenteras i patientens journal av ansvarig personal</li>
			<li>Vid utskrivning från akutliggaren välj DRG ”nej” och ”godkänn”</li>
			<li>Konsultinsatser kan bestå av t.ex. EKG-tagning, KAD-sättning, insättande av PVK, gipsning eller provtagning 
				<b>som ingår i ett pågående besök eller ett vårdtillfälle på annan klinik inkl. psykiatri och geriatrisk 
				klinik</b></li>
			<li>Då övriga kliniker faktureras för ovanstående tjänster skall ett underlag för fakturering i form av 
				blankett <b>”Konsultation sjuksköterska/undersköterska”</b> lämnas till valfri chefssjuksköterska i postfack</li>
			<li>
				Vid förfrågan om vi kan utföra insatsen på annan plats än akutmottagningen gäller följande:
				<ol>
					<li>Sjuksköterska med ledningsansvar ”äger frågan”. Det innebär, att han/hon avgör om det är 
						möjligt/lämpligt med hänsyn till den medicinska säkerheten på akutmottagningen att låta 
						någon gå ifrån. 
						Om detta inte är möjligt, ombesörjer avdelningen patienttransport till och från till 
						akutmottagningen för 
						konsultinsatsen. Diskussion kan föras med jour på berörd klinik.</li>
					<li>Anses detta omöjligt/olämpligt/farligt får den berörda klinikens jour ta ställning till alternativa 
						lösningar. Skulle därefter akutmottagningens bemanning likafullt minskas får den berörda klinikens jour 
						samråda med medicinjour på akutkliniken som därefter får ta det fulla medicinska ansvaret för att så 
						sker.</li>
				</ol>
			</li>
	    </ul>
	</div>
@stop