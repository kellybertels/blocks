<?php
//security extra line to open moodle just internally not from external
defined('MOODLE_INTERNAL') || die();

class block_simplehtml extends block_list {
    public function init() {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }
    // The PHP tag and the curly bracket for the class definition 
    // will only be closed after there is another function added in the next section.

    public function specialization() {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_simplehtml');            
            } else {
                $this->title = $this->config->title;
            }
     
            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_simplehtml');
            }    
        }
    }

    public function get_content() {
    global $OUTPUT, $COURSE, $DB;

    if ($this->content !== null) {
        return $this->content;
      }  
    if (!empty($this->config->text)) {
        $this->content->text = $this->config->text;
    }    
  
    $this->content         = new stdClass;
    $this->content->items  = array();
    $this->content->icons  = array();

 // The other code.
 $url = new moodle_url('/blocks/simplehtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
 $this->content->footer = html_writer::link($url, get_string('addpage', 'block_simplehtml'));

 $icon = $OUTPUT->pix_icon('teacher_list_icon', 'listicon', 'block_simplehtml', []);
 // Placing the icon within the link text.
 $this->content->items[] = html_writer::tag('a', $icon . 'Menu Option 1', array('href' => '/user/files.php'));

 //tutorial example ( do not work)
// $this->content->icons[] = html_writer::empty_tag('img', array('src' => 'images/icons/1.gif', 'class' => 'icon'));

 // Add more list items here   
 return $this->content;

    // This is the new code.
    if ($simplehtmlpages = $DB->get_records('mdl_block_simplehtml', array('blockid' => $this->instance->id))) {
        $this->content->text .= html_writer::start_tag('ul');
        foreach ($simplehtmlpages as $simplehtmlpage) {
            $url = new moodle_url('/blocks/simplehtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id, 'id' => $simplehtmlpage->id, 'viewpage' => '1'));
            $this->content->text .= html_writer::start_tag('li');
            $this->content->text .= html_writer::link($url, $simplehtmlpage->pagetitle);
            $this->content->text .= html_writer::end_tag('li');
        }
        $this->content->text .= html_writer::end_tag('ul');
    }


    }



/* 
    public function get_content() {
        global $OUTPUT, $COURSE, $DB; 

        if ($this->content !== null) {
          return $this->content;
        }       
        $this->content         = new stdClass;
        $this->content->items  = array();
        $this->content->icons  = array();

      //replacing footer to function from Advanced Blocks tutorial
    
        // The other code.
         $url = new moodle_url('/blocks/simplehtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
        $this->content->footer = html_writer::link($url, get_string('addpage', 'block_simplehtml'));

        $icon = $OUTPUT->pix_icon('teacher_list_icon', 'listicon', 'block_simplehtml', []);
        // Placing the icon within the link text.
        $this->content->items[] = html_writer::tag('a', $icon . 'Menu Option 1', array('href' => '/user/files.php'));
    
        //tutorial example ( do not work)
       // $this->content->icons[] = html_writer::empty_tag('img', array('src' => 'images/icons/1.gif', 'class' => 'icon'));
   
        // Add more list items here   
        return $this->content;
      }
 */
      

/*  this was replaced by the get_content function above as recommended at "Additional Content Types" from the tutorial to create a block list

public function get_content() {
    if ($this->content !== null) {
      return $this->content;
    } 
    $this->content =  new stdClass;
    if (! empty($this->config->text)) {
        $this->content->text = $this->config->text;
    }
    //once the task of getting the contentfor the block , will go dinamically now using the if statement above this line bellow can be commented out
    $this->content->text   = 'The content of our SimpleHTML block!'; 

    //this 'else' display the default message if the value havent beeing edited yet
    else{
        $this->content->text = 'go to settings (right corner of this box) to insert some value here.';
        }
    $this->content->footer = 'Footer By Kelly Nagy Bertels'; 
    return $this->content;
}
*/





//this function allows more than one "simplehtml" block be added by the teacher
public function instance_allow_multiple() {
    return true;
  }

//this means this has a config file, this is the right place to put it so: kelly do not move it!  ...this is not an import as in java!
  public function has_config() {
      return true;
}
//this function overrites a function in the moodle, changing how it is saving 
public function instance_config_save($data,$nolongerused =false) {
    if(get_config('simplehtml', 'Allow_HTML') === '1') {
      $data->text = strip_tags($data->text);
    }
   
    // And now forward to the default implementation defined in the parent class
    return parent::instance_config_save($data,$nolongerused);
  }


// public function html_attributes() {
//     $attributes = parent::html_attributes(); // Get default values
//     $attributes['class'] .= ' block_'. $this->name(); // Append our class to class attribute
//     return $attributes;
// }

public function html_attributes() {
    $attributes = parent::html_attributes(); // Get default values

    if(get_config('simplehtml','SET_CSS') == '1')
    {
        $attributes['class'].= ' setbg';
    }
    if(get_config('simplehtml','SET_CSS1') == '1')
    {
        $attributes['class'].= ' setbg1';
    }
    if(get_config('simplehtml','SET_CSS2') == '1')
    {
        $attributes['class'].= ' setbg2';
    }
    if(get_config('simplehtml','SET_CSS3') == '1')
    {
        $attributes['class'].= ' setbg3';
    }
    if(get_config('simplehtml','SET_CSS4') == '1')
    {
        $attributes['class'].= ' setbg4';
    }
    if(get_config('simplehtml','SET_CSS5') == '1')
    {
        $attributes['class'].= ' setbg5';
    }
    if(get_config('simplehtml','SET_CSSBord') == '1')
    {
        $attributes['class'].= ' setborder';
    }
    if(get_config('simplehtml','SET_CSS0') == '1')
    {
        $attributes['class'].= ' settext';
    }
    return $attributes;

}

//this will allow the block to be added just in especific pages index, calendar-view and will not be able to be add in 'course-view social'
/*public function applicable_formats() {
    return array(
        'site-index' => true,
        'my-index' => true,
        'calendar-view' => true, 
        'course-view-social' => false);
      
  }
*/



//last bracket do not delete
}