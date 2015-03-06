<?php

class PDFParser {
	
	public static function parse($path, $name) {
		$filename = $path . '/' . $name;
		
		// Parse pdf file and build necessary objects.
		$parser = new \Smalot\PdfParser\Parser();
		$pdf = $parser->parseFile($filename);
		$c = $pdf->getText();
		$info = array();
		
		preg_match_all('/Namn på dokument\s+(.*)\s+/', $c, $m);
		$info['title'] = trim(@$m[1][0]);
		preg_match_all('/Dnr DS\s+(.*)\s+/', $c, $m);
		$info['dnr_ds'] = trim(@$m[1][0]);
		preg_match_all('/Enhet:\s+(.*)\s+/', $c, $m);
		$info['enhet'] = trim(@$m[1][0]);
		preg_match_all('/Urspr. version\s*(\(datum\)\s*\n)?(.*)\s+/', $c, $m);
		$info['first_version'] = trim(@$m[count($m)-1][0]);
		preg_match_all('/Fastställd\/Gäller från:\s+(.*)\s+/U', $c, $m);
		$info['faststalld']['datum'] = trim(@$m[1][0]);
		preg_match_all('/Fastställt av:\s+(.*)\s+/', $c, $m);
		$info['faststalld']['av'] = trim(@$m[1][0]);
		preg_match_all('/Översyn\/revision:\s+(.*)\s+/U', $c, $m);
		$info['oversyn']['datum'] = trim(@$m[1][0]);
		preg_match_all('/Ansvarig\s*:\s*(.*)\n\s*\n/Us', $c, $m);
		$info['oversyn']['ansvarig'] = explode(',', trim(@$m[1][0]));
		preg_match_all('/\n\s*\n(.*)/s', $c, $m);
		$info['content'] = utf8_encode(
			str_replace(array("?", "\n"), array("", "\n"), 
				utf8_decode(
					preg_replace('/-(.*)\n/', '<li>$1</li>',
						preg_replace("/\xb7/", "\n-", 
							preg_replace("/\n\n/", "\n", trim(@$m[1][0]))
						)
					)
				)
			)
		);
		return $info;
	}

}