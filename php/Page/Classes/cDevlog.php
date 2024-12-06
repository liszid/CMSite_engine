<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Samples\{
    sCard
    ,sBreadcrumbs
    ,sFrame
    ,sRedirect
};

class cDevlog implements iDevlog {
    static public function Latest(){
        return self::latestDeployment;
    }
    static public function Prompt($bool){
        $returnContent = '';
        if ($bool) {
            $returnContent .= '
                <div class="container bootstrap snippet" style="color:black">
                        <div class="row">
                            <div class="col-12">
                                <div class=" bg-light">
                                    <div class="container p-3 my-3 bg-light">
                                        <div class="jumbotron bg-light">
                                            '.self::latestDeployment.'
                                            '.self::deploymentLogs.'
                                        </div>
                                    </div><br />
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        return $returnContent;
    }
    static public function Page(){
        
        $textColor = $GLOBALS['Site']['Style']['Text']['Body'];
        $headerTextColor = $GLOBALS['Site']['Style']['Text']['Header'];
        
        $returnString = '
            <div class="mx-md-3 row pt-1 justify-content-center">
                <div class="d-none d-md-block col-11 pt-4">
                    '.sBreadcrumbs::Prompt('Devlog').'
                </div>
                <br />
                <div class="col-12 m-0 p-0 text-'.$textColor.'">
                    <div class="container bootstrap snippet" style="color:black">
                        <div class="row">
                            <div class="col-12">
                                <div class="bg-light m-0 p-0">
                                    <div class="container m-0 p-0 bg-light">
                                        <div class="jumbotron m-0 p-0 bg-light">
                                            '.self::latestDeployment.'
                                            '.self::deploymentLogs.'
                                        </div>
                                    </div><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            
        return $returnString; 
    }
}