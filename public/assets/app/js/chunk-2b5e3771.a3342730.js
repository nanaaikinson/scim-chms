(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2b5e3771"],{"07ac":function(t,e,r){var n=r("23e7"),o=r("6f53").values;n({target:"Object",stat:!0},{values:function(t){return o(t)}})},"1da1":function(t,e,r){"use strict";r.d(e,"a",(function(){return o}));r("d3b7");function n(t,e,r,n,o,a,i){try{var s=t[a](i),c=s.value}catch(u){return void r(u)}s.done?e(c):Promise.resolve(c).then(n,o)}function o(t){return function(){var e=this,r=arguments;return new Promise((function(o,a){var i=t.apply(e,r);function s(t){n(i,o,a,s,c,"next",t)}function c(t){n(i,o,a,s,c,"throw",t)}s(void 0)}))}}},"3ed8":function(t,e,r){"use strict";var n=r("451b");e["a"]={all:function(){return n["a"].get("/staff/people")},members:function(){return n["a"].get("/staff/people/members")},store:function(t){return n["a"].post("/staff/people",t)},show:function(t){return n["a"].get("/staff/people/"+t)},update:function(t,e){return n["a"].post("/staff/people/"+e,t)},delete:function(t){return n["a"]["delete"]("/staff/people/"+t)},person:{details:function(t){return n["a"].get("/staff/people/"+t+"/details")},attendance:function(t,e){return n["a"].get("/staff/people/"+t+"/attendance",e)},followUp:function(t,e){return n["a"].get("/staff/people/"+t+"/follow-ups",e)},contributions:function(t,e){return n["a"].get("/staff/people/"+t+"/contributions",e)}}}},"404c":function(t,e,r){"use strict";t.exports=r("6361")},"6f53":function(t,e,r){var n=r("83ab"),o=r("df75"),a=r("fc6a"),i=r("d1e7").f,s=function(t){return function(e){var r,s=a(e),c=o(s),u=c.length,l=0,f=[];while(u>l)r=c[l++],n&&!i.call(s,r)||f.push(t?[r,s[r]]:s[r]);return f}};t.exports={entries:s(!0),values:s(!1)}},"96cf":function(t,e,r){var n=function(t){"use strict";var e,r=Object.prototype,n=r.hasOwnProperty,o="function"===typeof Symbol?Symbol:{},a=o.iterator||"@@iterator",i=o.asyncIterator||"@@asyncIterator",s=o.toStringTag||"@@toStringTag";function c(t,e,r,n){var o=e&&e.prototype instanceof m?e:m,a=Object.create(o.prototype),i=new j(n||[]);return a._invoke=C(t,r,i),a}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(n){return{type:"throw",arg:n}}}t.wrap=c;var l="suspendedStart",f="suspendedYield",p="executing",d="completed",h={};function m(){}function v(){}function y(){}var g={};g[a]=function(){return this};var b=Object.getPrototypeOf,w=b&&b(b(R([])));w&&w!==r&&n.call(w,a)&&(g=w);var x=y.prototype=m.prototype=Object.create(g);function _(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function L(t,e){function r(o,a,i,s){var c=u(t[o],t,a);if("throw"!==c.type){var l=c.arg,f=l.value;return f&&"object"===typeof f&&n.call(f,"__await")?e.resolve(f.__await).then((function(t){r("next",t,i,s)}),(function(t){r("throw",t,i,s)})):e.resolve(f).then((function(t){l.value=t,i(l)}),(function(t){return r("throw",t,i,s)}))}s(c.arg)}var o;function a(t,n){function a(){return new e((function(e,o){r(t,n,e,o)}))}return o=o?o.then(a,a):a()}this._invoke=a}function C(t,e,r){var n=l;return function(o,a){if(n===p)throw new Error("Generator is already running");if(n===d){if("throw"===o)throw a;return S()}r.method=o,r.arg=a;while(1){var i=r.delegate;if(i){var s=E(i,r);if(s){if(s===h)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===l)throw n=d,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=p;var c=u(t,e,r);if("normal"===c.type){if(n=r.done?d:f,c.arg===h)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n=d,r.method="throw",r.arg=c.arg)}}}function E(t,r){var n=t.iterator[r.method];if(n===e){if(r.delegate=null,"throw"===r.method){if(t.iterator["return"]&&(r.method="return",r.arg=e,E(t,r),"throw"===r.method))return h;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return h}var o=u(n,t.iterator,r.arg);if("throw"===o.type)return r.method="throw",r.arg=o.arg,r.delegate=null,h;var a=o.arg;return a?a.done?(r[t.resultName]=a.value,r.next=t.nextLoc,"return"!==r.method&&(r.method="next",r.arg=e),r.delegate=null,h):a:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,h)}function k(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function j(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(k,this),this.reset(!0)}function R(t){if(t){var r=t[a];if(r)return r.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var o=-1,i=function r(){while(++o<t.length)if(n.call(t,o))return r.value=t[o],r.done=!1,r;return r.value=e,r.done=!0,r};return i.next=i}}return{next:S}}function S(){return{value:e,done:!0}}return v.prototype=x.constructor=y,y.constructor=v,y[s]=v.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,y):(t.__proto__=y,s in t||(t[s]="GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},_(L.prototype),L.prototype[i]=function(){return this},t.AsyncIterator=L,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new L(c(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},_(x),x[s]="Generator",x[a]=function(){return this},x.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){while(e.length){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=R,j.prototype={constructor:j,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(O),!t)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var r=this;function o(n,o){return s.type="throw",s.arg=t,r.next=n,o&&(r.method="next",r.arg=e),!!o}for(var a=this.tryEntries.length-1;a>=0;--a){var i=this.tryEntries[a],s=i.completion;if("root"===i.tryLoc)return o("end");if(i.tryLoc<=this.prev){var c=n.call(i,"catchLoc"),u=n.call(i,"finallyLoc");if(c&&u){if(this.prev<i.catchLoc)return o(i.catchLoc,!0);if(this.prev<i.finallyLoc)return o(i.finallyLoc)}else if(c){if(this.prev<i.catchLoc)return o(i.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return o(i.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var o=this.tryEntries[r];if(o.tryLoc<=this.prev&&n.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,h):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),h},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),O(r),h}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;O(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,r,n){return this.delegate={iterator:R(t),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=e),h}},t}(t.exports);try{regeneratorRuntime=n}catch(o){Function("r","regeneratorRuntime = r")(n)}},a503:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"card min-height-500"},[r("div",{staticClass:"card-body"},[r("div",{staticClass:"d-flex"},[r("p",{staticClass:"mb-3"},[t._v("NB: Fields marked * are required")]),r("div",{staticClass:"ml-auto"},[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:t.addMoreRecords}},[t._v(" Add More Records ")])])]),r("div",{ref:"formMsg",staticClass:"form-msg"}),r("form",{on:{submit:function(e){return e.preventDefault(),t.addFamily(e)}}},[r("div",{staticClass:"row mt-4"},[r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"amount"}},[t._v("Name *")]),r("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.name,expression:"name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"name",id:"name",required:""},domProps:{value:t.name},on:{input:function(e){e.target.composing||(t.name=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),t._l(t.families,(function(e,n){return r("div",{key:n,staticClass:"row border ml-2 py-4 px-3 col-md-6 mt-4"},[r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"leader"}},[t._v("Add Member")]),r("Dropdown",{staticClass:"form-control",attrs:{options:t.members,filter:!0,optionValue:"id",optionLabel:"name",placeholder:"Select Member"},model:{value:e.id,callback:function(r){t.$set(e,"id",r)},expression:"family.id"}})],1)]),r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("div",{staticClass:"d-flex"},[r("label",{attrs:{for:"relation"}},[t._v("Relation")]),t.families.length>1&&0!==n?r("button",{directives:[{name:"tooltip",rawName:"v-tooltip.top",value:"Remove",expression:"'Remove'",modifiers:{top:!0}}],staticClass:"btn btn-danger btn-icon-28 ml-auto",staticStyle:{"margin-top":"-8px"},attrs:{type:"button"},on:{click:t.RemoveRecord}},[r("i",{staticClass:"pi pi-trash"})]):t._e()]),r("select",{directives:[{name:"model",rawName:"v-model.trim",value:e.relation,expression:"family.relation",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{name:"relation",id:"relation"},on:{change:function(r){var n=Array.prototype.filter.call(r.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"relation",r.target.multiple?n:n[0])}}},[r("option",{attrs:{value:""}},[t._v(" Select")]),r("option",{attrs:{value:"Head"}},[t._v("Head")]),r("option",{attrs:{value:"Spouse"}},[t._v("Spouse")]),r("option",{attrs:{value:"Children"}},[t._v("Children")]),r("option",{attrs:{value:"Sibling"}},[t._v("Sibling")]),r("option",{attrs:{value:"Grand Parent"}},[t._v("Grand Parent")])])])])])}))],2),r("div",{staticClass:"text-center"},[r("div",{staticClass:"form-group mt-5"},[r("button",{ref:"submitBtn",staticClass:"btn btn-success px-5"},[t._v("Save")])])])])])])])},o=[],a=(r("d81d"),r("b0c0"),r("07ac"),r("96cf"),r("1da1")),i=r("ca16"),s=r("3ed8"),c=r("da63"),u=r("3d20"),l=r.n(u),f=r("404c"),p=r.n(f),d={name:"FamilyAdd",components:{Dropdown:p.a},data:function(){return{name:"",families:[{id:"",relation:""}],members:[]}},methods:{addFamily:function(t){var e=this;return Object(a["a"])(regeneratorRuntime.mark((function t(){var r,n,o,a,s,u,f,p;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=e.$refs.submitBtn,n=e.$refs.formMsg,t.prev=2,Object(i["a"])(r),o={name:e.name,people:e.families},t.next=7,c["a"].store(o);case 7:a=t.sent,s=a.data,Object(i["b"])(r),l.a.fire("Success",s.message,"success"),e.$router.push({name:"family"}),t.next=20;break;case 14:t.prev=14,t.t0=t["catch"](2),u=t.t0.response.data,f="",422===u.code?(Object(i["b"])(r),p=Object.values(u.errors),p.map((function(t){f+='<span class="d-block">'.concat(t,"</span>")}))):f+=u.message,n.innerHTML='<div class="alert alert-danger">'.concat(f,"</div>");case 20:case"end":return t.stop()}}),t,null,[[2,14]])})))()},getMembers:function(){var t=this;return Object(a["a"])(regeneratorRuntime.mark((function e(){var r,n;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,s["a"].members();case 3:r=e.sent,n=r.data,t.members=n.data,e.next=11;break;case 8:e.prev=8,e.t0=e["catch"](0),console.log(e.t0);case 11:case"end":return e.stop()}}),e,null,[[0,8]])})))()},addMoreRecords:function(){this.families.push({id:"",relation:""})},RemoveRecord:function(){this.families.pop()}},created:function(){var t=this;return Object(a["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.getMembers();case 2:case"end":return e.stop()}}),e)})))()}},h=d,m=r("2877"),v=Object(m["a"])(h,n,o,!1,null,null,null);e["default"]=v.exports},da63:function(t,e,r){"use strict";var n=r("451b");e["a"]={all:function(){return n["a"].get("/staff/family")},store:function(t){return n["a"].post("/staff/family",t)},show:function(t){return n["a"].get("/staff/family/"+t)},update:function(t,e){return n["a"].put("/staff/family/"+e,t)},delete:function(t){return n["a"]["delete"]("/staff/family/"+t)}}}}]);
//# sourceMappingURL=chunk-2b5e3771.a3342730.js.map