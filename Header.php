<?php
class Header
{

public function __construct(string $header)
{
    $this->header = $header;
}

public function show()
{
    print "<div class='pagetop'><header><h2 style=font-family:dubai>";
    print htmlspecialchars($this->header);
    print "</h2></header>";
}

}
?>