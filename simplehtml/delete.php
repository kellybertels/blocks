<?php
require_once('../../config.php');
 
$courseid = required_param('courseid', PARAM_INT);
$id = optional_param('id', 0, PARAM_INT);
$confirm = optional_param('confirm', 0, PARAM_INT);
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_simplehtml', $courseid);
}
 
require_login($course);
 
if(! $simplehtmlpage = $DB->get_record('block_simplehtml', array('id' => $id))) {
    print_error('nopage', 'block_simplehtml', '', $id);
}
 
$site = get_site();
$PAGE->set_url('/blocks/simplehtml/view.php', array('id' => $id, 'courseid' => $courseid));
$heading = $site->fullname . ' :: ' . $course->shortname . ' :: ' . $simplehtmlpage->pagetitle;
$PAGE->set_heading($heading);
echo $OUTPUT->header();
echo $OUTPUT->footer();