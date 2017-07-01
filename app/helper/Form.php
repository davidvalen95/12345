<?php



namespace App\Helper;

class Form{

    public $placeholder;
    public $name;
    public $icon;
    public $type;
    public $options = array();
    public $oldValue = "";
    public $validatorSetting;
    //placeholder, name, type, icon, options:array
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
        }else if ($this->type == "textarea"){
            $input = "<textarea class='form-control' name='$this->name' rows='15' class='form-control' id='$this->name' placeholder='$this->placeholder'></textarea>";
        }else if($this->type == "editor"){
            $input = "<textarea  rows='15' class='form-control' id='$this->name' placeholder='' name='$this->name'></textarea>
                        <script type='text/javascript'>
                        	$('#$this->name').wysihtml5();

                            $('.textarea').val();
                        </script>
                        ";
        }else{

            $input = "<input id='$this->name' value='$this->oldValue' type='$this->type' class='form-control' placeholder='$this->placeholder' name ='$this->name'>";
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
        <div class='form-group mForm-group $hasError'>

          <label  for='$this->name' class=' control-label'>$this->placeholder</label>
          $input
          $errorMessage

          <span class='glyphicon $this->icon form-control-feedback'></span>
        </div>

        ";

        return $form;
    }








    public static function getEmail(){
        $form = new Form("Email","email","email","glyphicon-envelope");
        $form->validatorSetting = 'required|email';
        return  $form;
        $form = new Form("Email","email","email","glyphicon-envelope");

    }

    public static function getPassword(){
        return new Form("Password","password","password","glyphicon-lock");;
    }
}


?>
