// alert('qwewqqqqqqqqqqqqq');
function AjaxGETResponse() {
    var myReq = getXMLHttpRequest();
    var cache = [];
    var functionHandler;
    var typeResponse;
    var me = this;
    if (myReq === false) {
        dispMessageModalWindow("Fatal Error. ошибка создания обьекта XMLHttpRequest", '#D2691E');
        return false;
    } else {
        myReq.upload.onerror = function () {
            dispMessageModalWindow('Произошла ошибка при загрузке данных на сервер!', '#D2691E');
        };
        myReq.timeout = 30000;
        myReq.ontimeout = function () {
            dispMessageModalWindow('Извините, запрос превысил максимальное время', '#D2691E');
        };
    }
    //--------------------------------------------------------------
    this.send = function () {
        sendAjaxQuery();
    };
    this.setAjaxQuery = function (theUrl, theParam, theFunct, theQuerType, theRespType) {
        if (cache.length < 50) {
            cache.push({'url': theUrl, 'param': theParam, 'funct': theFunct, 'typeQuery': theQuerType, 'typeResponse': theRespType});
            sendAjaxQuery();
        }
    };
    //======функция====отпр.===ajax===POST===запроса================
    function sendAjaxQuery() {
        if (!cache || cache.length == 0)
            return false;
        if (myReq) {
            if (myReq.readyState == 4 || myReq.readyState == 0) {
                var cacheEntry = cache.shift();
                var theUrl = cacheEntry.url;
                var theParam = cacheEntry.param;
                var theTypeQuery = cacheEntry.typeQuery;
                functionHandler = cacheEntry.funct;
                typeResponse = cacheEntry.typeResponse;
                if (theTypeQuery == 'GET') {
                    var strQuery = (theParam.length) ? theUrl + "?" + theParam : theUrl;
                    myReq.open("GET", strQuery, true);
                    myReq.onreadystatechange = getAjaxResponse;
                    myReq.send();
                } else if (theTypeQuery == 'POST') {
                    myReq.open("POST", theUrl, true);
                    myReq.onreadystatechange = getAjaxResponse;
                    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    myReq.send(theParam);
                }
            } else {
                setTimeout(me.send, 1000);
            }
        } else {
            dispMessageModalWindow("Error - ошибка 2 создания обьекта XMLHttpRequest");
        }
    }
    //-------------------------------------------------------------
    function getAjaxResponse() {
        if (myReq.readyState == 4) {
            if (myReq.status == 200) {
//				alert(myReq.responseText);
                if (typeResponse == 'xml') {
                    var theXMLresponseDoc = myReq.responseXML;
                    if (!myReq.responseXML || !myReq.responseXML.documentElement) {
                        dispMessageModalWindow("Неверная структура документа XML .  " + myReq.responseText);
                    } else {
                        var firstNodeName = theXMLresponseDoc.childNodes[0].tagName;
                        if (firstNodeName == 'response') {
                            functionHandler(myReq.responseXML);
                        } else if (firstNodeName == 'error') {
                            dispMessageModalWindow(theXMLresponseDoc.childNodes[0].textContent, '#FFA500');
                        } else {
                            dispMessageModalWindow(theXMLresponseDoc.childNodes[0].textContent);
                        }
                    }
                } else {
                    functionHandler(myReq.responseText);
                }
            }
        }
    }
    // ===== Ajax ===создание===обьекта====XMLHttpRequest===========
    function getXMLHttpRequest()
    {
        var req;
        if (window.ActiveXObject) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                req = false;
            }
        } else {
            try {
                req = new XMLHttpRequest();
            } catch (e) {
                req = false;
            }
        }
        return req;
    }
    //----------------------------------------------------------------------------------------------------------------------------------------
    function dispMessageModalWindow(messageData, colorData, domElementData) {
        var div = document.createElement('div');
        var color = colorData || '#7A96A1';
        var domElement = domElementData || document.body;
        div.style.cssText = "min-width:600px;max-width: 100%;min-height: 400px;max-height: 100%;cursor:pointer;padding:10px;color:black;font-sixe:1.3rem;text-align:center;font: 1em/2em arial;border: 4px double #1E0D69;position:fixed;z-index: 1000;top:50%;left:50%;transform:translate(-50%, -50%);box-shadow: 6px 6px #14536B;background:" + color + ";";
        domElement.insertBefore(div, domElement.firstChild);
        div.innerHTML = messageData;
        div.onclick = function () {
            domElement.removeChild(div);
        };
        return true;
    }
}
//=========================
//=========================================================================================================
//ф-я вывода строки пейджера.Принимает:
// pagerObject - обьект Pager полеченный из соотв.Экземпляра класса pagerModel
//domElementForviewPager - элемент DOM в конец списка элементов которого рисует строку пейджера
//numPageData - номер текущей страницы
//functionGoNewPage - ф-я кот.вызывается по клику на пейджере и куда передается номер выбранной страницы.
function viewPager(pagerObject, domElementForviewPager, numPageData, functionGoNewPage) {
    var p = document.createElement('p');
    p.className = "stringPagePointer";
    domElementForviewPager.appendChild(p);
    for (var i = 0; i < pagerObject.length; i++) {
        var span = document.createElement('span');
        if (pagerObject[i] == '-1') {
            span.textContent = '...';
            span.className = "noPagePinter";
        } else {
            span.textContent = pagerObject[i];
            span.setAttribute("page", pagerObject[i]);
            span.onclick = function () {
                functionGoNewPage(this.getAttribute('page'));
            };
            if (pagerObject[i] == numPageData) {
                span.className = "activePagePointer";
            } else {
                span.className = "passivePagePointer";
            }
        }
        p.appendChild(span);
    }
}
//----------------------------------------------------------------	
//ф-я вывода таблицы элементов.Принимаает
//arrElementData - массив обьектов для вывода,
//domElementForInputTable - DOM  элемент для вставки таблицы
//arrTitleForTableData - ассоциативный массив управления выводом( какие поля обьекта выводим в таблице) [ поля обьекта : заголовок соотв.столбца]
//idTitleData - имя ключевого поля, значение которого помещаем в атрибут 'idElement' строки tr таблицы
// functOnclickData - ф-я которая вызывается по onclick на строке таблицы
function viewTableElements(arrElementData, domElementForInputTable, arrTitleForTableData, idTitleData, functOnclickData) {
    var table = document.createElement('table');
    table.className = "resultTable";
    domElementForInputTable.appendChild(table);
    var tr = document.createElement('tr');
    table.appendChild(tr);
    for ( var item in  arrTitleForTableData) {
        var th = document.createElement('th');
        th.textContent = arrTitleForTableData[item];
        tr.appendChild(th);
    }
    for (var i = 0; i < arrElementData.length; i++) {
        var tr = document.createElement('tr');
        tr.setAttribute('idElement', arrElementData[i][idTitleData]);
        tr.onclick = functOnclickData.bind(tr, [arrElementData[i][idTitleData]]);
        table.appendChild(tr);
        for ( var item in  arrTitleForTableData) {
            var td = document.createElement('td');
            td.textContent = arrElementData[i][item];
            tr.appendChild(td);
        }
    }
}

