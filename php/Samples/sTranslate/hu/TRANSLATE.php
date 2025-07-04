<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface TRANSLATE
{
    const TRANSLATE = [
        "Administrative" => [
            "navbar" => "Admin",
            "fa" => "pencil-square",
            "title" => "Adminisztráció",
            "help" => "Az Adminisztrativ felulet hasznalatahoz kattintson a kartyara",
            "card" => "",
        ],
        "Administrative/Users" => [
            "navbar" => "Fiókok",
            "fa" => "user",
            "title" => "Fiókok kezelése",
            "help" =>
                "Felhasználói fiókok kezeléséhez kattintson a menüsorban az 'Admin' gombra és ott válassza a 'Felhasználók' menüpontot",
            "card" => "Fiókok szerkesztéséhez kattintson a kártyára",
            "info" => [
                "color" => "success",
                "header" => "Információ",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => '
                    Az új felhasználó alapértelmett jelszava a felhasználói neve, illetve jogosultsága a 2-es ID-val rendelkezö "Alapértelmezett" jogosultsági kör<br />
                    <br />
                    <b>Bejelentkezési név: </b>A felhasználó felhasználói neve<br />
                    <b>E-mail cím: </b>A felhasználói fiókhoz tartozó e-mail fiók, amelyre a későbbiekben értesítéseket is lehet küldeni<br />
                    <b>Jogosultsági kör: </b>Az aktuális/kiválasztott jogosultsági köre a felhasználónak<br />
                    <br />
                    <b>Felhasználó jogosultsági körének megváltoztatása: </b><a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Felhasználói jelszó alaphelyzetbe állítása: </b><a class="btn btn-warning btn-sm"><i class="fa fa-undo" aria-hidden="true"></i></a><br />
                    <b>Felhasználói fiók törlése: </b><a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>',
            ],
            "action" => [
                "Add" => "Felhasználó hozzáadása",
                "Edit" => "Felhasználói jogkör szerkesztése",
                "Reset" => "Felhasználói jelszó módosítása",
                "Delete" => "Felhasználó törlése",
            ],
        ],
        "Administrative/Groups" => [
            "navbar" => "Jogosultságok",
            "fa" => "users",
            "title" => "Jogosultsági körök kezelése",
            "help" =>
                "Jogosultságok kezeléséhez kattintson a menüsorban az 'Admin' gombra és ott válassza a 'Csoportok' menüpontot",
            "card" => "Jogosultságoszerkesztéséhez kattintson a kártyára",
            "info" => [
                "color" => "success",
                "header" => "Információ",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => '
                    <b>Állítható engedélyek, jogkörök</b> <br />
                    <br />
                    <b>Adminisztrativ engedély</b> - A felhasználó láthat minden bejegyzést, és szerkesztheti őket<br />
                    <b>Felhasználók kezelése</b> - Felhasználók létrehozása, csoportba helyezése, jelszavak helyreállítása<br />
                    <b>Felhasználói jogosultságok kezelése</b> - Jogosultság körök létrehozása, kezelése<br />
                    <b>Felhasználói csoportok kezelése</b> - Felhasználói csoportok létrehozása, kezelése<br />
                    <b>Adminisztratív eszközök kezelése</b> - Speciális adminisztratív funkciók elérése<br />
                    <b>Regisztrált felhasználók  felületének megtekintése</b> - Regisztrált felhasználók nyilvános adatainak megtekintése<br />
                    <b>Ügyfelek és telephelyek  felületének jogosultsága</b> - Ügyfelek és telephelyek hozzáadása, kezelése<br />
                    <b>Tudáscikkek jogosultság</b> - Tudáscikkek hozzáadása, kezelése<br />
                    <b>Hozzáférések felületének jogosultsága</b> - Hozzáférési adatok hozzáadása, kezelése<br />
                    <b>Hardverek felületének jogosultsága</b> - Hardverek hozzáadása, kezelése<br />
                    <b>Profil szerkesztése</b> - A felhasználó szerkesztheti-e saját profilját<br />
                    <b>Bejelentkezés</b> - Felhasználó aktív állapota, ha ez tiltott, akkor a felhasználó inaktív<br />
                    <br />
                    <b>Adatok megtekintése:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Jogosultsági kör szerkesztése: </b><a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> <br />
                    <b>Jogosultsági kör törlése: </b><a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>',
            ],
            "action" => [
                "Add" => "Jogkör hozzáadása",
                "Edit" => "Jogkör szerkesztése",
                "View" => "Jogkör megtekintése",
                "Delete" => "Jogkör törlése",
            ],
        ],
        "Administrative/Huntgroups" => [
            "navbar" => "Csoportok",
            "fa" => "users",
            "title" => "Csoportok kezelése",
            "help" =>
                "Csoportok kezeléséhez kattintson a menüsorban az 'Admin' gombra és ott válassza a 'Csoportok' menüpontot",
            "card" => "Csoportok szerkesztéséhez kattintson a kártyára",
            "info" => [
                "color" => "success",
                "header" => "Információ",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => '
                    Ezen a felületen történik a csoportok létrehozása, és a csoporttagságok hozzárendelése.<br />
                    Szerkesztéskor a Csoport nevét, leírását és tagjait lehet módosítani.<br />
                    A csoport tagok hozzárendelésekor a CTRL /SHIFT billentyűk segítenek abban, hogy több felhasználót is kilehessen jelölni.<br />
                    <br />
                    <b>Csoport adatainak megtekintése:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Csoport szerkesztése:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Eltávolítás:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />',
            ],
            "action" => [
                "Add" => "Csoport hozzáadása",
                "Edit" => "Csoport szerkesztése",
                "View" => "Csoport megtekintése",
                "Delete" => "Csoport törlése",
            ],
        ],
        "Administrative/Tools" => [
            "navbar" => "Eszközök",
            "fa" => "wrench",
            "title" => "Segéd eszközök",
            "help" => "",
            "card" => "Adminisztratív segéd eszközökért kattintson a kártyára",
            "info" => [
                "color" => "success",
                "header" => "Információ",
                "title" => "",
                "content" => '
                    <b>Felhasználói események </b> Megtekinthető az utolsó felhasználói aktivitások<br />
                    <b>Tudáscikk típusok </b> Tudáscikk típusok kezelése (hozzáadás, törlés, módosítás)<br />
                    <b>Telephely típusok </b> Telephely típusok kezelése (hozzáadás, törlés, módosítás)<br />
                    <b>Adatok importálása az Emu-ból </b>
                    <b>Adatbázis alaphelyzetbe állítása </b> Eldobja az aktuális adatbázist, és újra építi az egészet<br />
                ',
            ],
            "action" => [
                "Delete" => "Adatbázis alaphelyzetbe állítása",
                "Logs" => "Események megtekintése",
                "Emu_Import" => "Importálás az Emu-ból",
            ],
        ],
        "Users" => [
            "navbar" => "Felhasználók",
            "fa" => "user",
            "title" => "Felhasználók megtekintése",
            "help" =>
                "Regisztrált felhasználók elérhetőségének megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra",
            "card" => "Regisztrált felhasználók elérhetőségének megtekintéséhez kattintson a kártyára",
        ],
        "Devlog" => [
            "navbar" => "DevNotes",
            "fa" => "cog",
            "title" => "Developer Notes",
            "help" => "",
            "card" => "",
        ],
        "Home" => [
            "navbar" => "Főoldal",
            "fa" => "home",
            "title" => "Főoldal",
            "help" => "",
            "card" => "",
        ],
        "Login" => [
            "navbar" => "Bejelentkezés",
            "fa" => "sign-in",
            "title" => "Bejelentkezés",
            "help" => "",
            "card" => "",
        ],
        "Logout" => [
            "navbar" => "Kijelentkezés",
            "fa" => "sign-out",
            "title" => "Kijelentkezés",
            "help" => "",
            "card" => "",
        ],
        "Profile" => [
            "navbar" => "Profil",
            "fa" => "user",
            "title" => "Profil",
            "help" =>
                "Profilja szerkesztéséhez kattintson a menüsávban a 'Profil' gombra és a 'Profil' oldalon a 'Szerkesztés' gombra",
            "card" =>
                "Profilja szerkesztéséhez kattintson a menüsávban a 'Profil' gombra és a 'Profil' oldalon a 'Szerkesztés' gombra",
        ],
        "Capacity" => [
            "navbar" => "Kapacitás",
            "fa" => "hdd-o",
            "title" => "Kapacitás menedzsment",
            "help" => "",
            "card" => "",
        ],
        "Capacity/Storage" => [
            "navbar" => "Tárolók",
            "fa" => "hdd-o",
            "title" => "Tárolók megtekintése",
            "help" => "",
            "card" => "Tárolók megtekintésért kattintson a kártyára",
            "action" => [
                "View" => "Tárolók Megtekintése",
            ],
        ],
        "Capacity/Group" => [
            "navbar" => "Tároló Csoportok",
            "fa" => "hdd-o",
            "title" => "Tároló Csoportok megtekintése",
            "help" => "",
            "card" => "Tároló Csoportok megtekintésért kattintson a kártyára",
            "action" => [
                "View" => "Tároló Csoportok Megtekintése",
            ],
        ],
        "Performance" => [
            "navbar" => "Teljesítmény",
            "fa" => "hdd-o",
            "title" => "Lokális teljesítmény menedzsment",
            "help" => "",
            "card" => "",
        ],
        "Performance/Laptop" => [
            "navbar" => "Teljesítmény",
            "fa" => "hdd-o",
            "title" => "Lokális laptop teljesítménye",
            "help" => "",
            "card" => "Laptop értékeinek ellenőrzése, felügyelete",
            "action" => [
                "View" => "Teljesítmény megtekintése",
            ],
        ],
        "Plans" => [
            "navbar" => "Tervező",
            "fa" => "calendar",
            "title" => "Tervező megtekintése",
            "help" => "Tervező megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra",
            "card" => "Tervező megtekintéséhez kattintson a kártyára",
        ],
        "Calendar" => [
            "navbar" => "Naptár",
            "fa" => "calendar",
            "title" => "Naptár megtekintése",
            "help" => "Naptár megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra",
            "card" => "Naptár megtekintéséhez kattintson a kártyára",
            "info" => [
                "color" => "success",
                "header" => "",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Esemény hozzáadása",
                "Edit" => "Esemény szerkesztése",
                "View" => "Esemény megtekintése",
                "Delete" => "Esemény törlése",
            ],
        ],
        "Plans/Calendar" => [
            "navbar" => "Naptár",
            "fa" => "calendar",
            "title" => "Naptár megtekintése",
            "help" => "Naptár megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra",
            "card" => "Naptár megtekintéséhez kattintson a kártyára",
            "info" => [
                "color" => "success",
                "header" => "",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Esemény hozzáadása",
                "Edit" => "Esemény szerkesztése",
                "View" => "Esemény megtekintése",
                "Delete" => "Esemény törlése",
            ],
        ],
        "Plans/Kanban" => [
            "navbar" => "Kanban",
            "fa" => "list-ul",
            "title" => "View Kanban",
            "help" => "To view the kanban list, click on the 'Availability' button in the menu bar",
            "card" => "Click on the card to view the kanban list",
            "info" => [
                "color" => "success",
                "header" => "",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Hozzáad",
                "Edit" => "Szerkeszt",
                "View" => "Megtekint",
                "Delete" => "Töröl",
            ],
        ],
    ];
}
?>
