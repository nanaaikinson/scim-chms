(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1d975937"],{"07ac":function(t,e,n){var r=n("23e7"),o=n("6f53").values;r({target:"Object",stat:!0},{values:function(t){return o(t)}})},"0952":function(t,e,n){},1276:function(t,e,n){"use strict";var r=n("d784"),o=n("44e7"),i=n("825a"),a=n("1d80"),s=n("4840"),u=n("8aa5"),c=n("50c4"),l=n("14c3"),f=n("9263"),d=n("d039"),h=[].push,p=Math.min,m=4294967295,v=!d((function(){return!RegExp(m,"y")}));r("split",2,(function(t,e,n){var r;return r="c"=="abbc".split(/(b)*/)[1]||4!="test".split(/(?:)/,-1).length||2!="ab".split(/(?:ab)*/).length||4!=".".split(/(.?)(.?)/).length||".".split(/()()/).length>1||"".split(/.?/).length?function(t,n){var r=String(a(this)),i=void 0===n?m:n>>>0;if(0===i)return[];if(void 0===t)return[r];if(!o(t))return e.call(r,t,i);var s,u,c,l=[],d=(t.ignoreCase?"i":"")+(t.multiline?"m":"")+(t.unicode?"u":"")+(t.sticky?"y":""),p=0,v=new RegExp(t.source,d+"g");while(s=f.call(v,r)){if(u=v.lastIndex,u>p&&(l.push(r.slice(p,s.index)),s.length>1&&s.index<r.length&&h.apply(l,s.slice(1)),c=s[0].length,p=u,l.length>=i))break;v.lastIndex===s.index&&v.lastIndex++}return p===r.length?!c&&v.test("")||l.push(""):l.push(r.slice(p)),l.length>i?l.slice(0,i):l}:"0".split(void 0,0).length?function(t,n){return void 0===t&&0===n?[]:e.call(this,t,n)}:e,[function(e,n){var o=a(this),i=void 0==e?void 0:e[t];return void 0!==i?i.call(e,o,n):r.call(String(o),e,n)},function(t,o){var a=n(r,t,this,o,r!==e);if(a.done)return a.value;var f=i(t),d=String(this),h=s(f,RegExp),g=f.unicode,b=(f.ignoreCase?"i":"")+(f.multiline?"m":"")+(f.unicode?"u":"")+(v?"y":"g"),y=new h(v?f:"^(?:"+f.source+")",b),w=void 0===o?m:o>>>0;if(0===w)return[];if(0===d.length)return null===l(y,d)?[d]:[];var x=0,C=0,_=[];while(C<d.length){y.lastIndex=v?C:0;var k,L=l(y,v?d:d.slice(C));if(null===L||(k=p(c(y.lastIndex+(v?0:C)),d.length))===x)C=u(d,C,g);else{if(_.push(d.slice(x,C)),_.length===w)return _;for(var E=1;E<=L.length-1;E++)if(_.push(L[E]),_.length===w)return _;C=x=k}}return _.push(d.slice(x)),_}]}),!v)},"1da1":function(t,e,n){"use strict";n.d(e,"a",(function(){return o}));n("d3b7");function r(t,e,n,r,o,i,a){try{var s=t[i](a),u=s.value}catch(c){return void n(c)}s.done?e(u):Promise.resolve(u).then(r,o)}function o(t){return function(){var e=this,n=arguments;return new Promise((function(o,i){var a=t.apply(e,n);function s(t){r(a,o,i,s,u,"next",t)}function u(t){r(a,o,i,s,u,"throw",t)}s(void 0)}))}}},"404c":function(t,e,n){"use strict";t.exports=n("6361")},"4e82":function(t,e,n){"use strict";var r=n("23e7"),o=n("1c0b"),i=n("7b0b"),a=n("d039"),s=n("a640"),u=[],c=u.sort,l=a((function(){u.sort(void 0)})),f=a((function(){u.sort(null)})),d=s("sort"),h=l||!f||!d;r({target:"Array",proto:!0,forced:h},{sort:function(t){return void 0===t?c.call(i(this)):c.call(i(this),o(t))}})},"66a7":function(t,e,n){"use strict";var r=n("451b");e["a"]={all:function(){return r["b"].get(r["a"]+"staff/contributions")},covenant:function(t){return r["b"].post(r["a"]+"staff/contributions/covenant-partner",t)},covedelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/covenant-partner/"+t)},coveshow:function(t){return r["b"].get(r["a"]+"staff/contributions/covenant-partner/"+t)},coveupdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/covenant-partner/"+e,t)},busing:function(t){return r["b"].post(r["a"]+"staff/contributions/busing",t)},busingshow:function(t){return r["b"].get(r["a"]+"staff/contributions/busing/"+t)},busingupdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/busing/"+e,t)},busingdelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/busing/"+t)},titheAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/tithes",t)},titheShow:function(t){return r["b"].get(r["a"]+"staff/contributions/tithes/"+t)},titheUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/tithes/"+e,t)},tithedelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/tithes/"+t)},groupAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/groups",t)},groupShow:function(t){return r["b"].get(r["a"]+"staff/contributions/groups/"+t)},groupUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/groups/"+e,t)},groupdelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/groups/"+t)},welfareAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/welfare",t)},welfareShow:function(t){return r["b"].get(r["a"]+"staff/contributions/welfare/"+t)},welfareUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/welfare/"+e,t)},welfaredelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/welfare/"+t)},pledgeAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/pledge",t)},pledgeShow:function(t){return r["b"].get(r["a"]+"staff/contributions/pledge/"+t)},pledgeUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/pledge/"+e,t)},pledgedelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/pledge/"+t)},generalAdd:function(t){return r["b"].post(r["a"]+"staff/contributions/general",t)},generaldelete:function(t){return r["b"]["delete"](r["a"]+"staff/contributions/general/"+t)},generalShow:function(t){return r["b"].get(r["a"]+"staff/contributions/general/"+t)},generalUpdate:function(t,e){return r["b"].put(r["a"]+"staff/contributions/general/"+e,t)}}},"7db0":function(t,e,n){"use strict";var r=n("23e7"),o=n("b727").find,i=n("44d2"),a=n("ae40"),s="find",u=!0,c=a(s);s in[]&&Array(1)[s]((function(){u=!1})),r({target:"Array",proto:!0,forced:u||!c},{find:function(t){return o(this,t,arguments.length>1?arguments[1]:void 0)}}),i(s)},"96cf":function(t,e,n){var r=function(t){"use strict";var e,n=Object.prototype,r=n.hasOwnProperty,o="function"===typeof Symbol?Symbol:{},i=o.iterator||"@@iterator",a=o.asyncIterator||"@@asyncIterator",s=o.toStringTag||"@@toStringTag";function u(t,e,n,r){var o=e&&e.prototype instanceof m?e:m,i=Object.create(o.prototype),a=new O(r||[]);return i._invoke=k(t,n,a),i}function c(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(r){return{type:"throw",arg:r}}}t.wrap=u;var l="suspendedStart",f="suspendedYield",d="executing",h="completed",p={};function m(){}function v(){}function g(){}var b={};b[i]=function(){return this};var y=Object.getPrototypeOf,w=y&&y(y(q([])));w&&w!==n&&r.call(w,i)&&(b=w);var x=g.prototype=m.prototype=Object.create(b);function C(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function _(t,e){function n(o,i,a,s){var u=c(t[o],t,i);if("throw"!==u.type){var l=u.arg,f=l.value;return f&&"object"===typeof f&&r.call(f,"__await")?e.resolve(f.__await).then((function(t){n("next",t,a,s)}),(function(t){n("throw",t,a,s)})):e.resolve(f).then((function(t){l.value=t,a(l)}),(function(t){return n("throw",t,a,s)}))}s(u.arg)}var o;function i(t,r){function i(){return new e((function(e,o){n(t,r,e,o)}))}return o=o?o.then(i,i):i()}this._invoke=i}function k(t,e,n){var r=l;return function(o,i){if(r===d)throw new Error("Generator is already running");if(r===h){if("throw"===o)throw i;return j()}n.method=o,n.arg=i;while(1){var a=n.delegate;if(a){var s=L(a,n);if(s){if(s===p)continue;return s}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if(r===l)throw r=h,n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r=d;var u=c(t,e,n);if("normal"===u.type){if(r=n.done?h:f,u.arg===p)continue;return{value:u.arg,done:n.done}}"throw"===u.type&&(r=h,n.method="throw",n.arg=u.arg)}}}function L(t,n){var r=t.iterator[n.method];if(r===e){if(n.delegate=null,"throw"===n.method){if(t.iterator["return"]&&(n.method="return",n.arg=e,L(t,n),"throw"===n.method))return p;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return p}var o=c(r,t.iterator,n.arg);if("throw"===o.type)return n.method="throw",n.arg=o.arg,n.delegate=null,p;var i=o.arg;return i?i.done?(n[t.resultName]=i.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=e),n.delegate=null,p):i:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,p)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function S(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function O(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function q(t){if(t){var n=t[i];if(n)return n.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var o=-1,a=function n(){while(++o<t.length)if(r.call(t,o))return n.value=t[o],n.done=!1,n;return n.value=e,n.done=!0,n};return a.next=a}}return{next:j}}function j(){return{value:e,done:!0}}return v.prototype=x.constructor=g,g.constructor=v,g[s]=v.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,g):(t.__proto__=g,s in t||(t[s]="GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},C(_.prototype),_.prototype[a]=function(){return this},t.AsyncIterator=_,t.async=function(e,n,r,o,i){void 0===i&&(i=Promise);var a=new _(u(e,n,r,o),i);return t.isGeneratorFunction(n)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},C(x),x[s]="Generator",x[i]=function(){return this},x.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var n in t)e.push(n);return e.reverse(),function n(){while(e.length){var r=e.pop();if(r in t)return n.value=r,n.done=!1,n}return n.done=!0,n}},t.values=q,O.prototype={constructor:O,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(S),!t)for(var n in this)"t"===n.charAt(0)&&r.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function o(r,o){return s.type="throw",s.arg=t,n.next=r,o&&(n.method="next",n.arg=e),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var a=this.tryEntries[i],s=a.completion;if("root"===a.tryLoc)return o("end");if(a.tryLoc<=this.prev){var u=r.call(a,"catchLoc"),c=r.call(a,"finallyLoc");if(u&&c){if(this.prev<a.catchLoc)return o(a.catchLoc,!0);if(this.prev<a.finallyLoc)return o(a.finallyLoc)}else if(u){if(this.prev<a.catchLoc)return o(a.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return o(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,p):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),p},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),S(n),p}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;S(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,r){return this.delegate={iterator:q(t),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=e),p}},t}(t.exports);try{regeneratorRuntime=r}catch(o){Function("r","regeneratorRuntime = r")(r)}},c1c7:function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"card"},[n("div",{staticClass:"card-body"},[n("ValidationObserver",{ref:"form"},[n("form",{on:{submit:function(e){return e.preventDefault(),t.submitForm(e)}}},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-8 offset-md-2"},[n("p",{staticClass:"mb-4"},[t._v("NB: Fields marked * are required")]),n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:""}},[t._v("Person *")]),n("input",{directives:[{name:"model",rawName:"v-model",value:t.tithe.person.name,expression:"tithe.person.name"}],staticClass:"form-control bg-white",attrs:{type:"text",name:"person",id:"person",readonly:""},domProps:{value:t.tithe.person.name},on:{input:function(e){e.target.composing||t.$set(t.tithe.person,"name",e.target.value)}}})])]),n("div",{staticClass:"col-md-6"},[n("ValidationProvider",{attrs:{name:"amount",rules:"required|decimal"},scopedSlots:t._u([{key:"default",fn:function(e){var r=e.errors;return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:""}},[t._v("Amount *")]),n("input",{directives:[{name:"model",rawName:"v-model.number",value:t.tithe.amount,expression:"tithe.amount",modifiers:{number:!0}}],staticClass:"form-control",attrs:{type:"text",name:"amount",id:"amount"},domProps:{value:t.tithe.amount},on:{input:function(e){e.target.composing||t.$set(t.tithe,"amount",t._n(e.target.value))},blur:function(e){return t.$forceUpdate()}}}),n("span",{staticClass:"text-danger"},[t._v(t._s(r[0]))])])]}}])})],1),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:""}},[t._v("Frequency *")]),n("Dropdown",{staticClass:"form-control",attrs:{options:t.frequencies,placeholder:""},model:{value:t.tithe.frequency,callback:function(e){t.$set(t.tithe,"frequency",e)},expression:"tithe.frequency"}})],1)]),n("div",{staticClass:"col-md-6"},[n("keep-alive",["monthly"===t.tithe.frequency.toLowerCase()?n("ValidationProvider",{attrs:{name:"date",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var r=e.errors;return[n("div",{staticClass:"form-group"},[n("label",{staticClass:"d-block",attrs:{for:""}},[t._v("Select Month *")]),n("Calendar",{staticClass:"w-100",attrs:{view:"month",dateFormat:"M-yy",yearNavigator:!0,yearRange:"2000:2100",placeholder:"Select Month"},model:{value:t.tithe.date,callback:function(e){t.$set(t.tithe,"date",e)},expression:"tithe.date"}}),n("span",{staticClass:"text-danger"},[t._v(t._s(r[0]))])],1)]}}],null,!1,1675005132)}):t._e()],1),"weekly"===t.tithe.frequency.toLowerCase()?n("div",{staticClass:"form-group"},[n("label",{staticClass:"d-block",attrs:{for:""}},[t._v("Select Date *")]),n("flatPickr",{staticClass:"form-control bg-white",attrs:{placeholder:"Select Date",config:t.dateConfig,required:""},model:{value:t.tithe.date,callback:function(e){t.$set(t.tithe,"date",e)},expression:"tithe.date"}})],1):t._e()],1),n("div",{staticClass:"col-md-6"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"method"}},[t._v("Method of payment *")]),n("select",{directives:[{name:"model",rawName:"v-model.number",value:t.tithe.method,expression:"tithe.method",modifiers:{number:!0}}],staticClass:"custom-select",attrs:{name:"method",id:"method"},on:{change:function(e){var n=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(e){var n="_value"in e?e._value:e.value;return t._n(n)}));t.$set(t.tithe,"method",e.target.multiple?n:n[0])}}},t._l(t.methods,(function(e,r){return n("option",{key:r,domProps:{value:e.id}},[t._v(t._s(e.name))])})),0)])]),n("div",{staticClass:"col-md-12"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:""}},[t._v("Comments *")]),n("input",{directives:[{name:"model",rawName:"v-model",value:t.tithe.comment,expression:"tithe.comment"}],staticClass:"form-control",attrs:{type:"text",name:"comment",id:"comment",required:""},domProps:{value:t.tithe.comment},on:{input:function(e){e.target.composing||t.$set(t.tithe,"comment",e.target.value)}}})]),n("div",{staticClass:"form-group mt-4"},[n("button",{ref:"submitBtn",staticClass:"btn btn-success px-5"},[t._v("Submit")])])])])])])])])],1)])])},o=[],i=(n("d81d"),n("fb6a"),n("d3b7"),n("07ac"),n("96cf"),n("1da1")),a=n("5530"),s=n("ca16"),u=n("66a7"),c=n("3d20"),l=n.n(c),f=n("404c"),d=n.n(f),h=n("9631"),p=n.n(h),m=n("c38f"),v=n.n(m),g=(n("0952"),n("5a0c")),b=n.n(g),y={name:"TitheEdit",components:{Dropdown:d.a,Calendar:p.a,flatPickr:v.a},data:function(){return{tithe:{person:{},date:"",amount:0,frequency:"",comment:"",method:""},frequencies:["Weekly","Monthly"],dateConfig:{altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d",allowInput:!0},mask:"",methods:[{name:"Cash",id:1},{name:"Cheque",id:2},{name:"Online",id:3},{name:"Mobile Money",id:4}]}},methods:{setData:function(t){this.tithe.person=t.person,this.tithe.date=t.date,this.tithe.amount=t.amount,this.tithe.frequency=t.frequency.charAt(0).toUpperCase()+t.frequency.slice(1),this.tithe.comment=t.comment,this.mask=t.mask,this.tithe.method=t.method},submitForm:function(t){var e=this;this.$refs.form.validate().then((function(t){if(t){var n=e.$refs.submitBtn;Object(s["a"])(n);var r=Object(a["a"])(Object(a["a"])({},e.tithe),{},{person:e.tithe.person.id,frequency:e.tithe.frequency.toLowerCase(),date:b()(e.tithe.date).format("YYYY-MM-DD")});u["a"].titheUpdate(r,e.mask).then((function(t){var n=t.data;l.a.fire("Success",n.message,"success"),e.$router.push({name:"Contributions"})}))["catch"]((function(t){var e=t.response,n=e.status,r=e.data,o="";if(422===n){var i=Object.values(r.errors);i.map((function(t){o+='<span class="d-block">'.concat(t,"</span>")}))}else o+=r.message;l.a.fire("",o,"warning")}))["finally"]((function(){Object(s["b"])(n)}))}}))}},beforeRouteEnter:function(t,e,n){return Object(i["a"])(regeneratorRuntime.mark((function e(){var r,o,i;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return r=t.params.mask,e.next=3,u["a"].titheShow(r);case 3:o=e.sent,i=o.data,n((function(t){return t.setData(i.data)}));case 6:case"end":return e.stop()}}),e)})))()}},w=y,x=n("2877"),C=Object(x["a"])(w,r,o,!1,null,null,null);e["default"]=C.exports},c20d:function(t,e,n){var r=n("da84"),o=n("58a8").trim,i=n("5899"),a=r.parseInt,s=/^[+-]?0[Xx]/,u=8!==a(i+"08")||22!==a(i+"0x16");t.exports=u?function(t,e){var n=o(String(t));return a(n,e>>>0||(s.test(n)?16:10))}:a},e25e:function(t,e,n){var r=n("23e7"),o=n("c20d");r({global:!0,forced:parseInt!=o},{parseInt:o})}}]);
//# sourceMappingURL=chunk-1d975937.4fd688f7.js.map