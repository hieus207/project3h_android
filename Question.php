<?php
class Question
{
  public $Idquestion;
  public $Questionform;
  public $Content;
  public $Image;
  public $Da1;
  public $Da2;
  public $Da3;
  public $Da4;
  public $Dadung;
  public function __construct($Idquestion,$Questionform,$Content,$Image,$Da1,$Da2,$Da3,$Da4,$Dadung)
  {
    $this->Idquestion = $Idquestion;
    $this->Questionform = $Questionform;
    $this->Content = $Content;
    $this->Image = $Image;
    $this->Da1 = $Da1;
    $this->Da2 = $Da2;
    $this->Da3 = $Da3;
    $this->Da4 = $Da4;
    $this->Dadung = $Dadung;
  }
 
}
?>