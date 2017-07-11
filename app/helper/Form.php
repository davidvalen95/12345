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
    //placeholder, name, type, icon, options:array, $value=null
    function __construct($placeholder, $name, $type, $icon, $options = array(), $value = null){
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->icon = $icon;
        $this->type = $type;
        $this->options = $options;
        if($value!=null){
            $this->oldValue = $value;
        }else{
            $this->oldValue = old($name);
        }

    }


    //return string format div
    public function getHidden(){
        return "<input id='$this->name' value='$this->oldValue' type='$this->type' class='form-control' placeholder='$this->placeholder' name ='$this->name'>";

    }
    public function getFormFormat($errors = NULL){
        if($this->type == "select"){
            $input = "<select required='required' name='$this->name' class='form-control'><option value=''>
                $this->placeholder
            </option>";
            foreach($this->options as $key=>$value){
                $selected = "";
                if($this->oldValue == $value){
                    $selected = "selected='selected'";
                }
              $input .= "<option $selected value='$key'>
                $value
              </option>";
            }
            $input .= "</select>";
        }else if ($this->type == "textarea"){
            $input = "<textarea class='form-control' name='$this->name' rows='15' class='form-control' id='$this->name' placeholder='$this->placeholder'></textarea>";
        }else if($this->type == "editor"){
            $input = "<textarea  class='form-control' id='$this->name' placeholder='' name='$this->name'></textarea>
                        <script type='text/javascript'>
                        	$('#$this->name').wysihtml5();

                            $('.textarea').val();
                        </script>
                        ";
        }else if($this->type == 'hidden'){


            return "<input  id='$this->name' value='$this->oldValue' type='hidden' class='form-control' placeholder='$this->placeholder' name ='$this->name'>";

        }else if($this->type == "datepicker"){

            $input = "
                    <div class='input-group date'>
                        <div class='input-group-addon'>
                            <i class='fa fa-calendar'></i>
                        </div>
                        <input class='form-control pull-right' id='$this->name' type='text' name='$this->name'>
                    </div>


                    <script type='text/javascript'>
                        $('#$this->name').datepicker({useCurrent:false});;

                        $('.textarea').val();
                    </script>

                    ";
        }

        else{

            $input = "<input id='$this->name' value='$this->oldValue' type='$this->type' class='form-control' placeholder='$this->placeholder' name ='$this->name'>";
        }
        $hasError = "";
        $errorMessage = "";
        if($errors){
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
        }
        $form =  "
        <div class='form-group mForm-group $hasError'>

          <label  for='$this->name' class=' control-label'>$this->placeholder</label>
          $input
          $errorMessage

          <span class='glyphicon $this->icon form-control-feedback'></span>
        </div>

        ";
        // debug($form);
        return $form;
    }



    public function getFormFormat2($errors){
        if(false){

        }
        else if($this->type == 'hidden'){


            return "<input  id='$this->name' value='$this->oldValue' type='hidden' class='form-control' placeholder='$this->placeholder' name ='$this->name'>";

        }else if($this->type == 'datepicker'){
            $input = "
            <div class='input-group date'>
                <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                </div>
                <input class='form-control pull-right' id='$this->name' type='text' name='$this->name'>
            </div>


            <script type='text/javascript'>
                $('#$this->name').datepicker({useCurrent:false});;

                $('.textarea').val();
            </script>


            ";
            // <div class="form-group">
            //     <label>Date:</label>
            //

            //     <!-- /.input group -->
            //   </div>
        }
        else{
            $input = "<div class='col-sm-10'><input id='$this->name' value='$this->oldValue' type='$this->type' class='form-control' placeholder='$this->placeholder' name ='$this->name'></div>";

        }




        $hasError = ($errors->has($this->name) ? "has-error" : NULL);
        $errorMessage = "";
        if(true){
            $errorMessage.= "<span class='helpBlock col-sm-offset-2 col-sm-10'>";
            foreach($errors->get($this->name) as $error){
                $errorMessage.= "<p>
                    $error
                </p> ";
            }
            $errorMessage .= "</span>";
        }
        $form =  "
        <div class='form-group mForm-group $hasError'>

          <label  for='$this->name' class='col-sm-2 control-label'>$this->placeholder</label>
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
