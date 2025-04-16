<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

class sRedirect
{
    public static function Home(): string
    {
        return self::Error([
            "icon" => "exclamation-triangle",
            "title" => "Hiba",
            "desc" => "Érvénytelen próbálkozás",
            "script" => "Instance.initElmnt('x=Home'); $('[data-dismiss=modal]').trigger({ type: 'click' });",
        ]);
    }

    public static function Modal(array $array = []): string
    {
        return '
            <modalmessage>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa ' .
            $array["icon"] .
            '"></i> ' .
            $array["title"] .
            '</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center justification-centered">
                    <h4>' .
            $array["desc"] .
            '</h4>
                    <div class="spinner-grow">
                        <img style="display:none;" src="' .
            $GLOBALS["Root"]["Path"] .
            'images/placeholder.png" alt="Loading Animation" onload="setTimeout(function(){ ' .
            (isset($array["script"]) ? $array["script"] : "window.location.reload()") .
            '}, 750);">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            </modalmessage>';
    }

    public static function Error(array $array = []): string
    {
        return '
            <errormessage>
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title text-white"><i class="fa ' .
            $array["icon"] .
            '"></i> ' .
            $array["title"] .
            '</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center text-white justification-centered">
                    <h4>' .
            $array["desc"] .
            '</h4>
                    <div class="spinner-grow">
                        <img style="display:none;" src="' .
            $GLOBALS["Root"]["Path"] .
            'images/placeholder.png" alt="Loading Animation" onload="setTimeout(function(){ ' .
            (isset($array["script"]) ? $array["script"] : "window.location.reload()") .
            '}, 750);">
                    </div>
                </div>
            </div>
            </errormessage>';
    }

    public static function Sample(array $array = []): string
    {
        $redirectArray = [
            "icon" => $array["redirect"]["icon"],
            "title" => $array["redirect"]["title"],
        ];
        if ($array["bool"]) {
            if (isset($array["update"]) && $array["update"]) {
                $dUser = new dUser();
                $dUser::Reload($array["id"]);
            }
            if (isset($array["redirect"]["success"])) {
                $redirectArray["script"] = $array["redirect"]["success"];
            }
            $redirectArray["desc"] = "Sikeres " . $array["redirect"]["desc"];
        } else {
            if (isset($array["redirect"]["fail"])) {
                $redirectArray["script"] = $array["redirect"]["fail"];
            }
            $redirectArray["desc"] = "Sikertelen " . $array["redirect"]["desc"];
        }
        return sRedirect::Modal($redirectArray);
    }
}
?>
