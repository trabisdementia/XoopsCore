/*
 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * Module System Commands
 *
 * Copyright © 2015 The XOOPS project http://xoops.org
 * -----------------------------------------------------------------
 * @copyright    The XOOPS project http://xoops.org
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @since        2.6
 * @author       Eduardo Cortés (AKA bitcero)    <i.bitcero@gmail.com>
 */

//@prepros-prepend bootbox.js
//@prepros-prepend pnotify.custom.js

/*
 ------------------------------------------------
 1. XOOPS INTERFACE
 ------------------------------------------------     */
(function () {

    this.xoops = {

        /*------------------------------------------------
         1.1 GET DOM ELEMENT
         ------------------------------------------------*/
        $: function (id) {
            var elements = new Array();

            for (var i = 0; i < arguments.length; i++) {
                var element = arguments[i];
                if (typeof element == 'string') {
                    element = document.getElementById(element);
                }

                if (arguments.length == 1) {
                    return element;
                }

                elements.push(element);
            }

            return elements;
        },

        /*------------------------------------------------
         1.2 GET AN URL
         ------------------------------------------------*/
        /**
         * Get the absolute or relative URL according to a given path
         * @param url
         * @param relative
         * @returns {string}
         */
        url: function (url, relative) {

            // Get the hostname
            var host = window.location.protocol + '//' + window.location.host;

            if (window.location.port != '') {
                host += ':' + window.location.port;
            }

            var baseUrl = xoURL.replace(host, '');

            if (undefined == url) {
                return xoURL;
            }

            if (arguments.length == 1 || true != relative) {
                return xoURL + url;
            }

            return baseUrl + url;
        },

        /*------------------------------------------------
         1.3 BOOTBOX INCLUSION
         ------------------------------------------------*/
        /**
         * Shows a modal using bootbox
         * See http://bootboxjs.com/ for usage
         */
        modal: bootbox,

        /*------------------------------------------------
         1.4 PNOTIFY INCLUSION
         ------------------------------------------------*/
        /**
         * This is a wrapper for PNotify plugin
         * See http://sciactive.com/pnotify/ for docs
         * @param options To be passed to PNotify plugin
         */
        notify: function (options) {

            //PNotify.prototype.options.styling = 'bootstrap3';
            return new PNotify(options);

        },

        /*------------------------------------------------
         1.5 OPEN WINDOW
         ------------------------------------------------*/
        openWindow: function (options) {

            var defaults = {
                url: '',
                name: 'xowindow',
                width: 400,
                height: 500,
                toolbar: 'no',
                location: 'no',
                status: 'no',
                menubar: 'no',
                scrollbar: 'yes',
                resizable: 'yes'
            };

            options = setOptions(options, defaults);

            if ('' == options.url) {
                console.log('No URL has been provided for xoops.openWindow');
                return false;
            }

            var stropts = "width=" + options.width + ",height=" + options.height +
                ",toolbar=" + options.toolbar + ",location=" + options + location +
                ",directories=no,status=" + options.status + ",menubar=" + options.menubar +
                ",scrollbars=" + options.scrollbar + ",resizable=" + options.resizable + ",copyhistory=no";

            var new_window = window.open(options.url, options.name, stropts);
            window.self.name = "main";
            new_window.focus();
            return new_window;

        },

        /*------------------------------------------------
         1.6 AJAX RESPONSE
         ------------------------------------------------*/
        AJAX: {

            /* -------- 1.6.1 PROCESS AN AJAX RESPONSE -------- */

            /*
             * Response must be an standard JSON object with next components:
             * type:     Can be 'error' when an error occurs in server or '' in other case
             * message:  Must be an string. Generally this string will be shown on a alert dialog
             * action:   The server can send a valid action to execute locally: reload, goto, function
             */
            retrieve: function (response) {
                // Check if this is an error response
                if ('error' == response.type) {

                    if ('' != response.message) {
                        alert(response.message);
                    }

                }

                if(undefined != response.token){
                    $("#xo-token").val(response.token);
                }

                this.processAction(response);

                if(response.type == 'error'){
                    return false;
                }

                return true;
            },

            /**
             * Process action to execute in client browser
             * <p>Available actions are:</p>
             * <code>goto, reload, action, closeWindow, closeModal</code>
             * @param response AJAX response
             */
            processAction: function (response) {

                // ACTION action
                if (undefined != response.action && '' != response.action) {

                    if(response.action.indexOf('function') < 0 && response.action.indexOf('eval') < 0){

                        if('function' == typeof window[response.action]){
                            window[response.action]();
                            return true;
                        }

                    }

                }

                // CLOSE MODAL action
                if (undefined != response.closeModal && '' != response.closeModal) {

                    var id = response.closeModal.replace('#', '');

                    if($("#" + id).length>0){
                        $("#" + id).modal('hide');
                        return true;
                    }

                }

                // OPEN MODAL action
                if (undefined != response.openModal && '' != response.openModal) {

                    xoops.modal.dialog({
                        title: response.title,
                        message: response.content,
                        color: response.color != undefined ? response.color : 'primary',
                        id: response.openModal,
                        buttons: response.buttons != undefined ? response.buttons : {main: {label: xoLang.close, className: 'btn-primary'}}
                    });

                    if($("#" + id).length>0){
                        $("#" + id).modal('hide');
                    }
                    return true;

                }

                // RELOAD action
                if (undefined != response.reload && 1 == response.reload) {

                    window.location.reload(true);
                    return true;

                }

                // GOTO action
                if (undefined != response.goto && '' != response.goto) {

                    window.location.href = response.goto;
                    return true;

                }

            }

        },

    };

    /*------------------------------------------------
     1.8 PRIVATE MEMBERS
     ------------------------------------------------*/
    /**
     * Set options according to given defaults properties
     * @param options
     * @param defaults
     * @returns {*}
     */
    function setOptions(options, defaults) {
        if (typeof(options) === "object") {
            options = extendDefaults(defauls, options);
        } else {
            options = defaults;
        }
        return options;
    }

    function extendDefaults(source, properties) {
        var property;
        for (property in properties) {
            if (properties.hasOwnProperty(property)) {
                source[property] = properties[property];
            }
        }
        return source;
    }

}());

