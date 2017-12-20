<?php

/* KOPFTEIL */
$dataForm = new MForm();
$dataForm->addTextField(2, array('label'=>'Absender'));
$dataForm->addTextField(3, array('label'=>'Empfänger'));
$dataForm->addTextField(4, array('label'=>'E-Mail Adressen, kommasepariert','class'=>'bcc'));
$dataForm->addCheckboxField('bcc', array('bcc"'=>'Ja','nein'=>'nein'),array('label'=>'Mehrere Empfänger?', 'class'=>'checkbcc'));
$dataForm->addTextField(5, array('label'=>'Betreff'));
echo $dataForm->show();

/* FORMULAR */
$id = 1;
$mform = new MForm();
$mform->addFieldset('Formular Generator');
$mform->addTextField("$id.0.bez", array('label'=>'Bezeichnung'));
$mform->addSelectField("$id.0.art", array('text'=>'text','textarea'=>'textarea','select'=>'select','email'=>'email','checkbox'=>'checkbox','radio'=>'radio','mediafile'=>'mediafile'), array('label'=>'Art', 'class'=>'yform_art')); // use string for x.0 json values
$mform->addTextField("$id.0.attDef", array('label'=>'Values, kommasepariert','class'=>'addFields'));
$mform->addTextField("$id.0.attMed", array('label'=>'Erlaubte Bildformate, kommasepariert','class'=>'gen_bildform'));
$mform->addCheckboxField("$id.0.multiSel", array('multiselect"'=>'Multiselect'),array('label'=>'Mehrfach Auswahl?'));//
$mform->addCheckboxField("$id.0.req", array('placeholderReq"'=>'Pflicht'),array('label'=>'Pflichtfeld?'));// media button

// parse form
echo MBlock::show($id, $mform->show()); // add settings min and max

?>
<script>
	function handle_onLoad() {
		var e = $(".yform_art")[0];
		var yform_art = e.options[e.selectedIndex].text;
		if(yform_art == 'select') {
			if($(".yform_art").parent().parent().next().find('.addFields') != '' && $(".yform_art").parent().parent().next().next().find('.gen_bildform') != '') {
				$(".yform_art").parent().parent().next().css('display','block');
				$(".yform_art").parent().parent().next().next().css('display','none');
				$(".yform_art").parent().parent().next().next().next().css('display','block');
			}
		}
		if(yform_art == 'radio') {
			if($(".yform_art").parent().parent().next().find('.addFields') != '' && $(".yform_art").parent().parent().next().next().find('.gen_bildform') != '') {
				$(".yform_art").parent().parent().next().css('display','block');
				$(".yform_art").parent().parent().next().next().css('display','none');
				$(".yform_art").parent().parent().next().next().next().css('display','none');
			}
		}
		if(yform_art == 'mediafile') {
			if($(".yform_art").parent().parent().next().find('.addFields') != '' && $(".yform_art").parent().parent().next().next().find('.gen_bildform') != '') {
				$(".yform_art").parent().parent().next().css('display','none');
				$(".yform_art").parent().parent().next().next().css('display','block');
				$(".yform_art").parent().parent().next().next().next().css('display','none');
			}
		}
		if(yform_art == 'checkbox' || yform_art == 'email' || yform_art == 'text' || yform_art == 'textarea'){
			if($(".yform_art").parent().parent().next().find('.addFields') != '' && $(".yform_art").parent().parent().next().next().find('.gen_bildform') != '') {
				$(".yform_art").parent().parent().next().css('display','none');
				$(".yform_art").parent().parent().next().next().css('display','none');
				$(".yform_art").parent().parent().next().next().next().css('display','none');
			}
		}
	}
	
	$(document).on('rex:ready', function() {
		handle_onLoad();
		$('.bcc').parent().parent().css('display','none');
		$("[id$=bcc]").change(function() {
			if($("input[type='checkbox']").is(":checked") == true) {
				$('.bcc').parent().parent().css('display','block');
			}
			if($("input[type='checkbox']").is(":checked") == false) {
				$('.bcc').parent().parent().css('display','none');
			}
		});
		$('.yform_art').change(function() {
			var e = $(this)[0];
			var yform_art = e.options[e.selectedIndex].text;
			if(yform_art == 'select') {
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','block');
					$(this).parent().parent().next().next().css('display','none');
					$(this).parent().parent().next().next().next().css('display','block');
				}
			}
			if(yform_art == 'radio') {
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','block');
					$(this).parent().parent().next().next().css('display','none');
					$(this).parent().parent().next().next().next().css('display','none');
				}
			}
			if(yform_art == 'mediafile') {
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','none');
					$(this).parent().parent().next().next().css('display','block');
					$(this).parent().parent().next().next().next().css('display','none');
				}
			}
			if(yform_art == 'checkbox' || yform_art == 'email' || yform_art == 'text' || yform_art == 'textarea'){
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','none');
					$(this).parent().parent().next().next().css('display','none');
					$(this).parent().parent().next().next().next().css('display','none');
				}
			}
		});	
	});
	
	$(document).on('mblock:add', function() {
		$('.yform_art').change(function() {
			var e = $(this)[0];
			var yform_art = e.options[e.selectedIndex].text;
			if(yform_art == 'select') {
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','block');
					$(this).parent().parent().next().next().css('display','none');
					$(this).parent().parent().next().next().next().css('display','block');
				}
			}
			if(yform_art == 'radio') {
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','block');
					$(this).parent().parent().next().next().css('display','none');
					$(this).parent().parent().next().next().next().css('display','none');
				}
			}
			if(yform_art == 'mediafile') {
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','none');
					$(this).parent().parent().next().next().css('display','block');
					$(this).parent().parent().next().next().next().css('display','none');
				}
			}
			if(yform_art == 'checkbox' || yform_art == 'email' || yform_art == 'text' || yform_art == 'textarea'){
				if($(this).parent().parent().next().find('.addFields') != '' && $(this).parent().parent().next().next().find('.gen_bildform') != '') {
					$(this).parent().parent().next().css('display','none');
					$(this).parent().parent().next().next().css('display','none');
					$(this).parent().parent().next().next().next().css('display','none');
				}
			}
		});
	});

</script> 