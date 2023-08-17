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
    /**
     * length
     */
    $length = new PluginWfArray();
    /**
     * Turn off trim.
     */
    wfRequest::$trim = false;
    /**
     * 
     */
    $html = wfRequest::get('html');
    $from = wfRequest::get('replace_from');
    $to = wfRequest::get('replace_to');
    /**
     * length before
     */
    $length->set('before', wfPhpfunc::strlen($html));
    /**
     * modify data
     */
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
    /**
     * 
     */
    if($from == '[beginning]'){
      wfPlugin::includeonce('string/array');
      $sa = new PluginStringArray();
      $data = $sa->from_br($html);
      foreach($data as $k => $v){
        $data[$k] = $to.$v;
      }
      $html = '';
      foreach($data as $v){
        $html .= $v."\n";
      }
    }elseif($from == '[end]'){
      wfPlugin::includeonce('string/array');
      $sa = new PluginStringArray();
      $data = $sa->from_br($html);
      foreach($data as $k => $v){
        $data[$k] = $v.$to;
      }
      $html = '';
      foreach($data as $v){
        $html .= $v."\n";
      }
    }else{
      $html = wfPhpfunc::str_replace($from, $to, $html);
    }
    /**
     * length after
     */
    $length->set('after', wfPhpfunc::strlen($html));
    /**
     * 
     */
    $element = new PluginWfYml(__DIR__.'/element/replace.yml');
    $element->setByTag(array('html' => $html));
    $element->setByTag($length->get(), 'length');
    wfDocument::renderElement($element->get());
  }
}
