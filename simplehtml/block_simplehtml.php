<?php
class block_simplehtml extends block_base {
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
    if ($this->content !== null) {
      return $this->content;
    } 
    $this->content =  new stdClass;
    if (! empty($this->config->text)) {
        $this->content->text = $this->config->text;
    }
    /*//once the task of getting the contentfor the block , will go dinamically now using the if statement above this line bellow can be commented out
    $this->content->text   = 'The content of our SimpleHTML block!'; */

    //this 'else' display the default message if the value havent beeing edited yet
    else{
        $this->content->text = 'go to settings (right corner of this box) to insert some value here.';
        }
    $this->content->footer = 'Footer By Kelly Nagy Bertels'; 
    return $this->content;
}

//this function allows more than one "simplehtml" block be added by the teacher
public function instance_allow_multiple() {
    return true;
  }


}