!function(e){function t(e,t,r){var n=e[0],o=/er/.test(r)?_indeterminate:/bl/.test(r)?f:_,s=r==_update?{checked:n[_],disabled:n[f],indeterminate:"true"==e.attr(_indeterminate)||"false"==e.attr(_determinate)}:n[o];if(/^(ch|di|in)/.test(r)&&!s)i(e,o);else if(/^(un|en|de)/.test(r)&&s)a(e,o);else if(r==_update)for(var d in s)s[d]?i(e,d,!0):a(e,d,!0);else t&&"toggle"!=r||(t||e[_callback]("ifClicked"),s?n[_type]!==u&&a(e,o):i(e,o))}function i(t,i,r){var l=t[0],h=t.parent(),b=i==_,m=i==_indeterminate,v=i==f,y=m?_determinate:b?p:"enabled",k=n(t,y+o(l[_type])),g=n(t,i+o(l[_type]));if(l[i]!==!0){if(!r&&i==_&&l[_type]==u&&l.name){var C=t.closest("form"),w='input[name="'+l.name+'"]';w=C.length?C.find(w):e(w),w.each(function(){this!==l&&e(this).data(d)&&a(e(this),i)})}m?(l[i]=!0,l[_]&&a(t,_,"force")):(r||(l[i]=!0),b&&l[_indeterminate]&&a(t,_indeterminate,!1)),s(t,b,i,r)}l[f]&&n(t,_cursor,!0)&&h.find("."+c).css(_cursor,"default"),h[_add](g||n(t,i)||""),h.attr("role")&&!m&&h.attr("aria-"+(v?f:_),"true"),h[_remove](k||n(t,y)||"")}function a(e,t,i){var a=e[0],r=e.parent(),d=t==_,l=t==_indeterminate,u=t==f,h=l?_determinate:d?p:"enabled",b=n(e,h+o(a[_type])),m=n(e,t+o(a[_type]));a[t]!==!1&&((l||!i||"force"==i)&&(a[t]=!1),s(e,d,h,i)),!a[f]&&n(e,_cursor,!0)&&r.find("."+c).css(_cursor,"pointer"),r[_remove](m||n(e,t)||""),r.attr("role")&&!l&&r.attr("aria-"+(u?f:_),"false"),r[_add](b||n(e,h)||"")}function r(t,i){t.data(d)&&(t.parent().html(t.attr("style",t.data(d).s||"")),i&&t[_callback](i),t.off(".i").unwrap(),e(_label+'[for="'+t[0].id+'"]').add(t.closest(_label)).off(".i"))}function n(e,t,i){return e.data(d)?e.data(d).o[t+(i?"":"Class")]:void 0}function o(e){return e.charAt(0).toUpperCase()+e.slice(1)}function s(e,t,i,a){a||(t&&e[_callback]("ifToggled"),e[_callback]("ifChanged")[_callback]("if"+o(i)))}var d="iCheck",c=d+"-helper",l="checkbox",u="radio",_="checked",p="un"+_,f="disabled";_determinate="determinate",_indeterminate="in"+_determinate,_update="update",_type="type",_click="click",_touch="touchbegin.i touchend.i",_add="addClass",_remove="removeClass",_callback="trigger",_label="label",_cursor="cursor",_mobile=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent),e.fn[d]=function(n,o){var s='input[type="'+l+'"], input[type="'+u+'"]',p=e(),h=function(t){t.each(function(){var t=e(this);p=t.is(s)?p.add(t):p.add(t.find(s))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(n))return n=n.toLowerCase(),h(this),p.each(function(){var i=e(this);"destroy"==n?r(i,"ifDestroyed"):t(i,!0,n),e.isFunction(o)&&o()});if("object"!=typeof n&&n)return this;var b=e.extend({checkedClass:_,disabledClass:f,indeterminateClass:_indeterminate,labelHover:!0},n),m=b.handle,v=b.hoverClass||"hover",y=b.focusClass||"focus",k=b.activeClass||"active",g=!!b.labelHover,C=b.labelHoverClass||"hover",w=0|(""+b.increaseArea).replace("%","");return(m==l||m==u)&&(s='input[type="'+m+'"]'),-50>w&&(w=-50),h(this),p.each(function(){var n=e(this);r(n);var o,s=this,p=s.id,h=-w+"%",m=100+2*w+"%",x={position:"absolute",top:h,left:h,display:"block",width:m,height:m,margin:0,padding:0,background:"#fff",border:0,opacity:0},A=_mobile?{position:"absolute",visibility:"hidden"}:w?x:{position:"absolute",opacity:0},H=s[_type]==l?b.checkboxClass||"i"+l:b.radioClass||"i"+u,j=e(_label+'[for="'+p+'"]').add(n.closest(_label)),D=!!b.aria,P=d+"-"+Math.random().toString(36).substr(2,6),T='<div class="'+H+'" '+(D?'role="'+s[_type]+'" ':"");D&&j.each(function(){T+='aria-labelledby="',this.id?T+=this.id:(this.id=P,T+=P),T+='"'}),T=n.wrap(T+"/>")[_callback]("ifCreated").parent().append(b.insert),o=e('<ins class="'+c+'"/>').css(x).appendTo(T),n.data(d,{o:b,s:n.attr("style")}).css(A),!!b.inheritClass&&T[_add](s.className||""),!!b.inheritID&&p&&T.attr("id",d+"-"+p),"static"==T.css("position")&&T.css("position","relative"),t(n,!0,_update),j.length&&j.on(_click+".i mouseover.i mouseout.i "+_touch,function(i){var a=i[_type],r=e(this);if(!s[f]){if(a==_click){if(e(i.target).is("a"))return;t(n,!1,!0)}else g&&(/ut|nd/.test(a)?(T[_remove](v),r[_remove](C)):(T[_add](v),r[_add](C)));if(!_mobile)return!1;i.stopPropagation()}}),n.on(_click+".i focus.i blur.i keyup.i keydown.i keypress.i",function(e){var t=e[_type],r=e.keyCode;return t==_click?!1:"keydown"==t&&32==r?(s[_type]==u&&s[_]||(s[_]?a(n,_):i(n,_)),!1):void("keyup"==t&&s[_type]==u?!s[_]&&i(n,_):/us|ur/.test(t)&&T["blur"==t?_remove:_add](y))}),o.on(_click+" mousedown mouseup mouseover mouseout "+_touch,function(e){var i=e[_type],a=/wn|up/.test(i)?k:v;if(!s[f]){if(i==_click?t(n,!1,!0):(/wn|er|in/.test(i)?T[_add](a):T[_remove](a+" "+k),j.length&&g&&a==v&&j[/ut|nd/.test(i)?_remove:_add](C)),!_mobile)return!1;e.stopPropagation()}})})}}(window.jQuery||window.Zepto);