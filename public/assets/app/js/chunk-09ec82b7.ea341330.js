(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-09ec82b7"],{"07ac":function(t,e,r){var n=r("23e7"),a=r("6f53").values;n({target:"Object",stat:!0},{values:function(t){return a(t)}})},"1da1":function(t,e,r){"use strict";r.d(e,"a",(function(){return a}));r("d3b7");function n(t,e,r,n,a,o,i){try{var s=t[o](i),c=s.value}catch(u){return void r(u)}s.done?e(c):Promise.resolve(c).then(n,a)}function a(t){return function(){var e=this,r=arguments;return new Promise((function(a,o){var i=t.apply(e,r);function s(t){n(i,a,o,s,c,"next",t)}function c(t){n(i,a,o,s,c,"throw",t)}s(void 0)}))}}},"3ed8":function(t,e,r){"use strict";var n=r("451b");e["a"]={all:function(){return n["a"].get("/staff/people")},members:function(){return n["a"].get("/staff/people/members")},store:function(t){return n["a"].post("/staff/people",t)},show:function(t){return n["a"].get("/staff/people/"+t)},update:function(t,e){return n["a"].post("/staff/people/"+e,t)},delete:function(t){return n["a"]["delete"]("/staff/people/"+t)},person:{details:function(t){return n["a"].get("/staff/people/"+t+"/details")},attendance:function(t,e){return n["a"].get("/staff/people/"+t+"/attendance",e)},followUp:function(t,e){return n["a"].get("/staff/people/"+t+"/follow-ups",e)},contributions:function(t,e){return n["a"].get("/staff/people/"+t+"/contributions",e)}}}},"404c":function(t,e,r){"use strict";t.exports=r("6361")},"6f53":function(t,e,r){var n=r("83ab"),a=r("df75"),o=r("fc6a"),i=r("d1e7").f,s=function(t){return function(e){var r,s=o(e),c=a(s),u=c.length,l=0,f=[];while(u>l)r=c[l++],n&&!i.call(s,r)||f.push(t?[r,s[r]]:s[r]);return f}};t.exports={entries:s(!0),values:s(!1)}},"96cf":function(t,e,r){var n=function(t){"use strict";var e,r=Object.prototype,n=r.hasOwnProperty,a="function"===typeof Symbol?Symbol:{},o=a.iterator||"@@iterator",i=a.asyncIterator||"@@asyncIterator",s=a.toStringTag||"@@toStringTag";function c(t,e,r,n){var a=e&&e.prototype instanceof h?e:h,o=Object.create(a.prototype),i=new j(n||[]);return o._invoke=k(t,r,i),o}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(n){return{type:"throw",arg:n}}}t.wrap=c;var l="suspendedStart",f="suspendedYield",p="executing",d="completed",m={};function h(){}function v(){}function y(){}var g={};g[o]=function(){return this};var b=Object.getPrototypeOf,w=b&&b(b(R([])));w&&w!==r&&n.call(w,o)&&(g=w);var x=y.prototype=h.prototype=Object.create(g);function _(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function L(t,e){function r(a,o,i,s){var c=u(t[a],t,o);if("throw"!==c.type){var l=c.arg,f=l.value;return f&&"object"===typeof f&&n.call(f,"__await")?e.resolve(f.__await).then((function(t){r("next",t,i,s)}),(function(t){r("throw",t,i,s)})):e.resolve(f).then((function(t){l.value=t,i(l)}),(function(t){return r("throw",t,i,s)}))}s(c.arg)}var a;function o(t,n){function o(){return new e((function(e,a){r(t,n,e,a)}))}return a=a?a.then(o,o):o()}this._invoke=o}function k(t,e,r){var n=l;return function(a,o){if(n===p)throw new Error("Generator is already running");if(n===d){if("throw"===a)throw o;return S()}r.method=a,r.arg=o;while(1){var i=r.delegate;if(i){var s=C(i,r);if(s){if(s===m)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===l)throw n=d,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=p;var c=u(t,e,r);if("normal"===c.type){if(n=r.done?d:f,c.arg===m)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n=d,r.method="throw",r.arg=c.arg)}}}function C(t,r){var n=t.iterator[r.method];if(n===e){if(r.delegate=null,"throw"===r.method){if(t.iterator["return"]&&(r.method="return",r.arg=e,C(t,r),"throw"===r.method))return m;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return m}var a=u(n,t.iterator,r.arg);if("throw"===a.type)return r.method="throw",r.arg=a.arg,r.delegate=null,m;var o=a.arg;return o?o.done?(r[t.resultName]=o.value,r.next=t.nextLoc,"return"!==r.method&&(r.method="next",r.arg=e),r.delegate=null,m):o:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,m)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function j(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function R(t){if(t){var r=t[o];if(r)return r.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var a=-1,i=function r(){while(++a<t.length)if(n.call(t,a))return r.value=t[a],r.done=!1,r;return r.value=e,r.done=!0,r};return i.next=i}}return{next:S}}function S(){return{value:e,done:!0}}return v.prototype=x.constructor=y,y.constructor=v,y[s]=v.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,y):(t.__proto__=y,s in t||(t[s]="GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},_(L.prototype),L.prototype[i]=function(){return this},t.AsyncIterator=L,t.async=function(e,r,n,a,o){void 0===o&&(o=Promise);var i=new L(c(e,r,n,a),o);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},_(x),x[s]="Generator",x[o]=function(){return this},x.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){while(e.length){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=R,j.prototype={constructor:j,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(O),!t)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var r=this;function a(n,a){return s.type="throw",s.arg=t,r.next=n,a&&(r.method="next",r.arg=e),!!a}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],s=i.completion;if("root"===i.tryLoc)return a("end");if(i.tryLoc<=this.prev){var c=n.call(i,"catchLoc"),u=n.call(i,"finallyLoc");if(c&&u){if(this.prev<i.catchLoc)return a(i.catchLoc,!0);if(this.prev<i.finallyLoc)return a(i.finallyLoc)}else if(c){if(this.prev<i.catchLoc)return a(i.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return a(i.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var a=this.tryEntries[r];if(a.tryLoc<=this.prev&&n.call(a,"finallyLoc")&&this.prev<a.finallyLoc){var o=a;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,m):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),m},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),O(r),m}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var a=n.arg;O(r)}return a}}throw new Error("illegal catch attempt")},delegateYield:function(t,r,n){return this.delegate={iterator:R(t),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=e),m}},t}(t.exports);try{regeneratorRuntime=n}catch(a){Function("r","regeneratorRuntime = r")(n)}},d258:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"card min-height-500"},[r("div",{staticClass:"card-body"},[r("div",{staticClass:"d-flex"},[r("p",{staticClass:"mb-3"},[t._v("NB: Fields marked * are required")]),r("div",{staticClass:"ml-auto"},[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:t.addMoreRecords}},[t._v(" Add More Records ")])])]),r("div",{ref:"formMsg",staticClass:"form-msg"}),r("form",{on:{submit:function(e){return e.preventDefault(),t.updateFamily(e)}}},[r("div",{staticClass:"row mt-4"},[r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"amount"}},[t._v("Name *")]),r("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.name,expression:"name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"name",id:"name",required:""},domProps:{value:t.name},on:{input:function(e){e.target.composing||(t.name=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),t._l(t.families,(function(e,n){return r("div",{key:n,staticClass:"row border ml-2 py-4 px-3 col-md-6 mt-4"},[r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"leader"}},[t._v("Add Member")]),r("Dropdown",{staticClass:"form-control",attrs:{options:t.members,filter:!0,optionValue:"id",optionLabel:"name",placeholder:"Select Member"},model:{value:e.id,callback:function(r){t.$set(e,"id",r)},expression:"family.id"}})],1)]),r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("div",{staticClass:"d-flex"},[r("label",{attrs:{for:"relation"}},[t._v("Relation")]),t.families.length>1&&0!==n?r("button",{directives:[{name:"tooltip",rawName:"v-tooltip.top",value:"Remove",expression:"'Remove'",modifiers:{top:!0}}],staticClass:"btn btn-danger btn-icon-28 ml-auto",staticStyle:{"margin-top":"-8px"},attrs:{type:"button"},on:{click:t.RemoveRecord}},[r("i",{staticClass:"pi pi-trash"})]):t._e()]),r("select",{directives:[{name:"model",rawName:"v-model.trim",value:e.relation,expression:"family.relation",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{name:"relation",id:"relation"},on:{change:function(r){var n=Array.prototype.filter.call(r.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"relation",r.target.multiple?n:n[0])}}},[r("option",{attrs:{value:""}},[t._v(" Select")]),r("option",{attrs:{value:"Head"}},[t._v("Head")]),r("option",{attrs:{value:"Spouse"}},[t._v("Spouse")]),r("option",{attrs:{value:"Children"}},[t._v("Children")]),r("option",{attrs:{value:"Sibling"}},[t._v("Sibling")]),r("option",{attrs:{value:"Grand Parent"}},[t._v("Grand Parent")])])])])])}))],2),r("div",{staticClass:"text-center"},[r("div",{staticClass:"form-group mt-5"},[r("button",{ref:"submitBtn",staticClass:"btn btn-success px-5"},[t._v(" Update ")])])])])])])])},a=[],o=(r("d81d"),r("b0c0"),r("d3b7"),r("07ac"),r("3ca3"),r("ddb0"),r("96cf"),r("1da1")),i=r("ca16"),s=r("3ed8"),c=r("da63"),u=r("3d20"),l=r.n(u),f=r("404c"),p=r.n(f),d={name:"FamilyEdit",components:{Dropdown:p.a},data:function(){return{name:"",families:[{id:"",relation:""}],members:[],mask:""}},methods:{updateFamily:function(t){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){var r,n,a,o,s,u,f,p;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=e.$refs.submitBtn,n=e.$refs.formMsg,t.prev=2,Object(i["a"])(r),a={name:e.name,people:e.families},t.next=7,c["a"].update(a,e.mask);case 7:o=t.sent,s=o.data,Object(i["b"])(r),l.a.fire("Success",s.message,"success"),e.$router.push({name:"family"}),t.next=20;break;case 14:t.prev=14,t.t0=t["catch"](2),u=t.t0.response.data,f="",422===u.code?(Object(i["b"])(r),p=Object.values(u.errors),p.map((function(t){f+='<span class="d-block">'.concat(t,"</span>")}))):f+=u.message,n.innerHTML='<div class="alert alert-danger">'.concat(f,"</div>");case 20:case"end":return t.stop()}}),t,null,[[2,14]])})))()},setData:function(t){var e=t[1].data.data;this.members=t[0].data.data,this.name=e.name,this.families=e.people,this.mask=e.mask},addMoreRecords:function(){this.families.push({id:"",relation:""})},RemoveRecord:function(){this.families.pop()}},beforeRouteEnter:function(t,e,r){return Object(o["a"])(regeneratorRuntime.mark((function e(){var n,a;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,n=t.params.mask,n||r({name:"Home"}),e.next=5,Promise.all([s["a"].members(),c["a"].show(n)]);case 5:a=e.sent,r((function(t){return t.setData(a)})),e.next=12;break;case 9:e.prev=9,e.t0=e["catch"](0),console.log(e.t0);case 12:case"end":return e.stop()}}),e,null,[[0,9]])})))()}},m=d,h=r("2877"),v=Object(h["a"])(m,n,a,!1,null,null,null);e["default"]=v.exports},da63:function(t,e,r){"use strict";var n=r("451b");e["a"]={all:function(){return n["a"].get("/staff/family")},store:function(t){return n["a"].post("/staff/family",t)},show:function(t){return n["a"].get("/staff/family/"+t)},update:function(t,e){return n["a"].put("/staff/family/"+e,t)},delete:function(t){return n["a"]["delete"]("/staff/family/"+t)}}}}]);
//# sourceMappingURL=chunk-09ec82b7.ea341330.js.map