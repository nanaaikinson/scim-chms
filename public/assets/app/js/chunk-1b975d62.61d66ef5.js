(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1b975d62"],{"07ac":function(t,e,r){var n=r("23e7"),a=r("6f53").values;n({target:"Object",stat:!0},{values:function(t){return a(t)}})},"1da1":function(t,e,r){"use strict";r.d(e,"a",(function(){return a}));r("d3b7");function n(t,e,r,n,a,o,i){try{var s=t[o](i),u=s.value}catch(c){return void r(c)}s.done?e(u):Promise.resolve(u).then(n,a)}function a(t){return function(){var e=this,r=arguments;return new Promise((function(a,o){var i=t.apply(e,r);function s(t){n(i,a,o,s,u,"next",t)}function u(t){n(i,a,o,s,u,"throw",t)}s(void 0)}))}}},"6f53":function(t,e,r){var n=r("83ab"),a=r("df75"),o=r("fc6a"),i=r("d1e7").f,s=function(t){return function(e){var r,s=o(e),u=a(s),c=u.length,l=0,f=[];while(c>l)r=u[l++],n&&!i.call(s,r)||f.push(t?[r,s[r]]:s[r]);return f}};t.exports={entries:s(!0),values:s(!1)}},"96cf":function(t,e,r){var n=function(t){"use strict";var e,r=Object.prototype,n=r.hasOwnProperty,a="function"===typeof Symbol?Symbol:{},o=a.iterator||"@@iterator",i=a.asyncIterator||"@@asyncIterator",s=a.toStringTag||"@@toStringTag";function u(t,e,r,n){var a=e&&e.prototype instanceof h?e:h,o=Object.create(a.prototype),i=new j(n||[]);return o._invoke=C(t,r,i),o}function c(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(n){return{type:"throw",arg:n}}}t.wrap=u;var l="suspendedStart",f="suspendedYield",m="executing",p="completed",d={};function h(){}function v(){}function g(){}var y={};y[o]=function(){return this};var b=Object.getPrototypeOf,w=b&&b(b(N([])));w&&w!==r&&n.call(w,o)&&(y=w);var _=g.prototype=h.prototype=Object.create(y);function x(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function L(t,e){function r(a,o,i,s){var u=c(t[a],t,o);if("throw"!==u.type){var l=u.arg,f=l.value;return f&&"object"===typeof f&&n.call(f,"__await")?e.resolve(f.__await).then((function(t){r("next",t,i,s)}),(function(t){r("throw",t,i,s)})):e.resolve(f).then((function(t){l.value=t,i(l)}),(function(t){return r("throw",t,i,s)}))}s(u.arg)}var a;function o(t,n){function o(){return new e((function(e,a){r(t,n,e,a)}))}return a=a?a.then(o,o):o()}this._invoke=o}function C(t,e,r){var n=l;return function(a,o){if(n===m)throw new Error("Generator is already running");if(n===p){if("throw"===a)throw o;return P()}r.method=a,r.arg=o;while(1){var i=r.delegate;if(i){var s=E(i,r);if(s){if(s===d)continue;return s}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===l)throw n=p,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=m;var u=c(t,e,r);if("normal"===u.type){if(n=r.done?p:f,u.arg===d)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(n=p,r.method="throw",r.arg=u.arg)}}}function E(t,r){var n=t.iterator[r.method];if(n===e){if(r.delegate=null,"throw"===r.method){if(t.iterator["return"]&&(r.method="return",r.arg=e,E(t,r),"throw"===r.method))return d;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var a=c(n,t.iterator,r.arg);if("throw"===a.type)return r.method="throw",r.arg=a.arg,r.delegate=null,d;var o=a.arg;return o?o.done?(r[t.resultName]=o.value,r.next=t.nextLoc,"return"!==r.method&&(r.method="next",r.arg=e),r.delegate=null,d):o:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,d)}function k(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function j(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(k,this),this.reset(!0)}function N(t){if(t){var r=t[o];if(r)return r.call(t);if("function"===typeof t.next)return t;if(!isNaN(t.length)){var a=-1,i=function r(){while(++a<t.length)if(n.call(t,a))return r.value=t[a],r.done=!1,r;return r.value=e,r.done=!0,r};return i.next=i}}return{next:P}}function P(){return{value:e,done:!0}}return v.prototype=_.constructor=g,g.constructor=v,g[s]=v.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"===typeof t&&t.constructor;return!!e&&(e===v||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,g):(t.__proto__=g,s in t||(t[s]="GeneratorFunction")),t.prototype=Object.create(_),t},t.awrap=function(t){return{__await:t}},x(L.prototype),L.prototype[i]=function(){return this},t.AsyncIterator=L,t.async=function(e,r,n,a,o){void 0===o&&(o=Promise);var i=new L(u(e,r,n,a),o);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},x(_),_[s]="Generator",_[o]=function(){return this},_.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){while(e.length){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=N,j.prototype={constructor:j,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(O),!t)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0],e=t.completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var r=this;function a(n,a){return s.type="throw",s.arg=t,r.next=n,a&&(r.method="next",r.arg=e),!!a}for(var o=this.tryEntries.length-1;o>=0;--o){var i=this.tryEntries[o],s=i.completion;if("root"===i.tryLoc)return a("end");if(i.tryLoc<=this.prev){var u=n.call(i,"catchLoc"),c=n.call(i,"finallyLoc");if(u&&c){if(this.prev<i.catchLoc)return a(i.catchLoc,!0);if(this.prev<i.finallyLoc)return a(i.finallyLoc)}else if(u){if(this.prev<i.catchLoc)return a(i.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return a(i.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var a=this.tryEntries[r];if(a.tryLoc<=this.prev&&n.call(a,"finallyLoc")&&this.prev<a.finallyLoc){var o=a;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var i=o?o.completion:{};return i.type=t,i.arg=e,o?(this.method="next",this.next=o.finallyLoc,d):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),O(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var a=n.arg;O(r)}return a}}throw new Error("illegal catch attempt")},delegateYield:function(t,r,n){return this.delegate={iterator:N(t),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=e),d}},t}(t.exports);try{regeneratorRuntime=n}catch(a){Function("r","regeneratorRuntime = r")(n)}},a5de:function(t,e,r){"use strict";var n=r("451b");e["a"]={all:function(){return n["b"].get(n["a"]+"staff/roles")},rolepermissions:function(){return n["b"].get(n["a"]+"staff/roles/permissions")},store:function(t){return n["b"].post(n["a"]+"staff/roles",t)},show:function(t){return n["b"].get(n["a"]+"staff/roles/"+t)},update:function(t,e){return n["b"].put(n["a"]+"staff/roles/"+e,t)},delete:function(t){return n["b"]["delete"](n["a"]+"staff/roles/"+t)}}},a9f5:function(t,e,r){"use strict";var n=r("451b");e["a"]={all:function(){return n["b"].get(n["a"]+"staff/users")},store:function(t){return n["b"].post(n["a"]+"staff/users",t)},show:function(t){return n["b"].get(n["a"]+"staff/users/"+t)},update:function(t,e){return n["b"].put(n["a"]+"staff/users/"+e,t)},delete:function(t){return n["b"]["delete"](n["a"]+"staff/users/"+t)}}},b0d5:function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"card min-height-500"},[r("div",{staticClass:"card-body"},[r("p",{staticClass:"mb-3"},[t._v("NB: Fields marked * are required")]),r("div",{ref:"formMsg",staticClass:"form-msg"}),r("form",{on:{submit:function(e){return e.preventDefault(),t.updateUser(e)}}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"first_name"}},[t._v("First Name *")]),r("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.first_name,expression:"first_name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"first_name",id:"first_name",required:""},domProps:{value:t.first_name},on:{input:function(e){e.target.composing||(t.first_name=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"last_name"}},[t._v("Last Name *")]),r("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.last_name,expression:"last_name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"last_name",id:"last_name",required:""},domProps:{value:t.last_name},on:{input:function(e){e.target.composing||(t.last_name=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"email"}},[t._v("Email *")]),r("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.email,expression:"email",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"email",name:"email",id:"email",required:""},domProps:{value:t.email},on:{input:function(e){e.target.composing||(t.email=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"telephone_number"}},[t._v("Mobile Phone ")]),r("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.telephone_number,expression:"telephone_number",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"telephone_number",id:"telephone_number"},domProps:{value:t.telephone_number},on:{input:function(e){e.target.composing||(t.telephone_number=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"role"}},[t._v("Role *")]),r("select",{directives:[{name:"model",rawName:"v-model.trim",value:t.role,expression:"role",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{name:"role",id:"role",required:""},on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.role=e.target.multiple?r:r[0]}}},[r("option",{attrs:{value:""}},[t._v("Select")]),t._l(t.roles,(function(e){return r("option",{key:e.id,domProps:{value:e.id}},[t._v(t._s(e.name))])}))],2)])]),r("div",{staticClass:"col-md-6"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"status"}},[t._v(" Status * ")]),r("select",{directives:[{name:"model",rawName:"v-model.trim",value:t.status,expression:"status",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{name:"status",id:"status",required:""},on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.status=e.target.multiple?r:r[0]}}},[r("option",{attrs:{value:""}},[t._v("Select")]),r("option",{attrs:{value:"1"}},[t._v("Active")]),r("option",{attrs:{value:"0"}},[t._v("Inactive")])])])])]),r("div",{staticClass:"text-center"},[r("div",{staticClass:"form-group mt-5"},[r("button",{ref:"submitBtn",staticClass:"btn btn-success px-5"},[t._v(" Update ")])])])])])])])},a=[],o=(r("d81d"),r("d3b7"),r("07ac"),r("3ca3"),r("ddb0"),r("96cf"),r("1da1")),i=r("ca16"),s=r("a9f5"),u=r("a5de"),c=r("3d20"),l=r.n(c),f={name:"UserEdit",data:function(){return{first_name:"",last_name:"",telephone_number:"",email:"",password:"",password_confirmation:"",auto_password:"",notify_user:"",status:"",role:"",roles:[],mask:""}},methods:{updateUser:function(t){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){var r,n,a,o,u,c,f,m;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return r=e.$refs.submitBtn,n=e.$refs.formMsg,t.prev=2,Object(i["a"])(r),a={first_name:e.first_name,last_name:e.last_name,telephone:e.telephone_number,email:e.email,password:e.password,password_confirmation:e.password_confirmation,role:e.role,auto_password:e.auto_password,notify_user:e.notify_user,status:e.status},t.next=7,s["a"].update(a,e.mask);case 7:o=t.sent,u=o.data,Object(i["b"])(r),l.a.fire("Success",u.message,"success"),e.$router.push({name:"user"}),t.next=20;break;case 14:t.prev=14,t.t0=t["catch"](2),c=t.t0.response.data,f="",422===c.code?(Object(i["b"])(r),m=Object.values(c.errors),m.map((function(t){f+='<span class="d-block">'.concat(t,"</span>")}))):f+=c.message,n.innerHTML='<div class="alert alert-danger">'.concat(f,"</div>");case 20:case"end":return t.stop()}}),t,null,[[2,14]])})))()},setData:function(t){var e=t[1].data.data;this.roles=t[0].data.data,this.first_name=e.first_name,this.last_name=e.last_name,this.telephone_number=e.telephone,this.email=e.email,this.status=e.status?1:0,this.role=e.role,this.mask=e.mask}},beforeRouteEnter:function(t,e,r){return Object(o["a"])(regeneratorRuntime.mark((function e(){var n,a;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,n=t.params.mask,n||r({name:"Home"}),e.next=5,Promise.all([u["a"].all(),s["a"].show(n)]);case 5:a=e.sent,r((function(t){return t.setData(a)})),e.next=12;break;case 9:e.prev=9,e.t0=e["catch"](0),console.log(e.t0);case 12:case"end":return e.stop()}}),e,null,[[0,9]])})))()}},m=f,p=r("2877"),d=Object(p["a"])(m,n,a,!1,null,null,null);e["default"]=d.exports},d81d:function(t,e,r){"use strict";var n=r("23e7"),a=r("b727").map,o=r("1dde"),i=r("ae40"),s=o("map"),u=i("map");n({target:"Array",proto:!0,forced:!s||!u},{map:function(t){return a(this,t,arguments.length>1?arguments[1]:void 0)}})}}]);
//# sourceMappingURL=chunk-1b975d62.61d66ef5.js.map