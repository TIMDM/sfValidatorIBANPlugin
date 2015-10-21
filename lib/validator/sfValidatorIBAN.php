<?php
function rep($letter)
{
  return intval(ord(strtolower($letter[0])) - 87);
}
class sfValidatorIBAN extends sfValidatorBase
{
  public function doClean($value)
  {
    if (null === $value || '' === $value) {
    //  return false;
    }

    $value = $this->ibanToUpper($value);

    // An IBAN without a country code is not an IBAN.
    if (0 === preg_match('/[A-Z]/', $value)) {
      throw new sfValidatorError($this, 'invalid', array('value'=>$value));
    }

    $teststring = preg_replace('/\s+/', '', $value);
    if (strlen($teststring) < 4) {
      throw new sfValidatorError($this, 'invalid', array('value'=>$value));
    }

    $teststring = substr($teststring, 4)
      .strval(ord($teststring{0}) - 55)
      .strval(ord($teststring{1}) - 55)
      .substr($teststring, 2, 2);

    $teststring = preg_replace_callback('/[A-Z]/', "rep", $teststring);
    $rest = 0;

    $strlen = strlen($teststring);
    for ($pos = 0; $pos < $strlen; $pos += 7) {
      $part = strval($rest).substr($teststring, $pos, 7);
      $rest = intval($part) % 97;
    }

    if ($rest != 1) {
      throw new sfValidatorError($this, 'invalid', array('value'=>$value));
    }

    return $value;
  }

  private function ibanToUpper($value)
  {
    return strtoupper($value);
  }
}