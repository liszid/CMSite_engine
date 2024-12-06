<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dCompany
    ,dCompany_Site
    ,dCompany_Site_Type
    ,dCombined
};

use Samples\{
    sCard
    ,sTables
    ,sTranslate
    ,sForm
    ,sFrame
};

class sCompany
{
/** @var object $dCompany dCompany class object */
    protected static $dCompany;
/** @var object $dCompany_Site dCompany_Site class object */
    protected static $dCompany_Site;
/** @var object $dCompany_Site_Type dCompany_Site_Type class object */
    protected static $dCompany_Site_Type;
/** @var object $dCombined dCombined class object */
    protected static $dCombined;
/** @var const COMPANY Class constant for dCompany form elements */
    const COMPANY = array(
        array('data' => 'companyName', 'desc' => 'Cég neve', 'type' => 'text', 'tags' => 'Add,View,Edit', 'must-fill' => true)
        ,array('data' => 'companyDesc', 'desc' => 'Cég leírása', 'type' => 'text', 'tags' => 'Add,View,Edit')
        ,array('data' => 'companyTaxNumber', 'desc' => 'Adószám', 'type' => 'text', 'tags' => 'View,Edit')
        ,array('data' => 'companyRegisteredNumber', 'desc' => 'Cégjegyzékszám', 'type' => 'text', 'tags' => 'View,Edit')
        ,array('data' => 'companyAddressCity', 'desc' => 'Székhely cím, Város', 'type' => 'text', 'tags' => 'View,Edit')
        ,array('data' => 'companyAddressPostcode', 'desc' => 'Székhely cím, Irányítószám', 'type' => 'text', 'tags' => 'View,Edit')
        ,array('data' => 'companyAddressStreet', 'desc' => 'Székhely cím, Utca/Házszám', 'type' => 'text', 'tags' => 'View,Edit')
    );
/** @var const COMPANY_SITE Class constant for dCompany_Site form elements */
    const COMPANY_SITE = array(
        array( 'data' => 'companySiteName', 'desc' => 'Telephely neve', 'type' => 'text', 'tags' => 'Add, View', 'must-fill' => true)
        ,array('data' => 'companyId', 'desc' => 'Cég neve', 'type' => 'selectpicker', 'tags' => 'Add, Edit,View', 'must-fill' => true)
        ,array('data' => 'companySiteTypeId', 'desc' => 'Telephely típusa', 'type' => 'selectpicker', 'tags' => 'Add, Edit,View', 'must-fill' => true)
        ,array('data' => 'companySiteDesc', 'desc' => 'Telephely leírása', 'type' => 'text', 'tags' => 'Add, Edit,View')
        ,array('data' => 'companySiteAddressCity', 'desc' => 'Város', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteAddressPostcode', 'desc' => 'Irányítószám', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteAddressStreet', 'desc' => 'Utca, Házszám', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteEmail', 'desc' => 'E-mail cím', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySitePhone', 'desc' => 'Telefonszám', 'type' => 'text', 'tags' => 'Edit,View')

    );
/** @var const COMPANY_SITE_OWNER Class constant for dCompany_Site form elements */
    const COMPANY_SITE_OWNER = array(
        array( 'data' => 'companySiteOwnerLastName', 'desc' => 'Vezetéknév', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteOwnerFirstName', 'desc' => 'Keresztnév', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteOwnerEmail', 'desc' => 'E-mail cím', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteOwnerPhone', 'desc' => 'Telefonszám', 'type' => 'text', 'tags' => 'Edit,View')
    );
/** @var const COMPANY_SITE_SUB_OWNER Class constant for dCompany_Site form elements */
    const COMPANY_SITE_SUB_OWNER = array(
        array( 'data' => 'companySiteSubOwnerLastName', 'desc' => 'Vezetéknév', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteSubOwnerFirstName', 'desc' => 'Keresztnév', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteSubOwnerEmail', 'desc' => 'E-mail cím', 'type' => 'text', 'tags' => 'Edit,View')
        ,array('data' => 'companySiteSubOwnerPhone', 'desc' => 'Telefonszám', 'type' => 'text', 'tags' => 'Edit,View')
    );
/** @var const TYPES Used for getting page specific variables, like form element IDs, form elements, tables */
    const TYPES = array(
        "Company" => array(
            "origo" => 'usrCmpCmp'
            ,"defaultData" => self::COMPANY
            ,"tableName" => 'COMPANY_COMPANY'
				,"dbTableId" => 'companyId'
				,"dateName" => 'companyDate'
        )
		,"Site" => array(
            "origo" => 'usrCmpSite'
            ,"defaultData" => self::COMPANY_SITE
            ,"tableName" => 'COMPANY_SITE'
				,"dbTableId" => 'companySiteId'
				,"dateName" => 'companySiteDate'
        )
	);
/**
 * Sets the class variable : dUser
 *
 * @author Liszi Dániel
 */
    protected static function setDCompany()
    {
        self::$dCompany = new dCompany();
    }
/**
 * Sets the class variable : dGroup
 *
 * @author Liszi Dániel
 */
    protected static function setDCompany_Site()
    {
        self::$dCompany_Site = new dCompany_Site();
    }
/**
 * Sets the class variable : dGroup
 *
 * @author Liszi Dániel
 */
    protected static function setDCompany_Site_Type()
    {
        self::$dCompany_Site_Type = new dCompany_Site_Type();
    }
/**
 * Sets the class variable : dCombined
 *
 * @author Liszi Dániel
 */
    protected static function setDCombined()
    {
        self::$dCombined = new dCombined();
    }
/**
 * Used for events indicated by users
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	public static function Action(array $array): string
	{
		$array['companyType'] = $array['y'];
		$array = array_merge($array, self::TYPES[$array['companyType']]);
		$array['origo'] .= $array['z'];
		$array['returnPath'] = array('x' => 'Company', 'y' => $array['companyType']);
		$returnContent = self::{$array['z']}($array);
		if (
			Valid::vString($returnContent)
				&& (
					strcmp($array['z'],'Filter2Company')
				)
		) {
			$returnContent = '<div class="text-center justification-centered">'.$returnContent.'</div>';
		}

		return $returnContent;
	}
/**
 * Company page display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Company(array $array): string
    {
        self::setDCompany();

        $returnString = '';
        $Company = self::$dCompany->Select(array(), 'All');

        if (isset($array['path'])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
        }

        $returnString .= sTables::Prompt($Company, self::TYPES['Company']['tableName']);
        return $returnString;
    }
/**
 * Company site display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Site(array $array): string
    {
        self::setDCombined();

        $returnString = '';
        $Company_Sites = self::$dCombined->Select(array(), 'Company_Site_Table');

        if (isset($array['path'])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
        }

        $returnString .= sTables::Prompt($Company_Sites, self::TYPES['Site']['tableName']);
        return $returnString;
    }
/**
 * Returns Adding form
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Add(array $array): string
    {
        self::setDCompany();
        self::setDCompany_Site();

        $wClass = (
            (! strcmp($array['companyType'],'Company'))
            ? self::$dCompany 
            : self::$dCompany_Site
        );

        if (! isset($array['Save'])) {
            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">'
                            .sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
                            .sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'Add'),'selectData' => array('companyId' => self::Company_Select(),'companySiteTypeId' => self::Company_Site_Type_Select())))
                        .'</div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            return
                '<h4>'.(
                    (
                        $wClass->Insert($array)
                    )
                    ? sTranslate::ACTION['Success']['content']
                    : sTranslate::ACTION['Fail']['content']
                ).'</h4>'.sForm::Spinner($array['returnPath']);
        }
    }
/**
 * Fires View action
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function View(array $array): string
    {
        self::setDCompany();
        self::setDCombined();

        $wItem = (
            (! strcmp($array['companyType'],'Company'))
            ? (self::$dCompany->Select(array('companyId' => (int)$array['dp']), 'byCompanyId'))[0]
            : (self::$dCombined->Select(array('companySiteId' => (int)$array['dp']), 'Company_Site_View'))[0]
        );

        return '
            <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                <div class="form-group col p-0">
                    <div class="col-12 row">'
                        .sCard::Collapsible(array('header' => 'Cég adatok','content' =>sForm::Generate(array('constData' => self::COMPANY,'staticData' => array('origo' => $array['origo'],'tag' => 'View'),'valueData' => $wItem,'selectData' => array('companyId' => self::Company_Select(),'companySiteTypeId' => self::Company_Site_Type_Select())))))
                        .(
                            (! strcmp($array['companyType'],'Site'))
                            ? sCard::Collapsible(array('header' => 'Telephely adatok','content' =>sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'View'),'valueData' => $wItem,'selectData' => array('companyId' => self::Company_Select(),'companySiteTypeId' => self::Company_Site_Type_Select())))))
                            .sCard::Collapsible(array('header' => 'Telephely vezető adatok','content' =>sForm::Generate(array('constData' => self::COMPANY_SITE_OWNER,'staticData' => array('origo' => $array['origo'],'tag' => 'View'),'valueData' => $wItem))))
                            .sCard::Collapsible(array('header' => 'Telephely vezető helyettes adatok','content' =>sForm::Generate(array('constData' => self::COMPANY_SITE_SUB_OWNER,'staticData' => array('origo' => $array['origo'],'tag' => 'View'),'valueData' => $wItem))))
                            : ''
                        )
                        .sForm::Input(array('origo' => 'usrCmpCmpView','data' => 'userName','desc' => 'Hozzáadta','value' => $wItem['userName'],'type' => 'text','disabled' => true))
                        .sForm::Input(array('origo' => 'usrCmpCmpView','data' => 'companyDate','desc' => 'Hozzáadva','value' => $wItem[$array['dateName']],'type' => 'text','disabled' => true))
                    .'</div>
                </div>
            </form>';
    }
/**
 * Fires Edit action
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Edit(array $array): string
    {
        self::setDCompany();

        if (! isset($array['Save'])) {
            self::setDCombined();

            $wItem = (
                (! strcmp($array['companyType'],'Company'))
                ? (self::$dCompany->Select(array('companyId' => (int)$array['dp']), 'byCompanyId'))[0]
                : (self::$dCombined->Select(array('companySiteId' => (int)$array['dp']), 'Company_Site_View'))[0]
            );

            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">'
                            .sForm::Input(array('origo' => $array['origo'], 'data' => 'userId', 'desc' => '', 'value' => $GLOBALS['sessionId'], 'type' => 'hidden'))
                            .sForm::Input(array('origo' => $array['origo'], 'data' => $array['dbTableId'], 'desc' => '', 'value' => $array['dp'], 'type' => 'hidden'))
                            .sCard::Collapsible(array('header' => 'Általános adatok','content' =>sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'Edit'),'valueData' => $wItem,'selectData' => array('companyId' => self::Company_Select(),'companySiteTypeId' => self::Company_Site_Type_Select())))))
                            .(
                                (! strcmp($array['companyType'],'Site'))
                                ? sCard::Collapsible(array('header' => 'Telephely vezető adatok','content' =>sForm::Generate(array('constData' => self::COMPANY_SITE_OWNER,'staticData' => array('origo' => $array['origo'],'tag' => 'Edit'),'valueData' => $wItem))))
                                .sCard::Collapsible(array('header' => 'Telephely vezető helyettes adatok','content' =>sForm::Generate(array('constData' => self::COMPANY_SITE_SUB_OWNER,'staticData' => array('origo' => $array['origo'],'tag' => 'Edit'),'valueData' => $wItem))))
                                : ''
                            )
                        .'</div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            self::setDCompany_Site();

            $wClass = (
                (! strcmp($array['companyType'],'Company'))
                ? self::$dCompany 
                : self::$dCompany_Site
            );

            return
                '<h4>'.(
                    (
                        $wClass->Update($array)
                    )
                    ? sTranslate::ACTION['Success']['content']
                    : sTranslate::ACTION['Fail']['content']
                ).'</h4>'.sForm::Spinner($array['returnPath']);
        }
    }
/**
 * Fires Delete action
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Delete(array $array): string
    {
        self::setDCompany();
        self::setDCompany_Site();

        $wClass = (
            (! strcmp($array['companyType'],'Company'))
            ? self::$dCompany 
            : self::$dCompany_Site
        );

        return
            '<h4>'.(
                (
                    $wClass->Delete(
                        array(
                            $array['dbTableId'] => (int)$array['dp']
                            ,'userId' => $GLOBALS['sessionId']
                        )
                    )
                )
                ? sTranslate::ACTION['Success']['content']
                : sTranslate::ACTION['Fail']['content']
            ).'</h4>'.sForm::Spinner($array['returnPath']);
        }

/**
 * Returns filtered data using companyId
 *
 * @param $array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Filter2Company(array $array): string
    {
        if (! strcmp($array['companyType'], 'Site')) {
            self::setDCompany_Site();
            $array['dp'] = (self::$dCompany_Site->Select(array('companySiteId' => $array['dp']), 'byCompanySiteId'))[0]['companyId'];
        }

        self::setDCombined();
        self::setDCompany();

        $returnContent = "";
        $Company = self::$dCompany->Select(array('companyId' => (int)$array['dp']), 'byCompanyId');
        $Company_Site = self::$dCombined->Select(array('companyId' => (int)$array['dp']), 'Company_Filter_Company_Site');
        $Passtorage =  self::$dCombined->Select(array('companyId' => (int)$array['dp']), 'Company_Filter_Passtorage');
        $Knowledge =  self::$dCombined->Select(array('companyId' => (int)$array['dp']), 'Company_Filter_Knowledge');
        $Device =  self::$dCombined->Select(array('companyId' => (int)$array['dp']), 'Company_Filter_Device');

        $returnContent .= '
            <h4>'.$Company[0]['companyName'].'</h4><br />
            '.sCard::Collapsible(array('header' => '<h5>Telephelyek</h5>','content' => sTables::Prompt($Company_Site, 'COMPANY_FILTER_COMPANY_SITE')))
            .sCard::Collapsible(array('header' => '<h5>Tudáscikkek</h5>','content' => sTables::Prompt($Knowledge, 'COMPANY_FILTER_KNOWLEDGE')))
            .sCard::Collapsible(array('header' => '<h5>Jelszótárolók</h5>','content' => sTables::Prompt($Passtorage, 'COMPANY_FILTER_PASSTORAGE')))
            .sCard::Collapsible(array('header' => '<h5>Eszközök</h5>','content' => sTables::Prompt($Device, 'COMPANY_FILTER_DEVICE')));

        return sFrame::Page(array('path' => 'Company/Company/Filter', 'content' => $returnContent));
    }
/**
 * Company site type selection
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    protected static function Company_Site_Type_Select(): array
    {
        self::setDCompany_Site_Type();

        $tempArray = array();
        foreach(self::$dCompany_Site_Type->Select(array(), 'All') as $i) {
            $tempArray[] = array('id' => $i['companySiteTypeId'], 'name' => $i['companySiteTypeName']);
        }

        return $tempArray;
    }

/**
 * Company selection
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    protected static function Company_Select(): array
    {
        self::setDCompany();

        $tempArray = array();
        foreach(self::$dCompany->Select(array(), 'forCompanySelect') as $i) {
            $tempArray[] = array('id' => $i['companyId'], 'name' => $i['companyName']);
        }

        return $tempArray;
    }
}
