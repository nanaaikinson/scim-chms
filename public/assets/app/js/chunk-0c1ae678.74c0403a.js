(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0c1ae678"],{"07ac":function(t,e,n){var r=n("23e7"),o=n("6f53").values;r({target:"Object",stat:!0},{values:function(t){return o(t)}})},"0952":function(t,e,n){},"1da1":function(t,e,n){"use strict";n.d(e,"a",(function(){return o}));n("d3b7");function r(t,e,n,r,o,i,a){try{var s=t[i](a),c=s.value}catch(u){return void n(u)}s.done?e(c):Promise.resolve(c).then(r,o)}function o(t){return function(){var e=this,n=arguments;return new Promise((function(o,i){var a=t.apply(e,n);function s(t){r(a,o,i,s,c,"next",t)}function c(t){r(a,o,i,s,c,"throw",t)}s(void 0)}))}}},"66a7":function(t,e,n){"use strict";var r=n("451b");e["a"]={all:function(){return r["a"].get("/staff/contributions")},covenant:function(t){return r["a"].post("/staff/contributions/covenant-partner",t)},covedelete:function(t){return r["a"]["delete"]("/staff/contributions/covenant-partner/"+t)},coveshow:function(t){return r["a"].get("/staff/contributions/covenant-partner/"+t)},coveupdate:function(t,e){return r["a"].put("/staff/contributions/covenant-partner/"+e,t)},busing:function(t){return r["a"].post("/staff/contributions/busing",t)},busingshow:function(t){return r["a"].get("/staff/contributions/busing/"+t)},busingupdate:function(t,e){return r["a"].put("/staff/contributions/busing/"+e,t)},busingdelete:function(t){return r["a"]["delete"]("/staff/contributions/busing/"+t)},titheAdd:function(t){return r["a"].post("/staff/contributions/tithes",t)},titheShow:function(t){return r["a"].get("/staff/contributions/tithes/"+t)},titheUpdate:function(t,e){return r["a"].put("/staff/contributions/tithes/"+e,t)},tithedelete:function(t){return r["a"]["delete"]("/staff/contributions/tithes/"+t)},groupAdd:function(t){return r["a"].post("/staff/contributions/groups",t)},groupShow:function(t){return r["a"].get("/staff/contributions/groups/"+t)},groupUpdate:function(t,e){return r["a"].put("/staff/contributions/groups/"+e,t)},groupdelete:function(t){return r["a"]["delete"]("/staff/contributions/groups/"+t)},welfareAdd:function(t){return r["a"].post("/staff/contributions/welfare",t)},welfareShow:function(t){return r["a"].get("/staff/contributions/welfare/"+t)},welfareUpdate:function(t,e){return r["a"].put("/staff/contributions/welfare/"+e,t)},welfaredelete:function(t){return r["a"]["delete"]("/staff/contributions/welfare/"+t)},pledgeAdd:function(t){return r["a"].post("/staff/contributions/pledge",t)},pledgeShow:function(t){return r["a"].get("/staff/contributions/pledge/"+t)},pledgeUpdate:function(t,e){return r["a"].put("/staff/contributions/pledge/"+e,t)},pledgedelete:function(t){return r["a"]["delete"]("/staff/contributions/pledge/"+t)},generalAdd:function(t){return r["a"].post("/staff/contributions/general",t)},generaldelete:function(t){return r["a"]["delete"]("/staff/contributions/general/"+t)},generalShow:function(t){return r["a"].get("/staff/contributions/general/"+t)},generalUpdate:function(t,e){return r["a"].put("/staff/contributions/general/"+e,t)}}},"6f53":function(t,e,n){var r=n("83ab"),o=n("df75"),i=n("fc6a"),a=n("d1e7").f,s=function(t){return function(e){var n,s=i(e),c=o(s),u=c.length,l=0,f=[];while(u>l)n=c[l++],r&&!a.call(s,n)||f.push(t?[n,s[n]]:s[n]);return f}};t.exports={entries:s(!0),values:s(!1)}},"96cf":function(t,e,n){var r=function(t){"use strict";var e,n=Object.prototype,r=n.hasOwnProperty,o="function"===typeof Symbol?Symbol:{},i=o.iterator||"@@iterator",a=o.asyncIterator||"@@asyncIterator",s=o.toStringTag||"@@toStringTag";function c(t,e,n,r){var o=e&&e.prototype instanceof h?e:h,i=Object.create(o.prototype),a=new j(r||[]);return i._invoke=L(t,n,a),i}function u(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(r){return{type:"throw",arg:r}}}t.wrap=c;var l="suspendedStart",f="suspendedYield",d="executing",p="completed",m={};function h(){}function v(){}function g(){}var b={};b[i]=function(){return this};var y=Object.getPrototypeOf,w=y&&y(y(S([])));w&&w!==n&&r.call(w,i)&&(b=w);var x=g.prototype=h.prototype=Object.create(b);function C(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function _(t,e){function n(o,i,a,s){var c=u(t[o],t,i);if("throw"!==c.type){var l=c.arg,f=l.value;return f&&"object"===typeof f&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,a,s)}),(function(t){n("throw",t,a,s)})):e.resolve(f).then((function(t){l.value=t,a(l)}),(function(t){return n("throw",t,a,s)}))}s(c.arg)}var o;function i(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}this._invoke=i}function L(t,e,n){var r=l;return function(o,i){if(r===d)throw new Error("Generator is already running");if(r===p){if("throw"===o)throw i;return N()}n.method=o,n.arg=i;while(1){var a=n.delegate;if(a){var s=k(a,n);if(s){if(s===m)continue;return s}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(r===l)throw r=p,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r=d;var c=u(t,e,n);if("normal"===c.type){if(r=n.done?p:f,c.arg===m)continue;return{value:c.arg,done:n.done}}"throw"===c.type&&(r=p,n.method="throw",n.arg=c.arg)}}}function k(t,n){var r=t.iterator[n.method];if(r===e){if(n.delegate=null,"throw"===n.method){if(t.iterator["return"]&&(n.method="return",n.arg=e,k(t,n),"throw"===n.method))return m;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return m}var o=u(r,t.iterator,n.arg);if("throw"===o.type)return n.method="throw",n.arg=o.arg,n.delegate=null,m;var i=o.arg;return i?i.done?(n[t.resultName]=i.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=e),n.delegate=null,m):i:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,m)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function j(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function S(t){if(t){var n=t[i];if(n)return n.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var o=-1,a=function n(){while(++o<t.length)if(r.call(t,o))return n.value=t[o],n.done=!1,n;return n.value=e,n.done=!0,n};return a.next=a}}return{next:N}}function N(){return{value:e,done:!0}}return v.prototype=x.constructor=g,g.constructor=v,g[s]=v.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,g):(t.__proto__=g,s in t||(t[s]="GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},C(_.prototype),_.prototype[a]=function(){return this},t.AsyncIterator=_,t.async=function(e,n,r,o,i){void 0===i&&(i=Promise);var a=new _(c(e,n,r,o),i);return t.isGeneratorFunction(n)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},C(x),x[s]="Generator",x[i]=function(){return this},x.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var n in t)e.push(n);return e.reverse(),function n(){while(e.length){var r=e.pop();if(r in t)return n.value=r,n.done=!1,n}return n.done=!0,n}},t.values=S,j.prototype={constructor:j,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(O),!t)for(var n in this)"t"===n.charAt(0)&&r.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function o(r,o){return s.type="throw",s.arg=t,n.next=r,o&&(n.method="next",n.arg=e),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var a=this.tryEntries[i],s=a.completion;if("root"===a.tryLoc)return o("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),u=r.call(a,"finallyLoc");if(c&&u){if(this.prev<a.catchLoc)return o(a.catchLoc,!0);if(this.prev<a.finallyLoc)return o(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return o(a.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return o(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,m):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),m},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),O(n),m}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;O(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,r){return this.delegate={iterator:S(t),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=e),m}},t}(t.exports);try{regeneratorRuntime=r}catch(o){Function("r","regeneratorRuntime = r")(r)}},c63e:function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"card min-height-500"},[n("div",{staticClass:"card-body"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-10 offset-md-1"},[n("div",{staticClass:"d-flex"},[n("p",{staticClass:"mb-3"},[t._v("NB: Fields marked * are required")]),n("div",{staticClass:"ml-auto"},[n("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:t.addMoreRecords}},[t._v(" Add More Records ")])])]),n("div",{ref:"formMsg",staticClass:"form-msg"}),n("form",{on:{submit:function(e){return e.preventDefault(),t.addGeneral(e)}}},[n("div",{staticClass:"row mt-3"},t._l(t.contributions,(function(e,r){return n("div",{key:r,staticClass:"col-md-6 mb-4"},[n("div",{staticClass:"row border mr-2 py-4 px-3"},[n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"title"}},[t._v("Title *")]),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.name,expression:"contribution.name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"title-"+r,id:"title-"+r,required:""},domProps:{value:e.name},on:{input:function(n){n.target.composing||t.$set(e,"name",n.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("div",{staticClass:"d-flex"},[n("label",{attrs:{for:"amount"}},[t._v("Amount *")]),t.contributions.length>1&&0!==r?n("button",{directives:[{name:"tooltip",rawName:"v-tooltip.top",value:"Remove",expression:"'Remove'",modifiers:{top:!0}}],staticClass:"btn btn-danger btn-icon-28 ml-auto",staticStyle:{"margin-top":"-8px"},attrs:{type:"button"},on:{click:t.RemoveRecord}},[n("i",{staticClass:"pi pi-trash"})]):t._e()]),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.amount,expression:"contribution.amount",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"number",name:"amount-"+r,min:"0",id:"amount-"+r,required:""},domProps:{value:e.amount},on:{input:function(n){n.target.composing||t.$set(e,"amount",n.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"date"}},[t._v("Date *")]),n("flat-pickr",{staticClass:"form-control bg-white",attrs:{placeholder:"Select Date",name:"date-"+r,id:"date-"+r},model:{value:e.date,callback:function(n){t.$set(e,"date",n)},expression:"contribution.date"}})],1)]),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"method"}},[t._v("Method of payment *")]),n("select",{directives:[{name:"model",rawName:"v-model.number",value:e.method,expression:"contribution.method",modifiers:{number:!0}}],staticClass:"custom-select",attrs:{name:"method",id:"method"},on:{change:function(n){var r=Array.prototype.filter.call(n.target.options,(function(t){return t.selected})).map((function(e){var n="_value"in e?e._value:e.value;return t._n(n)}));t.$set(e,"method",n.target.multiple?r:r[0])}}},t._l(t.methods,(function(e,r){return n("option",{key:r,domProps:{value:e.id}},[t._v(t._s(e.name))])})),0)])]),n("div",{staticClass:"col-md-12"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"comment"}},[t._v("Comment")]),n("input",{directives:[{name:"model",rawName:"v-model",value:e.comment,expression:"contribution.comment"}],staticClass:"form-control",attrs:{type:"text",name:"comment-"+r,id:"comment-"+r},domProps:{value:e.comment},on:{input:function(n){n.target.composing||t.$set(e,"comment",n.target.value)}}})])])])])})),0),n("div",{staticClass:"text-center"},[n("div",{staticClass:"form-group mt-5"},[n("button",{ref:"submitBtn",staticClass:"btn btn-success px-5"},[t._v(" Save ")])])])])])])])])])},o=[],i=(n("4160"),n("d81d"),n("b0c0"),n("07ac"),n("159b"),n("96cf"),n("1da1")),a=n("ca16"),s=n("66a7"),c=n("3d20"),u=n.n(c),l=n("c38f"),f=n.n(l),d=(n("0952"),{name:"General",components:{flatPickr:f.a},data:function(){return{contributions:[{amount:0,comment:"",name:"",date:"",method:1}],methods:[{name:"Cash",id:1},{name:"Cheque",id:2},{name:"Online",id:3},{name:"Mobile Money",id:4}]}},methods:{addGeneral:function(t){var e=this;return Object(i["a"])(regeneratorRuntime.mark((function t(){var n,r,o,i,c,l,f,d,p;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(n=e.$refs.submitBtn,r=e.$refs.formMsg,t.prev=2,o=[],e.contributions.forEach((function(t){t.date||o.push("error"),t.name||o.push("error"),t.method||o.push("error")})),!o.length){t.next=8;break}return u.a.fire("","All fields marked * are required","info"),t.abrupt("return");case 8:return Object(a["a"])(n),i={contributions:e.contributions},t.next=12,s["a"].generalAdd(i);case 12:c=t.sent,l=c.data,Object(a["b"])(n),u.a.fire("Success",l.message,"success"),e.$router.push({name:"Contributions"}),t.next=25;break;case 19:t.prev=19,t.t0=t["catch"](2),f=t.t0.response.data,d="",422===f.code?(Object(a["b"])(n),p=Object.values(f.errors),p.map((function(t){d+='<span class="d-block">'.concat(t,"</span>")}))):d+=f.message,r.innerHTML='<div class="alert alert-danger">'.concat(d,"</div>");case 25:case"end":return t.stop()}}),t,null,[[2,19]])})))()},addMoreRecords:function(){this.contributions.push({amount:0,comment:"",name:"",date:"",method:1})},RemoveRecord:function(){this.contributions.pop()}}}),p=d,m=n("2877"),h=Object(m["a"])(p,r,o,!1,null,null,null);e["default"]=h.exports},d81d:function(t,e,n){"use strict";var r=n("23e7"),o=n("b727").map,i=n("1dde"),a=n("ae40"),s=i("map"),c=a("map");r({target:"Array",proto:!0,forced:!s||!c},{map:function(t){return o(this,t,arguments.length>1?arguments[1]:void 0)}})}}]);
//# sourceMappingURL=chunk-0c1ae678.74c0403a.js.map