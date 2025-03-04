const iAjaxParams = (iAjaxParams = Object) => class extends iAjaxParams
{
    constructor()
    {
        super();
/**
 * Defines which elements are considered as <a>
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'tagA',
        {
            get( ) {
                return document.getElementsByTagName("a");
            }
        } );
/**
 * Workaround for Ajax related content saving
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'stringInnerContent',
        {
            get( ) {
                return this._stringInnerContent;
            },
            set(arg) {
                this._stringInnerContent = arg;
            }
        } );
/**
 * Locates the error page, which is accessible from the root directory
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'errorSite',
        {
            get( ) {
                return "404.html";
            }
        } );
/**
 * Locates the ajax php, which is accessible through the root directory
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'ajaxFile',
        {
            get( ) {
                return location.protocol + '//' + location.host+"/__noLoad/Ajax.php";
            }
        });
        
        Object.defineProperty( this, 'performanceLoadFile',
        {
            get( ) {
                return location.protocol + '//' + location.host+"/php/Automated/AutoXML.php";
            }
        });
/**
 * Sets the time interval of Ajax queries
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'ajaxInterval',
        {
            get( ) {
                return this._ajaxInterval;
            },
            set(arg) {
                this._ajaxInterval = arg;
            }
        });
/**
 * Property to change the modals class
 *
 * @deprecated No longer used by internal code and not recommended.
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'customModal',
        {
            get( ) {
                return [
                    ["Login", "sm"]
                    ,["Logout", "sm"]
                    ,["Administrative/Tools/Logs", "xl"]
                ];
            }
        } );
/**
 * Used to set Non-Modal actions
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'notModalActions',
        {
            get( ) {
                return [
                    "Administrative/Tools/Logs"
                ];
            }
        } );
/**
 * Used to set specific pages, which uses GET as parameters
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'modalPagesForGet',
        {
            get( ) {
                return [
                    "Login"
                    ,"Logout"
                    ,"Profile"
                ];
            }
        } );
/**
 * Sets which element is used for displaying modal messages
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'modalDialogElement',
        {
            get( ) {
                return document.getElementById("modalDialog");
            }
        } );
/**
 * Used for generating POST messages for specific actions
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'arrayObject',
        {
            get( ) {
                return [
                    ["usrLogin", "x=Login&Login=", "button", [], "modalDialog"]
                    ,["usrEdit", "x=Profile&y=Edit&Save=", "button", [], "modalDialog"]
                    ,["usrPassword", "x=Profile&y=Password&Save=", "button", [], "modalDialog"]
                    ,["usrEdit", "x=Profile", "cancel", [], "modalDialog"]
                    ,["admUsrsAdd", "x=Administrative&y=Users&z=Add&Save=", "button", [], "modalDialog"]
                    ,["admGrpsAdd", "x=Administrative&y=Groups&z=Add&Save=", "button", [], "modalDialog"]
                    ,["admGrpsEdit", "x=Administrative&y=Groups&z=Edit&Save=", "button", [], "modalDialog"]
                    ,["admHuntgroupsAdd", "x=Administrative&y=Huntgroups&z=Add&Save=", "button", [], "modalDialog"]
                    ,["admHuntgroupsEdit", "x=Administrative&y=Huntgroups&z=Edit&Save=", "button", [], "modalDialog"]
                    ,["admMemsEdit", "x=Administrative&y=Users&z=Edit&Save=", "button", [], "modalDialog"]
                    ,["admUsrPass", "x=Administrative&y=Users&z=Reset&Save=", "button", [], "modalDialog"]
                ];
            }
        } );
/**
 * Sets which tables are used with SEARCH extension
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'tableSearching',
        {
            get( ) {
                return[
                    "tableAdminUsers"
                    ,"tableAdminHungroups"
                    ,"tableAdminMembership"
                    ,"tableAccessAccess"
                    ,"tableAdminLogs"
                    ,"tableHomeUsers"
                    ,"tableCapMngmtStorage"
                    ,"tableCapMngmtStoragePhys"
                    ,"tableCapMngmtStorageTotal"
                    ,"tableCapMngmtStorageGroup"
                ];
            }
        });
/**
 * Sets which tables are used without SEARCH extension
 *
 * @author Liszi Dániel
 */
        Object.defineProperty( this, 'tableNonSearching',
        {
            get( ) {
                return[
                    "tableAdminHuntgroups"
                    ,"tableAdminGroups"
                ];
            }
        });
    }
};
