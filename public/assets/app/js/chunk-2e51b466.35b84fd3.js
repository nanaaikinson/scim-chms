(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2e51b466"],{"8c69":function(t,o,n){"use strict";var e=n("451b");o["a"]={all:function(){return e["b"].get("/staff/books")},store:function(t){return e["b"].post("/staff/books",t)},show:function(t){return e["b"].get("/staff/books/"+t)},update:function(t,o){return e["b"].post("/staff/books/"+o,t)},delete:function(t){return e["b"]["delete"]("/staff/books/"+t)},generateDownloadableLink:function(t){return e["b"].get("/staff/books/"+t+"/generate-link")},public:{all:function(){return e["b"].get("/staff/public/books")}}}},d467:function(t,o,n){"use strict";n.r(o);var e=function(){var t=this,o=t.$createElement,n=t._self._c||o;return n("div",{staticClass:"container"},[n("h4",{staticClass:"my-4"},[t._v("Welcome to SCIM's E-Book Store")]),n("div",{staticClass:"row"},t._l(t.books,(function(o){return n("div",{key:o.mask,staticClass:"col-md-3 col-lg-3 mb-3"},[n("div",{staticClass:"book-container"},[n("div",{staticClass:"image"},[n("img",{style:{backgroundImage:"url("+o.cover+")"},attrs:{src:o.cover,alt:o.title}})]),t._m(0,!0)])])})),0)])},s=[function(){var t=this,o=t.$createElement,n=t._self._c||o;return n("div",{staticClass:"content mt-3"},[n("button",{staticClass:"btn btn-info btn-block py-2"},[t._v("Read")])])}],a=n("8c69"),c={name:"Books",data:function(){return{books:[],loading:!0}},methods:{getBooks:function(){var t=this;a["a"]["public"].all().then((function(o){var n=o.data;t.books=n.data}))}},created:function(){this.getBooks()}},i=c,r=n("2877"),l=Object(r["a"])(i,e,s,!1,null,null,null);o["default"]=l.exports}}]);
//# sourceMappingURL=chunk-2e51b466.35b84fd3.js.map