webpackJsonp([8],{GTbk:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=s("Dd8w"),a=s.n(n),i=s("mvHQ"),o=s.n(i),r=s("LOoJ"),c=(s("7iEP"),s("PM1u")),d=s("pr3M"),u=s("J7Ch"),l=(s("M4fF"),s("O3Q9")),m=s("66ui"),g=(s("D0Oq"),s("NYxO"),{components:{MoreIcon:d.a,BackIcon:u.a},data:function(){return{targetUser:{},currentUser:window.TS_WEB.currentUserId,userInfo:{},cid:0,user_id:0,message:{content:"",max_id:0}}},methods:{goTo:l.b,changeUrl:l.a,sendmsg:function(){var t=this,e="2",s=(new Date).getTime()+"_"+this.user_id,n=["convr.msg",{cid:this.cid,type:0,txt:this.message.content,rt:!1},s];if(e+=o()(n),!TS_WEB.webSocket)return this.$store.dispatch(c.N,function(t){t({show:!0,time:1500,status:!1,text:"链接出错,可能是没有配置聊天服务器"})}),!1;if(1!=TS_WEB.webSocket.readyState)Object(m.a)(),setTimeout(function(){1==TS_WEB.webSocket.readyState&&t.sendmsg()},1e3);else{TS_WEB.webSocket.send(e);var a={cid:this.cid,uid:this.currentUser,txt:this.message.content,hash:s,mid:0,seq:-1,time:0,owner:window.TS_WEB.currentUserId};window.TS_WEB.dataBase.transaction("rw?",window.TS_WEB.dataBase.messagebase,function(){window.TS_WEB.dataBase.messagebase.put(a)}).catch(function(t){console.error("Generic error: "+t)}),this.message.content=""}}},computed:{room:function(){var t=this.$store.getters[c._2]["room_"+this.cid],e=void 0===t?{}:t;return e},messagelists:function(){var t=this.room,e=t.lists,s=void 0===e?[]:e,n=t.count,a=void 0===n?0:n;return this.$nextTick(function(){var t=this;0!=a&&this.$store.dispatch(c.k,function(e){e(t.cid)}),window.scrollTo(0,document.body.scrollHeight)}),s},myAvatar:function(){var t=this.userInfo.avatar;return void 0===t?"":t},canSend:function(){var t=this.message.content;return!(t=(t=t.replace(/(^\s*)|(\s*$)/g,"")).replace(" ","")).length}},created:function(){var t=this,e=this.user_id=this.$route.params.user_id;if(this.cid=parseInt(this.$route.params.cid),!e)return this.$store.dispatch(c.N,function(t){t({text:"got some errors",time:1500,status:!1,show:!0})}),void setTimeout(function(){t.$router.go(-1)},1600);var s=this.$storeLocal.get(e);void 0!==s?this.targetUser=a()({},s):Object(r.d)(e,30).then(function(e){t.targetUser=a()({},e)});var n=this.$storeLocal.get(window.TS_WEB.currentUserId);void 0!==n?this.userInfo=a()({},n):Object(r.d)(window.TS_WEB.currentUserId,30).then(function(e){t.userInfo=a()({},e)})}}),v={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"imMessage"},[s("div",{staticClass:"commonHeader"},[s("Row",{attrs:{gutter:24}},[s("Col",{staticStyle:{display:"flex","justify-content":"flex-start"},attrs:{span:"5"},nativeOn:{click:function(e){t.goTo(-1)}}},[s("BackIcon",{attrs:{height:"21",width:"21",color:"#999"}})],1),t._v(" "),s("Col",{staticClass:"title-col",attrs:{span:"14"}},[t._v("\n          "+t._s(t.targetUser.name)+"\n        ")]),t._v(" "),s("Col",{staticClass:"header-end-col",attrs:{span:"5"}})],1)],1),t._v(" "),s("div",{staticClass:"messageList",attrs:{id:"messagelists"}},t._l(t.messagelists,function(e){return s("div",{staticClass:"message"},[e.user_id!==t.currentUser?s("div",{staticClass:"hemessage"},[s("img",{staticClass:"avatar",attrs:{src:t.room.avatar}}),t._v(" "),s("div",{staticClass:"content"},[s("h5",{staticClass:"name"},[t._v(t._s(t.room.name))]),t._v(" "),s("div",{staticClass:"msg-content"},[t._v(" \n\t\t\t\t\t\t\t"+t._s(e.txt)+"\n\t\t\t\t\t\t")])])]):t._e(),t._v(" "),e.user_id==t.currentUser?s("div",{staticClass:"mymessage"},[s("div",{staticClass:"content"},[s("h5",{staticClass:"name"},[t._v(t._s(t.userInfo.name))]),t._v(" "),s("div",{staticClass:"msg-content"},[t._v(" \n\t\t\t\t\t\t\t"+t._s(e.txt)+"\n\t\t\t\t\t\t")])]),t._v(" "),s("img",{staticClass:"avatar",attrs:{src:t.myAvatar,alt:""}})]):t._e()])})),t._v(" "),s("div",{staticClass:"sendBox"},[s("Row",{staticStyle:{width:"100%"},attrs:{gutter:16}},[s("Col",{attrs:{span:"20"}},[s("Input",{directives:[{name:"childfocus",rawName:"v-childfocus"}],staticClass:"commentInput",attrs:{maxLength:255,type:"textarea",placeholder:"say anything",autosize:{minRows:1,maxRows:4}},model:{value:t.message.content,callback:function(e){t.$set(t.message,"content",e)},expression:"message.content"}})],1),t._v(" "),s("Col",{attrs:{span:"4"}},[s("Button",{staticClass:"sendButton",attrs:{size:"small",long:!0,disabled:t.canSend,type:"primary"},nativeOn:{click:function(e){t.sendmsg()}}},[t._v("发送")])],1)],1)],1)])},staticRenderFns:[]};var _=s("VU/8")(g,v,!1,function(t){s("pPIh")},"data-v-4ca6dbf7",null);e.default=_.exports},KPGV:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=s("lHA8"),a=s.n(n),i=s("c/Tr"),o=s.n(i),r=s("Gu7T"),c=s.n(r),d=s("Dd8w"),u=s.n(d),l=s("PM1u"),m=s("vLgD"),g=s("emCR"),v=s("LOoJ"),_=s("JKGc"),h=s("Rgjh"),f=s("pWbq"),w=s("O3Q9"),y=s("M4fF"),p=s.n(y),C=s("NYxO"),S={components:{ToolBar:g.a,DiggIcon:_.a,CommentIcon:h.a},data:function(){return{messages:{},isWeiXin:TS_WEB.isWeiXin,commentsText:"",diggsText:""}},computed:u()({},Object(C.c)({messageCount:function(t){return t.messageCount.messageCount}}),{imMessageList:function(){var t=u()({},this.$store.getters[l._2]);return!p.a.keys(t).length>0?{}:t},diggTime:function(){var t=this.messageCount.diggs,e=(t=void 0===t?{}:t).time;return void 0===e?(new window.Date).getTime():e},diggLists:function(){var t=this,e=this.messageCount.diggs,s=(e=void 0===e?{}:e).uids,n=void 0===s?[]:s,i="",r=0,d=[].concat(c()(n));if(!n.length){var u=[],m={diggs:{}};return window.TS_WEB.dataBase.transaction("rw?",window.TS_WEB.dataBase.diggslist,function(){window.TS_WEB.dataBase.diggslist.where({user_id:window.TS_WEB.currentUserId}).limit(10).toArray().then(function(e){e.length&&(e.forEach(function(t){u.push(t.uid)}),m.diggs.count=0,m.diggs.uids=o()(new a.a(u)),t.$store.dispatch(l.I,function(t){t(m)}))})}),0}return o()(new a.a(d)).slice(0,3).forEach(function(e,s){if(!(++r>3)){var n=t.$storeLocal.get("user_"+e);if(void 0===n)Object(v.d)(e,30).then(function(e){var s=e.name;i+=(void 0===s?"":s)+"、",t.diggsText=i.substr(0,i.length-1)});else{var a=n.name;i+=(void 0===a?"":a)+"、",t.diggsText=i.substr(0,i.length-1)}}}),d.length},commentTime:function(){var t=this.messageCount.comments,e=(t=void 0===t?{}:t).time;return void 0===e?(new window.Date).getTime():e},commentLists:function(){var t=this,e=this.messageCount.comments,s=(e=void 0===e?{}:e).uids,n=void 0===s?[]:s,a="",i=0;if(!n.length){var o=[],r={comments:{}};return window.TS_WEB.dataBase.transaction("rw?",window.TS_WEB.dataBase.commentslist,function(){window.TS_WEB.dataBase.commentslist.where({user_id:window.TS_WEB.currentUserId}).limit(10).toArray().then(function(e){e.length&&(e.forEach(function(t){o.push(t.uid)}),r.comments.count=0,r.comments.uids=p.a.uniq(o),t.$store.dispatch("GET_USER_BY_ID",n),t.$store.dispatch(l.I,function(t){t(r)}))})}),0}return n.slice(0,3).forEach(function(e,s){if(!(++i>3)){var n=t.$store.getters.getUserById(e)[0].name;a+=n+"、",t.commentsText=a.substr(0,a.length-1)}}),n.length>0}}),methods:{timers:f.a,changeUrl:w.a,removeByValue:function(t,e){for(var s=[],n=0;n<t.length;n++)t[n]!==parseInt(e)&&s.push(t[n]);return s}},created:function(){var t=this,e=0;e=this.$storeLocal.get("messageFlushTime");var s=parseInt((new window.Date).getTime()/1e3);e||(e=s-86400),this.$storeLocal.set("messageFlushTime",s),Object(m.a)().get(Object(m.c)("users/flushmessages?key=diggs,comments&time="+(e+1)),{},{validateStatus:function(t){return 200===t}}).then(function(e){var s={};e.data.data.forEach(function(e){e.count&&("follows"===e.key?s.fans=e.count+t.messageCount[e.key]:"comments"===e.key?(s[e.key]={},s[e.key].count=e.count+t.messageCount[e.key].count,s[e.key].uids=o()(new a.a([].concat(c()(t.messageCount[e.key].uids),c()(e.uids)))),s[e.key].time=t.timers(e.time,8,!1)):"diggs"===e.key&&(s[e.key]={},s[e.key].count=e.count+t.messageCount[e.key].count,s[e.key].uids=o()(new a.a([].concat(c()(t.messageCount[e.key].uids),c()(e.uids)))),s[e.key].time=t.timers(e.time,8,!1)))}),t.$store.dispatch(l.I,function(t){t(s)})}),window.TS_WEB.dataBase.transaction("rw?",window.TS_WEB.dataBase.chatroom,window.TS_WEB.dataBase.messagebase,function(){window.TS_WEB.dataBase.chatroom.orderBy("last_message_time").filter(function(t){return t.owner===window.TS_WEB.currentUserId}).limit(10).reverse().toArray(function(e){e.length&&e.forEach(function(e){var s={},n=e.uids.split(","),a=0;a=n[0]==window.TS_WEB.currentUserId?n[1]:n[0],window.TS_WEB.dataBase.messagebase.orderBy("seq").filter(function(t){return-1!=t.seq&&t.cid===e.cid}).limit(15).reverse().toArray(function(n){var i=[],o={};n.length&&(n=n.reverse()).forEach(function(t){o.user_id=t.uid,o.txt=t.txt,o.time=t.time,o.addCount=!1,i=[].concat(c()(i),[o]),o={}});var r=t.$storeLocal.get("user_"+a);r?(s.name=r.name,s.avatar=r.avatar,s.lists=i,s.cid=e.cid,s.user_id=a,t.$store.dispatch(l.H,function(t){t(s)}),s={}):Object(v.d)(a).then(function(n){s.name=n.name,s.avatar=n.avatar,s.lists=i,s.cid=e.cid,s.user_id=a,t.$store.dispatch(l.H,function(t){t(s)}),s={}})})})})}).catch(function(t){console.log(t)})}},T={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"messageList"},[s("div",{staticClass:"commonHeader"},[s("Row",{attrs:{gutter:24}},[s("Col",{staticClass:"title-col",attrs:{span:"14",offset:"5"}},[t._v("\n        消息\n      ")])],1)],1),t._v(" "),s("div",{class:t.$style.entryLists},[s("Row",{class:t.$style.entry,attrs:{gutter:24}},[s("div",{class:t.$style.entryContainer,on:{click:function(e){t.changeUrl("/users/mycomments")}}},[s("Col",{class:t.$style.entryIcon,attrs:{span:"4"}},[s("div",{class:t.$style.commentIcon},[s("div",{staticStyle:{width:"100%","border-radius":"100px",padding:"2vw"}},[s("CommentIcon",{attrs:{height:"100%",width:"100%",color:"#fff"}})],1)])]),t._v(" "),t.messageCount.comments.count?s("Col",{staticStyle:{padding:"0"},attrs:{span:"14"}},[s("h4",{staticStyle:{"font-weight":"400"}},[t._v("评论的")]),t._v(" "),t.commentLists?s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v(t._s(t.commentsText)+" "),s("span",{directives:[{name:"show",rawName:"v-show",value:t.messageCount.comments.count>3,expression:"messageCount.comments.count > 3"}]},[t._v("等人")]),t._v("评论了我")]):s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v("还没有人评论我")])]):s("Col",{staticStyle:{padding:"0 12px 0 0"},attrs:{span:"20"}},[s("h4",{staticStyle:{"font-weight":"400"}},[t._v("评论的")]),t._v(" "),t.commentLists?s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v(t._s(t.commentsText)+" "),s("span",{directives:[{name:"show",rawName:"v-show",value:t.messageCount.comments.count>3,expression:"messageCount.comments.count > 3"}]},[t._v("等人")]),t._v("评论过我")]):s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v("还没有人评论我")])]),t._v(" "),t.messageCount.comments.count?s("Col",{attrs:{span:"6"}},[s("timeago",{class:t.$style.time,attrs:{since:t.commentTime,locale:"zh-CN","auto-update":60}}),t._v(" "),s("i",{class:t.$style.messageCount},[t._v(t._s(t.messageCount.comments.count))])],1):t._e()],1)]),t._v(" "),s("Row",{class:t.$style.entry,attrs:{gutter:24}},[s("div",{class:t.$style.entryContainer,on:{click:function(e){t.changeUrl("/users/diggs")}}},[s("Col",{class:t.$style.entryIcon,attrs:{span:"4"}},[s("div",{class:t.$style.diggIcon},[s("div",{staticStyle:{width:"100%","border-radius":"100px",padding:"2vw"}},[s("DiggIcon",{attrs:{height:"100%",width:"100%",color:"#fff"}})],1)])]),t._v(" "),t.messageCount.diggs.count?s("Col",{staticStyle:{padding:"0"},attrs:{span:"14"}},[s("h4",{staticStyle:{"font-weight":"400"}},[t._v("赞过的")]),t._v(" "),t.diggLists?s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v(t._s(t.diggsText)+" "),s("span",{directives:[{name:"show",rawName:"v-show",value:t.messageCount.diggs.count>3,expression:"messageCount.diggs.count > 3"}]},[t._v("等人")]),t._v("赞了我")]):s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v("还没有人赞我")])]):s("Col",{staticStyle:{padding:"0 12px 0 0"},attrs:{span:"20"}},[s("h4",{staticStyle:{"font-weight":"400"}},[t._v("赞过的")]),t._v(" "),t.diggLists?s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v(t._s(t.diggsText)+" "),s("span",{directives:[{name:"show",rawName:"v-show",value:t.messageCount.diggs.count>3,expression:"messageCount.diggs.count > 3"}]},[t._v("等人")]),t._v("赞过我")]):s("div",{staticStyle:{color:"#999","font-size":"12px"}},[t._v("还没有人赞我")])]),t._v(" "),t.messageCount.diggs.count?s("Col",{attrs:{span:"6"}},[s("timeago",{class:t.$style.time,attrs:{since:t.diggTime,locale:"zh-CN","auto-update":60}}),t._v(" "),s("i",{class:t.$style.messageCount},[t._v(t._s(t.messageCount.diggs.count))])],1):t._e()],1)]),t._v(" "),t._l(t.imMessageList,function(e,n){return s("Row",{key:n,class:t.$style.entry,attrs:{gutter:24}},[s("div",{class:t.$style.entryContainer,on:{click:function(s){t.changeUrl("/users/message/"+e.user_id+"/"+e.cid)}}},[s("Col",{class:t.$style.entryIcon,attrs:{span:"4"}},[s("div",{class:t.$style.messageAvatar},[s("img",{class:t.$style.avatar,attrs:{src:e.avatar}})])]),t._v(" "),s("Col",{staticStyle:{padding:"0"},attrs:{span:"14"}},[s("h4",{staticStyle:{"font-weight":"400"}},[t._v(t._s(e.name))]),t._v(" "),e.lists.length?s("div",{class:t.$style.messagePreview},[t._v("\n            "+t._s(e.lists.length?e.lists[e.lists.length-1].txt:"")+"\n          ")]):t._e()]),t._v(" "),e.lists.length?s("Col",{staticStyle:{"padding-top":"4px"},attrs:{span:"6"}},[s("timeago",{class:t.$style.timer,attrs:{since:e.lists[e.lists.length-1].time,locale:"zh-CN","auto-update":60}}),t._v(" "),e.count?s("i",{class:t.$style.messageCount},[t._v(t._s(e.count||0))]):t._e()],1):t._e()],1)])})],2),t._v(" "),s("ToolBar")],1)},staticRenderFns:[]};var B=s("VU/8")(S,T,!1,function(t){this.$style=s("WQPE")},null,null);e.default=B.exports},WQPE:function(t,e){t.exports={timer:"_25SCyJhkgEvfzrK05SAfut_0",entryLists:"_3yyncdW8idzL4afUMXEEam_0",entry:"_21Ba_uvhmDWHr2tQZUPINg_0",entryContainer:"_3N-F6uU0JN-44wpuUornLp_0",messagePreview:"_2IhdB-AYP0apGkMD2za_At_0",time:"_15XPl6wM0xcIMjJf8B3Iod_0",messageCount:"_1fyeGn_Ja44Q6TYOL7kmQ5_0",entryIcon:"_3oRXRchEjzHAq4RaTEJtMT_0",diggIcon:"_21irCLUROsH8QFiYEYKoYO_0",messageAvatar:"_3U7qL2ZG_D9W6mvaDhTjx2_0",avatar:"_1RRNCXSJmYxuIoGeUcnYFL_0",commentIcon:"_1wOcYPuRyLpoBw4OfSP9be_0"}},pPIh:function(t,e){}});
//# sourceMappingURL=8.a050960236a2c31dde3e.js.map