/*------------------------------------------------
 2. BACKWARD COMPATIBILITY
 ------------------------------------------------*/

/**
 * @deprecated Use xoops.$() instead
 * @returns {*}
 */
function xoops$() {
    var elements = new Array();

    for (var i = 0; i < arguments.length; i++) {
        var element = arguments[i];
        if (typeof element == 'string') {
            element = document.getElementById(element);
        }

        if (arguments.length == 1) {
            return element;
        }

        elements.push(element);
    }

    return elements;
}


function xoopsGetElementById(id) {
    return xoops.$(id);
}

function xoopsSetElementProp(name, prop, val) {
    var elt = xoopsGetElementById(name);
    if (elt) {
        elt[prop] = val;
    }
}

function xoopsSetElementStyle(name, prop, val) {
    var elt = xoopsGetElementById(name);
    if (elt && elt.style) {
        elt.style[prop] = val;
    }
}

function xoopsGetFormElement(fname, ctlname) {
    var frm = document.forms[fname];
    return frm ? frm.elements[ctlname] : null;
}

function justReturn() {
    return;
}

function openWithSelfMain(url, name, width, height, returnwindow) {
    return xoops.openWindow({
        name: name,
        width: width,
        height: height,
        url: url
    });
}

function setElementColor(id, color) {
    xoopsGetElementById(id).style.color = "#" + color;
}

function setElementFont(id, font) {
    xoopsGetElementById(id).style.fontFamily = font;
}

function setElementSize(id, size) {
    xoopsGetElementById(id).style.fontSize = size;
}

function setVisible(id) {
    xoopsGetElementById(id).style.visibility = "visible";
}

function setHidden(id) {
    xoopsGetElementById(id).style.visibility = "hidden";
}

function appendSelectOption(selectMenuId, optionName, optionValue) {
    var selectMenu = xoopsGetElementById(selectMenuId);
    var newoption = new Option(optionName, optionValue);
    newoption.selected = true;
    selectMenu.options[selectMenu.options.length] = newoption;
}

function disableElement(target) {
    var targetDom = xoopsGetElementById(target);
    if (targetDom.disabled != true) {
        targetDom.disabled = true;
    } else {
        targetDom.disabled = false;
    }
}

