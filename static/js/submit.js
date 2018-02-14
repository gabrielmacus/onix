//https://github.com/defunctzombie/form-serialize
var k_r_submitter=/^(?:submit|button|image|reset|file)$/i,k_r_success_contrls=/^(?:input|select|textarea|keygen)/i,brackets=/(\[[^\[\]]*\])/g;function serialize(e,s){"object"!=typeof s?s={hash:!!s}:void 0===s.hash&&(s.hash=!0);for(var a=s.hash?{}:"",r=s.serializer||(s.hash?hash_serializer:str_serialize),t=e&&e.elements?e.elements:[],i=Object.create(null),n=0;n<t.length;++n){var h=t[n];if((s.disabled||!h.disabled)&&h.name&&(k_r_success_contrls.test(h.nodeName)&&!k_r_submitter.test(h.type))){var l=h.name,c=h.value;if("checkbox"!==h.type&&"radio"!==h.type||h.checked||(c=void 0),s.empty){if("checkbox"!==h.type||h.checked||(c=""),"radio"===h.type&&(i[h.name]||h.checked?h.checked&&(i[h.name]=!0):i[h.name]=!1),void 0==c&&"radio"==h.type)continue}else if(!c)continue;if("select-multiple"!==h.type)a=r(a,l,c);else{c=[];for(var u=h.options,o=!1,p=0;p<u.length;++p){var _=u[p],f=s.empty&&!_.value,m=_.value||f;_.selected&&m&&(o=!0,a=s.hash&&"[]"!==l.slice(l.length-2)?r(a,l+"[]",_.value):r(a,l,_.value))}!o&&s.empty&&(a=r(a,l,""))}}}if(s.empty)for(var l in i)i[l]||(a=r(a,l,""));return a}function parse_keys(e){var s=[],a=new RegExp(brackets),r=/^([^\[\]]*)/.exec(e);for(r[1]&&s.push(r[1]);null!==(r=a.exec(e));)s.push(r[1]);return s}function hash_assign(e,s,a){if(0===s.length)return e=a;var r=s.shift(),t=r.match(/^\[(.+?)\]$/);if("[]"===r)return e=e||[],Array.isArray(e)?e.push(hash_assign(null,s,a)):(e._values=e._values||[],e._values.push(hash_assign(null,s,a))),e;if(t){var i=t[1],n=+i;isNaN(n)?(e=e||{})[i]=hash_assign(e[i],s,a):(e=e||[])[n]=hash_assign(e[n],s,a)}else e[r]=hash_assign(e[r],s,a);return e}function hash_serializer(e,s,a){if(s.match(brackets)){hash_assign(e,parse_keys(s),a)}else{var r=e[s];r?(Array.isArray(r)||(e[s]=[r]),e[s].push(a)):e[s]=a}return e}function str_serialize(e,s,a){return a=a.replace(/(\r)?\n/g,"\r\n"),a=(a=encodeURIComponent(a)).replace(/%20/g,"+"),e+(e?"&":"")+encodeURIComponent(s)+"="+a} ;

