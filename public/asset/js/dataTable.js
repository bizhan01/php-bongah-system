
"use strict";

var MainController = (function () {
    "use strict";

})();

var UiController = (function () {
    "use strict";

    var DOMString = {
        selectTop: 'form input[name=selectTop]',
        selectBottom: 'form input[name=selectBottom]',
        selects: '.selects',
        formSubmit: 'form.actionForm',
        apply_comand_top: 'select[name=apply_comand_top]',
        apply_comand_bottom: 'select[name=apply_comand_bottom]',
        searchSubmit: 'form.search',
        inputSearch: 'form.search input[name=search]',
        tdAction: 'td.tdAction a:nth-child(3)',
        tdTrashAction: 'td.tdTrashAction a:nth-child(3)',

    };

    return {
        getDOMString: function () {
            return DOMString;
        },
        getCheckedField: function () {
            return {
                selectTop: document.querySelector(DOMString.selectTop),
                selectBottom: document.querySelector(DOMString.selectBottom),
                selects: document.querySelectorAll(DOMString.selects),
                apply_comand_top: document.querySelector(DOMString.apply_comand_top),
                apply_comand_bottom: document.querySelector(DOMString.apply_comand_bottom),
                tableSearch: document.querySelector(DOMString.inputSearch),
                formSubmit: document.querySelector(DOMString.formSubmit),
                searchSubmit: document.querySelector(DOMString.searchSubmit),
                tdActions: document.querySelectorAll(DOMString.tdAction),
                tdTrashActions: document.querySelectorAll(DOMString.tdTrashAction),
            }
        },

        confirmDelete: function (e) {

            var confirm = window.confirm("Do you want to permanently delete?");
            if (confirm == false) {
                e.preventDefault();
            }
        },

        confirmTrashDelete: function (e) {

            var confirm = window.confirm("Do you want to Trash?");
            if (confirm == false) {
                e.preventDefault();
            }
        },


        allowFormSubmitted: function (e) {
            var Count = this.countChecked();

            var CheckedItem = Count.checked;
            var Fields = this.getCheckedField();
            var applay_comand_top = Fields.apply_comand_top.value;
            var apply_comand_bottom = Fields.apply_comand_bottom.value;

            if (applay_comand_top > 0 || apply_comand_bottom > 0) {
                if (CheckedItem < 1) {
                    alert("Checked At lest One item");
                    e.preventDefault();
                } else if (applay_comand_top == 2 || apply_comand_bottom == 2) {
                    this.confirmDelete(e);
                } else if(applay_comand_top == 3 || apply_comand_bottom == 3){
                    this.confirmTrashDelete(e);
                }

            } else {
                alert("Please Select Action");
                e.preventDefault();
            }

        },
        allowSearchFormSubmit: function (e) {
            var Fields = this.getCheckedField();
            var input = Fields.tableSearch;

            if (input.value.length < 1) {
                alert("Put at least 3 letters");
                e.preventDefault();
            }

        },

        countChecked: function () {
            var Fields = this.getCheckedField();
            var Selects = Fields.selects;
            var i;
            var checked = 0, notChecked = 0;
            for (i = 0; i < Selects.length; i++) {
                if (Selects[i].checked == true) {
                    checked++;
                } else {
                    notChecked++;
                }
            }
            return {
                checked: checked,
                notChecked: notChecked,
            }
        },

        setTopCheckedOrNot: function () {
            var count = this.countChecked();
            var checked = count.checked;
            var notChecked = count.notChecked;
            if (notChecked == 0) {
                this.putCheckedTopButtom();
            } else {
                this.notCheckedTopButtom();
            }

        },

        putChecked: function () {
            var Fields = this.getCheckedField();
            var Selects = Fields.selects;
            var i;
            for (i = 0; i < Selects.length; i++) {
                Selects[i].checked = true;
            }
        },
        putNotChecked: function () {
            var Fields = this.getCheckedField();
            var Selects = Fields.selects;
            var i;
            for (i = 0; i < Selects.length; i++) {
                Selects[i].checked = false;
            }
        },

        putCheckedTopButtom: function () {
            var Fields = this.getCheckedField();
            var top = Fields.selectTop;
            var buttom = Fields.selectBottom;

            top.checked = true;
            buttom.checked = true;

        },
        notCheckedTopButtom: function () {
            var Fields = this.getCheckedField();
            var top = Fields.selectTop;
            var buttom = Fields.selectBottom;
            top.checked = false;
            buttom.checked = false;
        },

        bothCheckedAndUnchecked: function (mainThis) {
            if (mainThis.checked == true) {
                this.putCheckedTopButtom();
                this.putChecked();
            } else {
                this.notCheckedTopButtom();
                this.putNotChecked();
            }

        },

    };

})();

var BaseController = (function (mainCnt, UICnt) {

    "use strict";

    var SetUpEvenListner = function () {
        var DOMString = UICnt.getDOMString();
        var Fields = UICnt.getCheckedField();

        var selectTop = Fields.selectTop;
        var selectBottom = Fields.selectBottom;
        var formSubmit = Fields.formSubmit;
        var searchSubmit = Fields.searchSubmit;
        var deleteActions = Fields.tdActions;
        var deleteTrashActions = Fields.tdTrashActions;

        if (selectTop != null) {
            selectTop.addEventListener('click', checkedItems);
        }
        if (selectBottom != null) {
            selectBottom.addEventListener('click', checkedItems);
        }

        var Selects = document.querySelectorAll(DOMString.selects);
        for (var i = 0; i < Selects.length; i++) {
            Selects[i].addEventListener('click', checkedSelectItems);
        }

        if (formSubmit != null) {
            formSubmit.addEventListener('submit', fromSubmit);
        }

        if (searchSubmit != null) {
            searchSubmit.addEventListener('submit', tableSubmit);
        }

        if (deleteActions != null) {
            for (var i = 0; i < deleteActions.length; i++) {
                deleteActions[i].addEventListener('click', UICnt.confirmDelete);
            }
        }
        if (deleteTrashActions != null) {
            for (var i = 0; i < deleteTrashActions.length; i++) {
                deleteTrashActions[i].addEventListener('click', UICnt.confirmTrashDelete);
            }
        }


    };

    var checkedItems = function () {
        var mainThis = this;
        UICnt.bothCheckedAndUnchecked(mainThis);
    };

    var checkedSelectItems = function () {
        var mainThis = this;
        UICnt.setTopCheckedOrNot();
    };

    var fromSubmit = function (e) {
        var mianThis = this;
        UICnt.allowFormSubmitted(e);
    };

    var tableSubmit = function (e) {
        UICnt.allowSearchFormSubmit(e);
    };

    return {
        init: function () {

            SetUpEvenListner();
        }
    }

})(MainController, UiController);

