(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-56e8d6e0"],{"1da1":function(t,e,r){"use strict";r.d(e,"a",(function(){return a}));r("d3b7");function n(t,e,r,n,a,o,i){try{var s=t[o](i),c=s.value}catch(u){return void r(u)}s.done?e(c):Promise.resolve(c).then(n,a)}function a(t){return function(){var e=this,r=arguments;return new Promise((function(a,o){var i=t.apply(e,r);function s(t){n(i,a,o,s,c,"next",t)}function c(t){n(i,a,o,s,c,"throw",t)}s(void 0)}))}}},3049:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("input",t._g({class:["p-inputtext p-component",{"p-filled":t.filled}],domProps:{value:t.value}},t.listeners))},a=[],o=(r("0d03"),r("d3b7"),r("25f0"),r("5530")),i={props:{value:null},computed:{listeners:function(){var t=this;return Object(o["a"])(Object(o["a"])({},this.$listeners),{},{input:function(e){return t.$emit("input",e.target.value)}})},filled:function(){return null!=this.value&&this.value.toString().length>0}}},s=i,c=r("2877"),u=Object(c["a"])(s,n,a,!1,null,null,null);e["default"]=u.exports},"3ed8":function(t,e,r){"use strict";var n=r("451b");e["a"]={all:function(){return n["b"].get(n["a"]+"staff/people")},members:function(){return n["b"].get(n["a"]+"staff/people/members")},store:function(t){return n["b"].post(n["a"]+"staff/people",t)},show:function(t){return n["b"].get(n["a"]+"staff/people/"+t)},update:function(t,e){return n["b"].post(n["a"]+"staff/people/"+e,t)},delete:function(t){return n["b"]["delete"](n["a"]+"staff/people/"+t)},person:{details:function(t){return n["b"].get(n["a"]+"staff/people/"+t+n["a"]+"details")},attendance:function(t,e){return n["b"].get(n["a"]+"staff/people/"+t+n["a"]+"attendance",e)},followUp:function(t,e){return n["b"].get(n["a"]+"staff/people/"+t+n["a"]+"follow-ups",e)},contributions:function(t,e){return n["b"].get(n["a"]+"staff/people/"+t+n["a"]+"contributions",e)}}}},6026:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"card"},[r("div",{staticClass:"card-body"},[r("div",{staticClass:"mb-5"},[r("router-link",{directives:[{name:"can",rawName:"v-can",value:"create-person",expression:"'create-person'"}],staticClass:"btn btn-primary px-5",attrs:{to:{name:"addperson"}}},[t._v("Add Person")])],1),r("div",[r("DataTable",{attrs:{value:t.people,paginator:!0,rows:10,loading:t.loading,filters:t.filters,paginatorTemplate:"FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown",rowsPerPageOptions:[10,25,50],currentPageReportTemplate:"Showing {first} to {last} of {totalRecords} entries",scrollable:!0,scrollHeight:"55vh"},scopedSlots:t._u([{key:"header",fn:function(){return[r("div",{staticClass:"table-header d-flex justify-content-end"},[r("span",{staticClass:"p-input-icon-left"},[r("i",{staticClass:"pi pi-search"}),r("InputText",{attrs:{placeholder:"Search For"},model:{value:t.filters["global"],callback:function(e){t.$set(t.filters,"global",e)},expression:"filters['global']"}})],1)])]},proxy:!0},{key:"empty",fn:function(){return[r("div",{staticClass:"text-center"},[t._v("No data found.")])]},proxy:!0}])},[r("Column",{attrs:{field:"id",header:"S/N",sortable:""}}),r("Column",{attrs:{field:"name",header:"Name",sortable:""},scopedSlots:t._u([{key:"body",fn:function(e){return[r("div",{staticClass:"d-flex align-items-center"},[r("div",[r("img",{staticClass:"img-fluid rounded avatar-image",attrs:{src:e.data.avatar?e.data.avatar:t.avatar}})]),r("div",{staticClass:"ml-3"},[r("span",[t._v(t._s(e.data.name))])])])]}}])}),r("Column",{attrs:{field:"email",header:"Email",sortable:""}}),r("Column",{attrs:{field:"primary_telephone",header:"Mobile Phone",sortable:""}}),r("Column",{attrs:{field:"created_at",header:"Date Added",sortable:""}}),r("Column",{attrs:{field:"actions",header:"Actions"},scopedSlots:t._u([{key:"body",fn:function(e){return[r("router-link",{directives:[{name:"can",rawName:"v-can",value:"view-person",expression:"'view-person'"},{name:"tooltip",rawName:"v-tooltip.top",value:"View Detail",expression:"'View Detail'",modifiers:{top:!0}}],staticClass:"btn btn-primary btn-icon mr-2",attrs:{tag:"button",to:{name:"PersonDetail",params:{mask:e.data.mask}}}},[r("i",{staticClass:"pi pi-eye"})]),r("router-link",{directives:[{name:"can",rawName:"v-can",value:"update-person",expression:"'update-person'"},{name:"tooltip",rawName:"v-tooltip.top",value:"Edit",expression:"'Edit'",modifiers:{top:!0}}],staticClass:"btn btn-primary btn-icon mr-2",attrs:{tag:"button",to:{name:"personedit",params:{mask:e.data.mask}}}},[r("i",{staticClass:"pi pi-pencil"})]),r("button",{directives:[{name:"can",rawName:"v-can",value:"delete-person",expression:"'delete-person'"},{name:"tooltip",rawName:"v-tooltip.top",value:"Delete",expression:"'Delete'",modifiers:{top:!0}}],staticClass:"btn btn-danger btn-icon mr-2",on:{click:function(r){return t.deletePerson(e.data.mask,r)}}},[r("i",{staticClass:"pi pi-trash no-pointer-events"})])]}}])})],1)],1)])])])},a=[],o=(r("96cf"),r("1da1")),i=r("23a5"),s=r.n(i),c=r("c524"),u=r.n(c),l=r("3ed8"),f=r("ca16"),p=r("3d20"),h=r.n(p),d=r("a84a"),v=r.n(d),m={name:"People",components:{DataTable:s.a,Column:u.a,InputText:v.a},data:function(){return{filters:{},people:[],loading:!0}},computed:{avatar:function(){return r("56fc")}},methods:{getPeople:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){var r,n;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,l["a"].all();case 3:r=e.sent,t.loading=!1,n=r.data,t.people=n.data,e.next=13;break;case 9:e.prev=9,e.t0=e["catch"](0),console.log(e.t0),t.loading=!1;case 13:case"end":return e.stop()}}),e,null,[[0,9]])})))()},deletePerson:function(t,e){var r=this;return Object(o["a"])(regeneratorRuntime.mark((function n(){var a,o,i,s,c;return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:return a=e.target,n.prev=1,n.next=4,h.a.fire({text:"Do you want to delete this person?",icon:"warning",showCancelButton:!0,cancelButtonText:"No",confirmButtonText:"Yes Delete It",reverseButtons:!0});case 4:if(o=n.sent,!o.value){n.next=14;break}return Object(f["a"])(a),n.next=9,l["a"]["delete"](t);case 9:i=n.sent,Object(f["b"])(a),s=i.data,h.a.fire({icon:"success",title:s.message}),r.getPeople();case 14:n.next=21;break;case 16:n.prev=16,n.t0=n["catch"](1),Object(f["b"])(a),c=n.t0.response.data,h.a.fire({icon:"error",title:c.message});case 21:case"end":return n.stop()}}),n,null,[[1,16]])})))()}},created:function(){var t=this;return Object(o["a"])(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.getPeople();case 2:case"end":return e.stop()}}),e)})))()}},g=m,y=(r("c3e6"),r("2877")),w=Object(y["a"])(g,n,a,!1,null,"1a3633a8",null);e["default"]=w.exports},7852:function(t,e,r){},"96cf":function(t,e,r){var n=function(t){"use strict";var e,r=Object.prototype,n=r.hasOwnProperty,a="function"===typeof Symbol?Symbol:{},o=a.iterator||"@@iterator",i=a.asyncIterator||"@@asyncIterator",s=a.toStringTag||"@@toStringTag";function c(t,e,r,n){var a=e&&e.prototype instanceof v?e:v,o=Object.create(a.prototype),i=new O(n||[]);return o._invoke=P(t,r,i),o}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(n){return{type:"throw",arg:n}}}t.wrap=c;var l="suspendedStart",f="suspendedYield",p="executing",h="completed",d={};function v(){}function m(){}function g(){}var y={};y[o]=function(){return this};var w=Object.getPrototypeOf,b=w&&w(w(j([])));b&&b!==r&&n.call(b,o)&&(y=b);var x=g.prototype=v.prototype=Object.create(y);function k(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function L(t,e){function r(a,o,i,s){var c=u(t[a],t,o);if("throw"!==c.type){var l=c.arg,f=l.value;return f&&"object"===typeof f&&n.call(f,"__await")?e.resolve(f.__await).then((function(t){r("next",t,i,s)}),(function(t){r("throw",t,i,s)})):e.resolve(f).then((function(t){l.value=t,i(l)}),(function(t){return r("throw",t,i,s)}))}s(c.arg)}var a;function o(t,n){function o(){return new e((function(e,a){r(t,n,e,a)}))}return a=a?a.then(o,o):o()}this._invoke=o}function P(t,e,r){var n=l;return function(a,o){if(n===p)throw new Error("Generator is already running");if(n===h){if("throw"===a)throw o;return N()}r.method=a,r.arg=o;while(1){var i=r.delegate;if(i){var s=_(i,r);if(s){if(s===d)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===l)throw n=h,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=p;var c=u(t,e,r);if("normal"===c.type){if(n=r.done?h:f,c.arg===d)continue;return{value:c.arg,done:r.done}}"throw"===c.type&&(n=h,r.method="throw",r.arg=c.arg)}}}function _(t,r){var n=t.iterator[r.method];if(n===e){if(r.delegate=null,"throw"===r.method){if(t.iterator["return"]&&(r.method="return",r.arg=e,_(t,r),"throw"===r.method))return d;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var a=u(n,t.iterator,r.arg);if("throw"===a.type)return r.method="throw",r.arg=a.arg,r.delegate=null,d;var o=a.arg;return o?o.done?(r[t.resultName]=o.value,r.next=t.nextLoc,"return"!==r.method&&(r.method="next",r.arg=e),r.delegate=null,d):o:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,d)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function C(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function O(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function j(t){if(t){var r=t[o];if(r)return r.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var a=-1,i=function r(){while(++a<t.length)if(n.call(t,a))return r.value=t[a],r.done=!1,r;return r.value=e,r.done=!0,r};return i.next=i}}return{next:N}}function N(){return{value:e,done:!0}}return m.prototype=x.constructor=g,g.constructor=m,g[s]=m.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,g):(t.__proto__=g,s in t||(t[s]="GeneratorFunction")),t.prototype=Object.create(x),t},t.awrap=function(t){return{__await:t}},k(L.prototype),L.prototype[i]=function(){return this},t.AsyncIterator=L,t.async=function(e,r,n,a,o){void 0===o&&(o=Promise);var i=new L(c(e,r,n,a),o);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},k(x),x[s]="Generator",x[o]=function(){return this},x.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){while(e.length){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=j,O.prototype={constructor:O,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(C),!t)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var r=this;function a(n,a){return s.type="throw",s.arg=t,r.next=n,a&&(r.method="next",r.arg=e),!!a}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],s=i.completion;if("root"===i.tryLoc)return a("end");if(i.tryLoc<=this.prev){var c=n.call(i,"catchLoc"),u=n.call(i,"finallyLoc");if(c&&u){if(this.prev<i.catchLoc)return a(i.catchLoc,!0);if(this.prev<i.finallyLoc)return a(i.finallyLoc)}else if(c){if(this.prev<i.catchLoc)return a(i.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return a(i.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var a=this.tryEntries[r];if(a.tryLoc<=this.prev&&n.call(a,"finallyLoc")&&this.prev<a.finallyLoc){var o=a;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,d):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),C(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var a=n.arg;C(r)}return a}}throw new Error("illegal catch attempt")},delegateYield:function(t,r,n){return this.delegate={iterator:j(t),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=e),d}},t}(t.exports);try{regeneratorRuntime=n}catch(a){Function("r","regeneratorRuntime = r")(n)}},a84a:function(t,e,r){"use strict";t.exports=r("3049")},c3e6:function(t,e,r){"use strict";var n=r("7852"),a=r.n(n);a.a}}]);
//# sourceMappingURL=chunk-56e8d6e0.5351234e.js.map