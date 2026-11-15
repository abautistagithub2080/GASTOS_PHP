//document.oncontextmenu = new Function("return false;");
//document.onkeypress = KeyPressed;
parent.window.history.go(1);
function gEBI(WObj) {
    return document.getElementById(WObj)
}
function SPLdTblMN() {
    var oTblMn = gEBI("TblMn");
    with (oTblMn) {
        style.position = "absolute"; style.top = 0; style.left = 0; style.height = "100%"; style.width = "100%";
    }
    document.body.appendChild(oTblMn);
    var oTD = gEBI("TD1"); var oCell = gEBI("FrmMn");
    with (oCell) {
        style.height = "100%"; style.width = "100%";
    }
    oTD.appendChild(oCell);
}

function SPLdTblX() {
    var oTblMn = gEBI("TblMn");
    with (oTblMn) {
        style.position = "absolute"; style.top = 0; style.left = 0; style.height = "100%"; style.width = "100%";
    }
    document.body.appendChild(oTblMn);
    var oTD = gEBI("TD1"); var oCell = gEBI("iFRM");
    with (oCell) {
        style.height = "100%"; style.width = "100%";
    }
    oTD.appendChild(oCell);
}

function SPLSubX() {
    var oTD = gEBI("TDSubMn"); var oCell = gEBI("iFRMRes");
    with (oCell) {
        style.height = "100%"; style.width = "100%";
    }
    oTD.appendChild(oCell);
}
function FNFrcWrt(WElem, WText, WFocus) {
    if (gEBI(WElem).value == "" || gEBI(WElem).value == "-1") {
        alert(WText); gEBI(WElem).focus(); gEBI(WElem).style.background = "#CCCCCC"; return false;
    }
    return true;
}
function FNMail(WMail) {
    var WCad = gEBI(WMail).value;
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if (filter.test(WCad)) {
        return true;
    }
    else {
        return false;
    }
}
function FNCombo(WCbx, WValor) {
    var nItems = gEBI(WCbx).options.length
    for (var J = 0; J < nItems; J++) {
        if (gEBI(WCbx).options[J].value == WValor) {
            gEBI(WCbx).options[J].selected = true; break;
        }
    }
}
function InOut(tdID, sClass) {
    gEBI(tdID).className = sClass;
}
function FNRuta(WRuta) {
    var aFile = WRuta.split("/"); var Item = aFile.length - 1; WFile = aFile[Item]; var aFile = null;
    return WFile;
}
function FNSnd(WPage) {
    var d = document.forms[0];
    with (d) {
        action = FNRuta(WPage); submit();
    }
    var d = null;
}

function FNSndX(WPage) {
    var d = document.forms[0];
    with (d) {
        action = WPage; submit();
    }
    var d = null;
}

function SPShowPag(sPage) {
    parent.frames[0].location = sPage;
}