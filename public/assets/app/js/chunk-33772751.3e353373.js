(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-33772751"],{"01e9":function(t,e,a){"use strict";var n=a("451b");e["a"]={all:function(){return n["a"].get("/staff/attendance")},store:function(t){return n["a"].post("/staff/attendance",t)},show:function(t){return n["a"].get("/staff/attendance/"+t)},update:function(t,e){return n["a"].post("/staff/attendance/"+e,t)},delete:function(t){return n["a"]["delete"]("/staff/attendance/"+t)},download:function(t){return n["a"].get("/staff/attendance/".concat(t,"/download"))},template:function(t){return n["a"].get("/staff/attendance/template",t)}}},"0952":function(t,e,a){},"4cb8":function(t,e,a){"use strict";var n=a("451b");e["a"]={all:function(){return n["a"].get("/staff/groups")},store:function(t){return n["a"].post("/staff/groups",t)},show:function(t){return n["a"].get("/staff/groups/"+t)},update:function(t,e){return n["a"].put("/staff/groups/"+e,t)},delete:function(t){return n["a"]["delete"]("/staff/groups/"+t)}}},6526:function(t,e,a){},"692e":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"card"},[a("div",{staticClass:"card-body"},[a("div",{staticClass:"col-md-8 offset-md-2"},[a("Steps",{attrs:{current:t.current,status:t.stepStatus}},[a("Step",{attrs:{title:"Download Template"}}),a("Step",{attrs:{title:"Upload Data File"}}),a("Step",{attrs:{title:"Import Attendance"}})],1),a("keep-alive",[0===t.current?a("StepOne",{attrs:{formModel:t.form},on:{"set-step":t.changeStep}}):t._e()],1),a("keep-alive",[1===t.current?a("StepTwo",{attrs:{file:t.form.file},on:{"set-step":t.changeStep,"set-back":t.changeStepBack,"set-file":t.setFile}}):t._e()],1),2===t.current?a("StepThree",{on:{"set-back":t.changeStepBack,"submit-data":t.submitData}}):t._e()],1)])])])},r=[],s=(a("d81d"),a("b0c0"),a("07ac"),a("96cf"),a("1da1")),o=a("f825"),i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._m(0),a("div",[a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"name"}},[t._v("Name *")]),a("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.name,expression:"name",modifiers:{trim:!0}}],staticClass:"form-control",attrs:{type:"text",name:"name",id:"name"},domProps:{value:t.name},on:{input:function(e){e.target.composing||(t.name=e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}})])]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"date"}},[t._v("Date *")]),a("flat-pickr",{staticClass:"form-control bg-white",attrs:{placeholder:"Select Date",name:"date",id:"date"},model:{value:t.date,callback:function(e){t.date="string"===typeof e?e.trim():e},expression:"date"}})],1)]),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"type"}},[t._v("Type *")]),a("select",{directives:[{name:"model",rawName:"v-model.trim",value:t.type,expression:"type",modifiers:{trim:!0}}],staticClass:"custom-select",attrs:{name:"type",id:"type"},on:{change:[function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.type=e.target.multiple?a:a[0]},t.onChangeAttendanceType]}},[a("option",{attrs:{value:""}},[t._v("Select type")]),a("option",{attrs:{disabled:""}},[t._v("----------------")]),a("option",{attrs:{value:"1"}},[t._v("General")]),a("option",{attrs:{value:"2"}},[t._v("Group")])])])]),2===t.type?a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"group"}},[t._v("Group *")]),a("select",{directives:[{name:"model",rawName:"v-model.trim",value:t.group,expression:"group",modifiers:{trim:!0}}],staticClass:"custom-select",attrs:{name:"group",id:"group"},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.group=e.target.multiple?a:a[0]}}},[a("option",{attrs:{value:""}},[t._v("Select group")]),a("option",{attrs:{disabled:""}},[t._v("----------------")]),t._l(t.groups,(function(e,n){return a("option",{key:n,domProps:{value:e.id}},[t._v(t._s(e.name))])}))],2)])]):t._e()]),a("div",{},[a("div",{staticClass:"mb-3"},[a("button",{ref:"downloadTem",staticClass:"btn btn-primary",attrs:{type:"button",disabled:t.disableProgessButton},on:{click:function(e){return t.downloadTemplate(e)}}},[t._v(" Download Template ")])]),a("div",[a("button",{staticClass:"btn btn-success",attrs:{disabled:t.disableProgessButton},on:{click:t.next}},[t._v(" Next ")])])])])])},c=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"alert alert-info mb-3 mt-4"},[a("h5",[t._v("Notes about how to import attendance from excel file")]),a("ul",{staticClass:"pl-3 mt-2"},[a("li",[t._v("Enter a name for the attendance to be taken for")]),a("li",[t._v("Select the type of attendance")]),a("li",[t._v(" Please make sure you've created a group if you wanna take attendance for a group ")]),a("li",[t._v(" All fields marked * are required ")])])])}],u=(a("e25e"),a("4cb8")),l=a("01e9"),p=a("c38f"),d=a.n(p),f=(a("0952"),a("ca16")),m=a("3d20"),v=a.n(m),b={data:function(){return{groups:[]}},components:{flatPickr:d.a},props:{formModel:{type:Object,required:!0}},computed:{name:{get:function(){return this.formModel.name},set:function(t){this.formModel.name=t}},type:{get:function(){return this.formModel.type},set:function(t){this.formModel.type=t}},group:{get:function(){return this.formModel.group_id},set:function(t){this.formModel.group_id=t}},date:{get:function(){return this.formModel.date},set:function(t){this.formModel.date=t}},disableProgessButton:function(){return(!this.name||1!==this.type||!this.date)&&!(this.name&&2===this.type&&this.group&&this.date)}},methods:{onChangeAttendanceType:function(t){var e=this;return Object(s["a"])(regeneratorRuntime.mark((function a(){var n,r,s;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:if(a.prev=0,n=parseInt(t.target.value),n){a.next=4;break}return a.abrupt("return");case 4:if(2!==n){a.next=13;break}if(!e.groups.length){a.next=8;break}return e.formModel.type=n,a.abrupt("return");case 8:return a.next=10,u["a"].all();case 10:r=a.sent,s=r.data.data,e.groups=s;case 13:e.formModel.type=n,a.next=19;break;case 16:a.prev=16,a.t0=a["catch"](0),console.log(a.t0.message);case 19:case"end":return a.stop()}}),a,null,[[0,16]])})))()},next:function(){this.disableProgessButton||this.$emit("set-step")},downloadTemplate:function(t,e){var a=this,n=this.$refs.downloadTem;Object(s["a"])(regeneratorRuntime.mark((function t(){var e,r,s,o,i,c,u,p;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.prev=0,Object(f["a"])(n),e={params:{type:a.type}},2===a.type?e.params.group_id=a.group:delete e.params.group_id,t.next=6,l["a"].template(e);case 6:r=t.sent,Object(f["b"])(n),s=r.data,o=s.data,i=o.url,c=o.filename,u=document.createElement("a"),u.setAttribute("download",c),u.setAttribute("href",i),document.body.appendChild(u),u.click(),document.body.removeChild(u),t.next=23;break;case 18:t.prev=18,t.t0=t["catch"](0),p=t.t0.response.data,v.a.fire({icon:"error",title:p.message}),Object(f["b"])(n);case 23:case"end":return t.stop()}}),t,null,[[0,18]])})))()}},created:function(){var t=this;return Object(s["a"])(regeneratorRuntime.mark((function e(){var a,n;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,u["a"].all();case 2:a=e.sent,n=a.data.data,t.groups=n;case 5:case"end":return e.stop()}}),e)})))()}},h=b,g=a("2877"),_=Object(g["a"])(h,i,c,!1,null,null,null),w=_.exports,y=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._m(0),a("div",[a("BFormFile",{staticClass:"mb-3",attrs:{plain:""},model:{value:t.uploadFile,callback:function(e){t.uploadFile=e},expression:"uploadFile"}}),a("div",{staticClass:"d-flex justify-content-between"},[a("button",{staticClass:"btn btn-primary mr-3",on:{click:t.previous}},[t._v("Previous")]),a("button",{staticClass:"btn btn-success",attrs:{disabled:t.disableProgessButton},on:{click:t.next}},[t._v(" Next ")])])],1)])},k=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"alert alert-info mb-3 mt-4"},[a("p",{staticClass:"mb-0"},[t._v("Please upload the data file.")])])}],x=a("c43f"),S={name:"StepTwo",components:{BFormFile:x["a"]},props:["file"],data:function(){return{uploadFile:null}},computed:{disableProgessButton:function(){return!this.file}},watch:{uploadFile:function(t){this.$emit("set-file",t)}},methods:{next:function(t){this.$emit("set-step")},previous:function(t){this.$emit("set-back")}}},C=S,j=Object(g["a"])(C,y,k,!1,null,null,null),O=j.exports,$=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._m(0),a("div",[a("div",{staticClass:"d-flex justify-content-between"},[a("button",{ref:"previousBtn",staticClass:"btn btn-primary mr-3",on:{click:t.previous}},[t._v(" Previous ")]),a("button",{ref:"submitBtn",staticClass:"btn btn-success",on:{click:t.submitData}},[t._v(" Submit ")])])])])},B=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"alert alert-info mb-3 mt-4"},[a("p",{staticClass:"mb-0"},[t._v("Please submit file.")])])}],T={name:"StepThree",data:function(){return{}},methods:{previous:function(t){this.$emit("set-back")},submitData:function(t){this.$emit("submit-data",this.$refs.submitBtn,this.$refs.previousBtn)}}},P=T,F=Object(g["a"])(P,$,B,!1,null,null,null),D=F.exports,E={name:"AttendanceEdit",components:{Steps:o["Steps"],Step:o["Step"],StepOne:w,StepTwo:O,StepThree:D},data:function(){return{stepStatus:"process",currentStep:0,form:{name:"",date:"",type:"",group_id:"",file:null},loading:!1,mask:""}},computed:{current:function(){return this.currentStep}},methods:{changeStep:function(){this.currentStep+=1},changeStepBack:function(){this.currentStep-=1},changeStepStatus:function(t){this.stepStatus=t},setFile:function(t){this.form.file=t},submitData:function(t,e){var a=this;return Object(s["a"])(regeneratorRuntime.mark((function n(){var r,s,o,i,c,u;return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:return n.prev=0,Object(f["a"])(t),Object(f["a"])(e),r=new FormData,r.append("name",a.form.name),r.append("type",a.form.type),r.append("date",a.form.date),r.append("file",a.form.file),r.append("group",a.form.group_id?a.form.group_id:""),n.next=11,l["a"].update(r,a.mask);case 11:s=n.sent,o=s.data,Object(f["b"])(t),Object(f["b"])(e),v.a.fire("Success",o.message,"success"),a.$router.push({name:"attendance"}),n.next=27;break;case 19:n.prev=19,n.t0=n["catch"](0),Object(f["b"])(t),Object(f["b"])(e),i=n.t0.response.data,c="",422===i.code?(u=Object.values(i.errors),u.map((function(t){c+='<span class="d-block">'.concat(t,"</span>")}))):c+=i.message,v.a.fire("Error",c,"error");case 27:case"end":return n.stop()}}),n,null,[[0,19]])})))()},setData:function(t){var e=t.data.attendance;this.form.name=e.name,this.form.date=e.date,this.form.type=e.type,this.form.group_id=e.group_id,this.mask=e.mask}},beforeRouteEnter:function(t,e,a){return Object(s["a"])(regeneratorRuntime.mark((function e(){var n,r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.prev=0,n=t.params.mask,n||a({name:"Home"}),e.next=5,l["a"].show(n);case 5:r=e.sent,a((function(t){return t.setData(r.data)})),e.next=12;break;case 9:e.prev=9,e.t0=e["catch"](0),console.log(e.t0);case 12:case"end":return e.stop()}}),e,null,[[0,9]])})))()}},M=E,R=(a("7d20"),Object(g["a"])(M,n,r,!1,null,"a21284da",null));e["default"]=R.exports},"7d20":function(t,e,a){"use strict";var n=a("6526"),r=a.n(n);r.a},c20d:function(t,e,a){var n=a("da84"),r=a("58a8").trim,s=a("5899"),o=n.parseInt,i=/^[+-]?0[Xx]/,c=8!==o(s+"08")||22!==o(s+"0x16");t.exports=c?function(t,e){var a=r(String(t));return o(a,e>>>0||(i.test(a)?16:10))}:o},d81d:function(t,e,a){"use strict";var n=a("23e7"),r=a("b727").map,s=a("1dde"),o=a("ae40"),i=s("map"),c=o("map");n({target:"Array",proto:!0,forced:!i||!c},{map:function(t){return r(this,t,arguments.length>1?arguments[1]:void 0)}})},e25e:function(t,e,a){var n=a("23e7"),r=a("c20d");n({global:!0,forced:parseInt!=r},{parseInt:r})}}]);
//# sourceMappingURL=chunk-33772751.3e353373.js.map