<?php
/**
 * FckEditor Helper Class
 *
 * This file represents the fckeditor.
 *
 * PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright		Copyright 2008, X-Project Team http://www.x-project.com
 * @version			1.0 Alpha
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class FckHelper extends Helper 
{
	var $Width = 800;
	var $Height = 500;

	function load($id, $width=null, $height=null, $toolbar = 'Default') {
		$did = Inflector::camelize(str_replace('/', '_', $id));
		if ($width) { 
			$this->Width = $width; 
		}
		if ($height) { 
			$this->Height = $height; 
		}
		
		$js = $this->webroot.'js/fckeditor/';
		$toolbar = 'Default';

return<<<FCK_CODE
<script type="text/javascript">
fckLoader_$did = function () {
var bFCKeditor_$did = new FCKeditor('$did');
bFCKeditor_$did.BasePath = '$js';
bFCKeditor_$did.ToolbarSet = '$toolbar';
bFCKeditor_$did.Width = $this->Width;
bFCKeditor_$did.Height = $this->Height;
bFCKeditor_$did.ReplaceTextarea();
}
fckLoader_$did();
</script>
FCK_CODE;
}

	function fileBrowserInput($fieldName, $htmlAttributes = array(), $return = false) {
		$output = $this->input($fieldName, $htmlAttributes, $return);
		if (!isset($htmlAttributes['id'])) {
			$htmlAttributes['id'] = $this->model . Inflector::camelize($this->field);
		}
			$output .= '<script type="text/javascript">';
			$output .= "//<![CDATA[\n";
			$output .= "function openFileBrowser(id){\n";
			$output .= "var fck = new FCKeditor(id);\n";
			$output .= "fck.BasePath = '".$this->webroot."js/fckeditor/'\n";
			$output .= "var url = fck.BasePath + 'editor/filemanager/browser/default/browser.html?Type=Image&amp;Connector=connectors/php/connector.php';\n";
			$output .= "var sOptions = 'toolbar=no,status=no,resizable=yes,dependent=yes,scrollbars=yes';\n";
			$output .= "sOptions += ',width=640';\n";
			$output .= "sOptions += ',height=480';\n";
			$output .= "window.SetUrl = function(fileUrl){\n";
			$output .= "\$(id).value = fileUrl;\n";
			$output .= "}\n";
			$output .= "var oWindow = window.open( url, 'FCKBrowseWindow', sOptions ) ;\n";
			$output .= "}\n";
			$output .= "//]]>\n";
			$output .= '</script>';
			$output .= '<a href="#" onclick="openFileBrowser(\''.$htmlAttributes['id'].'\'); return false;">select an image...</a>';
			return $output;
			}
}

?>