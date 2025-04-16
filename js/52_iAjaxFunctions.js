const iAjaxFunctions = (iAjaxFunctions = Object) =>
    class extends iAjaxFunctions {
        constructor() {
            super();
        }

        funcFileExists(url) {
            let xhttp = new XMLHttpRequest();
            xhttp.open("HEAD", url, true);
            xhttp.send();
            return xhttp.status != 404;
        }

        findSource(srcTag, srcTagName) {
            if (srcTag.tagName.toLowerCase() !== "body") {
                if (srcTag.tagName.toLowerCase() === srcTagName) {
                    return srcTag;
                } else {
                    return this.findSource(srcTag.parentElement, srcTagName);
                }
            } else {
                return false;
            }
        }

        changeModalSize(lmnt) {
            let _self = this;
            let localBool = false;
            let newSize = "";

            this.customModal.forEach((cModal) => {
                if (lmnt !== null && cModal[0] !== null) {
                    if (lmnt.localeCompare(cModal[0]) === 0) {
                        localBool = true;
                        newSize = cModal[1];
                    }
                }
            });

            if (localBool && !this.checkTag("errormessage") && !this.checkTag("modalmessage")) {
                if (!this.modalDialogElement.classList.contains("modal-" + newSize)) {
                    this.removeModalSizes(_self, ["xl", "lg", "sm"]);
                    this.modalDialogElement.classList.add("modal-" + newSize);
                }
            } else {
                if (!this.modalDialogElement.classList.contains("modal-lg")) {
                    this.removeModalSizes(_self, ["xl", "sm"]);
                    this.modalDialogElement.classList.add("modal-lg");
                }
            }
        }

        printElement(elem) {
            var domClone = elem.cloneNode(true);
            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSectionReDefine = document.createElement("div");
                $printSectionReDefine.id = "printSection";
                document.body.appendChild($printSectionReDefine);
            }

            var collapseIds = domClone.querySelectorAll('*[id^="collapse"]');
            collapseIds.forEach((cId) => {
                cId.classList.add("show");
            });

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }

        removeModalSizes(_self, modalSizes) {
            modalSizes.forEach((mSize) => {
                if (_self.modalDialogElement.classList.contains("modal-" + mSize)) {
                    _self.modalDialogElement.classList.remove("modal-" + mSize);
                }
            });
        }

        checkTag(tagname) {
            return !document.getElementsByTagName(tagname) ? true : false;
        }
    };