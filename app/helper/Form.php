<?php



namespace App\Helper;

class Form{

    public $placeholder;
    public $name;
    public $icon;
    public $type;
    public $options = array();
    public $oldValue = "";
    function __construct($placeholder, $name, $type, $icon, $options = array()){
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->icon = $icon;
        $this->type = $type;
        $this->options = $options;
        $this->oldValue = old($name);
    }


    //return string format div
    public function getFormFormat($cssCounter=0,$errors = NULL){
        if($this->type == "select"){
            $input = "<select required='required' name='$this->name' class='form-control'>";
            foreach($this->options as $key=>$value){
              $input .= "<option value='$key'>
                $value
              </option>";
            }
            $input .= "</select>";
        }else if ($this->type == ""){

        }else{

            $input = "<input value='$this->oldValue' type='$this->type' class='form-control' placeholder='$this->placeholder' name ='$this->name'>";
        }

        $hasError = ($errors->has($this->name) ? "has-error" : NULL);
        $errorMessage = "";
        if(true){
            $errorMessage.= "<span class='helpBlock'>";
            foreach($errors->get($this->name) as $error){
                $errorMessage.= "<p>
                    $error
                </p> ";
            }
            $errorMessage .= "</span>";
        }
        $form =  "
        <div class='form-group $hasError'>

          <label  class=' control-label mLabel-$cssCounter'>$this->placeholder</label>
          $input
          $errorMessage

          <span class='glyphicon $this->icon form-control-feedback'></span>
        </div>

        ";

        return $form;
    }


}


?>
