<?php
$string['pluginname'] = 'Simple HTML block';
$string['simplehtml'] = 'Simple HTML';
$string['simplehtml:addinstance'] = 'Add a new simple HTML block';
$string['simplehtml:myaddinstance'] = 'Add a new simple HTML block to the My Moodle page';
$string['blockstring'] = 'Edit the Content:';
$string['blocktitle'] = 'Edit the Title :';

if (! empty($this->config->text)) {
    $this->content->text = $this->config->text;
}
