const iAjaxFunctions = (iAjaxFunctions = Object) => class extends iAjaxFunctions
{
    constructor()
    {
        super();
    }

/**
 * Checks if file exists
 *
 * @param url string
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    funcFileExists(url)
    {
        let xhttp = new XMLHttpRequest();
        xhttp.open('HEAD', url, true);
        xhttp.send();
        return xhttp.status!=404;
    }

/**
 * Finds the original element recursively
 *
 * @param srcTag object
 * @param srcTagName string
 *
 * @return on success object, on fail false
 *
 * @author Liszi Dániel
 */
    findSource(srcTag, srcTagName)
    {
        if (srcTag.tagName.toLowerCase() !== 'body') {
            if (srcTag.tagName.toLowerCase() === srcTagName) {
                return srcTag;
            } else {
                return this.findSource(srcTag.parentElement, srcTagName);
            }
        } else {
            return false;
        }
    }

/**
 * Changes specific modals size
 *
 * @param lmnt string
 *
 * @author Liszi Dániel
 */
    changeModalSize(lmnt)
    {
	let _self = this;
	let localBool = false;
	let newSize = "";

	this.customModal.forEach(cModal => {
    	    if (lmnt !== null && cModal[0] !== null) {
		if(lmnt.localeCompare(cModal[0]) === 0) {
		    localBool = true;
		    newSize = cModal[1];
		}
	    }
	});

        if (localBool && ( ! this.checkTag("errormessage") && ! this.checkTag("modalmessage"))) {
            if(! this.modalDialogElement.classList.contains("modal-" + newSize)) {
		this.removeModalSizes(_self, ["xl", "lg", "sm"]);
                this.modalDialogElement.classList.add("modal-" + newSize);
            }
        } else {
            if(! this.modalDialogElement.classList.contains("modal-lg")) {
		this.removeModalSizes(_self, ["xl", "sm"]);
                this.modalDialogElement.classList.add("modal-lg");
            }

	}
    }
/**
 * Forces node into print view, modified script
 *
 * @param elem NODE
 *
 * @source http://jsfiddle.net/deepstutorials/42c21a8h/8/
 *
 * @author Liszi Dániel
 */
    printElement(elem) {
        var domClone = elem.cloneNode(true);
        var $printSection = document.getElementById("printSection");

        if (!$printSection) {
            var $printSectionReDefine = document.createElement("div");
            $printSectionReDefine.id = "printSection";
            document.body.appendChild($printSectionReDefine);
        }

        var collapseIds = domClone.querySelectorAll('*[id^="collapse"]');
        collapseIds.forEach(cId => {
            cId.classList.add("show");
        });

        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
    }

/**
 * Removes modal size classes
 *.
 * @param lmnt string
 *.
 * @author Liszi Dániel
 */

    removeModalSizes(_self, modalSizes){
        modalSizes.forEach(mSize => {
    	    if (_self.modalDialogElement.classList.contains("modal-" + mSize)) {
                _self.modalDialogElement.classList.remove("modal-" + mSize);
    	    }
	});
    }

/**
 * Checks if element by tagname exists
 *
 * @param tagname string
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    checkTag(tagname)
    {
        return (!document.getElementsByTagName(tagname))? true : false;
    }
};
