!function(){"use strict";var t,e={908:function(){var t=window.wp.blocks,e=window.wp.i18n,n=window.wp.element,o=window.wp.blockEditor,i=window.wp.components;window.jQuery,(0,t.registerBlockType)("oet-block/oet-publication-intro-block",{title:(0,e.__)("Publication Intro","oet-publication-intro-block"),category:"oet-block-category",icon:"format-aside",supports:{html:!1},attributes:{title:{type:"string"},content:{type:"string"},isChanged:{type:"boolean",default:!1},blockId:{type:"string"},firstLoad:{type:"boolean",default:!0}},edit:function(t){const{attributes:r,setAttributes:l,isSelected:c,clientId:a}=t;return[(0,n.createElement)(n.Fragment,null,(0,n.createElement)(o.InspectorControls,{key:r.blockId},(0,n.createElement)(i.PanelBody,{title:(0,e.__)("Publication Intro Block Settings","oet-publication-intro-block"),initialOpen:!0},(0,n.createElement)(i.PanelRow,null,(0,n.createElement)(TextControl,{label:(0,e.__)("Title","oet-publication-intro-block"),value:r.title,onChange:t=>{l({title:t,isChanged:!0})}})),(0,n.createElement)(i.PanelRow,null,(0,n.createElement)(i.TextareaControl,{label:(0,e.__)("Content","oet-publication-intro-block"),help:(0,e.__)("Enter some text","oet-publication-intro-block"),value:r.content,onChange:t=>{l({content:t,isChanged:!0})}}))))),(0,n.createElement)("div",{className:"oet-publication-intro-block"},"")]}})}},n={};function o(t){var i=n[t];if(void 0!==i)return i.exports;var r=n[t]={exports:{}};return e[t](r,r.exports,o),r.exports}o.m=e,t=[],o.O=function(e,n,i,r){if(!n){var l=1/0;for(s=0;s<t.length;s++){n=t[s][0],i=t[s][1],r=t[s][2];for(var c=!0,a=0;a<n.length;a++)(!1&r||l>=r)&&Object.keys(o.O).every((function(t){return o.O[t](n[a])}))?n.splice(a--,1):(c=!1,r<l&&(l=r));if(c){t.splice(s--,1);var u=i();void 0!==u&&(e=u)}}return e}r=r||0;for(var s=t.length;s>0&&t[s-1][2]>r;s--)t[s]=t[s-1];t[s]=[n,i,r]},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},function(){var t={826:0,46:0};o.O.j=function(e){return 0===t[e]};var e=function(e,n){var i,r,l=n[0],c=n[1],a=n[2],u=0;if(l.some((function(e){return 0!==t[e]}))){for(i in c)o.o(c,i)&&(o.m[i]=c[i]);if(a)var s=a(o)}for(e&&e(n);u<l.length;u++)r=l[u],o.o(t,r)&&t[r]&&t[r][0](),t[l[u]]=0;return o.O(s)},n=self.webpackChunkoet_publication_intro=self.webpackChunkoet_publication_intro||[];n.forEach(e.bind(null,0)),n.push=e.bind(null,n.push.bind(n))}();var i=o.O(void 0,[46],(function(){return o(908)}));i=o.O(i)}();