(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-442f92d5"],{"07ac":function(t,e,n){var r=n("23e7"),o=n("6f53").values;r({target:"Object",stat:!0},{values:function(t){return o(t)}})},"0952":function(t,e,n){},"1da1":function(t,e,n){"use strict";n.d(e,"a",(function(){return o}));n("d3b7");function r(t,e,n,r,o,a,i){try{var s=t[a](i),u=s.value}catch(c){return void n(c)}s.done?e(u):Promise.resolve(u).then(r,o)}function o(t){return function(){var e=this,n=arguments;return new Promise((function(o,a){var i=t.apply(e,n);function s(t){r(i,o,a,s,u,"next",t)}function u(t){r(i,o,a,s,u,"throw",t)}s(void 0)}))}}},"3ed8":function(t,e,n){"use strict";var r=n("451b");e["a"]={all:function(){return r["b"].get(r["a"]+"staff/people")},members:function(){return r["b"].get(r["a"]+"staff/people/members")},store:function(t){return r["b"].post(r["a"]+"staff/people",t)},show:function(t){return r["b"].get(r["a"]+"staff/people/"+t)},update:function(t,e){return r["b"].post(r["a"]+"staff/people/"+e,t)},delete:function(t){return r["b"]["delete"](r["a"]+"staff/people/"+t)},person:{details:function(t){return r["b"].get(r["a"]+"staff/people/"+t+r["a"]+"details")},attendance:function(t,e){return r["b"].get(r["a"]+"staff/people/"+t+r["a"]+"attendance",e)},followUp:function(t,e){return r["b"].get(r["a"]+"staff/people/"+t+r["a"]+"follow-ups",e)},contributions:function(t,e){return r["b"].get(r["a"]+"staff/people/"+t+r["a"]+"contributions",e)}}}},"404c":function(t,e,n){"use strict";t.exports=n("6361")},"5c81":function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"card min-height-500"},[n("div",{staticClass:"card-body"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-8 offset-md-2"},[n("p",{staticClass:"mb-3"},[t._v("NB: Fields marked * are required")]),n("div",{ref:"formMsg",staticClass:"form-msg"}),n("form",{staticClass:"mt-4",on:{submit:function(e){return e.preventDefault(),t.updateCovenant(e)}}},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"amount"}},[t._v("Amount *")]),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.amount,expression:"amount",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"number",name:"amount",min:"0",id:"amount",required:""},domProps:{value:t.amount},on:{input:function(e){e.target.composing||(t.amount=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"date"}},[t._v("Date *")]),n("flat-pickr",{staticClass:"form-control bg-white",attrs:{placeholder:"Select Date",name:"date",id:"date",required:""},model:{value:t.date,callback:function(e){t.date=e},expression:"date"}})],1)]),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"person"}},[t._v("Person *")]),n("Dropdown",{staticClass:"form-control",attrs:{options:t.members,filter:!0,optionLabel:"name",optionValue:"id",placeholder:"Select Person"},model:{value:t.member,callback:function(e){t.member=e},expression:"member"}})],1)]),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"method"}},[t._v("Method of payment *")]),n("select",{directives:[{name:"model",rawName:"v-model.number",value:t.method,expression:"method",modifiers:{number:!0}}],staticClass:"custom-select",attrs:{name:"method",id:"method"},on:{change:function(e){var n=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(e){var n="_value"in e?e._value:e.value;return t._n(n)}));t.method=e.target.multiple?n:n[0]}}},t._l(t.methods,(function(e,r){return n("option",{key:r,domProps:{value:e.id}},[t._v(t._s(e.name))])})),0)])]),n("div",{staticClass:"col-md-12"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"comment"}},[t._v("Comment *")]),n("textarea",{directives:[{name:"model",rawName:"v-model",value:t.comment,expression:"comment"}],staticClass:"form-control",attrs:{name:"comment",id:"comment",cols:"30",rows:"5",required:""},domProps:{value:t.comment},on:{input:function(e){e.target.composing||(t.comment=e.target.value)}}})])])]),n("div",{staticClass:"text-center"},[n("div",{staticClass:"form-group mt-5"},[n("button",{ref:"submitBtn",staticClass:"btn btn-success px-5"},[t._v("Update")])])])])])])])])])},o=[],a=(n("d81d"),n("d3b7"),n("07ac"),n("3ca3"),n("ddb0"),n("96cf"),n("1da1")),i=n("ca16"),s=n("3ed8"),u=n("66a7"),c=n("3d20"),f=n.n(c),l=n("404c"),d=n.n(l),p=n("c38f"),m=n.n(p),h=(n("0952"),{name:"CovenantEdit",components:{Dropdown:d.a,flatPickr:m.a},data:function(){return{amount:"",comment:"",date:"",member:"",members:[],mask:"",method:"",methods:[{name:"Cash",id:1},{name:"Cheque",id:2},{name:"Online",id:3},{name:"Mobile Money",id:4}]}},methods:{updateCovenant:function(t){var e=this;return Object(a["a"])(regeneratorRuntime.mark((function t(){var n,r,o,a,s,c,l,d;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return n=e.$refs.submitBtn,r=e.$refs.formMsg,t.prev=2,Object(i["a"])(n),o={amount:e.amount,comment:e.comment,date:e.date,person:e.member,method:e.method},t.next=7,u["a"].coveupdate(o,e.mask);case 7:a=t.sent,s=a.data,Object(i["b"])(n),f.a.fire("Success",s.message,"success"),e.$router.push({name:"Contributions"}),t.next=20;break;case 14:t.prev=14,t.t0=t["catch"](2),c=t.t0.response.data,l="",422===c.code?(Object(i["b"])(n),d=Object.values(c.errors),d.map((function(t){l+='<span class="d-block">'.concat(t,"</span>")}))):l+=c.message,r.innerHTML='<div class="alert alert-danger">'.concat(l,"</div>");case 20:case"end":return t.stop()}}),t,null,[[2,14]])})))()},setData:function(t){var e=t[1].data.data;this.members=t[0].data.data,this.amount=e.amount,this.member=e.person.id,this.date=e.date,this.comment=e.comment,this.mask=e.mask,this.method=e.method}},beforeRouteEnter:function(t,e,n){return Object(a["a"])(regeneratorRuntime.mark((function e(){var r,o;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,r=t.params.mask,r||n({name:"Home"}),e.next=5,Promise.all([s["a"].members(),u["a"].coveshow(r)]);case 5:o=e.sent,n((function(t){return t.setData(o)})),e.next=12;break;case 9:e.prev=9,e.t0=e["catch"](0),console.log(e.t0);case 12:case"end":return e.stop()}}),e,null,[[0,9]])})))()}}),v=h,b=n("2877"),g=Object(b["a"])(v,r,o,!1,null,null,null);e["default"]=g.exports},"66a7":function(t,e,n){"use strict";var r=n("451b");e["a"]={all:function(){return r["b"].get(r["a"]+"staff/contributions")},covenant:function(t){return r["b"].post(r["a"]+"staff/contributions/covenant-partner",t)},covedelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/covenant-partner/"+t)},coveshow:function(t){return r["b"].get(r["a"]+"staff/contributions/covenant-partner/"+t)},coveupdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/covenant-partner/"+e,t)},busing:function(t){return r["b"].post(r["a"]+"staff/contributions/busing",t)},busingshow:function(t){return r["b"].get(r["a"]+"staff/contributions/busing/"+t)},busingupdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/busing/"+e,t)},busingdelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/busing/"+t)},titheAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/tithes",t)},titheShow:function(t){return r["b"].get(r["a"]+"staff/contributions/tithes/"+t)},titheUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/tithes/"+e,t)},tithedelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/tithes/"+t)},groupAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/groups",t)},groupShow:function(t){return r["b"].get(r["a"]+"staff/contributions/groups/"+t)},groupUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/groups/"+e,t)},groupdelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/groups/"+t)},welfareAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/welfare",t)},welfareShow:function(t){return r["b"].get(r["a"]+"staff/contributions/welfare/"+t)},welfareUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/welfare/"+e,t)},welfaredelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/welfare/"+t)},pledgeAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/pledge",t)},pledgeShow:function(t){return r["b"].get(r["a"]+"staff/contributions/pledge/"+t)},pledgeUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/pledge/"+e,t)},pledgedelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/pledge/"+t)},generalAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/general",t)},generaldelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/general/"+t)},generalShow:function(t){return r["b"].get(r["a"]+"staff/contributions/general/"+t)},generalUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/general/"+e,t)}}},"6f53":function(t,e,n){var r=n("83ab"),o=n("df75"),a=n("fc6a"),i=n("d1e7").f,s=function(t){return function(e){var n,s=a(e),u=o(s),c=u.length,f=0,l=[];while(c>f)n=u[f++],r&&!i.call(s,n)||l.push(t?[n,s[n]]:s[n]);return l}};t.exports={entries:s(!0),values:s(!1)}},"96cf":function(t,e,n){var r=function(t){"use strict";var e,n=Object.prototype,r=n.hasOwnProperty,o="function"===typeof Symbol?Symbol:{},a=o.iterator||"@@iterator",i=o.asyncIterator||"@@asyncIterator",s=o.toStringTag||"@@toStringTag";function u(t,e,n,r){var o=e&&e.prototype instanceof h?e:h,a=Object.create(o.prototype),i=new j(r||[]);return a._invoke=_(t,n,i),a}function c(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(r){return{type:"throw",arg:r}}}t.wrap=u;var f="suspendedStart",l="suspendedYield",d="executing",p="completed",m={};function h(){}function v(){}function b(){}var g={};g[a]=function(){return this};var w=Object.getPrototypeOf,y=w&&w(w(P([])));y&&y!==n&&r.call(y,a)&&(g=y);var x=b.prototype=h.prototype=Object.create(g);function C(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function L(t,e){function n(o,a,i,s){var u=c(t[o],t,a);if("throw"!==u.type){var f=u.arg,l=f.value;return l&&"object"===typeof l&&r.call(l,"__await")?e.resolve(l.__await).then((function(t){n("next",t,i,s)}),(function(t){n("throw",t,i,s)})):e.resolve(l).then((function(t){f.value=t,i(f)}),(function(t){return n("throw",t,i,s)}))}s(u.arg)}var o;function a(t,r){function a(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(a,a):a()}this._invoke=a}function _(t,e,n){var r=f;return function(o,a){if(r===d)throw new Error("Generator is already running");if(r===p){if("throw"===o)throw a;return S()}n.method=o,n.arg=a;while(1){var i=n.delegate;if(i){var s=k(i,n);if(s){if(s===m)continue;return s}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(r===f)throw r=p,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r=d;var u=c(t,e,n);if("normal"===u.type){if(r=n.done?p:l,u.arg===m)continue;return{value:u.arg,done:n.done}}"throw"===u.type&&(r=p,n.method="throw",n.arg=u.arg)}}}function k(t,n){var r=t.iterator[n.method];if(r===e){if(n.delegate=null,"throw"===n.method){if(t.iterator["return"]&&(n.method="return",n.arg=e,k(t,n),"throw"===n.method))return m;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return m}var o=c(r,t.iterator,n.arg);if("throw"===o.type)return n.method="throw",n.arg=o.arg,n.delegate=null,m;var a=o.arg;return a?a.done?(n[t.resultName]=a.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=e),n.delegate=null,m):a:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,m)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function j(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function P(t){if(t){var n=t[a];if(n)return n.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var o=-1,i=function n(){while(++o<t.length)if(r.call(t,o))return n.value=t[o],n.done=!1,n;return n.value=e,n.done=!0,n};return i.next=i}}return{next:S}}function S(){return{value:e,done:!0}}return v.prototype=x.constructor=b,b.constructor=v,b[s]=v.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,b):(t.__proto__=b,s in t||(t[s]="GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},C(L.prototype),L.prototype[i]=function(){return this},t.AsyncIterator=L,t.async=function(e,n,r,o,a){void 0===a&&(a=Promise);var i=new L(u(e,n,r,o),a);return t.isGeneratorFunction(n)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},C(x),x[s]="Generator",x[a]=function(){return this},x.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var n in t)e.push(n);return e.reverse(),function n(){while(e.length){var r=e.pop();if(r in t)return n.value=r,n.done=!1,n}return n.done=!0,n}},t.values=P,j.prototype={constructor:j,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(O),!t)for(var n in this)"t"===n.charAt(0)&&r.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function o(r,o){return s.type="throw",s.arg=t,n.next=r,o&&(n.method="next",n.arg=e),!!o}for(var a=this.tryEntries.length-1;a>=0;--a){var i=this.tryEntries[a],s=i.completion;if("root"===i.tryLoc)return o("end");if(i.tryLoc<=this.prev){var u=r.call(i,"catchLoc"),c=r.call(i,"finallyLoc");if(u&&c){if(this.prev<i.catchLoc)return o(i.catchLoc,!0);if(this.prev<i.finallyLoc)return o(i.finallyLoc)}else if(u){if(this.prev<i.catchLoc)return o(i.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return o(i.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,m):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),m},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),O(n),m}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;O(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,r){return this.delegate={iterator:P(t),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=e),m}},t}(t.exports);try{regeneratorRuntime=r}catch(o){Function("r","regeneratorRuntime = r")(r)}}}]);
//# sourceMappingURL=chunk-442f92d5.30231991.js.map