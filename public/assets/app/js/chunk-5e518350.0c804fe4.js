(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5e518350"],{"0582":function(e,t,a){"use strict";function r(e){if("undefined"===typeof Symbol||null==e[Symbol.iterator]){if(Array.isArray(e)||(e=n(e))){var t=0,a=function(){};return{s:a,n:function(){return t>=e.length?{done:!0}:{done:!1,value:e[t++]}},e:function(e){throw e},f:a}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var r,i,o=!0,s=!1;return{s:function(){r=e[Symbol.iterator]()},n:function(){var e=r.next();return o=e.done,e},e:function(e){s=!0,i=e},f:function(){try{o||null==r.return||r.return()}finally{if(s)throw i}}}}function n(e,t){if(e){if("string"===typeof e)return i(e,t);var a=Object.prototype.toString.call(e).slice(8,-1);return"Object"===a&&e.constructor&&(a=e.constructor.name),"Map"===a||"Set"===a?Array.from(a):"Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a)?i(e,t):void 0}}function i(e,t){(null==t||t>e.length)&&(t=e.length);for(var a=0,r=new Array(t);a<t;a++)r[a]=e[a];return r}function o(e){return o="function"===typeof Symbol&&"symbol"===typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"===typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},o(e)}function s(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function l(e,t){for(var a=0;a<t.length;a++){var r=t[a];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function c(e,t,a){return t&&l(e.prototype,t),a&&l(e,a),e}Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var u=function(){function e(){s(this,e)}return c(e,null,[{key:"equals",value:function(e,t,a){return a?this.resolveFieldData(e,a)===this.resolveFieldData(t,a):this.deepEquals(e,t)}},{key:"deepEquals",value:function(e,t){if(e===t)return!0;if(e&&t&&"object"==o(e)&&"object"==o(t)){var a,r,n,i=Array.isArray(e),s=Array.isArray(t);if(i&&s){if(r=e.length,r!=t.length)return!1;for(a=r;0!==a--;)if(!this.deepEquals(e[a],t[a]))return!1;return!0}if(i!=s)return!1;var l=e instanceof Date,c=t instanceof Date;if(l!=c)return!1;if(l&&c)return e.getTime()==t.getTime();var u=e instanceof RegExp,m=t instanceof RegExp;if(u!=m)return!1;if(u&&m)return e.toString()==t.toString();var d=Object.keys(e);if(r=d.length,r!==Object.keys(t).length)return!1;for(a=r;0!==a--;)if(!Object.prototype.hasOwnProperty.call(t,d[a]))return!1;for(a=r;0!==a--;)if(n=d[a],!this.deepEquals(e[n],t[n]))return!1;return!0}return e!==e&&t!==t}},{key:"resolveFieldData",value:function(e,t){if(e&&t){if(-1===t.indexOf("."))return e[t];for(var a=t.split("."),r=e,n=0,i=a.length;n<i;++n)r=r[a[n]];return r}return null}},{key:"filter",value:function(e,t,a){var n=[];if(e){var i,o=r(e);try{for(o.s();!(i=o.n()).done;){var s,l=i.value,c=r(t);try{for(c.s();!(s=c.n()).done;){var u=s.value;if(String(this.resolveFieldData(l,u)).toLowerCase().indexOf(a.toLowerCase())>-1){n.push(l);break}}}catch(m){c.e(m)}finally{c.f()}}}catch(m){o.e(m)}finally{o.f()}}return n}},{key:"reorderArray",value:function(e,t,a){var r;if(e&&t!==a){if(a>=e.length){r=a-e.length;while(1+r--)e.push(void 0)}e.splice(a,0,e.splice(t,1)[0])}}},{key:"findIndexInList",value:function(e,t){var a=-1;if(t)for(var r=0;r<t.length;r++)if(t[r]===e){a=r;break}return a}},{key:"contains",value:function(e,t){if(null!=e&&t&&t.length){var a,n=r(t);try{for(n.s();!(a=n.n()).done;){var i=a.value;if(this.equals(e,i))return!0}}catch(o){n.e(o)}finally{n.f()}}return!1}},{key:"insertIntoOrderedArray",value:function(e,t,a,r){if(a.length>0){for(var n=!1,i=0;i<a.length;i++){var o=this.findIndexInList(a[i],r);if(o>t){a.splice(i,0,e),n=!0;break}}n||a.push(e)}else a.push(e)}},{key:"removeAccents",value:function(e){return e&&e.search(/[\xC0-\xFF]/g)>-1&&(e=e.replace(/[\xC0-\xC5]/g,"A").replace(/[\xC6]/g,"AE").replace(/[\xC7]/g,"C").replace(/[\xC8-\xCB]/g,"E").replace(/[\xCC-\xCF]/g,"I").replace(/[\xD0]/g,"D").replace(/[\xD1]/g,"N").replace(/[\xD2-\xD6\xD8]/g,"O").replace(/[\xD9-\xDC]/g,"U").replace(/[\xDD]/g,"Y").replace(/[\xDE]/g,"P").replace(/[\xE0-\xE5]/g,"a").replace(/[\xE6]/g,"ae").replace(/[\xE7]/g,"c").replace(/[\xE8-\xEB]/g,"e").replace(/[\xEC-\xEF]/g,"i").replace(/[\xF1]/g,"n").replace(/[\xF2-\xF6\xF8]/g,"o").replace(/[\xF9-\xFC]/g,"u").replace(/[\xFE]/g,"p").replace(/[\xFD\xFF]/g,"y")),e}}]),e}();t.default=u},"0952":function(e,t,a){},"498a":function(e,t,a){"use strict";var r=a("23e7"),n=a("58a8").trim,i=a("c8d2");r({target:"String",proto:!0,forced:i("trim")},{trim:function(){return n(this)}})},"4cb8":function(e,t,a){"use strict";var r=a("451b");t["a"]={all:function(){return r["b"].get("/staff/groups")},store:function(e){return r["b"].post("/staff/groups",e)},show:function(e){return r["b"].get("/staff/groups/"+e)},update:function(e,t){return r["b"].put("/staff/groups/"+t,e)},delete:function(e){return r["b"]["delete"]("/staff/groups/"+e)}}},b85c:function(e,t,a){"use strict";a.d(t,"a",(function(){return n}));a("a4d3"),a("e01a"),a("d28b"),a("277d"),a("d3b7"),a("3ca3"),a("ddb0");var r=a("06c5");function n(e,t){var a;if("undefined"===typeof Symbol||null==e[Symbol.iterator]){if(Array.isArray(e)||(a=Object(r["a"])(e))||t&&e&&"number"===typeof e.length){a&&(e=a);var n=0,i=function(){};return{s:i,n:function(){return n>=e.length?{done:!0}:{done:!1,value:e[n++]}},e:function(e){throw e},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var o,s=!0,l=!1;return{s:function(){a=e[Symbol.iterator]()},n:function(){var e=a.next();return s=e.done,e},e:function(e){l=!0,o=e},f:function(){try{s||null==a["return"]||a["return"]()}finally{if(l)throw o}}}}},ba38:function(e,t,a){"use strict";a.r(t);var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("div",{staticClass:"card min-height-500"},[a("div",{staticClass:"card-body"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-10 offset-md-1"},[a("p",{staticClass:"mb-3"},[e._v("NB: Fields marked * are required")]),a("div",{ref:"formMsg",staticClass:"form-msg"}),a("form",{on:{submit:function(t){return t.preventDefault(),e.updatePerson(t)}}},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-12 d-flex justify-content-center"},[a("div",{staticClass:"form-group"},[a("div",{staticClass:"avatar-upload"},[a("div",{staticClass:"avatar-edit"},[a("input",{attrs:{type:"file",id:"imageUpload",accept:".png, .jpg, .jpeg"},on:{change:e.changeImage}}),e._m(0)]),a("div",{staticClass:"avatar-preview"},[a("div",{ref:"imagePreview",style:e.avatar,attrs:{id:"imagePreview"}})])])])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"first_name"}},[e._v("First Name *")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.first_name,expression:"first_name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"first_name",id:"first_name",required:""},domProps:{value:e.first_name},on:{input:function(t){t.target.composing||(e.first_name=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"last_name"}},[e._v("Last Name *")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.last_name,expression:"last_name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"last_name",id:"last_name",required:""},domProps:{value:e.last_name},on:{input:function(t){t.target.composing||(e.last_name=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"middle_name"}},[e._v("Middle Name")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.middle_name,expression:"middle_name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"middle_name",id:"middle_name"},domProps:{value:e.middle_name},on:{input:function(t){t.target.composing||(e.middle_name=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"date_of_birth"}},[e._v("Date of Birth")]),a("flat-pickr",{staticClass:"form-control bg-white",attrs:{config:e.config,placeholder:"Select Date",name:"date_of_birth",id:"date_of_birth"},model:{value:e.date_of_birth,callback:function(t){e.date_of_birth=t},expression:"date_of_birth"}})],1)]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"email"}},[e._v("Email")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.email,expression:"email",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"email",name:"email",id:"email"},domProps:{value:e.email},on:{input:function(t){t.target.composing||(e.email=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"gender"}},[e._v("Gender")]),a("select",{directives:[{name:"model",rawName:"v-model.trim",value:e.gender,expression:"gender",modifiers:{trim:!0}}],staticClass:"custom-select",attrs:{name:"gender",id:"gender"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.gender=t.target.multiple?a:a[0]}}},[a("option",{attrs:{value:""}},[e._v("Select")]),a("option",{attrs:{value:"Male"}},[e._v("Male")]),a("option",{attrs:{value:"Female"}},[e._v("Female")])])])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"grade"}},[e._v("Grade")]),a("select",{directives:[{name:"model",rawName:"v-model.trim",value:e.grade,expression:"grade",modifiers:{trim:!0}}],staticClass:"custom-select",attrs:{name:"grade",id:"grade"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.grade=t.target.multiple?a:a[0]}}},[a("option",{attrs:{value:""}},[e._v("Select")]),a("option",{attrs:{value:"Primary"}},[e._v("Primary")]),a("option",{attrs:{value:"Junior High"}},[e._v("Junior High")]),a("option",{attrs:{value:"Senior High"}},[e._v("Senior High")]),a("option",{attrs:{value:"College"}},[e._v("College")]),a("option",{attrs:{value:"None"}},[e._v("None")])])])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"marital_status"}},[e._v("Marital Status")]),a("select",{directives:[{name:"model",rawName:"v-model.trim",value:e.marital_status,expression:"marital_status",modifiers:{trim:!0}}],staticClass:"custom-select",attrs:{name:"marital_status",id:"marital_status"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.marital_status=t.target.multiple?a:a[0]}}},[a("option",{attrs:{value:""}},[e._v("Select")]),a("option",{attrs:{value:"Single"}},[e._v("Single")]),a("option",{attrs:{value:"Married"}},[e._v("Married")]),a("option",{attrs:{value:"Widowed"}},[e._v("Widowed")]),a("option",{attrs:{value:"Engaged"}},[e._v("Engaged")]),a("option",{attrs:{value:"Divorced"}},[e._v("Divorced")])])])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"member_status"}},[e._v("Membership Status")]),a("select",{directives:[{name:"model",rawName:"v-model.trim",value:e.member_status,expression:"member_status",modifiers:{trim:!0}}],staticClass:"custom-select",attrs:{name:"member_status",id:"member_status"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.member_status=t.target.multiple?a:a[0]}}},[a("option",{attrs:{value:""}},[e._v("Select")]),a("option",{attrs:{value:"1"}},[e._v("Member")]),a("option",{attrs:{value:"2"}},[e._v("Guest")]),a("option",{attrs:{value:"3"}},[e._v("Distant Member")]),a("option",{attrs:{value:"4"}},[e._v("Pre Member")])])])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"baptism_date"}},[e._v("Baptismal Date")]),a("flat-pickr",{staticClass:"form-control bg-white",attrs:{placeholder:"Select Date",config:e.config,name:"baptism_date",id:"baptism_date "},model:{value:e.baptism_date,callback:function(t){e.baptism_date=t},expression:"baptism_date"}})],1)]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"join_date"}},[e._v("Join Date")]),a("flat-pickr",{staticClass:"form-control bg-white",attrs:{config:e.config,placeholder:"Select Date",name:"join_date",id:"join_date"},model:{value:e.join_date,callback:function(t){e.join_date=t},expression:"join_date"}})],1)]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"employer"}},[e._v("Employer")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.employer,expression:"employer",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"employer ",id:"employer "},domProps:{value:e.employer},on:{input:function(t){t.target.composing||(e.employer=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"occupation"}},[e._v("Occupation")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.occupation,expression:"occupation",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"occupation ",id:"occupation "},domProps:{value:e.occupation},on:{input:function(t){t.target.composing||(e.occupation=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"primary_telephone"}},[e._v("Primary Telephone")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.primary_telephone,expression:"primary_telephone",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"primary_telephone",id:"primary_telephone"},domProps:{value:e.primary_telephone},on:{input:function(t){t.target.composing||(e.primary_telephone=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"secondary_telephone"}},[e._v("Secondary Telephone")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.secondary_telephone,expression:"secondary_telephone",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"secondary_telephone",id:"secondary_telephone"},domProps:{value:e.secondary_telephone},on:{input:function(t){t.target.composing||(e.secondary_telephone=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"postal_address"}},[e._v("Postal Address")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.postal_address,expression:"postal_address",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"postal_address",id:"postal_address"},domProps:{value:e.postal_address},on:{input:function(t){t.target.composing||(e.postal_address=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"physical_address"}},[e._v("Physical Address")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.physical_address,expression:"physical_address",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"physical_address",id:"physical_address"},domProps:{value:e.physical_address},on:{input:function(t){t.target.composing||(e.physical_address=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"tithe_number"}},[e._v("Tithe Number")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.tithe_number,expression:"tithe_number",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"tithe_number",id:"tithe_number"},domProps:{value:e.tithe_number},on:{input:function(t){t.target.composing||(e.tithe_number=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"role"}},[e._v("Groups")]),a("MultiSelect",{staticClass:"form-control",attrs:{options:e.groups,filter:!0,optionValue:"id",optionLabel:"name",placeholder:"Select Group"},model:{value:e.group,callback:function(t){e.group=t},expression:"group"}})],1)]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"family"}},[e._v("Family")]),a("select",{directives:[{name:"model",rawName:"v-model",value:e.family,expression:"family"}],staticClass:"custom-select",attrs:{name:"family",id:"family"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.family=t.target.multiple?a:a[0]}}},[a("option",{attrs:{value:""}},[e._v("Choose Family")]),a("option",{attrs:{disabled:""}},[e._v("---------------")]),a("option",{attrs:{value:"-1"}},[e._v("Create a new family using surname")]),e._l(e.families,(function(t,r){return a("option",{key:r,domProps:{value:t.id}},[e._v(e._s(t.name)+"---"+e._s(t.id))])}))],2)])]),e.family?a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"relation"}},[e._v("Family Relation")]),a("select",{directives:[{name:"model",rawName:"v-model",value:e.relation,expression:"relation"}],staticClass:"custom-select",attrs:{name:"relation",id:"relation"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.relation=t.target.multiple?a:a[0]}}},[a("option",{attrs:{value:""}},[e._v("Choose relation")]),a("option",{attrs:{disabled:""}},[e._v("---------------")]),a("option",{attrs:{value:"Head"}},[e._v("Head")]),a("option",{attrs:{value:"Spouse"}},[e._v("Spouse")]),a("option",{attrs:{value:"Children"}},[e._v("Children")]),a("option",{attrs:{value:"Sibling"}},[e._v("Sibling")]),a("option",{attrs:{value:"Grand Parent"}},[e._v("Grand Parent")])])])]):e._e(),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"next_of_kin_name"}},[e._v("Next of Kin")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.next_of_kin_name,expression:"next_of_kin_name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"next_of_kin_name",id:"next_of_kin_name"},domProps:{value:e.next_of_kin_name},on:{input:function(t){t.target.composing||(e.next_of_kin_name=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"next_of_kin_telephone"}},[e._v("Next of Kin Telephone")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.next_of_kin_telephone,expression:"next_of_kin_telephone",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"next_of_kin_telephone",id:"next_of_kin_telephone"},domProps:{value:e.next_of_kin_telephone},on:{input:function(t){t.target.composing||(e.next_of_kin_telephone=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"emergency_telephone"}},[e._v("Emergency Telephone")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.emergency_telephone,expression:"emergency_telephone",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"emergency_telephone",id:"emergency_telephone"},domProps:{value:e.emergency_telephone},on:{input:function(t){t.target.composing||(e.emergency_telephone=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"comments"}},[e._v("Comments *")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.comments,expression:"comments",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"comments",id:"comments",required:""},domProps:{value:e.comments},on:{input:function(t){t.target.composing||(e.comments=t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}})])])]),a("div",{staticClass:"text-center"},[a("div",{staticClass:"form-group mt-5"},[a("button",{ref:"submitBtn",staticClass:"btn btn-success px-5"},[e._v(" Save ")])])])])])])])])])},n=[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("label",{attrs:{for:"imageUpload"}},[a("i",{staticClass:"pi pi-pencil",staticStyle:{position:"absolute",top:"5px",left:"10px"}})])}],i=(a("4160"),a("d81d"),a("0d03"),a("d3b7"),a("07ac"),a("3ca3"),a("159b"),a("ddb0"),a("2b3d"),a("96cf"),a("1da1")),o=a("ade3"),s=a("ca16"),l=a("c38f"),c=a.n(l),u=(a("0952"),a("3ed8")),m=a("4cb8"),d=a("da63"),p=a("3d20"),f=a.n(p),v=a("86b0"),_=a.n(v),g={name:"PersonAdd",components:{flatPickr:c.a,MultiSelect:_.a},data:function(){var e;return e={first_name:"",last_name:"",middle_name:"",date_of_birth:"",email:"",gender:"",grade:"",marital_status:"",member_status:"",baptism_date:"",join_date:"",employer:"",occupation:"",primary_telephone:"",secondary_telephone:"",postal_address:"",physical_address:"",tithe_number:"",next_of_kin_name:"",next_of_kin_telephone:"",emergency_telephone:"",image:"",family:"",relation:"",group:[],groups:[],families:[],profile:""},Object(o["a"])(e,"groups",[]),Object(o["a"])(e,"mask",""),Object(o["a"])(e,"config",{maxDate:new Date}),Object(o["a"])(e,"comments",""),e},computed:{avatar:function(){return{backgroundImage:"url("+this.profile+")"}}},methods:{updatePerson:function(e){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function e(){var a,r,n,i,o,l,c,m;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return a=t.$refs.submitBtn,r=t.$refs.formMsg,e.prev=2,Object(s["a"])(a),n=new FormData,n.append("avatar",t.profile),n.append("first_name",t.first_name),n.append("last_name",t.last_name),n.append("middle_name",t.middle_name),n.append("date_of_birth",t.date_of_birth),n.append("email",t.email),n.append("gender",t.gender),n.append("grade",t.grade),n.append("marital_status",t.marital_status),n.append("member_status",t.member_status),n.append("baptism_date",t.baptism_date),n.append("baptism_date",t.baptism_date),n.append("join_date",t.join_date),n.append("employer",t.employer),n.append("occupation",t.occupation),n.append("primary_telephone",t.primary_telephone),n.append("secondary_telephone",t.secondary_telephone),n.append("postal_address",t.postal_address),n.append("physical_address",t.physical_address),n.append("tithe_number",t.tithe_number),n.append("emergency_telephone",t.emergency_telephone),n.append("next_of_kin_name",t.next_of_kin_name),n.append("next_of_kin_telephone",t.next_of_kin_telephone),n.append("family",t.family),n.append("relation",t.relation),t.group.forEach((function(e){n.append("groups[]",e)})),e.next=33,u["a"].update(n,t.mask);case 33:i=e.sent,o=i.data,Object(s["b"])(a),f.a.fire("Success",o.message,"success"),t.$router.push({name:"people"}),e.next=46;break;case 40:e.prev=40,e.t0=e["catch"](2),l=e.t0.response.data,c="",422===l.code?(Object(s["b"])(a),m=Object.values(l.errors),m.map((function(e){c+='<span class="d-block">'.concat(e,"</span>")}))):c+=l.message,r.innerHTML='<div class="alert alert-danger">'.concat(c,"</div>");case 46:case"end":return e.stop()}}),e,null,[[2,40]])})))()},setData:function(e){var t=e[1].data.data;this.groups=e[0].data.data,this.first_name=t.first_name,this.last_name=t.last_name,this.middle_name=t.middle_name,this.email=t.email,this.gender=t.gender,this.marital_status=t.marital_status,this.member_status=t.member_status,this.baptism_date=t.baptism_date,this.date_of_birth=t.date_of_birth,this.join_date=t.join_date,this.employer=t.employer,this.occupation=t.occupation,this.primary_telephone=t.primary_telephone,this.secondary_telephone=t.secondary_telephone,this.postal_address=t.postal_address,this.physical_address=t.physical_address,this.tithe_number=t.tithe_number,this.group=t.groups,this.mask=t.mask,this.profile=t.avatar,this.next_of_kin_telephone=t.next_of_kin_telephone,this.next_of_kin_name=t.next_of_kin_name,this.emergency_telephone=t.emergency_telephone,this.family=t.family?t.family.id:"",this.relation=t.family?t.family.relation:""},changeImage:function(e){var t=e.target.files[0];if(t.size/1024/1024>2)f.a.fire("Error","The file must be less than 2MB","error");else{var a=URL.createObjectURL(t),r=this.$refs.imagePreview;r.setAttribute("style","background-image:url(".concat(a,")")),this.profile=t}},getFamilies:function(){var e=this;return Object(i["a"])(regeneratorRuntime.mark((function t(){var a,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,d["a"].all();case 3:a=t.sent,r=a.data,e.families=r.data,t.next=11;break;case 8:t.prev=8,t.t0=t["catch"](0),console.log(t.t0);case 11:case"end":return t.stop()}}),t,null,[[0,8]])})))()}},created:function(){var e=this;return Object(i["a"])(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,e.getFamilies();case 2:case"end":return t.stop()}}),t)})))()},beforeRouteEnter:function(e,t,a){return Object(i["a"])(regeneratorRuntime.mark((function t(){var r,n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,r=e.params.mask,r||a({name:"Home"}),t.next=5,Promise.all([m["a"].all(),u["a"].show(r)]);case 5:n=t.sent,a((function(e){return e.setData(n)})),t.next=12;break;case 9:t.prev=9,t.t0=t["catch"](0),console.log(t.t0);case 12:case"end":return t.stop()}}),t,null,[[0,9]])})))()}},h=g,b=a("2877"),y=Object(b["a"])(h,r,n,!1,null,null,null);t["default"]=y.exports},c840:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var r=n(a("3a94"));function n(e){return e&&e.__esModule?e:{default:e}}function i(e){e.addEventListener("mousedown",c),e.addEventListener("mouseleave",u)}function o(e){e.removeEventListener("mousedown",c),e.removeEventListener("mouseleave",u)}function s(e){var t=document.createElement("span");t.className="p-ink",e.appendChild(t),t.addEventListener("animationend",d)}function l(e){var t=p(e);t&&(o(e),t.removeEventListener("animationend",d),t.remove())}function c(e){var t=e.currentTarget,a=p(t);if(a&&"none"!==getComputedStyle(a,null).display){if(r.default.removeClass(a,"p-ink-active"),!r.default.getHeight(a)&&!r.default.getWidth(a)){var n=Math.max(r.default.getOuterWidth(t),r.default.getOuterHeight(t));a.style.height=n+"px",a.style.width=n+"px"}var i=r.default.getOffset(t),o=e.pageX-i.left+document.body.scrollTop-r.default.getWidth(a)/2,s=e.pageY-i.top+document.body.scrollLeft-r.default.getHeight(a)/2;a.style.top=s+"px",a.style.left=o+"px",r.default.addClass(a,"p-ink-active")}}function u(e){m(e)}function m(e){var t=e.target,a=p(t);a&&r.default.removeClass(a,"p-ink-active")}function d(e){r.default.removeClass(e.currentTarget,"p-ink-active")}function p(e){for(var t=0;t<e.children.length;t++)if(-1!==e.children[t].className.indexOf("p-ink"))return e.children[t];return null}var f={inserted:function(e,t,a){a.context.$primevue&&a.context.$primevue.ripple&&(s(e),i(e))},unbind:function(e){l(e)}},v=f;t.default=v},c8d2:function(e,t,a){var r=a("d039"),n=a("5899"),i="​᠎";e.exports=function(e){return r((function(){return!!n[e]()||i[e]()!=i||n[e].name!==e}))}},c975:function(e,t,a){"use strict";var r=a("23e7"),n=a("4d64").indexOf,i=a("a640"),o=a("ae40"),s=[].indexOf,l=!!s&&1/[1].indexOf(1,-0)<0,c=i("indexOf"),u=o("indexOf",{ACCESSORS:!0,1:0});r({target:"Array",proto:!0,forced:l||!c||!u},{indexOf:function(e){return l?s.apply(this,arguments)||0:n(this,e,arguments.length>1?arguments[1]:void 0)}})},d81d:function(e,t,a){"use strict";var r=a("23e7"),n=a("b727").map,i=a("1dde"),o=a("ae40"),s=i("map"),l=o("map");r({target:"Array",proto:!0,forced:!s||!l},{map:function(e){return n(this,e,arguments.length>1?arguments[1]:void 0)}})},da63:function(e,t,a){"use strict";var r=a("451b");t["a"]={all:function(){return r["b"].get("/staff/family")},store:function(e){return r["b"].post("/staff/family",e)},show:function(e){return r["b"].get("/staff/family/"+e)},update:function(e,t){return r["b"].put("/staff/family/"+t,e)},delete:function(e){return r["b"]["delete"]("/staff/family/"+e)}}}}]);
//# sourceMappingURL=chunk-5e518350.0c804fe4.js.map