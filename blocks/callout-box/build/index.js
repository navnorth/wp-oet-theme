!function(){"use strict";var e,t={557:function(e,t,o){var l=window.wp.blocks,n=window.wp.i18n,a=window.wp.element,c=window.wp.blockEditor,r=window.wp.components,i=window.jQuery,u=o.n(i);function b(e){var t="Loading...";const{attributes:o,setAttributes:l,isSelected:i,clientId:b}=e,s=[{label:(0,n.__)("Checkmark","oet-callout-box-block"),value:"checkmark"},{label:(0,n.__)("Book","oet-callout-box-block"),value:"book"},{label:(0,n.__)("Light bulb","oet-callout-box-block"),value:"light-bulb"},{label:(0,n.__)("Exclamation","oet-callout-box-block"),value:"exclamation"},{label:(0,n.__)("Sun","oet-callout-box-block"),value:"sun"}],d=[{label:(0,n.__)("Select alignment","oet-callout-box-block"),value:""},{label:(0,n.__)("Left","oet-callout-box-block"),value:"left"},{label:(0,n.__)("Right","oet-callout-box-block"),value:"right"}];return b!==o.blockId&&l({blockId:b}),void 0!==o.isChanged&&0!=o.isChanged||(t=(0,a.createElement)("div",{className:"admin-callout-box-heading"},(0,a.createElement)("div",{className:"oet-callout-box-block"},(0,a.createElement)("div",{className:"pull-out-box checkmark col-xs-12"},(0,a.createElement)(c.RichText,{value:o.content,onChange:e=>{l({content:e})},allowedFormats:["core/bold","core/italic"],id:"callout-box-content",placeholder:(0,n.__)("Enter content here...","oet-callout-box-block")})),(0,a.createElement)("div",{className:"btnSaveCallout"},(0,a.createElement)(r.Button,{className:"btn-save-callout components-button is-primary",onClick:()=>{l({isChanged:!0})},isPrimary:!0},"Save"))))),u()(document).on("change",".block-editor-block-inspector .components-color-picker input",(function(){console.log(this)})),o.isChanged&&(m=o,k=o.blockId,p={action:"display_callout_box",attributes:m},u().ajax({url:oet_callout_box.ajax_url,type:"POST",data:p,success:function(e){console.log(e),e.error?(u()("#block-"+k+" .oet-callout-box-block").html(""),u()("#block-"+k+" .oet-callout-box-block").html(e.message)):(u()("#block-"+k+" .oet-callout-box-block").html(""),u()("#block-"+k+" .oet-callout-box-block").html(e))},error:function(e,t,o){console.log(o)}})),[(0,a.createElement)(a.Fragment,null,(0,a.createElement)(c.InspectorControls,{key:o.blockId},(0,a.createElement)(r.PanelBody,{title:(0,n.__)("Settings","oet-callout-box-block"),initialOpen:!0},(0,a.createElement)(r.PanelRow,null,(0,a.createElement)(r.SelectControl,{label:(0,n.__)("Type","oet-callout-box-block"),options:s,value:o.type,onChange:e=>{l({type:e,isChanged:!0})}})),(0,a.createElement)(r.PanelRow,null,(0,a.createElement)(r.RangeControl,{label:(0,n.__)("Width","oet-callout-box-block"),value:o.width,onChange:e=>{l({width:e,isChanged:!0})},min:1,max:12})),(0,a.createElement)(r.PanelRow,null,(0,a.createElement)(r.BaseControl,{id:"calloutColor",label:(0,n.__)("Color","oet-callout-box-block")},(0,a.createElement)(r.ColorPicker,{color:o.color,onChange:e=>{l({color:e,isChanged:!0})},copyFormat:"hex"}))),(0,a.createElement)(r.PanelRow,null,(0,a.createElement)(r.SelectControl,{label:(0,n.__)("Alignment","oet-callout-box-block"),options:d,value:o.alignment,onChange:e=>{l({alignment:e,isChanged:!0})}})),(0,a.createElement)(r.PanelRow,null,(0,a.createElement)(r.TextareaControl,{label:(0,n.__)("Content","oet-callout-box-block"),value:o.content,onChange:e=>{l({content:e,isChanged:!0})}}))))),(0,a.createElement)("div",(0,c.useBlockProps)(),(0,a.createElement)("div",{className:"oet-callout-box-block"},t))];var m,k,p}var s=JSON.parse('{"$schema":"https://json.schemastore.org/block.json","apiVersion":2,"name":"oet-block/oet-callout-box-block","version":"0.1.0","title":"Callout Box","category":"oet-block-category","icon":"admin-comments","description":"Displays callout box on a page","supports":{"html":false},"attributes":{"type":{"type":"string","default":"checkmark"},"width":{"type":"number","default":12},"color":{"type":"string","default":"#00529f"},"alignment":{"type":"string","default":"left"},"content":{"type":"string"},"isChanged":{"type":"boolean","default":false},"blockId":{"type":"string"}},"textdomain":"oet-callout-box-block","editorScript":"file:./build/index.js","editorStyle":"file:./build/index.css","style":"file:./build/style-index.css"}');1==oet_callout_box.version_58?(0,l.registerBlockType)(s,{edit:b}):(0,l.registerBlockType)("oet-block/oet-callout-box-block",{title:(0,n.__)("Callout Box","oet-callout-box-block"),category:"oet-block-category",icon:"admin-comments",supports:{html:!1},attributes:{type:{type:"string",default:"checkmark"},width:{type:"number",default:12},color:{type:"string",default:"#00529f"},alignment:{type:"string",default:"left"},content:{type:"string"},isChanged:{type:"boolean",default:!1},blockId:{type:"string"}},edit:b})}},o={};function l(e){var n=o[e];if(void 0!==n)return n.exports;var a=o[e]={exports:{}};return t[e](a,a.exports,l),a.exports}l.m=t,e=[],l.O=function(t,o,n,a){if(!o){var c=1/0;for(b=0;b<e.length;b++){o=e[b][0],n=e[b][1],a=e[b][2];for(var r=!0,i=0;i<o.length;i++)(!1&a||c>=a)&&Object.keys(l.O).every((function(e){return l.O[e](o[i])}))?o.splice(i--,1):(r=!1,a<c&&(c=a));if(r){e.splice(b--,1);var u=n();void 0!==u&&(t=u)}}return t}a=a||0;for(var b=e.length;b>0&&e[b-1][2]>a;b--)e[b]=e[b-1];e[b]=[o,n,a]},l.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(t,{a:t}),t},l.d=function(e,t){for(var o in t)l.o(t,o)&&!l.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,46:0};l.O.j=function(t){return 0===e[t]};var t=function(t,o){var n,a,c=o[0],r=o[1],i=o[2],u=0;if(c.some((function(t){return 0!==e[t]}))){for(n in r)l.o(r,n)&&(l.m[n]=r[n]);if(i)var b=i(l)}for(t&&t(o);u<c.length;u++)a=c[u],l.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return l.O(b)},o=self.webpackChunkoet_callout_box=self.webpackChunkoet_callout_box||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))}();var n=l.O(void 0,[46],(function(){return l(557)}));n=l.O(n)}();