var ajaxGet = new AjaxGETResponse;
var selectDepartament = document.getElementById("selectDepartament");
var selectPaginationSize = document.getElementById("selectPaginationSize");
var staffContent = document.getElementById("staffContent");

selectDepartament.oninput = getStaffList;
selectPaginationSize.oninput = getStaffList;

var theUrl = "/ajaxDepartament/getAllElement";
var theParam = JSON.stringify({departament: 0});
ajaxGet.setAjaxQuery(theUrl, theParam, setSelectDepartament, "POST", "text");


function setSelectDepartament(responseXMLDocument) {
    // alert(responseXMLDocument);
    var response = JSON.parse(responseXMLDocument);
    if (response && response.status == "ok" && response.departament && response.departament.length) {
        for (var i = 0; i < response.departament.length; i++) {
            var option = document.createElement('option');
            option.value = response.departament[ i ].id_d;
            option.textContent = response.departament[ i ].title;
            selectDepartament.appendChild(option);
        }
        selectDepartament.value = idDepartament;
    }
    getStaffList();
}

function getStaffList(  ) {
    var size = selectPaginationSize.value;
    var dep = selectDepartament.value;
    var theUrl = "/ajaxStaff/getElement";
    var theParam = JSON.stringify({'departament': dep, 'size': size, 'page': page});
    ajaxGet.setAjaxQuery(theUrl, theParam, viewStaffList, "POST", "text");

}
function viewStaffList(responseXMLDocument) {
    // alert(responseXMLDocument);
    staffContent.innerHTML = "";
    var response = JSON.parse(responseXMLDocument);
    if (response && response.status == "ok") {
        page = response.page || 1;
        if (response.pager && response.pager.length) {
            viewPager(response.pager, staffContent, page, nextPage);
        }
        var tableHead = { 'name':'имя' , 'surname': 'фамилия', 'birchday': 'дата рождения', 'title' : 'отдел' , 'position' : 'должность' , 'rate_type' : 'тип сотрудника', 'salary' : 'оплата' };
        viewTableElements(response.arrStaff, staffContent, tableHead, 'id_s', emptyFun);
    }

    function  nextPage(pageData) {
        page = pageData;
        getStaffList(  );
    }
    function emptyFun(){}
    
}


