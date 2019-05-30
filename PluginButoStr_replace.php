<?php
class PluginButoStr_replace{
  function __construct() {
    wfPlugin::includeonce('wf/yml');
    wfPlugin::includeonce('wf/array');
  }
  public function page_form(){
    $element = new PluginWfYml(__DIR__.'/element/form.yml');
    wfDocument::renderElement($element->get());
  }
  public function page_replace(){
    $html = wfRequest::get('html');
    $from = wfRequest::get('replace_from');
    $to = wfRequest::get('replace_to');
    if($from=='\n'){
      $from = "\n";
    }elseif($from=='\r\n'){
      $from = "\r\n";
    }elseif($from=='\t'){
      $from = "\t";
    }
    if($to=='\n'){
      $to = "\n";
    }elseif($to=='\t'){
      $to = "\t";
    }
    $html = str_replace($from, $to, $html);
    $element = new PluginWfYml(__DIR__.'/element/replace.yml');
    $element->setByTag(array('html' => $html));
    wfDocument::renderElement($element->get());
  }
}
