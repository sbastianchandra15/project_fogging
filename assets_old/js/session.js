"use strict";

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Store = function () {
    function Store(storeType) {
        _classCallCheck(this, Store);

        // to ditermin if `localStorage` or `sessionStorage`
        this.storeType = storeType;
        // Shortcut for `length`
        this.l = this.storeType.length;
    }
    // Check if item is set boefore or not


    _createClass(Store, [{
        key: "isSet",
        value: function isSet(id) {
            return this.storeType.getItem(id) !== null;
        }
        // Shortcut for `setItem` function

    }, {
        key: "set",
        value: function set(id, val) {
            // Object to store in this format => {"value": value}
            var obj = {}; // We use Object to keep the value type
            obj.type = typeof val === "undefined" ? "undefined" : _typeof(val);
            if (val instanceof Date) {
                obj.type = "date";
            }

            obj.value = val;
            this.storeType.setItem(id, JSON.stringify(obj));
            this.l = this.storeType.length;
        }
        // Shortcut for `getItem` function

    }, {
        key: "get",
        value: function get(id) {
            if (!this.isSet(id)) return;

            var obj = JSON.parse(this.storeType.getItem(id));
            if (obj.type === "date") return new Date(obj.value);
            return obj.value;
        }
        // Shortcut for `removeItem` function

    }, {
        key: "remove",
        value: function remove(id) {
            this.storeType.removeItem(id);
            this.l = this.storeType.length;
        }
        // Anthoer Shortcut for `removeItem` function
        // this function is equal to remove function

    }, {
        key: "rm",
        value: function rm(id) {
            this.storeType.removeItem(id);
            this.l = this.storeType.length;
        }
        // Shortcut for `clear` function

    }, {
        key: "c",
        value: function c() {
            this.storeType.clear();
            this.l = this.storeType.length;
        }
        // get all items keys

    }, {
        key: "keys",
        value: function keys() {
            return Object.keys(this.storeType);
        }
        // get all items values

    }, {
        key: "values",
        value: function values() {
            var values = [];
            for (var item in this.storeType) {
                values.push(JSON.parse(this.storeType[item]).value);
            }return values;
        }
        // return all stored items in `{"key": key, "value",value}` format for each item

    }, {
        key: "all",
        value: function all() {
            var items = [];
            for (var index in Object.keys(this.storeType)) {
                var item = {};
                item.key = Object.keys(this.storeType)[index];
                item.value = this.get(item.key);
                items.push(item);
            }
            return items;
        }
    }]);

    return Store;
}();

var ls = new Store(localStorage);
var ses = new Store(sessionStorage);

/*
    == (To Do) ==
    - When rm, remove works fine, return true else if item not found return undefined
    - store -> `RegExp`, `Error` objects  NOT IMPORTANT

*/
