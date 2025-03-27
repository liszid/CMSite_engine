const iAjax = (iAjax = Object) => class extends iAjax { 
    
    constructor() { super(); }

    setInnerHTML(xhttp, id = "body") {
        const z = document.getElementById(id);
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const stringInnerContent = xhttp.responseText;
            document.getElementById(id).innerHTML = stringInnerContent;
            $('.navbar-collapse').collapse('hide');
            this.evntCKEditor();
            this.evntSelectPicker();
            this.evntDataTable();
            this.evntCopyDisabled();
            this.evntForm(z.getElementsByTagName('input'));
            this.evntForm(z.getElementsByTagName('button'));
            this.evntHrefs(z.getElementsByTagName('a'));
            this.evntChart();
            this.evntCalendar();
            this.initializeCollapsibles();
            this.periodicCheckAndUpdate();
        } else if (xhttp.status === 404) {
            xhttp.open("GET", window.errorSite, true);
            xhttp.send();
        }
    }

    ajaxCall(param, id, type) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => this.setInnerHTML(xhttp, id);
        if (type === "GET") {
            xhttp.open(type, this.ajaxFile + "?" + param, true);
            xhttp.send();
        } else {
            xhttp.open(type, this.ajaxFile, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(param);
        }
        return false;
    }

    initElmnt(param = "x=Home", id = "body", type = "POST") {
        this.ajaxCall(param, id, type);
        if (id === 'modalDialog') {
            $('#modalBox').modal({ show: true });
        }
    }

    loadContent() {
        const urlParams = new URLSearchParams(window.location.search);
        let urlCanonical = window.location.pathname.split("/").filter(Boolean);

        if (urlCanonical.length) {
            let canonical = `a=${urlCanonical[0]}`;
            if (urlCanonical[1]) canonical += `&b=${urlCanonical[1]}`;
            if (urlCanonical[2]) canonical += `&c=${urlCanonical[2]}`;

            this.initElmnt(canonical);
        } else {
            this.initElmnt("d=Home");
        }
    }

    // Új függvény az adatbeolvasó PHP script periodikus futtatására
    periodicCheckAndUpdate() {
        setInterval(() => {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState === 4 && xhttp.status === 200) {
                    console.log("PHP script sikeresen lefutott és frissítette az adatokat");
                }
            };
            xhttp.open("GET", this.performanceLoadFile, true);
            xhttp.send();
        }, 30000); // 300 000 ms = 5 perc
    }
}