/*! atomicjs v3.4.0 | (c) 2017 Chris Ferdinandi | MIT License | https://github.com/cferdinandi/atomic */
!(function(e,t){"function"==typeof define&&define.amd?define([],(function(){return t(e)})):"object"==typeof exports?module.exports=t(e):window.atomic=t(e)})("undefined"!=typeof global?global:"undefined"!=typeof window?window:this,(function(e){"use strict";var t,n={},r=!!e.XMLHttpRequest&&!!e.JSON,o={type:"GET",url:null,data:{},callback:null,headers:{"Content-type":"application/x-www-form-urlencoded"},responseType:"text",withCredentials:!1},a=function(){for(var e={},t=0;t<arguments.length;t++){var n=arguments[t];!(function(t){for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&("[object Object]"===Object.prototype.toString.call(t[n])?e[n]=a(!0,e[n],t[n]):e[n]=t[n])})(n)}return e},s=function(e){var n;if("text"!==t.responseType&&""!==t.responseType)return[e.response,e];try{n=JSON.parse(e.responseText)}catch(t){n=e.responseText}return[n,e]},i=function(e){if("string"==typeof e)return e;if(/application\/json/i.test(t.headers["Content-type"])||"[object Array]"===Object.prototype.toString.call(e))return JSON.stringify(e);var n=[];for(var r in e)e.hasOwnProperty(r)&&n.push(encodeURIComponent(r)+"="+encodeURIComponent(e[r]));return n.join("&")},c=function(){var e={success:function(){},error:function(){},always:function(){}},n=new XMLHttpRequest,r={success:function(t){return e.success=t,r},error:function(t){return e.error=t,r},always:function(t){return e.always=t,r},abort:function(){n.abort()},request:n};n.onreadystatechange=function(){if(4===n.readyState){var t=s(n);n.status>=200&&n.status<300?e.success.apply(e,t):e.error.apply(e,t),e.always.apply(e,t)}},n.open(t.type,t.url,!0),n.responseType=t.responseType;for(var o in t.headers)t.headers.hasOwnProperty(o)&&n.setRequestHeader(o,t.headers[o]);return t.withCredentials&&(n.withCredentials=!0),n.send(i(t.data)),r},u=function(){var n=e.document.getElementsByTagName("script")[0],r=e.document.createElement("script");t.data.callback=t.callback,r.src=t.url+(t.url.indexOf("?")+1?"&":"?")+i(t.data),n.parentNode.insertBefore(r,n),r.onload=function(){this.remove()}};return n.ajax=function(e){if(r)return t=a(o,e||{}),"jsonp"===t.type.toLowerCase()?u():c()},n}));


/**
 * Created by Gabriel on 31/01/2018.
 */
/**
 * Process submit event on forms
 * @param id string Form element id
 * @param successCallback function
 * @param errorCallback function
 * @constructor
 */
var FormElement=function (id,successCallback,errorCallback,vueData) {

    vueData = (!vueData)?{}:vueData;

    vueData.errors={};
    vueData.model = {};

    this.element = document.querySelector("#"+id);

    var vue = new Vue({
        el: "#"+id,
        data: vueData,
        methods:{
            cleanErrors:function (err) {

                Vue.delete(this.errors,err);
            }
        }
    })


    document.querySelector("#"+id).onsubmit = function (event) {

            event.preventDefault();

                 Vue.set(vue,"errors",{});

            var method = event.srcElement.method;
            var enc  = event.srcElement.enctype;
            //var data = serialize(event.srcElement,{hash:true,empty:true});
            var data = JSON.parse(JSON.stringify(vue.model));



            var action  = event.srcElement.action;

           event.srcElement.classList.add("submitting");




            switch (enc)
            {
                case "multipart/form-data":

                    /*
                     * var form = document.querySelector('form');
                     var data = new FormData(form);
                     var req = new XMLHttpRequest();
                     req.send(data);*/

                    //TODO:set file uploads

                    break;
                default:

                    atomic.ajax({
                        type: method,
                        url:  action,
                        data: data
                    })
                        .success(function (data, xhr) {

                            if(successCallback){
                                return successCallback(data,xhr);
                            }

                            if(data.message)
                            {
                                //TODO: replace the default alert popup with a customized one, or the posibility to print the message into an element that was previously passed as an arg
                                alert(data.message);
                            }



                        })
                        .error(function (error,xhr) {
                            console.log(xhr);
                            // What do when the request fails
                            if(errorCallback)
                            {
                                return errorCallback(error,xhr);
                            }

                            if(error.validation)
                            {

                                for(var k in error.errors)
                                {

                                    Vue.set(vue.errors,k,error.errors[k]);

                                }


                            }
                            else
                            {
                                //TODO: replace the default alert popup with a customized one, or the posibility to print the message into an element that was previously passed as an arg
                                var errorMsg = (typeof error == "object")?error.error:error;
                                alert(errorMsg);
                            }
                        })
                        .always(function (data, xhr) {
                            event.srcElement.classList.remove("submitting");
                        });




                    break;
            }




    };



}

var Utils =
    {

    };