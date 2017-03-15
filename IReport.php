<?php

namespace andjelko\ireport;

use Yii;
use yii\base\Component;

#include_once(dirname(__FILE__) . '/IReportParser.php');
#include_once(dirname(__FILE__) . '/IReportRender.php');
#
use andjelko\ireport\IReportParser;
use andjelko\ireport\IReportRender;
include_once(dirname(__FILE__) . '/IReportProvider.php');
use IReportProvider;
use IReportProviderDB;


//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class IReport extends Component{

    private $reportparser;
    public $debug = false;
    
    public function init()
    {
        parent::init();
        $this->reportparser = new IReportParser;
        $this->reportparser->parser(simplexml_load_file($fileReport));
    }

    public function __construct($fileReport) {

        $this->reportparser = new IReportParser;
        $this->reportparser->parser(simplexml_load_file($fileReport));
    }

    public function getParameters() {
        return $this->reportparser->parameters;
    }

    public function setParameters($value) {
        $this->reportparser->parameters = $value;
    }

    public function execute($outpage = 'D',$filename='report_name.pdf') {
        $this->reportparser->debugsql = $this->debug;
        $IRender = new IReportRender($this->reportparser);
        $IRender->debuggroup = $this->debug;
        $IRender->provider = new IReportProviderDB(Yii::$app->db);
        $IRender->outpage = $outpage;
        $IRender->filename = $filename;
        return $IRender->execute();
    }

}

?>
