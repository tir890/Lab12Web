<?php
class Form {
    private $fields = [];
    private $action;
    private $submitBtn;
    private $jumField = 0;

    public function __construct($action = "", $submitBtn = "Simpan") {
        $this->action = $action;
        $this->submitBtn = $submitBtn;
    }

    public function addField($name, $label, $type = "text", $value = "") {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->fields[$this->jumField]['type'] = $type;
        $this->fields[$this->jumField]['value'] = $value;
        $this->jumField++;
    }

    public function displayForm() {
        echo "<form action='{$this->action}' method='POST' class='custom-form'>";
        echo "<table width='100%'>";
        
        foreach ($this->fields as $f) {
            echo "<tr>
                    <td width='20%'><label>{$f['label']}</label></td>";
            
            echo "<td>";
            if ($f['type'] == 'textarea') {
                echo "<textarea name='{$f['name']}'>{$f['value']}</textarea>";
            } else {
                echo "<input type='{$f['type']}' name='{$f['name']}' value='{$f['value']}'>";
            }
            echo "</td></tr>";
        }
        
        echo "<tr><td></td><td><button type='submit' class='btn-submit'>{$this->submitBtn}</button></td></tr>";
        echo "</table>";
        echo "</form>";
    }
}
?>