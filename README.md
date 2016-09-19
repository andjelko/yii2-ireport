# yii2-ireport

Components for run jasperReports  

This is rewrite from yii-ireport

yii2-ireport use tcpdf to create pdf

## How to install

Update your composer.json with

    {
      "require": {
        "andjelko/yii2-ireport": "*"
      }
    }

## Using

use andjelko\ireport\IReport;

$path = dirname(__FILE__) . 'file.jrxml'; // path to jrxml<br>
$IReport = new  IReport($path);<br>
$IReport->parameters = array('parameters'=>$parameters);<br>
$IReport->execute('I','file_name');
