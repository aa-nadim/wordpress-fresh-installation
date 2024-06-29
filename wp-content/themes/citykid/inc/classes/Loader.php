<?php
namespace Citykid;

final class Loader{
    public function __construct() {
       $this->init();
       add_action( 'init', [$this, 'globals'] ); 
	}
    
    private function init(){
       
        new Header();        
        new Footer();             
        
    }

    public function globals(){
        // $GLOBALS['citykid'] = new Helpers();
    }

}