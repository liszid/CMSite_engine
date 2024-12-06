<?php

declare(strict_types=1);

namespace Page\Actions;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Samples\{
    sForm
    ,sTranslate
};

class Membership extends \Page\Classes\sAdministrative
{
/*
* Return Membership Editing form
* @param $array array
* @return string
* @author Liszi Dániel
* @since 2020.11.04
*/
    public static function Edit(array $array): string
    {
        self::setDGroup();
        self::setDGroup_Member();

        if (! isset($array['Save'])) {
            $selectTag = array();

            foreach(self::$dGroup->Select(array(), 'forMemberEdit') as $i) {
                $selectTag[] = array('id' => $i['groupId'], 'name' => $i['groupName']);
            }

            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">
                            '.sForm::Input(array('origo' => 'admMemsEdit', 'data' => 'groupMemberId', 'desc' => 'Csoport tag Id', 'value' => $array['dp'], 'type' => 'hidden')).'
                            '.sForm::Input(array('origo' => 'admMemsEdit', 'data' => 'groupId', 'desc' => 'Csoport Id', 'value' => (self::$dGroup_Member->Select(array('groupMemberId' => $array['dp']), 'byGroupMemberId'))[0]['groupId'], 'select' => $selectTag, 'type' => 'select')).'
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="admMemsEdit-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            return
                '<h4>'.(
                    (self::$dGroup_Member->Update($array, 'byGroupMemberId'))
                        ? sTranslate::ACTION['Success']['content']
                        : sTranslate::ACTION['Fail']['content']
                ).'</h4>'.sForm::Spinner(array('x' => 'Administrative', 'y' => 'Membership'));
        }
        return 'Edit, dp: '.$array['dp'];
    }
}
