(function(e){function t(t){for(var n,i,a=t[0],l=t[1],u=t[2],d=0,v=[];d<a.length;d++)i=a[d],Object.prototype.hasOwnProperty.call(s,i)&&s[i]&&v.push(s[i][0]),s[i]=0;for(n in l)Object.prototype.hasOwnProperty.call(l,n)&&(e[n]=l[n]);c&&c(t);while(v.length)v.shift()();return o.push.apply(o,u||[]),r()}function r(){for(var e,t=0;t<o.length;t++){for(var r=o[t],n=!0,a=1;a<r.length;a++){var l=r[a];0!==s[l]&&(n=!1)}n&&(o.splice(t--,1),e=i(i.s=r[0]))}return e}var n={},s={app:0},o=[];function i(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=e,i.c=n,i.d=function(e,t,r){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},i.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)i.d(r,n,function(t){return e[t]}.bind(null,n));return r},i.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="/";var a=window["webpackJsonp"]=window["webpackJsonp"]||[],l=a.push.bind(a);a.push=t,a=a.slice();for(var u=0;u<a.length;u++)t(a[u]);var c=l;o.push([0,"chunk-vendors"]),r()})({0:function(e,t,r){e.exports=r("56d7")},"034f":function(e,t,r){"use strict";var n=r("85ec"),s=r.n(n);s.a},"4d5c":function(e,t,r){},"523b":function(e,t,r){"use strict";var n=r("da0b"),s=r.n(n);s.a},"56d7":function(e,t,r){"use strict";r.r(t);r("e260"),r("e6cf"),r("cca6"),r("a79d");var n,s,o=r("a026"),i=r("95ae"),a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"vgl-menu",class:[{active:e.hover},e.menuStyle],on:{mouseleave:function(t){e.hover=!1}}},[r("div",{staticClass:"menu-container"},[e._t("menu"),r("transition",{attrs:{name:"fade"}},[r("ul",{directives:[{name:"show",rawName:"v-show",value:e.hover,expression:"hover"}],staticClass:"vgl-sub-menus"},e._l(e.subMenus,(function(t){return r("li",{key:t.id,domProps:{innerHTML:e._s(t.item)}})})),0)])],2)])},l=[],u=(r("4160"),r("159b"),{name:"RectangleMenu",props:{menuStyle:{type:String,required:!0}},data:function(){return{subMenus:[],hover:!1}},methods:{updateSubMenus:function(){var e=this,t=this.$el.querySelector("ul#menu-primary-menu > .menu-item.active");this.subMenus=[],t.querySelectorAll(".sub-menu > li").forEach((function(t,r){return e.subMenus.push({id:r,item:t.innerHTML})}))},mouseOver:function(e){if("a"==e.srcElement.nodeName.toLowerCase()){var t=this.$el.querySelectorAll("ul#menu-primary-menu > .menu-item");t.forEach((function(e){return e.classList.remove("active")})),e.target.parentNode.classList.add("active"),this.updateSubMenus(),this.hover=!0}}},mounted:function(){var e=this;this.$el.querySelectorAll("ul#menu-primary-menu > .menu-item > a").forEach((function(t){return t.addEventListener("mouseover",e.mouseOver)}));var t=this.$el.querySelector("ul#menu-primary-menu > .menu-item"),r=this.$el.querySelectorAll("ul#menu-primary-menu > .menu-item");r.forEach((function(e){return e.classList.remove("active")})),t.classList.add("active"),this.updateSubMenus()}}),c=u,d=(r("523b"),r("2877")),v=Object(d["a"])(c,a,l,!1,null,null,null),p=v.exports,m=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"vgl-mobile-hamburger-container"},[r("div",{staticClass:"mobile-hamburger",on:{click:e.hamburgerClicked}},[r("div",{class:["top-bar",{change:e.hamburgerActive}]}),r("div",{class:["middle-bar",{change:e.hamburgerActive}]}),r("div",{class:["bottom-bar",{change:e.hamburgerActive}]})])])},h=[],f={name:"MobileBurger",props:{},data:function(){return{hamburgerActive:!1}},methods:{hamburgerClicked:function(){this.hamburgerActive=!this.hamburgerActive,this.$eventBus.$emit("mobile-hamburger-clicked",this.hamburgerActive)}},mounted:function(){console.log("I'm mobile menu")}},b=f,g=(r("c3f5"),Object(d["a"])(b,m,h,!1,null,null,null)),_=g.exports,y=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{class:["vgl-mobile-menu",{active:e.showMobile}]},[r("div",{staticClass:"mobile-menu"},[e._t("mobile-menu")],2),e._t("mobile-middle"),e._t("mobile-bottom-menu")],2)},C=[],S={name:"MobileMenu",props:{},data:function(){return{showMobile:!1}},methods:{clickMenuItem:function(e){var t=e.target.querySelector("ul.sub-menu");console.log(t),t&&(t.classList.contains("active")?t.classList.remove("active"):t.classList.add("active")),e.target.classList.contains("active")?e.target.classList.remove("active"):e.target.classList.add("active")}},mounted:function(){var e=this;this.$eventBus.$on("mobile-hamburger-clicked",function(e){this.showMobile=e,console.log(this.showMobile),window.jQuery("header").toggleClass("active")}.bind(this)),this.$el.querySelectorAll(".mobile-menu > ul > li").forEach((function(t){return t.addEventListener("click",e.clickMenuItem)}))}},k=S,w=(r("8c23"),Object(d["a"])(k,y,C,!1,null,null,null)),M=w.exports,x=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"hello"},[r("h1",[e._v(e._s(e.msg))]),e._m(0),r("h3",[e._v("Installed CLI Plugins")]),e._m(1),r("h3",[e._v("Essential Links")]),e._m(2),r("h3",[e._v("Ecosystem")]),e._m(3)])},j=[function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("p",[e._v(" For a guide and recipes on how to configure / customize this project,"),r("br"),e._v(" check out the "),r("a",{attrs:{href:"https://cli.vuejs.org",target:"_blank",rel:"noopener"}},[e._v("vue-cli documentation")]),e._v(". ")])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("ul",[r("li",[r("a",{attrs:{href:"https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-babel",target:"_blank",rel:"noopener"}},[e._v("babel")])]),r("li",[r("a",{attrs:{href:"https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-eslint",target:"_blank",rel:"noopener"}},[e._v("eslint")])])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("ul",[r("li",[r("a",{attrs:{href:"https://vuejs.org",target:"_blank",rel:"noopener"}},[e._v("Core Docs")])]),r("li",[r("a",{attrs:{href:"https://forum.vuejs.org",target:"_blank",rel:"noopener"}},[e._v("Forum")])]),r("li",[r("a",{attrs:{href:"https://chat.vuejs.org",target:"_blank",rel:"noopener"}},[e._v("Community Chat")])]),r("li",[r("a",{attrs:{href:"https://twitter.com/vuejs",target:"_blank",rel:"noopener"}},[e._v("Twitter")])]),r("li",[r("a",{attrs:{href:"https://news.vuejs.org",target:"_blank",rel:"noopener"}},[e._v("News")])])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("ul",[r("li",[r("a",{attrs:{href:"https://router.vuejs.org",target:"_blank",rel:"noopener"}},[e._v("vue-router")])]),r("li",[r("a",{attrs:{href:"https://vuex.vuejs.org",target:"_blank",rel:"noopener"}},[e._v("vuex")])]),r("li",[r("a",{attrs:{href:"https://github.com/vuejs/vue-devtools#vue-devtools",target:"_blank",rel:"noopener"}},[e._v("vue-devtools")])]),r("li",[r("a",{attrs:{href:"https://vue-loader.vuejs.org",target:"_blank",rel:"noopener"}},[e._v("vue-loader")])]),r("li",[r("a",{attrs:{href:"https://github.com/vuejs/awesome-vue",target:"_blank",rel:"noopener"}},[e._v("awesome-vue")])])])}],q={name:"HelloWorld",props:{msg:String}},E=q,$=(r("d865"),Object(d["a"])(E,x,j,!1,null,"15f5bc0c",null)),O=$.exports,A=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"vgl-home-hero-slider vgl-container",style:{"--bordder-color":e.borderColor,"--border-width":e.borderWidth}},[r("div",{staticClass:"vgl-slider-item-border-bottom"}),r("VueSlickCarousel",{attrs:{slidesToShow:1,slidesToScroll:1,speed:500,infinite:!0,dots:!0}},[e._v(" "+e._s(e.borderColor)+" "),e._l(e.posts,(function(t){return r("div",{key:t.id},[r("div",{staticClass:"vgl-slider-item",style:{"background-image":"url("+t.featured_url+")"}},[r("div",{staticClass:"vgl-slider-info"},[r("h2",{staticClass:"vgl-slider-title"},[r("a",{attrs:{href:t.permalink}},[e._v(e._s(t.title))])]),r("span",[e._v("by "+e._s(t.authorName)+" | "+e._s(t.category))])])])])}))],2),r("HelloWorld")],1)},P=[],L=r("a7ab"),N=r.n(L),T={name:"HeroBannerSlider",components:{VueSlickCarousel:N.a},props:{posts:{type:Array,default:function(){return[{title:"aaa",id:1},{title:"bbb",id:2}]}},borderColor:{type:String,required:!1},borderWidth:{type:String,required:!1}},mounted:function(){},computed:function(){return{}}},B=T,H=(r("9818"),Object(d["a"])(B,A,P,!1,null,null,null)),I=H.exports,V=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("vue-slider",{model:{value:e.value,callback:function(t){e.value=t},expression:"value"}})},R=[],W=r("4971"),z=r.n(W),D=(r("3e39"),{components:{VueSlider:z.a},data:function(){return{value:0}}}),F=D,J=Object(d["a"])(F,V,R,!1,null,null,null),G=J.exports,Q=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"vgl-hot-posts vgl-container"},[r("div",{staticClass:"vgl-content-wrapper"},[r("h2",{staticClass:"vgl-hot-post-title"},[e._v(e._s(e.title)+" "),r("img",{attrs:{src:"/wp-content/themes/vgl/src/assets/fire.png"}})]),e._l(e.posts,(function(t){return r("div",{key:t.id,class:[{"col-full":1==e.colCount,"col-half":2==e.colCount,"col-one-third":3==e.colCount,"col-one-fourth":4==e.colCount,"col-one-fifth":5==e.colCount},"vgl-hot-post"]},[r("img",{attrs:{src:t.featured_url}}),r("div",[r("span",[r("b",[e._v("by")]),e._v(" "+e._s(t.authorName)+" | "+e._s(t.category))]),r("p",[e._v(e._s(t.title))])])])}))],2)])},U=[],K=(r("a9e3"),{name:"HotPosts",props:{posts:{type:Array,required:!0},colCount:{type:Number,required:!0},title:{type:String,required:!1}},mounted:function(){}}),X=K,Y=(r("5f27"),Object(d["a"])(X,Q,U,!1,null,null,null)),Z=Y.exports,ee=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"vgl-posts vgl-container"},[" "!=e.heading?r("h2",{staticClass:"posts-heading"},[e._v(e._s(e.heading))]):e._e(),"masonry"==e.gridStyle?r("masonry",{attrs:{cols:{default:e.colCount,1023:1},gutter:100}},e._l(e.updatedPosts,(function(t,n){return r("div",{key:t.id,class:["vgl-post"]},[r("div",{class:["featured-image","index"+n]},[r("div",{style:{"background-image":"url("+t.featured_url+")"}})]),r("div",{class:["vgl-post-info","index"+n]},[r("h3",{staticClass:"title",domProps:{innerHTML:e._s(t.title)}}),r("span",[r("b",[e._v("by")]),e._v(" "+e._s(t.authorName)+" | "+e._s(t.category))]),r("a",{attrs:{href:t.permalink}},[e._v("READ MORE")])])])})),0):"list"==e.gridStyle?r("div",e._l(e.updatedPosts,(function(t){return r("div",{key:t.id,staticClass:"vgl-post"},[r("div",{staticClass:"featured-image"},[r("div",{style:{"background-image":"url("+t.featured_url+")"}})]),r("div",{staticClass:"post-info"},[r("p",{staticClass:"title",domProps:{innerHTML:e._s(t.title)}}),r("p",{staticClass:"excerpt"}),r("span",{staticClass:"name_category"},[r("b",[e._v("by")]),e._v(" "+e._s(t.authorName)+" | "+e._s(t.category))]),r("a",{attrs:{href:t.permalink}},[e._v("READ MORE")])])])})),0):e._e(),e.showLoadMore?r("a",{staticClass:"vgl-loadmorebtn",class:[{active:e.isActive}],on:{click:function(t){return e.loadMoreClicked()}}},[e._v(e._s(e.loadMoreText))]):e._e()],1)},te=[],re={name:"PostsGrid",components:{},props:{posts:{type:Array,required:!0},startIndex:{type:Number,required:!0},count:{type:Number,required:!0},colCount:{type:Number,required:!0},gridStyle:{type:Number,required:!0},heading:{type:String,required:!0},showLoadMore:{type:Boolean,required:!1},loadMoreText:{type:String,required:!1},order:{type:String,required:!1},orderBy:{type:String,required:!1}},data:function(){return{index:this.startIndex+this.count,updatedPosts:this.posts,isActive:!1,loadMorePostCount:12,postIndex:0}},methods:{loadMoreClicked:function(){var e=this;this.isActive=!0,window.jQuery.post(window.ajaxurl,{action:"vgl_loadmore_posts",data:{startIndex:this.index,order:this.order,orderBy:this.orderBy,count:this.loadMorePostCount}},{headers:{"Content-Type":"application/x-www-form-urlencoded; charset=UTF-8",Accept:"text/html, */*; q=0.01"}}).success((function(t){JSON.parse(t).forEach((function(t){return e.updatedPosts.push(t)})),e.index=e.index+e.loadMorePostCount}))}},computed:{},mounted:function(){this.showLoadMore&&(console.log(this.loadMoreText),console.log(this.startIndex),console.log(this.count),console.log(this.index))}},ne=re,se=(r("8abb"),Object(d["a"])(ne,ee,te,!1,null,null,null)),oe=se.exports,ie=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"vgl-woo-product-slider vgl-container"},[r("VueSlickCarousel",e._b({},"VueSlickCarousel",e.settings,!1),e._l(e.products,(function(t){return r("div",{key:t.id,staticClass:"vgl-woo-product-slider-item"},[r("div",{staticClass:"slider-image",style:{"background-image":"url("+t.featured_url+")"}}),r("div",{staticClass:"slider-content"},[r("p",{staticClass:"title"},[e._v(e._s(t.product_name))]),r("p",{staticClass:"price"},[e._v(e._s(t.currency)+e._s(t.price))])])])})),0)],1)},ae=[],le={name:"WooProductSlider",components:{VueSlickCarousel:N.a},props:{products:{type:Array,required:!0},productCount:{type:Number,required:!0},desktopSlideCount:{type:Number,required:!0},mobileSlideCount:{type:Number,required:!0}},data:function(){return{settings:{arrows:!1,dots:!0,infinite:!1,slidesToScroll:1,slidesToShow:this.desktopSlideCount,responsive:[{breakpoint:768,settings:{slidesToShow:this.mobileSlideCount}}]},dotCount:0}},mounted:function(){var e=this,t=this.$el.querySelectorAll(".slick-dots li");this.dotCount=t.length,t.forEach((function(t){t.style.width="calc(100% / "+e.dotCount+")"}))},computed:function(){return{}}},ue=le,ce=(r("7b62"),Object(d["a"])(ue,ie,ae,!1,null,null,null)),de=ce.exports,ve=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"vgl-posts vgl-container"},[r("h2",{staticClass:"posts-heading"},[e._v(e._s(e.heading))]),r("VueSlickCarousel",e._b({},"VueSlickCarousel",e.settings,!1),e._l(e.posts,(function(t){return r("div",{key:t.id,staticClass:"vgl-posts-slider-item"},[r("div",{staticClass:"featured_image",style:{"background-image":"url("+t.featured_url+")"}}),r("div",{staticClass:"post-info"},[r("p",{staticClass:"title"},[e._v(e._s(t.title))]),r("p",{staticClass:"name_category"},[r("span",[e._v("by ")]),e._v(e._s(t.authorName)+" | "+e._s(t.category))]),r("a",{staticClass:"read_more btn",attrs:{href:t.permalink}},[e._v("Read More")])])])})),0)],1)},pe=[],me={name:"PostsSlider",components:{VueSlickCarousel:N.a},props:{posts:{type:Array,required:!0},heading:{type:String,required:!0},count:{type:Number,required:!0},desktopSliderShow:{type:Number,required:!0},mobileSlidershow:{type:Number,required:!0}},data:function(){return{settings:{arrows:!1,dots:!0,infinite:!1,slidesToScroll:1,slidesToShow:this.desktopSliderShow,responsive:[{breakpoint:768,settings:{slidesToShow:this.mobileSlidershow,arrows:!0}}]},dotCount:0}},computed:function(){},mounted:function(){var e=this,t=this.$el.querySelectorAll(".slick-dots li");this.dotCount=t.length,t.forEach((function(t){t.style.width="calc(100% / "+e.dotCount+")"}))}},he=me,fe=(r("7292"),Object(d["a"])(he,ve,pe,!1,null,null,null)),be=fe.exports,ge={name:"App",components:{RectangleMenu:p,MobileBurger:_,MobileMenu:M,HelloWorld:O,HeroBannerSlider:I,VueSlider:G,HotPosts:Z,PostsGrid:oe,WooProductSlider:de,PostsSlider:be},mounted:function(){this.initialize()},methods:{initialize:function(){}}},_e=ge,ye=(r("034f"),Object(d["a"])(_e,n,s,!1,null,null,null)),Ce=ye.exports,Se=r("bc3a"),ke=r.n(Se),we=r("a7fe"),Me=r.n(we);o["default"].prototype.$eventBus=new o["default"],o["default"].config.productionTip=!1,o["default"].use(i["a"]),o["default"].use(Me.a,ke.a),new o["default"](Ce).$mount("#app")},"5f27":function(e,t,r){"use strict";var n=r("a1f1"),s=r.n(n);s.a},"60f9":function(e,t,r){},7292:function(e,t,r){"use strict";var n=r("d7a6"),s=r.n(n);s.a},"7b62":function(e,t,r){"use strict";var n=r("b714"),s=r.n(n);s.a},"85ec":function(e,t,r){},"8abb":function(e,t,r){"use strict";var n=r("ee32"),s=r.n(n);s.a},"8c23":function(e,t,r){"use strict";var n=r("4d5c"),s=r.n(n);s.a},9818:function(e,t,r){"use strict";var n=r("cb66"),s=r.n(n);s.a},a1f1:function(e,t,r){},b714:function(e,t,r){},c192:function(e,t,r){},c3f5:function(e,t,r){"use strict";var n=r("60f9"),s=r.n(n);s.a},cb66:function(e,t,r){},d7a6:function(e,t,r){},d865:function(e,t,r){"use strict";var n=r("c192"),s=r.n(n);s.a},da0b:function(e,t,r){},ee32:function(e,t,r){}});
//# sourceMappingURL=app.js.map