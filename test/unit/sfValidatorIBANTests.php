<?php

require_once('test/bootstrap/unit.php');
require_once('lib/validator/sfValidatorIBAN.php');

class sfValidatorIBANTest extends PHPUnit_Framework_TestCase
{
  public function getIBANS()
  {
    $arr = array(
        "AD"=>"AD1200012030200359100100",
        "AE"=>"AE070331234567890123456",
        "AL"=>"AL47212110090000000235698741",
        "AT"=>"AT611904300234573201",
        "AZ"=>"AZ21NABZ00000000137010001944",
        "BA"=>"BA391290079401028494",
        "BE"=>"BE68539007547034",
        "BG"=>"BG80BNBG96611020345678",
        "BH"=>"BH67BMAG00001299123456",
        "BR"=>"BR9700360305000010009795493P1",
        "CH"=>"CH9300762011623852957",
        "CR"=>"CR0515202001026284066",
        "CY"=>"CY17002001280000001200527600",
        "CZ"=>"CZ6508000000192000145399",
        "DE"=>"DE89370400440532013000",
        "DK"=>"DK5000400440116243",
        "DO"=>"DO28BAGR00000001212453611324",
        "EE"=>"EE382200221020145685",
        "ES"=>"ES9121000418450200051332",
        "FI"=>"FI2112345600000785",
        "FO"=>"FO6264600001631634",
        "FR"=>"FR1420041010050500013M02606",
        "GB"=>"GB29NWBK60161331926819",
        "GE"=>"GE29NB0000000101904917",
        "GI"=>"GI75NWBK000000007099453",
        "GL"=>"GL8964710001000206",
        "GR"=>"GR1601101250000000012300695",
        "GT"=>"GT82TRAJ01020000001210029690",
        "HR"=>"HR1210010051863000160",
        "HU"=>"HU42117730161111101800000000",
        "IE"=>"IE29AIBK93115212345678",
        "IL"=>"IL620108000000099999999",
        "IS"=>"IS140159260076545510730339",
        "IT"=>"IT60X0542811101000000123456",
        "KW"=>"KW81CBKU0000000000001234560101",
        "KZ"=>"KZ86125KZT5004100100",
        "LB"=>"LB62099900000001001901229114",
        "LI"=>"LI21088100002324013AA",
        "LT"=>"LT121000011101001000",
        "LU"=>"LU280019400644750000",
        "LV"=>"LV80BANK0000435195001",
        "MC"=>"MC5811222000010123456789030",
        "MD"=>"MD24AG000225100013104168",
        "ME"=>"ME25505000012345678951",
        "MK"=>"MK07250120000058984",
        "MR"=>"MR1300020001010000123456753",
        "MT"=>"MT84MALT011000012345MTLCAST001S",
        "MU"=>"MU17BOMM0101101030300200000MUR",
        "NL"=>"NL91ABNA0417164300",
        "NO"=>"NO9386011117947",
        "PK"=>"PK36SCBL0000001123456702",
        "PL"=>"PL61109010140000071219812874",
        "PS"=>"PS92PALS000000000400123456702",
        "PT"=>"PT50000201231234567890154",
        "RO"=>"RO49AAAA1B31007593840000",
        "RS"=>"RS35260005601001611379",
        "SA"=>"SA0380000000608010167519",
        "SE"=>"SE4550000000058398257466",
        "SI"=>"SI56263300012039086",
        "SK"=>"SK3112000000198742637541",
        "SM"=>"SM86U0322509800000000270100",
        "TN"=>"TN5910006035183598478831",
        "TR"=>"TR330006100519786457841326",
        "VG"=>"VG96VPVG0000012345678901",
    );
    return $arr;
  }

  public function setUp(){

  }

  public function setDown(){

  }

  public function testIBANIsValid()
  {
    foreach($this->getIBANS() as $iban)
    {
      $validator = new sfValidatorIBAN();
      $this->assertEquals($validator->doClean($iban), $iban);
    }
  }

  /**
   * @expectedException sfValidatorError
   * @expectedExceptionMessage Invalid.
   */
  public function testExceptionWrongBank()
  {
    $validator = new sfValidatorIBAN();
    $this->assertEquals($validator->doClean('VG96VPVG0000012345678900'), 'VG96VPVG0000012345678901');
  }

  public function testExceptionLowerCase()
  {
    $validator = new sfValidatorIBAN();
    $this->assertEquals($validator->doClean('vg96vpvg0000012345678901'), 'VG96VPVG0000012345678901');
  }
}
