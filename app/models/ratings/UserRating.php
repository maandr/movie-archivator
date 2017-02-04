<?php
class UserRating {
  public $total;

  public $plot;
  public $dialog;
  public $cinematography;
  public $tention;
  public $sound;
  public $editing;
  public $meaning;
  public $acting;
  public $fun;
  public $rewatch;
  public $score;
  public $look;
  public $characters;

  function __construct() {
    $this->total = 0;
    $this->plot = 11;
    $this->dialog = 11;
    $this->cinematography = 11;
    $this->tention = 11;
    $this->sound = 11;
    $this->editing = 11;
    $this->meaning = 11;
    $this->acting = 11;
    $this->fun = 11;
    $this->rewatch = 11;
    $this->score = 11;
    $this->look = 11;
    $this->characters = 11;
  }
}
?>
