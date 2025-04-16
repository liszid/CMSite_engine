const iAjaxEvnts = (iAjaxEvnts = Object) =>
    class extends iAjaxEvnts {
        constructor() {
            super();
        }

        evntSelectPicker() {
            if ($(".selectpicker").length !== 0) {
                $(".selectpicker").selectpicker();
            }
        }

        evntCKEditor() {
            if ($(".ckeditor").length !== 0) {
                ClassicEditor.create(document.querySelector(".ckeditor"), {
                    toolbar: {
                        items: [
                            "heading",
                            "|",
                            "fontSize",
                            "bold",
                            "italic",
                            "underline",
                            "link",
                            "alignment",
                            "indent",
                            "outdent",
                            "numberedList",
                            "bulletedList",
                            "|",
                            "horizontalLine",
                            "blockQuote",
                            "imageUpload",
                            "insertTable",
                            "|",
                            "undo",
                            "redo"
                        ]
                    },
                    language: "hu",
                    image: {
                        toolbar: ["imageTextAlternative", "imageStyle:full", "imageStyle:side"]
                    },
                    table: {
                        contentToolbar: [
                            "tableColumn",
                            "tableRow",
                            "mergeTableCells",
                            "tableCellProperties",
                            "tableProperties"
                        ]
                    },
                    licenseKey: ""
                })
                    .then((editor) => {
                        window.editor = editor;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }

        evntCopyDisabled() {
            if ($('input[type="text"][readonly]').length !== 0) {
                $('input[type="text"][readonly]').each(function (index) {
                    console.log($(this).val());
                    $(this).on("click", function (e) {
                        navigator.clipboard.writeText(e.currentTarget.value).then(function () {
                            if ($("#snackbar").length === 0) {
                                $(
                                    '<div id="snackbar"><b>Siker!</b> A szöveg sikeresen rákerült a vágólapra. </div>'
                                ).appendTo("#modalBox");
                            }
                            $("#snackbar").addClass("show");

                            setTimeout(function () {
                                $("#snackbar").removeClass("show");
                            }, 1500);
                        });
                        console.log($(this).val());
                    });
                });
            }
        }

        evntDataTable() {
            let _self = this;
            if ($("table").length !== 0) {
                $("table").each(function () {
                    if (!$.fn.dataTable.isDataTable(this)) {
                        $('[data-toggle="tooltip"]').tooltip();
                        if ($.inArray($(this).attr("id"), _self.tableSearching) >= 0) {
                            $("#" + $(this).attr("id") + " thead tr:eq(0) th").each(function (i) {
                                var title = $(this).text();
                                if (title !== "" && !$(this).hasClass("never")) {
                                    $(this).html('<center><input type="text" placeholder="' + title + '" /></center>');
                                    $("input", this).attr("size", $("input", this).attr("placeholder").length);
                                    $("input", this).on("keyup change", function () {
                                        if (table.column(i).search() !== this.value) {
                                            table.column(i).search(this.value).draw();
                                        }
                                    });
                                }
                            });
                            var table = $(this).DataTable({
                                columnDefs: [
                                    { targets: "no-sort", orderable: false },
                                    { targets: "never", orderable: false, order: [], visible: false }
                                ],
                                lengthMenu: [
                                    [25, 50, 100, -1],
                                    [25, 50, 100, "Mind"]
                                ],
                                order: [[0, "desc"]],
                                fixedHeader: true,
                                language: {
                                    url: "plug-ins/datatable.lang.hungarian.json"
                                }
                            });
                        } else {
                            if ($.inArray($(this).attr("id"), _self.tableNonSearching) >= 0) {
                                $(this).DataTable({
                                    order: [[0, "asc"]],
                                    columnDefs: [
                                        { targets: "no-sort", orderable: false },
                                        { targets: "never", orderable: false, order: [], visible: false }
                                    ],
                                    lengthMenu: [
                                        [25, 50, 100, -1],
                                        [25, 50, 100, "Mind"]
                                    ],
                                    paging: false,
                                    searching: false,
                                    language: {
                                        url: "plug-ins/datatable.lang.hungarian.json"
                                    }
                                });
                            }
                        }
                    }
                });
            }
        }

        evntHrefs(srcTag = this.tagA) {
            let _self = this;
            if (srcTag.length > 0) {
                var addEvent = (e) => {
                    let tempSrcLmnt = _self.findSource(e.target, "a");
                    let srcLmnt = tempSrcLmnt !== undefined ? (tempSrcLmnt !== false ? tempSrcLmnt : null) : null;
                    let loc =
                        srcLmnt !== null && srcLmnt.getAttribute("data-link") !== null ? srcLmnt.getAttribute("data-link") : null;
                    _self.changeModalSize(loc);
                    if (loc !== null && srcLmnt !== null) {
                        e.preventDefault();
                        let tempLocation = loc.split("/");
                        let dataPost =
                            srcLmnt.getAttribute("data-post") !== null ? srcLmnt.getAttribute("data-post") : "";
                        if (tempLocation.length > 1) {
                            let canonicLocation = "x=" + tempLocation[0] + "&y=" + tempLocation[1];
                            canonicLocation = canonicLocation.concat(
                                tempLocation[2] !== undefined ? "&z=" + tempLocation[2] : ""
                            );
                            canonicLocation = canonicLocation.concat(
                                tempLocation[3] !== undefined ? "&zn=" + tempLocation[3] : ""
                            );
                            if (dataPost !== "") {
                                if (tempLocation[2] !== undefined && _self.notModalActions.indexOf(loc) >= 0) {
                                    _self.initElmnt(canonicLocation + "&dp=" + dataPost, "body");
                                } else {
                                    _self.initElmnt(canonicLocation + "&dp=" + dataPost, "modalDialog");
                                }
                            } else {
                                _self.initElmnt(canonicLocation);
                            }
                            history.pushState(loc, "", "/" + loc);
                        } else {
                            if (srcLmnt.hasAttribute("data-target")) {
                                if (dataPost !== "") {
                                    _self.initElmnt("x=" + loc + "&dp=" + dataPost, "modalDialog");
                                } else {
                                    _self.initElmnt("x=" + loc, "modalDialog");
                                }
                            } else {
                                _self.initElmnt("x=" + loc);
                                history.pushState(loc, "", "/" + loc);
                            }
                        }
                    }
                };
                for (var hrefIndex in srcTag) {
                    if (isFinite(hrefIndex)) {
                        srcTag[hrefIndex].addEventListener("click", addEvent);
                    }
                }
            }
        }

        evntCalendar() {
            let _self = this;
            if ($("#calendar").length !== 0) {
                $("#calendar").evoCalendar({
                    theme: "Default",
                    language: "hu",
                    format: "mm/dd/yyyy",
                    todayHighlight: false,
                    firstDayOfWeek: 1,
                    eventDisplayDefault: true,
                    eventListToggler: false,
                    sidebarDisplayDefault: true,
                    sidebarToggler: false
                });
                var data = JSON.parse(jQuery("#json").text());
                console.log(data);
                $("#calendar").evoCalendar("addCalendarEvent", data);
            }

            if ($("#homeCalendar").length !== 0) {
                $("#homeCalendar").evoCalendar({
                    theme: "Default",
                    language: "hu",
                    todayHighlight: true,
                    firstDayOfWeek: 1,
                    eventDisplayDefault: false,
                    eventListToggler: false,
                    sidebarDisplayDefault: false,
                    sidebarToggler: false
                });
            }
        }

        evntChart() {
            function convertToDate(timestamp) {
                return new Date(timestamp * 1000);
            }

            let containers = document.querySelectorAll(".chartContainer");

            CanvasJS.addColorSet("greenShades", ["#ffff31", "#efcc00", "#fff8dc", "#90EE90"]);

            containers.forEach(function (container) {
                let data = JSON.parse(container.textContent);
                let chartType = container.getAttribute("data-chart-type");
                let chartLabel = container.getAttribute("data-label");

                data.forEach(function (series) {
                    series.dataPoints.forEach(function (point) {
                        point.x = convertToDate(point.x);
                    });
                    series.dataPoints.sort(function (a, b) {
                        return a.x - b.x;
                    });
                });

                let chartOptions = {
                    theme: "dark1",
                    colorSet: "greenShades",
                    animationEnabled: true,
                    title: {
                        text: chartLabel
                    },
                    axisX: {
                        valueFormatString: "YYYY-MM-DD HH:mm:ss"
                    },
                    axisY: {
                        title: "Values",
                        suffix: ""
                    },
                    legend: {
                        cursor: "pointer",
                        fontSize: 16,
                        itemclick: toggleDataSeries
                    },
                    toolTip: {
                        shared: true
                    },
                    data: []
                };

                if (chartType === "multi") {
                    data.forEach((series) => {
                        chartOptions.data.push({
                            name: series.name,
                            type: series.type,
                            showInLegend: true,
                            dataPoints: series.dataPoints
                        });
                    });
                } else if (chartType === "line") {
                    data.forEach((series) => {
                        chartOptions.data.push({
                            type: "line",
                            name: series.name,
                            showInLegend: true,
                            dataPoints: series.dataPoints
                        });
                    });
                } else if (chartType === "column") {
                    data.forEach((series) => {
                        chartOptions.data.push({
                            type: "column",
                            name: series.name,
                            showInLegend: true,
                            dataPoints: series.dataPoints
                        });
                    });
                } else if (chartType === "area") {
                    data.forEach((series) => {
                        chartOptions.data.push({
                            type: "area",
                            name: series.name,
                            showInLegend: true,
                            dataPoints: series.dataPoints
                        });
                    });
                } else {
                    console.error("Unsupported chart type: " + chartType);
                }

                let chart = new CanvasJS.Chart(container, chartOptions);
                chart.render();
            });

            function toggleDataSeries(e) {
                if (typeof e.dataSeries.visible === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }
        }

        evntForm(tag) {
            let _self = this;
            if (tag.length > 0) {
                var addEvent = (e) => {
                    let mustFill = true;
                    let tempSrcLmnt = _self.findSource(e.target, "input");
                    if (tempSrcLmnt === undefined || tempSrcLmnt === false) {
                        tempSrcLmnt = _self.findSource(e.target, "button");
                    }
                    let srcLmnt = tempSrcLmnt !== undefined ? (tempSrcLmnt !== false ? tempSrcLmnt : null) : null;

                    e.preventDefault();
                    if (srcLmnt.hasAttribute("id")) {
                        for (let i = 0; i < _self.arrayObject.length; i++) {
                            if (
                                srcLmnt
                                    .getAttribute("id")
                                    .startsWith(_self.arrayObject[i][0] + "-" + _self.arrayObject[i][2])
                            ) {
                                let returnString = _self.arrayObject[i][1];
                                let innerArray = document.querySelectorAll('[id^="' + _self.arrayObject[i][0] + '-"]');
                                if (innerArray.length > 0) {
                                    for (let k = 0; k < innerArray.length; k++) {
                                        let innerArrayObjectName = innerArray[k].id.split("-")[1];

                                        if (
                                            innerArray[k].hasAttribute("data-must-fill") &&
                                            (innerArray[k].value === null || innerArray[k].value === "")
                                        ) {
                                            mustFill = false;
                                            innerArray[k].classList.add("is-invalid");
                                        } else {
                                            innerArray[k].classList.remove("is-invalid");
                                        }

                                        if (!innerArrayObjectName.includes("pWord")) {
                                            if (innerArrayObjectName.includes("Checkbox")) {
                                                let arrayOfSelectedOptions = innerArray[k].selectedOptions;
                                                returnString = returnString.concat("&" + innerArrayObjectName + "=");
                                                for (let o = 0; o < arrayOfSelectedOptions.length; o++) {
                                                    returnString = returnString.concat(arrayOfSelectedOptions[o].value);
                                                    if (o < arrayOfSelectedOptions.length - 1) {
                                                        returnString = returnString.concat(",");
                                                    }
                                                }
                                            } else {
                                                let valueOfK = "";
                                                if (innerArray[k].classList.contains("ckeditor")) {
                                                    valueOfK = encodeURIComponent(editor.getData());
                                                } else if (innerArray[k].getAttribute("type") === "file") {
                                                    returnString = returnString.concat(
                                                        "&" + innerArrayObjectName + "={"
                                                    );
                                                    for (var variableName in innerArray[k].files[0]) {
                                                        returnString = returnString.concat(
                                                            variableName +
                                                                ":" +
                                                                innerArray[k].files[0][variableName] +
                                                                ","
                                                        );
                                                    }
                                                    returnString = returnString.concat("}");
                                                    console.log(returnString);
                                                } else {
                                                    valueOfK = innerArray[k].value;
                                                }
                                                returnString = returnString.concat(
                                                    "&" + innerArrayObjectName + "=" + valueOfK
                                                );
                                            }
                                        } else {
                                            returnString = returnString.concat(
                                                "&" + innerArrayObjectName + "=" + _self.MD5(innerArray[k].value)
                                            );
                                        }
                                    }
                                } else if (srcLmnt.hasAttribute("data-id")) {
                                    if (_self.arrayObject[i][5]) {
                                        returnString = returnString.concat(
                                            "&" + _self.arrayObject[i][5] + "=" + srcLmnt.getAttribute("data-id")
                                        );
                                    }
                                }
                                if (mustFill) {
                                    if (_self.arrayObject[i][4]) {
                                        _self.initElmnt(returnString, _self.arrayObject[i][4]);
                                    } else {
                                        _self.initElmnt(returnString);
                                    }
                                }
                            }
                        }
                    }
                };
                for (var hrefIndex in tag) {
                    if (isFinite(hrefIndex)) {
                        switch (tag[hrefIndex].tagName.toLowerCase()) {
                            case "button":
                                tag[hrefIndex].addEventListener("click", addEvent);
                                break;
                        }
                    }
                }
            }
        }

        initializeCollapsibles() {
            var collapsibles = document.getElementsByClassName("collapsible");

            for (var i = 0; i < collapsibles.length; i++) {
                collapsibles[i].addEventListener("click", function () {
                    this.classList.toggle("collapsible-active");
                    var content = this.nextElementSibling;
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            }
        }
    };

(function () {
    addEvent(window, "load", function () {
        if (isInternetExplorer()) polyfillDataUriDownload();
    });

    function polyfillDataUriDownload() {
        var links = document.querySelectorAll("a[download], area[download]");
        for (var index = 0, length = links.length; index < length; ++index) {
            (function (link) {
                var dataUri = link.getAttribute("href");
                var fileName = link.getAttribute("download");
                if (dataUri.slice(0, 5) != "data:") throw new Error("The XHR part is not implemented here.");
                addEvent(link, "click", function (event) {
                    cancelEvent(event);
                    try {
                        var dataBlob = dataUriToBlob(dataUri);
                        forceBlobDownload(dataBlob, fileName);
                    } catch (e) {
                        alert(e);
                    }
                });
            })(links[index]);
        }
    }

    function forceBlobDownload(dataBlob, fileName) {
        window.navigator.msSaveBlob(dataBlob, fileName);
    }

    function dataUriToBlob(dataUri) {
        if (!/base64/.test(dataUri)) throw new Error("Supports only base64 encoding.");
        var parts = dataUri.split(/[:;,]/),
            type = parts[1],
            binData = atob(parts.pop()),
            mx = binData.length,
            uiArr = new Uint8Array(mx);
        for (var i = 0; i < mx; ++i) uiArr[i] = binData.charCodeAt(i);
        return new Blob([uiArr], { type: type });
    }

    function addEvent(subject, type, listener) {
        if (window.addEventListener) subject.addEventListener(type, listener, false);
        else if (window.attachEvent) subject.attachEvent("on" + type, listener);
    }

    function cancelEvent(event) {
        if (event.preventDefault) event.preventDefault();
        else event.returnValue = false;
    }

    function isInternetExplorer() {
        return /*@cc_on!@*/ false || !!document.documentMode;
    }
})();
