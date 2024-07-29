!function(e){var t={};function a(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,a),r.l=!0,r.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)a.d(n,r,function(t){return e[t]}.bind(null,r));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=0)}([function(e,t,a){e.exports=a(1)},function(e,t,a){"use strict";var n,r,o,i,l,d,u,c,s,b,g,v,f,p,m,_,h,y,w,P,E,k,O,R,j=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(e[n]=a[n])}return e},S=function(){function e(e,t){for(var a=0;a<t.length;a++){var n=t[a];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(t,a,n){return a&&e(t.prototype,a),n&&e(t,n),t}}();function M(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function B(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}n=wp.i18n,r=wp.plugins,o=wp.element,i=wp.data,l=wp.components,d=n.__,u=r.registerPlugin,c=o.Component,s=o.Fragment,b=i.select,g=i.withSelect,v=i.withDispatch,f=l.PanelBody,p=l.ButtonGroup,m=l.Button,_=wp.compose.compose,h=wp.editPost||wp.editor,y=h.PluginSidebar,w=h.PluginSidebarMoreMenuItem,P=d("PublishPress Blocks Settings","advanced-gutenberg"),E=[{label:d("Inherit from global settings","advanced-gutenberg"),value:""},{label:d("Enable","advanced-gutenberg"),value:"enable"},{label:d("Disable","advanced-gutenberg"),value:"disable"}],k=[{label:d("Inherit from global settings","advanced-gutenberg"),value:""},{label:d("Original","advanced-gutenberg"),value:"default"},{label:d("Large","advanced-gutenberg"),value:"large"},{label:d("Full width","advanced-gutenberg"),value:"full"}],O=function(e){function t(){return M(this,t),B(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),S(t,[{key:"onUpdateMeta",value:function(e){var t=this.props,a=t.metaValues;(0,t.updateMetaField)(j({},a,e)),function(){var e=b("core/editor").getEditedPostAttribute("meta");if(!e)return null;var t=e.advgb_blocks_editor_width,a=e.advgb_blocks_columns_visual_guide,n=window.document.body.classList;n.remove("advgb-editor-width-default","advgb-editor-width-large","advgb-editor-width-full","advgb-editor-col-guide-enable","advgb-editor-col-guide-disable"),t?n.add("advgb-editor-width-"+t):n.add("advgb-editor-width-"+advg_settings.editor_width_global),a?n.add("advgb-editor-col-guide-"+a):n.add("advgb-editor-col-guide-"+advg_settings.enable_columns_visual_guide_global)}()}},{key:"render",value:function(){var e=this,t=this.props,a=t.columnsVisualGuide,n=t.editorWidth;return React.createElement(s,null,React.createElement("div",{className:"advgb-editor-sidebar-note"},d("These settings will override the PublishPress Blocks global settings.","advanced-gutenberg")),React.createElement(f,{title:d("Editor width","advanced-gutenberg")},React.createElement("div",{className:"advgb-editor-sidebar-note"},d("Change your editor width","advanced-gutenberg")),React.createElement(p,{className:"advgb-button-group"},k.map((function(t,a){return React.createElement(m,{className:"advgb-button",key:a,isSecondary:t.value!==n,isPrimary:t.value===n,onClick:function(){return e.onUpdateMeta({advgb_blocks_editor_width:t.value})}},t.label)})))),void 0!==advgbBlocks.enable_advgb_blocks&&"1"===advgbBlocks.enable_advgb_blocks&&React.createElement(f,{title:d("Columns Visual Guide","advanced-gutenberg"),initialOpen:!1},React.createElement("div",{className:"advgb-editor-sidebar-note"},d("Border to materialize PublishPress Blocks Column block","advanced-gutenberg")),React.createElement(p,{className:"advgb-button-group"},E.map((function(t,n){return React.createElement(m,{className:"advgb-button",key:n,isSecondary:t.value!==a,isPrimary:t.value===a,onClick:function(){return e.onUpdateMeta({advgb_blocks_columns_visual_guide:t.value})}},t.label)})))))}}]),t}(c),R=_(v((function(e){return{updateMetaField:function(t){e("core/editor").editPost({meta:t})}}})),g((function(e){var t=e("core/editor").getEditedPostAttribute("meta");return{metaValues:t,columnsVisualGuide:t.advgb_blocks_columns_visual_guide,editorWidth:t.advgb_blocks_editor_width}})))(O),u("advgb-editor-sidebar",{render:function(){return React.createElement(s,null,React.createElement(w,{target:"advgb-editor-sidebar",icon:"layout"},P),React.createElement(y,{name:"advgb-editor-sidebar",title:P,icon:"layout"},React.createElement("div",{className:"advgb-editor-sidebar-content"},React.createElement(R,null))))}})}]);
//# sourceMappingURL=post-sidebar.js.map