function xoopsCheckAll(form, switchId) {
    var eltForm = xoops$(form);
    var eltSwitch = xoops$(switchId);
    // You MUST NOT specify names, it's just kept for BC with the old lame crappy code
    if (!eltForm && document.forms[form]) {
        eltForm = document.forms[form];
    }
    if (!eltSwitch && eltForm.elements[switchId]) {
        eltSwitch = eltForm.elements[switchId];
    }

    var i;
    for (i = 0; i != eltForm.elements.length; i++) {
        if (eltForm.elements[i] != eltSwitch && eltForm.elements[i].type == 'checkbox') {
            eltForm.elements[i].checked = eltSwitch.checked;
        }
    }
}


function xoopsCheckGroup(form, switchId, groupName) {
    var eltForm = xoops$(form);
    var eltSwitch = xoops$(switchId);
    // You MUST NOT specify names, it's just kept for BC with the old lame crappy code
    if (!eltForm && document.forms[form]) {
        eltForm = document.forms[form];
    }
    if (!eltSwitch && eltForm.elements[switchId]) {
        eltSwitch = eltForm.elements[switchId];
    }

    var i;
    for (i = 0; i != eltForm.elements.length; i++) {
        var e = eltForm.elements[i];
        if ((e.type == 'checkbox') && ( e.name == groupName )) {
            e.checked = eltSwitch.checked;
            e.click();
            e.click();  // Click to activate subgroups twice so we don't reverse effect
        }
    }
}

function xoopsCheckAllElements(elementIds, switchId) {
    var switch_cbox = xoopsGetElementById(switchId);
    for (var i = 0; i < elementIds.length; i++) {
        var e = xoopsGetElementById(elementIds[i]);
        if ((e.name != switch_cbox.name) && (e.type == 'checkbox')) {
            e.checked = switch_cbox.checked;
        }
    }
}

function xoopsSavePosition(id) {
    var textareaDom = xoopsGetElementById(id);
    if (textareaDom.createTextRange) {
        textareaDom.caretPos = document.selection.createRange().duplicate();
    }
}
function xoopsInsertText(domobj, text) {
    if (domobj.selectionEnd) {
        //firefox
        var start = domobj.selectionStart;
        var end = domobj.selectionEnd;
        domobj.value = domobj.value.substr(0, start) + text + domobj.value.substr(end, domobj.value.length);
        domobj.focus();
        var pos = start + text.length;
        domobj.setSelectionRange(pos, pos);
        domobj.blur();
    } else if (domobj.createTextRange && domobj.caretPos) {
        //IE
        var caretPos = domobj.caretPos;
        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    } else if (domobj.getSelection && domobj.caretPos) {
        var caretPos = domobj.caretPos;
        caretPos.text = caretPos.text.charat(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    } else {
        domobj.value = domobj.value + text;
    }
}

function xoopsCodeSmilie(id, smilieCode) {
    var revisedMessage;
    var textareaDom = xoopsGetElementById(id);
    xoopsInsertText(textareaDom, smilieCode);
    textareaDom.focus();
    return;
}
function showImgSelected(imgId, selectId, imgDir, extra, xoopsUrl) {
    if (xoopsUrl == null) {
        xoopsUrl = "./";
    }
    imgDom = xoopsGetElementById(imgId);
    selectDom = xoopsGetElementById(selectId);
    if (selectDom.options[selectDom.selectedIndex].value != "") {
        imgDom.src = xoopsUrl + "/" + imgDir + "/" + selectDom.options[selectDom.selectedIndex].value + extra;
    } else {
        imgDom.src = xoopsUrl + "/images/blank.gif";
    }
}

function xoopsExternalLinks() {
    if (!document.getElementsByTagName) {
        return;
    }
    var anchors = document.getElementsByTagName("a");
    for (var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        if (anchor.getAttribute("href")) {
            // Check rel value with extra rels, like "external noflow". No test for performance yet
            var $pattern = new RegExp("external", "i");
            if ($pattern.test(anchor.getAttribute("rel"))) {
                /*anchor.onclick = function() {
                 window.open(this.href);
                 return false;
                 }*/
                anchor.target = "_blank";
            }
        }
    }
}

function xoopsOnloadEvent(func) {
    if (window.onload) {
        xoopsAddEvent(window, 'load', window.onload);
    }
    xoopsAddEvent(window, 'load', func);
}

function xoopsAddEvent(obj, evType, fn) {
    if (obj.addEventListener) {
        obj.addEventListener(evType, fn, true);
        return true;
    } else {
        if (obj.attachEvent) {
            var r = obj.attachEvent("on" + evType, fn);
            return r;
        } else {
            return false;
        }
    }
}

xoopsOnloadEvent(xoopsExternalLinks);