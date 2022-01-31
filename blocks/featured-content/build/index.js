!function(){"use strict";var e,t={557:function(e,t,n){var o=window.wp.blocks,l=window.wp.i18n,a=JSON.parse('{"$schema":"https://json.schemastore.org/block.json","apiVersion":2,"name":"oet-block/oet-featured-content-block","version":"0.1.0","title":"Featured Content","category":"oet-block-category","icon":"media-document","description":"This block displays featured content on a page/post.","keywords":["OET","featured","featured content"],"attributes":{"title":{"type":"string"},"topIcon":{"type":"string","default":"star"},"alignment":{"type":"string","default":"left"},"content":{"type":"string"},"isChanged":{"type":"boolean","default":false},"blockId":{"type":"string"}},"supports":{"html":false},"textdomain":"oet-featured-content-block","editorScript":"file:./build/index.js","editorStyle":"file:./build/index.css","style":"file:./build/style-index.css"}'),c=window.wp.element,r=window.wp.blockEditor,i=window.wp.components,d=window.jQuery,s=n.n(d);function u(e){var t="Loading...";const{attributes:n,setAttributes:o,isSelected:a,clientId:d}=e;return d!==n.blockId&&o({blockId:d}),void 0!==n.isChanged&&0!=n.isChanged||(t=(0,c.createElement)("div",{className:"admin-featured-content-heading"},(0,c.createElement)("div",{className:"featured_content_box pblctn_right_sid_mtr"},(0,c.createElement)("div",{className:"col-md-12 col-sm-6 col-xs-6"},(0,c.createElement)("div",{className:"pblctn_box"},(0,c.createElement)("span",{className:"socl_icns fa-stack"},(0,c.createElement)("i",{className:"fa fa-star "}))),(0,c.createElement)("div",{className:"cntnbx_cntnr"},(0,c.createElement)("div",{className:"admin-featured-content-error"}),(0,c.createElement)("div",{className:"rght_sid_wdgt_hedng"},(0,c.createElement)(TextControl,{value:n.title,onChange:e=>{o({title:e})},className:"components-placeholder__input featured-content-title",id:"featured-content-title",placeholder:(0,l.__)("Featured Content Title","oet-featured-content-block")})),(0,c.createElement)("div",{className:"featured-block-content"},(0,c.createElement)(r.RichText,{value:n.content,allowedFormats:["core/bold","core/italic"],id:"featured-content",onChange:e=>{o({content:e})},placeholder:(0,l.__)("Enter content here...","oet-featured-content-block")})),(0,c.createElement)("div",{className:"btnSaveFeaturedContent"},(0,c.createElement)(i.Button,{className:"btn-save-featured-content components-button is-primary",onClick:()=>{""==s()("#block-"+n.blockId+" .oet-featured-content-block .admin-featured-content-heading #featured-content-title").val()&&""==s()("#block-"+n.blockId+" .oet-featured-content-block .admin-featured-content-heading .featured-block-content .rich-text").val()?(s()("#block-"+n.blockId+" .oet-featured-content-block .admin-featured-content-heading .admin-featured-content-error").html(""),s()("#block-"+n.blockId+" .oet-featured-content-block .admin-featured-content-heading .admin-featured-content-error").text("Please specify one of the fields below.")):o({isChanged:!0})},isPrimary:!0},"Save"))))))),n.isChanged&&(u=n,f=n.blockId,b={action:"display_featured_content",attributes:u},s().ajax({url:oet_featured_content.ajax_url,type:"POST",data:b,success:function(e){console.log(e),e.error?(s()("#block-"+f+" .oet-featured-content-block").html(""),s()("#block-"+f+" .oet-featured-content-block").html(e.message)):(console.log(s()("#block-"+f+" .oet-featured-content-block")),s()("#block-"+f+" .oet-featured-content-block").html(""),s()("#block-"+f+" .oet-featured-content-block").html(e))},error:function(e,t,n){console.log(n)}})),[(0,c.createElement)(c.Fragment,null,(0,c.createElement)(r.InspectorControls,{key:n.blockId},(0,c.createElement)(i.PanelBody,{title:(0,l.__)("Featured Content Block Settings","oet-featured-content-block"),initialOpen:!0},(0,c.createElement)(i.PanelRow,null,(0,c.createElement)(TextControl,{label:(0,l.__)("Title","oet-featured-content-block"),value:n.title,onChange:e=>{o({title:e,isChanged:!0})}})),(0,c.createElement)(i.PanelRow,null,(0,c.createElement)(i.TextareaControl,{label:(0,l.__)("Content","oet-featured-content-block"),help:(0,l.__)("Enter featured content","oet-featured-content-block"),value:n.content,onChange:e=>{o({content:e,isChanged:!0})}})),(0,c.createElement)(i.PanelRow,null,(0,c.createElement)(i.SelectControl,{label:(0,l.__)("Icon","oet-featured-content-block"),value:n.topIcon,options:[{label:"Star",value:"star"},{label:"Sun",value:"sun"},{label:"Wifi",value:"wifi"},{label:"Book",value:"book"},{label:"Cogs",value:"cogs"}],onChange:e=>{o({topIcon:e,isChanged:!0})}})),(0,c.createElement)(i.PanelRow,null,(0,c.createElement)(i.SelectControl,{label:(0,l.__)("Alignment","oet-featured-content-block"),value:n.alignment,options:[{label:"Select alignment",value:""},{label:"Left",value:"left"},{label:"Center",value:"center"},{label:"Right",value:"right"}],onChange:e=>{o({alignment:e,isChanged:!0})}}))))),(0,c.createElement)("div",(0,r.useBlockProps)(),(0,c.createElement)("div",{className:"oet-featured-content-block"},t))];var u,f,b}1==oet_featured_content.version_58?(0,o.registerBlockType)(a,{edit:u}):(0,o.registerBlockType)("oet-block/oet-featured-content-block",{title:(0,l.__)("Featured Content","oet-video-block"),category:"oet-block-category",icon:"media-document",supports:{html:!1},attributes:{title:{type:"string",default:""},topIcon:{type:"string",default:"star"},alignment:{type:"string",default:"left"},content:{type:"string",default:""},isChanged:{type:"boolean",default:!1},blockId:{type:"string"}},edit:u})}},n={};function o(e){var l=n[e];if(void 0!==l)return l.exports;var a=n[e]={exports:{}};return t[e](a,a.exports,o),a.exports}o.m=t,e=[],o.O=function(t,n,l,a){if(!n){var c=1/0;for(s=0;s<e.length;s++){n=e[s][0],l=e[s][1],a=e[s][2];for(var r=!0,i=0;i<n.length;i++)(!1&a||c>=a)&&Object.keys(o.O).every((function(e){return o.O[e](n[i])}))?n.splice(i--,1):(r=!1,a<c&&(c=a));if(r){e.splice(s--,1);var d=l();void 0!==d&&(t=d)}}return t}a=a||0;for(var s=e.length;s>0&&e[s-1][2]>a;s--)e[s]=e[s-1];e[s]=[n,l,a]},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,{a:t}),t},o.d=function(e,t){for(var n in t)o.o(t,n)&&!o.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,46:0};o.O.j=function(t){return 0===e[t]};var t=function(t,n){var l,a,c=n[0],r=n[1],i=n[2],d=0;if(c.some((function(t){return 0!==e[t]}))){for(l in r)o.o(r,l)&&(o.m[l]=r[l]);if(i)var s=i(o)}for(t&&t(n);d<c.length;d++)a=c[d],o.o(e,a)&&e[a]&&e[a][0](),e[c[d]]=0;return o.O(s)},n=self.webpackChunkoet_featured_content_block=self.webpackChunkoet_featured_content_block||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var l=o.O(void 0,[46],(function(){return o(557)}));l=o.O(l)}();