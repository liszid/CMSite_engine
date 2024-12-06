<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface TRANSLATE
{
    const TRANSLATE = array(
        "Administrative" => array(
            "navbar" => "Admin"
            ,"fa" => "pencil-square"
            ,"title" => "Adminisztráció"
            ,"help" => "Az Adminisztrativ felulet hasznalatahoz kattintson a kartyara"
            ,"card" => ""
        )
        ,"Administrative/Users" => array(
            "navbar" => "Fiókok"
            ,"fa" => "user"
            ,"title" => "Fiókok kezelése"
            ,"help" => "Felhasználói fiókok kezeléséhez kattintson a menüsorban az 'Admin' gombra és ott válassza a 'Felhasználók' menüpontot"
            ,"card" => "Fiókok szerkesztéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    Az új felhasználó alapértelmett jelszava a felhasználói neve, illetve jogosultsága a 2-es ID-val rendelkezö "Alapértelmezett" jogosultsági kör<br />
                    <br />
                    <b>Bejelentkezési név: </b>A felhasználó felhasználói neve<br />
                    <b>E-mail cím: </b>A felhasználói fiókhoz tartozó e-mail fiók, amelyre a későbbiekben értesítéseket is lehet küldeni<br />
                    <b>Jogosultsági kör: </b>Az aktuális/kiválasztott jogosultsági köre a felhasználónak<br />
                    <br />
                    <b>Felhasználó jogosultsági körének megváltoztatása: </b><a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Felhasználói jelszó alaphelyzetbe állítása: </b><a class="btn btn-warning btn-sm"><i class="fa fa-undo" aria-hidden="true"></i></a><br />
                    <b>Felhasználói fiók törlése: </b><a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            )
            ,"action" => array(
                "Add" => "Felhasználó hozzáadása"
                ,"Edit" => "Felhasználói jogkör szerkesztése"
                ,"Reset" => "Felhasználói jelszó módosítása"
                ,"Delete" => "Felhasználó törlése"
            )
        )
        ,"Administrative/Groups" => array(
            "navbar" => "Jogosultságok"
            ,"fa" => "users"
            ,"title" => "Jogosultsági körök kezelése"
            ,"help" => "Jogosultságok kezeléséhez kattintson a menüsorban az 'Admin' gombra és ott válassza a 'Csoportok' menüpontot"
            ,"card" => "Jogosultságoszerkesztéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
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
                    <b>Jogosultsági kör törlése: </b><a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            )
            ,"action" => array(
                "Add" => "Jogkör hozzáadása"
                ,"Edit" => "Jogkör szerkesztése"
                ,"View" => "Jogkör megtekintése"
                ,"Delete" => "Jogkör törlése"
            )
        )
        ,"Administrative/Huntgroups" => array(
            "navbar" => "Csoportok"
            ,"fa" => "users"
            ,"title" => "Csoportok kezelése"
            ,"help" => "Csoportok kezeléséhez kattintson a menüsorban az 'Admin' gombra és ott válassza a 'Csoportok' menüpontot"
            ,"card" => "Csoportok szerkesztéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    Ezen a felületen történik a csoportok létrehozása, és a csoporttagságok hozzárendelése.<br />
                    Szerkesztéskor a Csoport nevét, leírását és tagjait lehet módosítani.<br />
                    A csoport tagok hozzárendelésekor a CTRL /SHIFT billentyűk segítenek abban, hogy több felhasználót is kilehessen jelölni.<br />
                    <br />
                    <b>Csoport adatainak megtekintése:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Csoport szerkesztése:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Eltávolítás:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Csoport hozzáadása"
                ,"Edit" => "Csoport szerkesztése"
                ,"View" => "Csoport megtekintése"
                ,"Delete" => "Csoport törlése"
            )
        )
        ,"Administrative/Tools" => array(
            "navbar" => "Eszközök"
            ,"fa" => "wrench"
            ,"title" => "Segéd eszközök"
            ,"help" => ""
            ,"card" => "Adminisztratív segéd eszközökért kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'title' => ''
                ,'content' => '
                    <b>Felhasználói események </b> Megtekinthető az utolsó felhasználói aktivitások<br />
                    <b>Tudáscikk típusok </b> Tudáscikk típusok kezelése (hozzáadás, törlés, módosítás)<br />
                    <b>Telephely típusok </b> Telephely típusok kezelése (hozzáadás, törlés, módosítás)<br />
                    <b>Adatok importálása az Emu-ból </b>
                    <b>Adatbázis alaphelyzetbe állítása </b> Eldobja az aktuális adatbázist, és újra építi az egészet<br />
                '
            )
            ,"action" => array(
                "Delete" => "Adatbázis alaphelyzetbe állítása"
                ,"Logs" => "Események megtekintése"
                ,"Emu_Import" => "Importálás az Emu-ból"
            )
        )
        ,"Administrative/Tools/Knowledge_Type" => array(
            "navbar" => "Tudáscikk típusok"
            ,"fa" => "wrench"
            ,"title" => "Tudáscikk típusok"
            ,"help" => ""
            ,"card" => "Tudáscikk típusok kezeléséért kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Hozzáadás"
                ,"Edit" => "Szerkesztés"
                ,"Delete" => "Eltávolítás"
            )
        )
        ,"Administrative/Tools/Company_Site_Type" => array(
            "navbar" => "Telephely típusok"
            ,"fa" => "wrench"
            ,"title" => "Telephely típusok"
            ,"help" => ""
            ,"card" => "Telephely típusok kezeléséért kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Hozzáadás"
                ,"Edit" => "Szerkesztés"
                ,"Delete" => "Eltávolítás"
            )
        )
        ,"Users" => array(
            "navbar" => "Felhasználók"
            ,"fa" => "user"
            ,"title" => "Felhasználók megtekintése"
            ,"help" => "Regisztrált felhasználók elérhetőségének megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra"
            ,"card" => "Regisztrált felhasználók elérhetőségének megtekintéséhez kattintson a kártyára"
        )
        ,"Devlog" => array(
            "navbar" => "DevNotes"
            ,"fa" => "cog"
            ,"title" => "Developer Notes"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Plans" => array(
            "navbar" => "Tervező"
            ,"fa" => "calendar"
            ,"title" => "Tervező megtekintése"
            ,"help" => "Tervező megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra"
            ,"card" => "Tervező megtekintéséhez kattintson a kártyára"
        )
		,"Calendar" => array(
            "navbar" => "Naptár"
            ,"fa" => "calendar"
            ,"title" => "Naptár megtekintése"
            ,"help" => "Naptár megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra"
            ,"card" => "Naptár megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Esemény hozzáadása"
                ,"Edit" => "Esemény szerkesztése"
                ,"View" => "Esemény megtekintése"
                ,"Delete" => "Esemény törlése"
            )
        )
        ,"Plans/Calendar" => array(
            "navbar" => "Naptár"
            ,"fa" => "calendar"
            ,"title" => "Naptár megtekintése"
            ,"help" => "Naptár megtekintéséhez kattintson a menüsorban az 'Elérhetőségek' gombra"
            ,"card" => "Naptár megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Esemény hozzáadása"
                ,"Edit" => "Esemény szerkesztése"
                ,"View" => "Esemény megtekintése"
                ,"Delete" => "Esemény törlése"
            )
        )
        ,"Plans/Kanban" => array(
            "navbar" => "Kanban"
            ,"fa" => "calendar"
            ,"title" => "View Kanban"
            ,"help" => "To view the kanban list, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view the kanban list"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Event"
                ,"Edit" => "Edit Event"
                ,"View" => "View Event"
                ,"Delete" => "Delete Event"
            )
        )
        ,"Plans/Groceries" => array(
            "navbar" => "Groceries"
            ,"fa" => "calendar"
            ,"title" => "View Groceries"
            ,"help" => "To view the Groceries list, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view the Groceries list"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Event"
                ,"Edit" => "Edit Event"
                ,"View" => "View Event"
                ,"Delete" => "Delete Event"
            )
        )
        ,"Home" => array(
            "navbar" => "Főoldal"
            ,"fa" => "home"
            ,"title" => "Főoldal"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Hardware" => array(
            "navbar" => "Eszközök"
            ,"fa" => "hdd-o"
            ,"title" => "Eszközök"
            ,"help" => "Eszközök olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Hardver' gombra kattintva a menüsávban"
            ,"card" => "Eszközök megtekintéséhez kattintson a kártyára"
        )
        ,"Company" => array(
            "navbar" => "Ügyfél adatok"
            ,"fa" => "building-o"
            ,"title" => "Ügyfél adatok"
            ,"help" => "Ügyfekkel kapcsolatos adatok olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Cégek' gombra kattintva a menüsávban"
            ,"card" => "Ügyfekkel kapcsolatos adatok megtekintéséhez kattintson a kártyára"
        )
        ,"Company/Company" => array(
            "navbar" => "Ügyfél"
            ,"fa" => "building-o"
            ,"title" => "Ügyfél adatok"
            ,"help" => "Ügyfél adatok olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Ügyfél' gombra kattintva a menüsávban"
            ,"card" => "Ügyfél adatok megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    Ezen a felületen vehetjük fel a partnereket, ügyfeleket, akikhez később telephelyeket, hardvereket és hozzáféréseket társíthatunk.<br />
                    <br />
                    <b>Ügyfél neve:</b> A cégnek a megnevezése/bejegyzett neve<br />
                    <b>Ügyfél leírása:</b> Megjegyzés a cégről, példuál: Foglalkozási köre<br />
                    <br />
                    <b>Adatok megtekintése:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Ügyfél szerkesztése:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Eltávolítás:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Ügyfél hozzáadása"
                ,"Edit" => "Ügyfél adatok szerkesztése"
                ,"View" => "Ügyfél adatok megtekintése"
                ,"Delete" => "Ügyfél törlése"
                ,"Filter" => "Adatok szűrése cégre"
            )
        )
        ,"Company/Site" => array(
            "navbar" => "Telephely"
            ,"fa" => "building-o"
            ,"title" => "Telephely adatok"
            ,"help" => "Ügyfél telephely adatok olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Ügyfél' gombra kattintva a menüsávban"
            ,"card" => "Ügyfél telephely adatok megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    Ezen a felületen vehetünk fel partnerekhez, ügyfelekhez tartozó telephelyeket, kirendeltségeket.<br />
                    <br />
                    <b>Cég neve:</b> A cégnek a megnevezése/bejegyzett neve<br />
                    <b>Cég leírása:</b> Megjegyzés a cégről, példuál: "Logisztikai cég", "Szolgáltató" stb.<br />
                    <b>Adószám:</b> Cég adószáma<br />
                    <b>Cégjegyzékszám:</b> Cégnek a regisztrációs cégjegyzékszáma<br />
                    <b>T.hely név</b>: Telephely neve<br />
                    <b>T.hely típus</b>: Telephely típusa<br />
                    <b>Város</b>: Telephely városa<br />
                    <b>IRSZ</b>: Telephely irányítószáma<br />
                    <b>Utca</b>: Telephely utca, házszáma<br />
                    <b>Telefonszám</b>: Telephely telefonszáma<br />
                    <b>E-mail</b>: Telephely e-mail címe<br />
                    <br />
                    Továbbá megadható még a Telephely vezetőjének és vezető helyettesének az alábbi adatai: <br />
                    <b>Keresztnév:</b> Telephely vezető/vezető helyettes keresztneve<br />
                    <b>Vezetékév:</b> Telephely vezető/vezető helyettes vezetékneve<br />
                    <b>Telefonszám</b>: Telephely vezető/vezető helyettes telefonszáma<br />
                    <b>E-mail</b>: Telephely vezető/vezető helyettes e-mail címe<br />
                    <br />
                    <b>Adatok megtekintése</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Telephely szerkesztése</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Eltávolítás</b>: <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Telephely hozzáadása"
                ,"Edit" => "Telephely adatok szerkesztése"
                ,"View" => "Telephely adatok megtekintése"
                ,"Delete" => "Telephely törlése"
            )
        )
        ,"Login" => array(
            "navbar" => "Bejelentkezés"
            ,"fa" => "sign-in"
            ,"title" => "Bejelentkezés"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Logout" => array(
            "navbar" => "Kijelentkezés"
            ,"fa" => "sign-out"
            ,"title" => "Kijelentkezés"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Profile" => array(
            "navbar" => "Profil"
            ,"fa" => "user"
            ,"title" => "Profil"
            ,"help" => "Profilja szerkesztéséhez kattintson a menüsávban a 'Profil' gombra és a 'Profil' oldalon a 'Szerkesztés' gombra"
            ,"card" => "Profilja szerkesztéséhez kattintson a menüsávban a 'Profil' gombra és a 'Profil' oldalon a 'Szerkesztés' gombra"
        )
        ,"Informations" => array(
            "navbar" => "Információk"
            ,"fa" => "info"
            ,"title" => "Információk"
            ,"help" => "Információk olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Tudáscikk' gombra kattintva a menüsávban"
            ,"card" => "Információk megtekintéséhez kattintson a kártyára"
        )
        ,"Informations/Access" => array(
            "navbar" => "Jelszavak"
            ,"fa" => "user-secret"
            ,"title" => "Jelszó adatok"
            ,"help" => "Jelszó adatok olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Hozzáférés' gombra kattintva a menüsávban"
            ,"card" => "Jelszó adatok megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Jelszó hozzáadása"
                ,"Edit" => "Jelszó szerkesztése"
                ,"View" => "Jelszó megtekintése"
                ,"Delete" => "Jelszó törlése"
            )
        )
        ,"Informations/Passtorage" => array(
            "navbar" => "Jelszótárolók"
            ,"fa" => "hdd-o"
            ,"title" => "Jelszótároló adatok"
            ,"help" => "Jelszótároló adatok olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Hardver' gombra kattintva a menüsávban"
            ,"card" => "Jelszótároló adatok megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'addButton' => true
                ,'addNonModal' => false
                ,'color' => 'success'
                ,'header' => 'Információ'
                ,'title' => ''
                ,'content' => '
                    <b>Általános adatok</b><br />
                    <b>Megnevezés</b>: Jelszótároló általános megnevezése. Például: "Mucika gépe"<br />
                    <b>Leírás</b>: Jelszótároló leírása, vagy megjegyzés róla. Például: ""<br />
                    <br />
                    <b>Jelszótároló adatainak megtekintése</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Adatok szerkesztése</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Eltávolítása</b>: <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Jelszótároló hozzáadása"
                ,"Edit" => "Jelszótároló szerkesztése"
                ,"View" => "Jelszótároló megtekintése"
                ,"Delete" => "Jelszótároló törlése"
                ,"Upload" => "Jelszótárolóhoz csatolmány feltöltése"
            )
        )
        ,"Informations/Knowledge" => array(
            "navbar" => "Tudáscikkek"
            ,"fa" => "info"
            ,"title" => "Tudáscikkek"
            ,"help" => "Tudáscikkek olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Cégek' gombra kattintva a menüsávban"
            ,"card" => "Tudáscikkek megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Információ'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    <b>Fontos információk!</b><br />
                    A felületen Tudáscikk hozzáadásakor lehetőség van megadni címet és címkét, amely a listában jelenik meg.<br />
                    A címnél érdemes kihagyni a céget, lévén hogy az droplist-ből választható.<br />
                    Cimkénél általánosan az alábbi label-eket használjuk:<br />
                    <ul>
                        <li><b>Dokumentáció</b> (relatíve minden tudáscikk az)</li>
                        <li><b>Fájl</b> (ha rendelkezik melléklettel, illetve a fájl/ok kiterjesztése)</li>
                        <li><b>Script</b> (ha kód részlet van a tudáscikkben)</li>
                        <li><b>Táblázat</b> (ha van valamilyen táblázat a cikkben)</li>
                        <li><b>Levél</b> (ha levelezés vagy annak részlete van a cikkben)</li>
                    </ul>
                    Minél pontosabb a cimkézés és címzés, annál könnyebb a keresés!
                    <br /> <b>Képek</b> és egyéb <b>mellékletek</b> a cikk létrehozása után adhatóak hozzá a cikkhez a <b>feltöltés</b> gomb használatával! <a class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i></a>'
            )
            ,"action" => array(
                "Add" => "Tudáscikk hozzáadása"
                ,"Edit" => "Tudáscikk szerkesztése"
                ,"View" => "Tudáscikk megtekintése"
                ,"Delete" => "Tudáscikk törlése"
                ,"Upload" => "Tudáscikkhez fájl feltöltése"
            )
        )
        ,"Informations/Device" => array(
            "navbar" => "Eszközök"
            ,"fa" => "hdd-o"
            ,"title" => "Eszköz adatok"
            ,"help" => "Eszköz adatok olvasása/írása/szerkesztése (jogosultság szinttől függően) elérhető a 'Hardver' gombra kattintva a menüsávban"
            ,"card" => "Eszköz adatok megtekintéséhez kattintson a kártyára"
            ,"info" => array(
                'addButton' => true
                ,'addNonModal' => false
                ,'color' => 'success'
                ,'header' => 'Információ'
                ,'title' => ''
                ,'content' => '
                    <b>Általános adatok</b><br />
                    <b>Megnevezés</b>: Eszköz általános megnevezése. Például: "Mucika gépe"<br />
                    <b>Leírás</b>: Eszköz leírása, vagy megjegyzés róla. Például: ""<br />
                    <br />
                    <b>Eszköz adatainak megtekintése</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Adatok szerkesztése</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Eltávolítása</b>: <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Eszköz hozzáadása"
                ,"Edit" => "Eszköz szerkesztése"
                ,"View" => "Eszköz megtekintése"
                ,"Delete" => "Eszköz törlése"
                ,"Upload" => "Eszköz csatolmány feltöltése"
            )
        )
    );
}
