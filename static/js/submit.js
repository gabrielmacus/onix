
/*! atomicjs v3.4.0 | (c) 2017 Chris Ferdinandi | MIT License | https://github.com/cferdinandi/atomic */
!(function(e,t){"function"==typeof define&&define.amd?define([],(function(){return t(e)})):"object"==typeof exports?module.exports=t(e):window.atomic=t(e)})("undefined"!=typeof global?global:"undefined"!=typeof window?window:this,(function(e){"use strict";var t,n={},r=!!e.XMLHttpRequest&&!!e.JSON,o={type:"GET",url:null,data:{},callback:null,headers:{"Content-type":"application/x-www-form-urlencoded"},responseType:"text",withCredentials:!1},a=function(){for(var e={},t=0;t<arguments.length;t++){var n=arguments[t];!(function(t){for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&("[object Object]"===Object.prototype.toString.call(t[n])?e[n]=a(!0,e[n],t[n]):e[n]=t[n])})(n)}return e},s=function(e){var n;if("text"!==t.responseType&&""!==t.responseType)return[e.response,e];try{n=JSON.parse(e.responseText)}catch(t){n=e.responseText}return[n,e]},i=function(e){if("string"==typeof e)return e;if(/application\/json/i.test(t.headers["Content-type"])||"[object Array]"===Object.prototype.toString.call(e))return JSON.stringify(e);var n=[];for(var r in e)e.hasOwnProperty(r)&&n.push(encodeURIComponent(r)+"="+encodeURIComponent(e[r]));return n.join("&")},c=function(){var e={success:function(){},error:function(){},always:function(){}},n=new XMLHttpRequest,r={success:function(t){return e.success=t,r},error:function(t){return e.error=t,r},always:function(t){return e.always=t,r},abort:function(){n.abort()},request:n};n.onreadystatechange=function(){if(4===n.readyState){var t=s(n);n.status>=200&&n.status<300?e.success.apply(e,t):e.error.apply(e,t),e.always.apply(e,t)}},n.open(t.type,t.url,!0),n.responseType=t.responseType;for(var o in t.headers)t.headers.hasOwnProperty(o)&&n.setRequestHeader(o,t.headers[o]);return t.withCredentials&&(n.withCredentials=!0),n.send(i(t.data)),r},u=function(){var n=e.document.getElementsByTagName("script")[0],r=e.document.createElement("script");t.data.callback=t.callback,r.src=t.url+(t.url.indexOf("?")+1?"&":"?")+i(t.data),n.parentNode.insertBefore(r,n),r.onload=function(){this.remove()}};return n.ajax=function(e){if(r)return t=a(o,e||{}),"jsonp"===t.type.toLowerCase()?u():c()},n}));


/**
 * Created by Gabriel on 31/01/2018.
 */

var Submit = function (element) {


    this.method = element.method;
    this.enctype = element.enctype;
    this.action = element.action;

    element.onsubmit=function (event) {

        event.preventDefault();
        return false;
    }

}
