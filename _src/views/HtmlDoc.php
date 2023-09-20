<?php 
 // in htmldoc.php :
 class HtmlDoc
 {
     private $title;
     private $author;
 //======================================================
 // PUBLIC
 //======================================================
     public function __construct(string $title, string $author)
     {
         $this->title = $title;
         $this->author = $author;
     }
 
     public function show()
     {
         $this->beginDoc();
         $this->beginHead();
         $this->showHeadContent();
         $this->endHead();
         $this->beginBody();
         $this->showBodyContent();
         $this->endBody();
         $this->endDoc();
     }    
 //======================================================
 // PROTECTED
 //======================================================
     protected function beginDoc() 
     { 
         echo '<!DOCTYPE html>'.PHP_EOL.'<html>'; 
     }
 
     protected function showHeadContent() 
     { 
         if ($this->title) 
             echo '<title>'.$this->title.'</title>'.PHP_EOL; 
         if ($this->author) 
             echo '<meta name="author" content="'.$this->author.'" />'.PHP_EOL; 
     }
     
     protected function showBodyContent() 
     { 
         echo '<h1>HtmlDoc</h1>'.PHP_EOL; 
     }
 //======================================================
 // PRIVATE
 //======================================================
     private function beginHead() 
     { 
         echo '<head>'.PHP_EOL; 
     }
 
     private function endHead()
     { 
         echo '</head>'.PHP_EOL; 
     }
     
     private function beginBody() 
     { 
         echo '<body>'.PHP_EOL; 
     }
 
     private function endBody() 
     { 
         echo '</body>'.PHP_EOL; 
     }
     
     private function endDoc() 
     { 
         echo '</html>'.PHP_EOL; 
     }
 }