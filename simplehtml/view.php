<?php

require_once('../../config.php');
require_once('simplehtml_form.php');


global $DB, $OUTPUT, $PAGE;


// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
//The navigation Breadcrumbs
$blockid = required_param('blockid', PARAM_INT);



//"Final Alterations" section at adv Block tutorial
$id = optional_param('id', 0, PARAM_INT);
$viewpage = optional_param('viewpage', false, PARAM_BOOL);

// You are testing an assignment of a variable here. I would expand this a little bit
// To something like this:

// Also, for the new php we have (you werent told this yet) instead of array(), we can use []
// Which variable are you getting the form data from? I think so ... :P Im not 100% sure what toform from form does. Okay well lets look at them.
// toform? fromform?
$course = $DB->get_record('course', ['id' => $courseid]);
if (empty($course)) {
    print_error('invalidcourse', 'block_simplehtml', $courseid);
}

require_login($course);
require_capability('block/simplehtml:managepages', context_course::instance($courseid));
$PAGE->set_url('/blocks/simplehtml/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_simplehtml'));


$simplehtml = new simplehtml_form();

//related to buttons section at adv blocks tutorial 
$toform['blockid'] = $blockid;
$toform['courseid'] = $courseid;
$simplehtml->set_data($toform);

echo $OUTPUT->header();

$settingsnode = $PAGE->settingsnav->add(get_string('simplehtmlsettings', 'block_simplehtml'));
$editurl = new moodle_url('/blocks/simplehtml/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_simplehtml'), $editurl);
$editnode->make_active();

/* 
// We need to add code to appropriately act on and store the submitted data
if (!$DB->insert_record('block_simplehtml', $fromform)) {
    print_error('inserterror', 'block_simplehtml');
} */

print_r($simplehtml->get_data());
if ($simplehtml->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $id));
    redirect($courseurl);
} else if ($fromform = $simplehtml->get_data()) {

    // Changing the array displaytext to the textvalue from the array. 
    $fromform->displaytext = $fromform->displaytext['text'];

    $courseurl = new moodle_url('/course/view.php', array('id' => $courseid));

    //for testing if array is printing 
    // print_object ($fromform) ;

    // redirect($courseurl);

    // We need to add code to appropriately act on and store the submitted data
    if ($fromform->id != 0) {
        print_r($fromform);
        if (!$DB->update_record('block_simplehtml', $fromform)) {
            print_error('updateerror', 'block_simplehtml');
        }
    } else {
        if (!$DB->insert_record('block_simplehtml', $fromform)) {
            print_error('inserterror', 'block_simplehtml');
        }
    }

    // form didn't validate or this is the first display
    $site = get_site();

    if ($id) {
        $simplehtmlpage = $DB->get_record('block_simplehtml', array('id' => $id));
        if ($viewpage) {
            block_simplehtml_print_page($simplehtmlpage);
        } else {
            $simplehtml->set_data($simplehtmlpage);
            $simplehtml->display();
        }
    } else {
        $simplehtml->display();
    }

    /* 
this was eddited because the editing functionality part added the code above , comment it out will avoid display twice
//final alterations code / display page 
if ($viewpage) {
    $simplehtmlpage = $DB->get_record('block_simplehtml', array('id' => $id));
    block_simplehtml_print_page($simplehtmlpage);
} else {
    $simplehtml->display(); 
} */
} else {
    // form didn't validate or this is the first display
    $site = get_site();
    $simplehtml->display();
    echo $OUTPUT->footer();
}
