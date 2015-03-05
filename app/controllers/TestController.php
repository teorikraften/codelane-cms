<?php

class TestController extends BaseController {
	/*
	 * Displays the index page view.
	 */
	public function showImportPage()
	{
		header('Content-Type: text/html; charset=utf-8');
		$path = 'PM/Akutmottagningen/Administrativa riktlinjer/Gemensamma PM akutmottagningen';
		//$name = 'Ansvarsarbete.pdf';
		$name = 'Ansvarsfördelning chefer kassa-receptionen.pdf';
		$filename = $path . '/' . $name;
		// Parse pdf file and build necessary objects.
		$parser = new \Smalot\PdfParser\Parser();
		$pdf = $parser->parseFile($filename);
		$c = $pdf->getText();
		$info = array();
		/**
		Försök hitta namn.
		*/
		preg_match_all('/Namn på dokument\s+(.*)\s+/', $c, $m);
		$info['namn'] = @$m[1][0];
		/**
		Försök hitta dnr ds.
		*/
		preg_match_all('/Dnr DS\s+(.*)\s+/', $c, $m);
		$info['dnr_ds'] = @$m[1][0];
		/**
		Försök hitta enhet.
		*/
		preg_match_all('/Enhet:\s+(.*)\s+/', $c, $m);
		$info['enhet'] = @$m[1][0];
		/**
		Försök hitta ursprungsversion.
		*/
		preg_match_all('/Urspr. version\s+(.*)\s+/', $c, $m);
		$info['ursprungsversion'] = @$m[1][0];
		/**
		Försök hitta Fastställd/Gäller från.
		*/
		preg_match_all('/Fastställd\/Gäller från:\s+(.*)\s+/U', $c, $m);
		$info['faststalld']['datum'] = @$m[1][0];
		/**
		Försök hitta Fastställd av
		*/
		preg_match_all('/Fastställt av:\s+(.*)\s+/', $c, $m);
		$info['faststalld']['av'] = @$m[1][0];
		/**
		Försök hitta Översyn/Revision
		*/
		preg_match_all('/Översyn\/revision:\s+(.*)\s+/U', $c, $m);
		$info['oversyn']['datum'] = @$m[1][0];
		/**
		Försök hitta ansvarig
		*/
		preg_match_all('/Ansvarig :\s*(.*)\n\s*\n/Us', $c, $m);
		$info['oversyn']['ansvarig'] = explode(',', @$m[1][0]);
		/**
		Försök hitta innehåll
		*/
		preg_match_all('/\n\s*\n(.*)/s', $c, $m);
		$info['innehall'] = utf8_encode(
			str_replace(array("?", "\n"), array("", "\n"), 
				utf8_decode(
					preg_replace("/\xb7/", "\n-", 
						preg_replace("/\s+/", " ", @$m[1][0])
					)
				)
			)
		);

		echo '<pre>';
		print_r($c);
		echo '</pre>';

		exit;
		return View::make('import')->with('filename', $filename)->with('content', $c);
	}
}
