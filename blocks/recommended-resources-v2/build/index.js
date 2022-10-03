(()=>{"use strict";var e,t={98:()=>{const e=window.wp.blocks,t=window.wp.i18n,o=(window.jQuery,window.wp.element),n=window.wp.blockEditor,r=window.wp.components;function a(e){var a=(0,t.__)("Loading...","oet-recommended-resources-block");const{attributes:l,setAttributes:c,clientId:d}=e,i=[{value:"",label:"Select media type"},{value:"video",label:"Video"},{value:"website",label:"Website"}],m=e=>{c({heading:e,isChanged:!0})},s=e=>{c({mediaType1:e,isChanged:!0})},u=e=>{c({mediaType2:e,isChanged:!0})},p=e=>{c({mediaType3:e,isChanged:!0})},g=e=>{c({mediaSource1:e,isChanged:!0})},b=e=>{c({mediaSource2:e,isChanged:!0})},_=e=>{c({mediaSource3:e,isChanged:!0})},k=e=>{c({mediaText1:e,isChanged:!0})},v=e=>{c({mediaText2:e,isChanged:!0})},y=e=>{c({mediaText3:e,isChanged:!0})};d!==l.blockId&&c({blockId:d}),a=l.firstLoad?(0,o.createElement)("div",{className:"admin_recommended_resources_heading"},(0,o.createElement)("div",{className:"pblctn_scl_icn_hedng"},(0,o.createElement)(r.TextControl,{placeholder:(0,t.__)("Enter heading here...","oet-recommended-resources-block"),value:l.heading,onChange:m})),(0,o.createElement)("div",{className:"col-md-12 col-sm-12 col-xs-12 padding_left padding_right tlkt_stp_vdo_cntnr"},(0,o.createElement)("div",{className:"col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg"},(0,o.createElement)("div",{key:"mediaType1"},(0,o.createElement)(r.SelectControl,{options:i,value:l.mediaType1,onChange:s})),(0,o.createElement)("div",{key:"mediaSource1"},(0,o.createElement)(r.TextControl,{placeholder:(0,t.__)("Youtube video or image url","oet-recommended-resources-block"),value:l.mediaSource1,onChange:g})),(0,o.createElement)("div",{key:"mediaText1"},(0,o.createElement)(r.TextControl,{placeholder:(0,t.__)("Enter text here...","oet-recommended-resources-block"),value:l.mediaText1,onChange:k}))),(0,o.createElement)("div",{className:"col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg"},(0,o.createElement)("div",{key:"mediaType2"},(0,o.createElement)(r.SelectControl,{options:i,value:l.mediaType2,onChange:u})),(0,o.createElement)("div",{key:"mediaSource2"},(0,o.createElement)(r.TextControl,{placeholder:(0,t.__)("Youtube video or image url","oet-recommended-resources-block"),value:l.mediaSource2,onChange:b})),(0,o.createElement)("div",{key:"mediaText2"},(0,o.createElement)(r.TextControl,{placeholder:(0,t.__)("Enter text here...","oet-recommended-resources-block"),value:l.mediaText2,onChange:v}))),(0,o.createElement)("div",{className:"col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg"},(0,o.createElement)("div",{key:"mediaType3"},(0,o.createElement)(r.SelectControl,{options:i,value:l.mediaType3,onChange:p})),(0,o.createElement)("div",{key:"mediaSource3"},(0,o.createElement)(r.TextControl,{placeholder:(0,t.__)("Youtube video or image url","oet-recommended-resources-block"),value:l.mediaSource3,onChange:_})),(0,o.createElement)("div",{key:"mediaText3"},(0,o.createElement)(r.TextControl,{placeholder:(0,t.__)("Enter text here...","oet-recommended-resources-block"),value:l.mediaText3,onChange:y})))),(0,o.createElement)("div",{className:"btnSaveRecommendedResources"},(0,o.createElement)(r.Button,{variant:"primary",onClick:()=>{c({isChanged:!0,firstLoad:!1})}},"Save"))):(0,o.createElement)("div",{className:"oet-recommended-resources-block"},(0,o.createElement)("h3",{className:"pblctn_scl_icn_hedng"},l.heading),(0,o.createElement)("div",{className:"col-md-12 col-sm-12 col-xs-12 padding_left padding_right tlkt_stp_vdo_cntnr"},(0,o.createElement)("div",{className:"col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two"},(0,o.createElement)("iframe",{title:"Video Embed",width:"274",height:"160",src:"//www.youtube.com/embed/xATpkkeX_qk",allowfullscreen:""}),(0,o.createElement)("p",null,l.mediaText1))));let h=(0,o.createElement)(o.Fragment,null,(0,o.createElement)(n.InspectorControls,{className:"oet-recommended-resources-block-inspector",key:"inspector-control"},(0,o.createElement)(r.PanelBody,{title:(0,t.__)("Settings","oet-recommended-resources-block"),initialOpen:!0},(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Heading","oet-recommended-resources-block"),value:l.heading,onChange:m})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.SelectControl,{label:(0,t.__)("Media Type 1","oet-recommended-resources-block"),value:l.mediaType1,options:i,onChange:s})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media/Image Source 1","oet-recommended-resources-block"),value:l.mediaSource1,onChange:g})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media Text 1","oet-recommended-resources-block"),value:l.mediaText1,onChange:k})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media Link 1","oet-recommended-resources-block"),value:l.mediaLink1,onChange:e=>{c({mediaLink1:e,isChanged:!0})}})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.SelectControl,{label:(0,t.__)("Media Type 2","oet-recommended-resources-block"),value:l.mediaType2,options:i,onChange:u})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media/Image Source 2","oet-recommended-resources-block"),value:l.mediaSource2,onChange:b})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media Text 2","oet-recommended-resources-block"),value:l.mediaText2,onChange:v})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media Link 2","oet-recommended-resources-block"),value:l.mediaLink2,onChange:e=>{c({mediaLink2:e,isChanged:!0})}})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.SelectControl,{label:(0,t.__)("Media Type 3","oet-recommended-resources-block"),value:l.mediaType3,options:i,onChange:p})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media/Image Source 3","oet-recommended-resources-block"),value:l.mediaSource3,onChange:_})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media Text 3","oet-recommended-resources-block"),value:l.mediaText3,onChange:y})),(0,o.createElement)(r.PanelRow,null,(0,o.createElement)(r.TextControl,{label:(0,t.__)("Media Link 3","oet-recommended-resources-block"),value:l.mediaLink3,onChange:e=>{c({mediaLink3:e,isChanged:!0})}})))));return(0,o.createElement)("div",(0,n.useBlockProps)(),h,(0,o.createElement)("div",{className:"oet-recommended-resources-block"},a))}function l(){return l=Object.assign?Object.assign.bind():function(e){for(var t=1;t<arguments.length;t++){var o=arguments[t];for(var n in o)Object.prototype.hasOwnProperty.call(o,n)&&(e[n]=o[n])}return e},l.apply(this,arguments)}const c=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"oet-block/oet-recommended-resources-block","version":"0.1.0","title":"Recommended Resources","category":"oet-block-category","icon":"list-view","description":"Displays the recommended resources section on a page.","supports":{"html":false},"attributes":{"heading":{"type":"string"},"mediaType1":{"type":"string"},"mediaSource1":{"type":"string"},"mediaText1":{"type":"string"},"mediaLink1":{"type":"string"},"mediaType2":{"type":"string"},"mediaSource2":{"type":"string"},"mediaText2":{"type":"string"},"mediaLink2":{"type":"string"},"mediaType3":{"type":"string"},"mediaSource3":{"type":"string"},"mediaText3":{"type":"string"},"mediaLink3":{"type":"string"},"isChanged":{"type":"boolean","default":false},"blockId":{"type":"string"},"firstLoad":{"type":"boolean","default":true}},"textdomain":"oet-recommended-resources-block","editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css"}');1==oet_recommended_resources.version_58?(0,e.registerBlockType)(c,{edit:a}):(0,e.registerBlockType)("oet-block/oet-recommended-resources-block",{title:(0,t.__)("Recommended resources","oet-recommended-resources-block"),description:(0,t.__)("Displays the recommended resources section on a page.","oet-recommended-resources-block"),category:"oet-block-category",icon:"list-view",keywords:[(0,t.__)("OET","oet-recommended-resources-block"),(0,t.__)("Recommended","oet-recommended-resources-block"),(0,t.__)("Resources","oet-recommended-resources-block")],attributes:{heading:{type:"string"},mediaType1:{type:"string"},mediaSource1:{type:"string"},mediaText1:{type:"string"},mediaLink1:{type:"string"},mediaType2:{type:"string"},mediaSource2:{type:"string"},mediaText2:{type:"string"},mediaLink2:{type:"string"},mediaType3:{type:"string"},mediaSource3:{type:"string"},mediaText3:{type:"string"},mediaLink3:{type:"string"},isChanged:{type:"boolean",default:!1},blockId:{type:"string"},firstLoad:{type:"boolean",default:!0}},edit:a,Save:function(){return(0,o.createElement)("div",l({},n.useBlockProps.save(),{key:"oet-recommended-resources"}),(0,o.createElement)("div",{className:"oet-recommended-resources-block"}))}})}},o={};function n(e){var r=o[e];if(void 0!==r)return r.exports;var a=o[e]={exports:{}};return t[e](a,a.exports,n),a.exports}n.m=t,e=[],n.O=(t,o,r,a)=>{if(!o){var l=1/0;for(m=0;m<e.length;m++){for(var[o,r,a]=e[m],c=!0,d=0;d<o.length;d++)(!1&a||l>=a)&&Object.keys(n.O).every((e=>n.O[e](o[d])))?o.splice(d--,1):(c=!1,a<l&&(l=a));if(c){e.splice(m--,1);var i=r();void 0!==i&&(t=i)}}return t}a=a||0;for(var m=e.length;m>0&&e[m-1][2]>a;m--)e[m]=e[m-1];e[m]=[o,r,a]},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={826:0,431:0};n.O.j=t=>0===e[t];var t=(t,o)=>{var r,a,[l,c,d]=o,i=0;if(l.some((t=>0!==e[t]))){for(r in c)n.o(c,r)&&(n.m[r]=c[r]);if(d)var m=d(n)}for(t&&t(o);i<l.length;i++)a=l[i],n.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return n.O(m)},o=globalThis.webpackChunkoet_recommended_resources_block=globalThis.webpackChunkoet_recommended_resources_block||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var r=n.O(void 0,[431],(()=>n(98)));r=n.O(r)})();