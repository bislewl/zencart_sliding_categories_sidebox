<?php
if(!defined('CSS_JS_LOADER_VERSION') && ZEN_LIGHTBOX_STATUS == 'true') {
    echo '<link rel="stylesheet" type="text/css" href="'.$template->get_template_dir('stylesheet_sidebox_categories.css',DIR_WS_TEMPLATE, $current_page_base,'css'). '/stylesheet_sidebox_categories.css'.'">';
    echo '<script type="text/javascript">
        if (typeof jQuery == \'undefined\') {  
  document.write("<scr" + "ipt type=\"text/javascript\" src=\"//code.jquery.com/jquery-1.11.3.min.js\"></scr" + "ipt>");
  }
</script>'."\n";
    echo '<script type="text/javascript" src="'.$template->get_template_dir('jquery_sidebox_categories.js',DIR_WS_TEMPLATE, $current_page_base,'jscript/jquery'). '/jquery_sidebox_categories.js'.'"></script>'; 
 } 
