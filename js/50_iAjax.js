const iAjax = (iAjax = Object) => class extends iAjax {
    constructor() {
        super();
    }

    /**
     * Sets the inner HTML of ajax call
     *
     * @param xhttp object
     * @param id string
     * @author Liszi Dániel
     */
    setInnerHTML(xhttp, id = "body") {
        const z = document.getElementById(id);
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const stringInnerContent = xhttp.responseText;
            document.getElementById(id).innerHTML = stringInnerContent;
            // Navbar collapsing
            $('.navbar-collapse').collapse('hide');
            // Possible CKEditor initialization
            this.evntCKEditor();
            // Possible SelectPicker initialization
            this.evntSelectPicker();
            // Possible DataTable initialization
            this.evntDataTable();
            // Possible Input copy initialization
            this.evntCopyDisabled();
            // Possible form element initialization
            this.evntForm(z.getElementsByTagName('input'));
            this.evntForm(z.getElementsByTagName('button'));
            this.evntHrefs(z.getElementsByTagName('a'));
            // Possible Chart initialization
            this.evntChart();
            // Possible Evo-Calendar initialization
            this.evntCalendar();
        } else if (xhttp.status === 404) {
            xhttp.open("GET", window.errorSite, true);
            xhttp.send();
        }
    }

    /**
     * Initiates Ajax query
     *
     * @param param string
     * @param id string
     * @param type string
     * @return bool
     * @author Liszi Dániel
     */
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

    /**
     * Ajax call goes through this
     *
     * @param param string
     * @param id string
     * @param type string
     * @author Liszi Dániel
     */
    initElmnt(param = "x=Home", id = "body", type = "POST") {
        this.ajaxCall(param, id, type);
        if (id === 'modalDialog') {
            $('#modalBox').modal({ show: true });
        }
    }

    /**
     * Loads content from either canonical or get format
     *
     * @author Liszi Dániel
     */
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
};
