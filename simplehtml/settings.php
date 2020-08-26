<?php
/**
 * 
 * 
 * references to : The Effects of Globalizationsection
 * from the Blocks tutorial. https://docs.moodle.org/dev/Blocks
 * 
 * what it needs to do?: this function will forbiden HTML and allows only text be added by the user inside the block. 
 * functionalities here, labels in language/en block_simplehtml
 * 
 * how do I check it is working? 
 * go to your moodle page > site administration > Plugins
 * Scroll down to Blocks > Manage Blocks >find the Simple HTML block> click in Settings
 * 
 * extra tutorials material used here: 
 * https://www.youtube.com/watch?v=9SV6L5OXkNM
 * 
 */

//this is the header and description 
$settings->add(new admin_setting_heading(
    'headerconfig',
    get_string('headerconfig', 'block_simplehtml'),
    get_string('descconfig', 'block_simplehtml')
));

//those are the options to mark- related to allow html 
$settings->add(new admin_setting_configcheckbox(
    'simplehtml/Allow_HTML',
    get_string('labelallowhtml', 'block_simplehtml'),
    get_string('descallowhtml', 'block_simplehtml'),
    '0'
    //the 0 here means that as default the check box will be unchecked.
));

//options for allow CSS classes 
$settings->add(new admin_setting_configcheckbox(
    'simplehtml/SET_CSS',
    //the simplehtml creates a table for my block (isn't Globally stored)
    get_string('labelallowcss', 'block_simplehtml'),
    get_string('descallowcss', 'block_simplehtml'),
    '0'
    //the 0 here means that as default the check box will be unchecked.
));