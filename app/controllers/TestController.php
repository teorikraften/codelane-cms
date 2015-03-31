<?php

include(app_path().'/classes/htmltodocx/h2d_htmlconverter.php');

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

	public function showDecodePage() {
		return View::make('decode');
	} 

	public function showEncodePage() {
		$all = PM::select('id', 'title')->get();
		$pms = array();
		foreach ($all as $v) {
			$pms[$v->id] = $v->title;
		}
		return View::make('encode')->with('pms', $pms);
	} 

	public function decode() {
		if (!Input::file('file')->isValid()) {
			return Redirect::back()->with('error', 'Ogiltig fil.');
		}

		// Get some paths
		$path = __DIR__.'/../storage/uploads/';
		$file = Input::file('file')->getClientOriginalName();
		$zipPath = $path . '/' . str_replace('.', '', $file) . rand(0, 100000);
   		$dataFile = 'word/document.xml';

		Input::file('file')->move($path, $file);

		$zip = new ZipArchive;
		$res = $zip->open($path . $file);
		$text = "";
		if ($res === TRUE) {
		  	// extract it to the path we determined above
		  	$zip->extractTo($zipPath);
		  	if (($index = $zip->locateName($dataFile)) !== false) {
            	// If found, read it to the string
	            $data = $zip->getFromIndex($index);
	            // Close archive file
	            $zip->close();
	            // Load XML from a string
	            // Skip errors and warnings
        		$xml = new DOMDocument();
	            $xml->loadXML($data);

	            // Return data without XML formatting tags
	            $contents = explode('\n',strip_tags($xml->saveXML()));
	            foreach($contents as $i=>$content) {
	                $text .= $contents[$i];
	            }
	        } else {
	        	return Redirect::back()->with('error', 'Datafilen kunde inte hittas: '. $dataFile .'.');
	        }
        	//$zip->close();
		} else {
			return Redirect::back()->with('error', 'Ett fel uppstod när filen analyserades.');
		}

		return View::make('decode-result')->with('content', $text);
	} 

	public function encode() {
		$pm = Input::get('pm');
		$pm = PM::findOrFail($pm);

		// New Word Document:
		$phpword_object = new \PhpOffice\PhpWord\PhpWord();
		$section = $phpword_object->createSection();

		// HTML Dom object:
		$html_dom = new simple_html_dom();
		$html_dom->load('<html><body>' . $pm->content . '</body></html>');

		// Create the dom array of elements which we are going to work on:
		$html_dom_array = $html_dom->find('html',0)->children();

		// Provide some initial settings:
		$initial_state = array(
  			// Required parameters:
  			'phpword_object' => &$phpword_object, // Must be passed by reference.
  			'base_root' => 'http://cms.local', // Required for link elements - change it to your domain.
  			'base_path' => '/', // Path from base_root to whatever url your links are relative to.
  			// Optional parameters - showing the defaults if you don't set anything:
  			'current_style' => array('size' => '11'), // The PHPWord style on the top element - may be inherited by descendent elements.
  			'parents' => array(0 => 'body'), // Our parent is body.
  			'list_depth' => 0, // This is the current depth of any current list.
  			'context' => 'section', // Possible values - section, footer or header.
  			'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
  			'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
  			'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
  			'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
  			'table_allowed' => TRUE, // Not in table, cannot be nested
  			'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
   			'style_sheet' => htmltodocx_docs_style(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
  		); 

		// Convert the HTML and put it into the PHPWord object
		htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $initial_state);

		// Clear the HTML dom object:
		$html_dom->clear(); 
		unset($html_dom);

		// Save File
		$h2d_file_uri = tempnam('', 'htd') . '.docx';
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword_object, 'Word2007');
		$objWriter->save($h2d_file_uri);

		return Response::download($h2d_file_uri);
	}
}
