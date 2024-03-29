<?php

require_once "_src/views/appdoc.php";

class FormDoc extends AppDoc
{
    public function __construct($content)
    {        
        parent::__construct(
            $content["title"],
            $content["header"],
            $content["navlinks"],
            $content["session"],
            $content["author"]
        );

        $this->form = $content["form"];
        $this->method = $content["method"];
        $this->fields = $content["fields"];
    }


    public function showMainContent()
    {
        $this->openForm();
        $this->mainForm();
        $this->closeForm();
    }


    protected function openForm()
    {
        print "<div class=form>
        <form method=".$this->method." id=".$this->form.">
            <table>";
    }

    protected function closeForm()
    {
        print "
        </table>
        </form></div>
        ";
    }

    protected function validateField($data)
    {
        $result = array(
            "value" => "",
            "error" => ""
        );
        require_once "_src/tools/sanitize_data.php";
        $input = new SanitizeData;
        
        if (empty($data))
        {
            $result["error"] = "ERROR";
        }
        else
        {
            $result["value"] = $input->sanitize($data);
        }
        return $result;
    }

    protected function mainForm()
    {
        foreach ($this->fields as $fields=>$field)
            {
                print PHP_EOL.
"                <tr>".PHP_EOL.
"                    <td>".$field["label"]."</td>";
                if($field["type"] == "textarea")
                {
                    print PHP_EOL.
"                    <td style='text-align:left'><textarea cols=42 rows=6 name=".$field["name"]."></textarea></td>";
                }
                else
                {
                    print PHP_EOL.
"                    <td style='text-align:left'><input type=".$field["type"]." name=".$field["name"]." value=".$field["value"]."></td>";
                }
                print PHP_EOL.
"                    <td><span class=error>".$field["error"] = isset($field["error"]) ? $field["error"] : ''."</span></td>
                </tr>";
            }       
    }
}

?>