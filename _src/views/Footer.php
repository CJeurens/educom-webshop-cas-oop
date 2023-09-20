<?php
class Footer
{
    public function __construct(string $author)
    {
        $this->author = $author;
    }

    public function show()
    {
        print "<footer><p>".htmlspecialchars("©2023 ".$this->author."")."</p></footer>";
    }
}
?>