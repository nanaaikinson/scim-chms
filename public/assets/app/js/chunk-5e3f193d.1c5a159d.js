(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5e3f193d"],{"2be5":function(t,e,a){},"404c":function(t,e,a){"use strict";t.exports=a("6361")},"7cd9":function(t,e,a){"use strict";var s=a("451b");e["a"]={all:function(){return s["a"].get("/staff/follow-up")},store:function(t){return s["a"].post("/staff/follow-up",t)},show:function(t){return s["a"].get("/staff/follow-up/"+t)},update:function(t,e){return s["a"].put("/staff/follow-up/"+e,t)},delete:function(t){return s["a"]["delete"]("/staff/follow-up/"+t)}}},a9f5:function(t,e,a){"use strict";var s=a("451b");e["a"]={all:function(){return s["a"].get("/staff/users")},store:function(t){return s["a"].post("/staff/users",t)},show:function(t){return s["a"].get("/staff/users/"+t)},update:function(t,e){return s["a"].put("/staff/users/"+e,t)},delete:function(t){return s["a"]["delete"]("/staff/users/"+t)}}},f79c:function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"card"},[a("div",{staticClass:"card-body"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-8 offset-md-2"},[a("div",{ref:"formMsg",staticClass:"formMsg"}),a("ValidationObserver",{ref:"validationObserver"},[a("form",{on:{submit:function(e){return e.preventDefault(),t.createFollowUp(e)}}},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6"},[a("ValidationProvider",{attrs:{name:"People field",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var s=e.errors;return[a("div",{staticClass:"form-group"},[a("label",{staticClass:"d-block",attrs:{for:"people"}},[t._v(" People "),a("span",{staticClass:"text-danger"},[t._v("*")])]),a("MultiSelect",{staticClass:"form-control",attrs:{options:t.people,optionLabel:"name",optionValue:"id",filter:"",required:""},model:{value:t.form.people,callback:function(e){t.$set(t.form,"people",e)},expression:"form.people"}}),a("span",{staticClass:"text-danger d-block"},[t._v(t._s(s[0]))])],1)]}}])})],1),a("div",{staticClass:"col-md-6"},[a("ValidationProvider",{attrs:{name:"Assigned to",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var s=e.errors;return[a("div",{staticClass:"form-group"},[a("label",{staticClass:"d-block",attrs:{for:"assigned_to"}},[t._v(" Assigned To "),a("span",{staticClass:"text-danger"},[t._v("*")])]),a("Dropdown",{staticClass:"form-control",attrs:{options:t.users,optionLabel:"name",optionValue:"id",filter:"",required:""},model:{value:t.form.assigned_to,callback:function(e){t.$set(t.form,"assigned_to",e)},expression:"form.assigned_to"}}),a("span",{staticClass:"text-danger d-block"},[t._v(t._s(s[0]))])],1)]}}])})],1),a("div",{staticClass:"col-md-6"},[a("ValidationProvider",{attrs:{name:"Follow-up date",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var s=e.errors;return[a("div",{staticClass:"form-group"},[a("label",{staticClass:"d-block",attrs:{for:"date"}},[t._v(" Follow-Up Date "),a("span",{staticClass:"text-danger"},[t._v("*")])]),a("DatePicker",{staticClass:"form-control bg-white",attrs:{id:"date",placeholder:"Select date",config:t.dateConfig},model:{value:t.form.date,callback:function(e){t.$set(t.form,"date",e)},expression:"form.date"}}),a("span",{staticClass:"text-danger d-block"},[t._v(t._s(s[0]))])],1)]}}])})],1),a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group"},[a("label",{staticClass:"d-block",attrs:{for:""}},[t._v(" Follow-up Type "),a("span",{staticClass:"text-danger"},[t._v("*")])]),a("Dropdown",{staticClass:"form-control",attrs:{options:t.visitTypes,optionLabel:"name",optionValue:"id",required:""},model:{value:t.form.type,callback:function(e){t.$set(t.form,"type",e)},expression:"form.type"}})],1)]),a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group"},[a("div",{staticClass:"custom-control custom-checkbox"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.completed,expression:"form.completed"}],staticClass:"custom-control-input",attrs:{type:"checkbox",id:"done"},domProps:{checked:Array.isArray(t.form.completed)?t._i(t.form.completed,null)>-1:t.form.completed},on:{change:function(e){var a=t.form.completed,s=e.target,o=!!s.checked;if(Array.isArray(a)){var r=null,n=t._i(a,r);s.checked?n<0&&t.$set(t.form,"completed",a.concat([r])):n>-1&&t.$set(t.form,"completed",a.slice(0,n).concat(a.slice(n+1)))}else t.$set(t.form,"completed",o)}}}),a("label",{staticClass:"custom-control-label",attrs:{for:"done"}},[t._v("Done")])]),t.form.completed?a("div",{},[a("keep-alive",[a("ValidationProvider",{attrs:{name:"Completion date",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var s=e.errors;return[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:""}},[t._v(" Completion Date "),a("span",{staticClass:"text-danger"},[t._v("*")])]),a("DatePicker",{staticClass:"form-control bg-white",attrs:{id:"completion_date",placeholder:"Select date",config:t.dateConfig},model:{value:t.form.completion_date,callback:function(e){t.$set(t.form,"completion_date",e)},expression:"form.completion_date"}}),a("span",{staticClass:"text-danger d-block"},[t._v(t._s(s[0]))])],1)]}}],null,!1,3603159698)})],1)],1):t._e()])]),a("div",{staticClass:"col-md-12"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:"comment"}},[t._v("Comment")]),a("textarea",{directives:[{name:"model",rawName:"v-model",value:t.form.comment,expression:"form.comment"}],staticClass:"form-control",attrs:{name:"comment",id:"comment",cols:"30",rows:"5"},domProps:{value:t.form.comment},on:{input:function(e){e.target.composing||t.$set(t.form,"comment",e.target.value)}}})])]),a("div",{staticClass:"col-md-12"},[a("div",{staticClass:"text-center"},[a("button",{ref:"submitBtn",staticClass:"btn btn-success px-5",attrs:{type:"submit"}},[t._v("Save")])])])])])])],1)])])])])},o=[],r=(a("d81d"),a("b0c0"),a("07ac"),a("5530")),n=(a("96cf"),a("1da1")),l=a("3d20"),c=a.n(l),i=a("ca16"),d=a("86b0"),u=a.n(d),f=a("404c"),m=a.n(f),p=a("7cd9"),v=a("3ed8"),b=a("a9f5"),C=a("c38f"),g=a.n(C),_=(a("2be5"),{name:"AddFollowUp",components:{MultiSelect:u.a,Dropdown:m.a,DatePicker:g.a},data:function(){return{people:[],users:[],form:{people:[],assigned_to:null,date:null,completion_date:null,type:1,completed:!1,comment:""},visitTypes:[{id:1,name:"Visit"},{id:2,name:"Phone"},{id:3,name:"Message"}],dateConfig:{altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d",allowInput:!0}}},methods:{setData:function(){var t=this;return Object(n["a"])(regeneratorRuntime.mark((function e(){var a,s,o,r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,v["a"].members();case 2:return a=e.sent,e.next=5,b["a"].all();case 5:return s=e.sent,e.next=8,a.data;case 8:return o=e.sent,e.next=11,s.data;case 11:r=e.sent,t.people=o.data.map((function(t){return{id:t.id,name:t.name}})),t.users=r.data.map((function(t){return{id:t.id,name:t.name}}));case 14:case"end":return e.stop()}}),e)})))()},createFollowUp:function(t){var e=this;this.$refs.validationObserver.validate().then((function(t){if(t){var a=e.$refs.submitBtn,s=e.$refs.formMsg;s.innerHTML="",Object(i["a"])(a);var o=Object(r["a"])(Object(r["a"])({},e.form),{},{completed:e.form.completed?1:0});p["a"].store(o).then((function(t){var a=t.data;c.a.fire("Success",a.message,"success"),e.$router.push({name:"FollowUp"})}))["catch"]((function(t){removeBtnLoading(a);var e=t.response,o=e.status,r=e.data,n="";422===o?Object.values(r.errors).map((function(t){n+='<span class="d-block">'.concat(t,"</span>")})):n+='<span class="d-block">'.concat(r.message,"</span>"),s.innerHTML='<div class="alert alert-danger">'.concat(n,"</div>")}))}}))}},beforeRouteEnter:function(t,e,a){a((function(t){t.setData(),a()}))}}),w=_,k=a("2877"),x=Object(k["a"])(w,s,o,!1,null,null,null);e["default"]=x.exports}}]);
//# sourceMappingURL=chunk-5e3f193d.1c5a159d.js.map