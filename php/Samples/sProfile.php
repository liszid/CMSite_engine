<?php

declare(strict_types = 1);

namespace Samples;

class sProfile implements sProfile\ICONS {
/**
 * Collective function for Profile display
 *
 * @param $array array
 * @param $type string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	public static function Prompt(array $array = array(), string $type = ''): string
	{
		switch ($type) {
			case 'Self':
				return self::Profile($array, true);
				break;
			case 'Other':
				return self::Profile($array, false);
				break;
			case 'Edit':
				return self::Edit($array);
				break;
			case 'Password':
				return self::Password($array);
				break;
		}
	}
/**
 * Loads profile
 *
 * @param $array array
 * @param $bool bool Distincts "inside" and "outside" look of the profile
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Profile(array $array = array(), bool $bool = false): string
	{
		$Huntgroups = '';
		foreach ($array['Huntgroups'] as $i) {
			$Huntgroups.= ' ' . $i['huntgroupName'] . ',';
		}
		if ( $bool ) {
		return '
			<div class="col-md-12 m-0 p-1">
				<div class="text-center">
					<h1>' . $array['userName'] . '</h1>
					<i class="fa fa-' . $array['userThumbnail'] . ' fa-5x"></i>
				</div>
				<hr>
				<div class="form-group col m-0 p-0">
					<div class = "col-12 row m-0 p-0">'
						.self::Property(array('desc' => "Jogosultságkör", 'value' => $array['groupName']))
						.self::Property(array('desc' => "Leírás", 'value' => $array['groupDesc']))
						.self::Property(array('desc' => "Csoportok", 'value' => substr($Huntgroups, 0, -1)))
						.self::Property(array('desc' => "Vezetéknév", 'value' => $array['userLastName']))
						.self::Property(array('desc' => "Keresztnév", 'value' => $array['userFirstName']))
						.self::Property(array('desc' => "Telephely", 'value' => $array['userContSite']))
						.self::Property(array('desc' => "E-mail", 'value' => $array['userContEmail']))
						.self::Property(array('desc' => "Telefon", 'value' => $array['userContPhone']))
					.'</div>
				</div>
				<div class="form-group">
					<div class="col-12 row text-center justify-content-center">' . self::Button(array('canEdit' => $array['canEdit'], 'dataPost' => 'Edit', 'title' => 'Szerkesztés'), $bool) . self::Button(array('canEdit' => $array['canEdit'], 'dataPost' => 'Password', 'title' => 'Jelszó'), $bool) . '</div>
				</div>
			</div>';
		} else {
		    return '
			<div class="col-md-12 m-0 p-0">
				<div class="form-group row text-'.$GLOBALS['Site']['Style']['Text']['Card']['Content'].'">
				    <div class="col-md-3">
    					<h1>' . $array['userName'] . '</h1>
    					<i class="fa fa-' . $array['userThumbnail'] . ' fa-5x"></i>
    				</div>
					<div class = "col-md-9">'
						.self::Property(array('desc' => "Jogosultságkör", 'value' => $array['groupName']))
						.self::Property(array('desc' => "Leírás", 'value' => $array['groupDesc']))
						.self::Property(array('desc' => "Csoportok", 'value' => substr($Huntgroups, 0, -1)))
					.'</div>
				</div>
			</div>';
		}
	}
/**
 * Adds a property element for Profile
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Property(array $array):string 
	{
		return '
	      <div class="container col-12 my-2 p-1 border-bottom border-right">
	          <b>' . $array['desc'] . '</b><span class="float-right">' . $array['value'] . '</span>
	      </div>';
	}
/**
 * Adds (Personal Data and Password) Editor button on Profile
 *
 * @param $array array
 * @param $bool bool
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Button(array $array, bool $bool): string
	{
		if ($bool) {
			return '
        <a href="#" class="col-12 col-lg-5 m-1 btn btn-lg btn-info' . (((int)$array['canEdit'] === 0) ? ' disabled' : '') . '" role="button" data-link="Profile" href="#" data-target="#modalBox" data-post="' . $array['dataPost'] . '">
            <i class="fa fa-pencil"></i> ' . $array['title'] . '
        </a>';
		} else {
			return '';
		}
	}
/**
 * Personal Data Editor for Profile
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Edit(array $array = array()): string
	{
		return '
        <div class="col-md-12 m-0 p-0">
            <div class="text-center">
        	<h1>' . $array['userName'] . '</h1>
                <i class="fa fa-' . $array['userThumbnail'] . ' fa-5x"></i>
            </div>
            <hr />
            <form method="post" class="form-group col-12 m-0 p-0" autocomplete="on">
                <div class="form-group col m-0 p-0">
                    <div class="col-12 row m-0 p-0">' . sForm::Input(array('origo' => 'usrEdit', 'data' => 'userId', 'desc' => 'Id', 'value' => $array['userId'], 'type' => 'hidden')) . sForm::Input(array('origo' => 'usrEdit', 'data' => 'userThumbnail', 'desc' => 'Ikon', 'value' => $array['userThumbnail'], 'select' => self::ICONS, 'fa' => true, 'type' => 'select')) . sForm::Input(array('origo' => 'usrEdit', 'data' => 'userLastName', 'desc' => 'Vezetéknév', 'value' => $array['userLastName'], 'type' => 'text')) . sForm::Input(array('origo' => 'usrEdit', 'data' => 'userFirstName', 'desc' => 'Keresztnév', 'value' => $array['userFirstName'], 'type' => 'text')) . sForm::Input(array('origo' => 'usrEdit', 'data' => 'userContPhone', 'desc' => 'Telefon', 'value' => $array['userContPhone'], 'type' => 'phone')) . sForm::Input(array('origo' => 'usrEdit', 'data' => 'userContSite', 'desc' => 'Telephely', 'value' => $array['userContSite'], 'type' => 'text')) . '</div>
                </div>
                <hr />
                <div class="form-group">
                    <div class="col-12 row">
                        <button class="btn btn-lg btn-success col-12 col-md-6" type="submit" id="usrEdit-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        <button class="btn btn-lg col-12 col-md-6" type="submit" id="usrEdit-cancel"><i class="fa fa-ban"></i> Vissza</button>
                    </div>
                </div>
            </form>
        </div>';
	}
/**
 * Password editor part for Profile
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Password(array $array = array()): string
	{
			return '
        <div class="col-md-12 m-0 p-0">
            <div class="text-center">
        	<h1>' . $array['userName'] . '</h1>
                <i class="fa fa-' . $array['userThumbnail'] . ' fa-5x"></i>
            </div>
            <hr />
            <form method="post" class="form-group col-12 m-0 p-0" autocomplete="on">
                <div class="form-group col m-0 p-0">
                    <div class="col-12 row m-0 p-0">' . sForm::Input(array('origo' => 'usrPassword', 'data' => 'userId', 'desc' => 'Id', 'value' => $array['userId'], 'type' => 'hidden'), '') . sForm::Input(array('origo' => 'usrPassword', 'data' => 'userPassword_Old', 'desc' => 'Régi jelszó', 'value' => '', 'type' => 'password')) . sForm::Input(array('origo' => 'usrPassword', 'data' => 'userPassword_New', 'desc' => 'Új jelszó', 'value' => '', 'type' => 'password')) . sForm::Input(array('origo' => 'usrPassword', 'data' => 'userPassword_Repeat', 'desc' => 'Új jelszó', 'value' => '', 'type' => 'password')) . '</div>
                </div>
                <hr />
                <div class="form-group">
                    <div class="col-12 row">
                        <button class="btn btn-lg btn-success col-12 col-md-6" type="submit" id="usrPassword-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        <button class="btn btn-lg col-12 col-md-6" type="submit" id="usrPassword-cancel"><i class="fa fa-ban"></i> Vissza</button>
                    </div>
                </div>
            </form>
        </div>';
	}
}
						