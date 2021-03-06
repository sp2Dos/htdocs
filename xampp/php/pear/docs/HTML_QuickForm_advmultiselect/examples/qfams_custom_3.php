<?php
/**
 * Custom advMultiSelect HTML_QuickForm element
 * loading values with fancy attributes (disabled, ...)
 *
 * @version    $Id: qfams_custom_3.php,v 1.2 2005/08/18 14:58:52 farell Exp $
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @package    HTML_QuickForm_advmultiselect
 * @subpackage Examples
 * @access     public
 * @example    examples/qfams_custom_3.php
 *             qfams_custom_3 source code
 * @link       http://www.laurent-laville.org/img/qfams/screenshot/custom3.png
 *             screenshot (Image PNG, 374x275 pixels) 4.96 Kb
 */

require_once 'HTML/QuickForm.php';
require_once 'HTML/QuickForm/advmultiselect.php';

$form = new HTML_QuickForm('amsCustom3');
$form->removeAttribute('name');        // XHTML compliance

$fruit_array = array(
    'apple'     =>  'Apple',
    'orange'    =>  'Orange',
    'pear'      =>  array('Pear', array('disabled' => 'disabled')),
    'banana'    =>  'Banana',
    'cherry'    =>  'Cherry',
    'kiwi'      =>  'Kiwi',
    'lemon'     =>  'Lemon',
    'lime'      =>  'Lime',
    'tangerine' =>  'Tangerine',
);

// rendering with QF renderer engine and template system
$form->addElement('header', null, 'Advanced Multiple Select: custom layout ');

$ams =& $form->addElement('advmultiselect', 'fruit', null, null,
                           array('class' => 'pool')
);
foreach ($fruit_array as $key => $data) {
    if (!is_array($data)) {
        $data = array($data);
    }
    $attr = isset($data[1]) ? $data[1] : null;
    $ams->addOption($data[0], $key, $attr);
}

$ams->setLabel(array('Fruit:', 'Available', 'Selected'));
$ams->setButtonAttributes('add',    array('value' => 'Add >>',
                                           'class' => 'inputCommand'
));
$ams->setButtonAttributes('remove', array('value' => '<< Remove',
                                           'class' => 'inputCommand'
));
$template = '
<table{class}>
<!-- BEGIN label_2 --><tr><th align="center">{label_2}</th><!-- END label_2 -->
<!-- BEGIN label_3 --><th align="center">{label_3}</th></tr><!-- END label_3 -->
<tr>
  <td>{unselected}</td>
  <td>{selected}</td>
</tr>
<tr>
  <td>{add}</td>
  <td>{remove}</td>
</tr>
</table>';
$ams->setElementTemplate($template);

if (isset($_POST['fruit'])) {
    $form->setDefaults(array('fruit' => $_POST['fruit']));
}

$form->addElement('submit', 'send', 'Send');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HTML_QuickForm::advMultiSelect custom example 3</title>
<style type="text/css">
<!--
body {
  background-color: #FFF;
  font-family: Verdana, Arial, helvetica;
  font-size: 10pt;
}

table.pool {
  border: 0;
  background-color: lightyellow;
}
table.pool td {
  padding-left: 1em;
}
table.pool th {
  font-size: 80%;
  font-style: italic;
  text-align: center;
}
table.pool select {
  background-color: lightblue;
}

.inputCommand {
    background-color: #d0d0d0;
    border: 1px solid #7B7B88;
    width: 7em;
    margin-bottom: 2px;
}
// -->
</style>
<?php echo $ams->getElementJs(false); ?>
</head>
<body>
<?php
if ($form->validate()) {
    $clean = $form->getSubmitValues();

    echo '<pre>';
    print_r($clean);
    echo '</pre>';
}
$form->display();
?>
</body>
</html>