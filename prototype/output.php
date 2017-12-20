<?php
$values = rex_var::toArray("REX_VALUE[1]");
$yform = new rex_yform();
$i = 0;
$fieldId = '';
$absender = 'REX_VALUE[2]';
$empfänger = 'REX_VALUE[3]';
$bccEmpfänger = 'REX_VALUE[4]';
$betreff = 'REX_VALUE[5]';
$output = '<style>hr { height: 1px;}</style>';
foreach($values as $value) {
	$fieldId = 'genField'. +$i;

  /***************/
 /* GET VALUES */
/*************/
    
	$art = $value['art'];
	$bez = $value['bez'];
	$req = $value['req'];
	$attributes = $value['attDef'];
	$mediaformat = $value['attMed'];
	$multiSel = $value['multiSel'];
	
	
  /**************/
 /* FUNCTIONS */
/************/	
    
	if($req == 'placeholderReq') {
		$req = '"required":""';
	}
	
	if($multiSel == 'multiselect') {
		$multiSel = '1';
	}	
	if($multiSel == '') {
		$multiSel = '0';
	}
	
  /**************/
 /* HANDLE IT */
/************/

	if($art == 'text' || $art == 'textarea') {
		 $yform->setValueField($art, array($fieldId,$bez,'','','{"placeholder":"", "type":"text",'.$req.'}'));
	}
	if($art == 'email') {
		 $yform->setValueField($art, array($fieldId,$bez,'','','{"placeholder":"", "type":"email",'.$req.'}'));
	}
	if($art == 'select') {
		 $yform->setValueField($art, array($fieldId,$bez,'bitte wählen=,'.$attributes.'','','bitte wählen',''.$multiSel.'','','{'.$req.'}'));
	}
	if($art == 'radio') {
		 $yform->setValueField($art, array($fieldId,$bez,''.$attributes.'','','{'.$req.'}'));
	}
	if($art == 'checkbox') {
		 $yform->setValueField($art, array($fieldId,$bez,'0,1','0'));	
	}
	if($art == 'mediafile') {
		 $yform->setValueField($art, array($fieldId,$bez,'0,5120',''.$mediaformat.'','','zu klein,zu groß,falscher Typ,Darf nicht leer sein'));
	}
	$output .= '<p><strong>'.$bez.':</strong> ###'.$fieldId.'### </p><hr>';
	$i = $i + 1;
}
#$code = '<?php echo '<input name="validate_timer" type="hidden" value="'.microtime(true).'" />';
$yform->setValueField('php', array('captcha','Captcha',''));

$yform->setObjectparams('form_action',rex_getUrl('REX_ARTICLE_ID'));
$yform->setActionField('email', array($absender, $empfänger, $betreff, $output));
$yform->setActionField('showtext', array('', '<p>Ihre Wertermittlung wurde versendet und wird von uns in Kürze bearbeitet</p>')); 
echo  $yform->getForm(); 

// HTML-Code des Formulars

/*
if($form) { // Wenn das Formular nicht abgesendet wurde
    echo $form; // HTML-Codes des Formulars ausgeben
} else { 

    // Ab hier beginnen die Vorbereitungen zum E-Mail-Versand
    $yform_email_template_key = ''; // Key, wie im Backend unter YForm > E-Mail-Templates hinterlegt
    $debug = 1;

    // Array mit Platzhaltern, die im E-Mail-Template ersetzt werden.
    /*$values = $this->params['value_pool']['email'];
    $values['custom'] = 'Eigener Platzhalter';*/
/*
    if ($yform_email_template = rex_yform_email_template::getTemplate($yform_email_template_key)) {

        if ($debug) {
            echo '<hr /><pre>'; var_dump($yform_email_template); echo '</pre><hr />';
        }
        $yform_email_template = rex_yform_email_template::replaceVars($yform_email_template, $values);
        $yform_email_template['mail_from'] = $absender;
        $yform_email_template['mail_from_name'] = $absender;
        $yform_email_template['mail_to'] = $empfänger;
        $yform_email_template['mail_to_name'] = $empfänger;
        $yform_email_template['subject'] = $betreff;

		
        if ($debug) {
            echo '<hr /><pre>'; var_dump($yform_email_template); echo '</pre><hr />';
        }
        if (!rex_yform_email_template::sendMail($yform_email_template, $template_name)) {
            if ($debug) { echo 'E-Mail konnte nicht gesendet werden.'; }
            return false;
        } else {
            if ($debug) { echo 'E-Mail erfolgreich gesendet.'; }
            return true;
        }
    } 
}*/
?>