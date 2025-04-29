const iAjaxParams = (iAjaxParams = Object) =>
    class extends iAjaxParams {
        constructor() {
            super();

            Object.defineProperty(this, "tagA", {
                get() {
                    return document.getElementsByTagName("a");
                }
            });

            Object.defineProperty(this, "stringInnerContent", {
                get() {
                    return this._stringInnerContent;
                },
                set(arg) {
                    this._stringInnerContent = arg;
                }
            });

            Object.defineProperty(this, "errorSite", {
                get() {
                    return "404.html";
                }
            });

            Object.defineProperty(this, "ajaxFile", {
                get() {
                    return location.protocol + "//" + location.host + "/__noLoad/Ajax.php";
                }
            });

            Object.defineProperty(this, "performanceLoadFile", {
                get() {
                    return location.protocol + "//" + location.host + "/php/Automated/AutoXML.php";
                }
            });

            Object.defineProperty(this, "ajaxInterval", {
                get() {
                    return this._ajaxInterval;
                },
                set(arg) {
                    this._ajaxInterval = arg;
                }
            });

            Object.defineProperty(this, "customModal", {
                get() {
                    return [
                        ["Login", "sm"],
                        ["Logout", "sm"],
                        ["Administrative/Tools/Logs", "xl"]
                    ];
                }
            });

            Object.defineProperty(this, "notModalActions", {
                get() {
                    return ["Administrative/Tools/Logs"];
                }
            });

            Object.defineProperty(this, "modalPagesForGet", {
                get() {
                    return ["Login", "Logout", "Profile"];
                }
            });

            Object.defineProperty(this, "modalDialogElement", {
                get() {
                    return document.getElementById("modalDialog");
                }
            });

            Object.defineProperty(this, "arrayObject", {
                get() {
                    return [
                        ["usrLogin", "x=Login&Login=", "button", [], "modalDialog"],
                        ["usrEdit", "x=Profile&y=Edit&Save=", "button", [], "modalDialog"],
                        ["usrPassword", "x=Profile&y=Password&Save=", "button", [], "modalDialog"],
                        ["usrEdit", "x=Profile", "cancel", [], "modalDialog"],
                        ["admUsrsAdd", "x=Administrative&y=Users&z=Add&Save=", "button", [], "modalDialog"],
                        ["admGrpsAdd", "x=Administrative&y=Groups&z=Add&Save=", "button", [], "modalDialog"],
                        ["admGrpsEdit", "x=Administrative&y=Groups&z=Edit&Save=", "button", [], "modalDialog"],
                        ["admHuntgroupsAdd", "x=Administrative&y=Huntgroups&z=Add&Save=", "button", [], "modalDialog"],
                        [
                            "admHuntgroupsEdit",
                            "x=Administrative&y=Huntgroups&z=Edit&Save=",
                            "button",
                            [],
                            "modalDialog"
                        ],
                        ["admMemsEdit", "x=Administrative&y=Users&z=Edit&Save=", "button", [], "modalDialog"],
                        ["admUsrPass", "x=Administrative&y=Users&z=Reset&Save=", "button", [], "modalDialog"],
                        ["usrCalendarAdd", "x=Plans&y=Calendar&z=Add&Save=", "button", [], "modalDialog"]
                    ];
                }
            });

            Object.defineProperty(this, "tableSearching", {
                get() {
                    return [
                        "tableAdminUsers",
                        "tableAdminHungroups",
                        "tableAdminMembership",
                        "tableAccessAccess",
                        "tableAdminLogs",
                        "tableHomeUsers",
                        "tableCapMngmtStorage",
                        "tableCapMngmtStoragePhys",
                        "tableCapMngmtStorageTotal",
                        "tableCapMngmtStorageGroup"
                    ];
                }
            });

            Object.defineProperty(this, "tableNonSearching", {
                get() {
                    return ["tableAdminHuntgroups", "tableAdminGroups"];
                }
            });
        }
    };
