!(function () {
    "use strict";
    var e,
        t = {
            502: function () {
                var e = window.wp.blocks,
                    t = JSON.parse(
                        '{"TN":"Featured Item","W3":"oet-block-category","qv":"pressthis","WL":"Add featured item block","Y4":{"blockid":{"type":"string"},"oetblkFeaturedItemHeading":{"type":"string"},"oetblkFeaturedItemTitle":{"type":"string"},"oetblkFeaturedItemDate":{"type":"string"},"oetblkFeaturedItemButtonDisplay":{"type":"boolean","default":true},"mediaID":{"type":"number","source":"attribute","attribute":"data-id","selector":"img"},"mediaURL":{"type":"string","source":"attribute","attribute":"src","selector":"img"},"thumbnail":{"type":"string","source":"attribute","attribute":"data-thumb","selector":"img"},"thumbnailsize":{"type":"integer"}}}'
                    ),
                    jQuery = window.jQuery,
                    o = window.wp.element,
                    a = window.wp.i18n,
                    r = window.wp.blockEditor,
                    l = window.wp.components;
                const i = ["image"];
                function n(e) {
                    let { mediaID: t, onSelect: a } = e;
                    return (0, o.createElement)(
                        r.MediaUploadCheck,
                        null,
                        (0, o.createElement)(r.MediaUpload, {
                            onSelect: a,
                            allowedTypes: i,
                            value: t,
                            render: (e) => {
                                let { open: t } = e;
                                return (0, o.createElement)(l.Button, { onClick: t, className: "button button-large oet-featured-item-addedit-image-button noimage" }, "Upload Image");
                            },
                        })
                    );
                }
                function c(e) {
                    const t = e.attributes,
                        i = e.setAttributes;
                    let c = window.oercurrBlocksJson ? (0, r.useBlockProps)() : "";
                    function d(e) {
                        e.map((e) => {
                            if ("oet-block/oet-featured-item-block" == e.name) {
                                var t = "cb" + new Date().getTime(),
                                    o = e.clientId;
                                wp.data.select("core/block-editor").getBlockAttributes(o).blockid || wp.data.dispatch("core/block-editor").updateBlockAttributes(o, { blockid: t });
                            }
                            e.innerBlocks.length > 0 && d(e.innerBlocks);
                        });
                    }
                    document.body.addEventListener("keydown", function (e) {
                        if ("Backspace" == e.key) {
                            let t = wp.data.select("core/block-editor").getSelectionStart();
                            jQuery(e.target).closest(".oet_featured_item_block_wrapper").length && "offset" in t && 0 === t.offset && e.preventDefault();
                        }
                    }),
                        wp.data
                            .select("core/block-editor")
                            .getBlocks()
                            .map((e) => {
                                if ("oet-block/oet-featured-item-block" == e.name) {
                                    var t = "cb" + new Date().getTime(),
                                        o = e.clientId;
                                    wp.data.select("core/block-editor").getBlockAttributes(o).blockid || wp.data.dispatch("core/block-editor").updateBlockAttributes(o, { blockid: t });
                                } else ("core/group" != e.name && "core/columns" != e.name) || d(e.innerBlocks);
                            });
                    const u = new Date();
                    let m = [];
                    const headingLevels = [
				      { value: 'h1', label: 'H1' },
				      { value: 'h2', label: 'H2' },
				      { value: 'h3', label: 'H3' },
				      { value: 'h4', label: 'H4' },
				      { value: 'h5', label: 'H5' },
				      { value: 'h6', label: 'H6' }
				    ];
                    return (
                        (m = t.oetblkFeaturedItemButtonDisplay
                            ? [
                                  /**--["core/heading", { placeholder: "Featured Item Title", className: "oet-featured-item-title oet-featured-item-title-ytr85g9wer", level: 4, textColor: "oet-color-pallete-orange" }],
                                  ["core/heading", { placeholder: "Publishing Date", className: "oet-featured-item-date oet-featured-item-date-ytr85g9wer", level: 5, textColor: "oet-color-pallete-black" }],--**/
                                  [
	                                  "core/paragraph",
	                                  { placeholder: "Featured Item Description", className: "oet-featured-item-content oet-featured-item-content-ytr85g9wer", align: "left", textColor: "oet-color-pallete-black", fontSize: "normal" },
                                  ],
                                  ["core/button", { className: "oet-featured-item-button oet-featured-item-button-ytr85g9wer", align: "left", text: "Button Text", backgroundColor: "oet-color-pallete-orange", textColor: "white" }],
                              ]
                            : [
                                  /**--[
                                      "core/heading",
                                      {
                                          placeholder: "Featured Item Title",
                                          className: "oet-featured-item-title oet-featured-item-date-ytr85g9wer",
                                          level: 4,
                                          textColor: "oet-color-pallete-orange",
                                          content: "<strong>Featured item Title here</strong>",
                                      },
                                  ],
                                  [
                                      "core/heading",
                                      {
                                          placeholder: "Publishing Date",
                                          className: "oet-featured-item-date oet-featured-item-date-ytr85g9wer",
                                          level: 5,
                                          textColor: "oet-color-pallete-black",
                                          content:
                                              "<strong>" +
                                              ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][u.getMonth()] +
                                              " " +
                                              u.getDate() +
                                              ", " +
                                              u.getFullYear() +
                                              "</strong>",
                                      },
                                  ],--**/
                                  [
                                      "core/paragraph",
                                      { placeholder: "Featured Item Description", className: "oet-featured-item-content oet-featured-item-content-ytr85g9wer", align: "left", textColor: "oet-color-pallete-black", fontSize: "normal" },
                                  ],
                                  ["core/button", { className: "oet-featured-item-button oet-featured-item-button-ytr85g9wer hidden", align: "left", text: "Button Text", backgroundColor: "oet-color-pallete-orange", textColor: "white" }],
                              ]),
                        (0, o.createElement)(
                            "div",
                            c,
                            (0, o.createElement)(
                                "div",
                                { className: "oet_featured_item_block_wrapper" },
                                (0, o.createElement)(
                                    r.InspectorControls,
                                    null,
                                    (0, o.createElement)(
                                        PanelBody,
                                        { title: (0, a.__)("Featured Item Block settings"), initialOpen: !0 },
                                        (0, o.createElement)(
                                            "div",
                                            { class: "oet_featured_item_inspector_wrapper" },
                                            (0, o.createElement)(l.SelectControl, {
                                                label: (0, a.__)("Heading Tag"),
                                                value: t.oetblkHeadingTag,
                                                options: headingLevels,
                                                onChange: (e) => {
                                                    i({ oetblkHeadingTag: e });
                                                },
                                            }),
                                            (0, o.createElement)(l.SelectControl, {
                                                label: (0, a.__)("Title Tag"),
                                                value: t.oetblkTitleTag,
                                                options: headingLevels,
                                                onChange: (e) => {
                                                    i({ oetblkTitleTag: e });
                                                },
                                            }),
                                            (0, o.createElement)(l.SelectControl, {
                                                label: (0, a.__)("Publishing Date Tag"),
                                                value: t.oetblkDateTag,
                                                options: headingLevels,
                                                onChange: (e) => {
                                                    i({ oetblkDateTag: e });
                                                },
                                            }),
                                            (0, o.createElement)(l.ToggleControl, {
                                                label: (0, a.__)("Show Button"),
                                                help: t.oetblkFeaturedItemButtonDisplay ? (0, a.__)("Show Featured Item Button", "five") : (0, a.__)("Hide Featured Item Button", "five"),
                                                checked: !!t.oetblkFeaturedItemButtonDisplay,
                                                onChange: (e) => {
                                                    return (o = !t.oetblkFeaturedItemButtonDisplay), void i({ oetblkFeaturedItemButtonDisplay: o });
                                                    var o;
                                                },
                                            }),
                                            (() => {
                                                if (t.mediaURL)
                                                    return (0, o.createElement)(l.RangeControl, {
                                                        label: (0, a.__)("Image Size"),
                                                        value: t.thumbnailsize,
                                                        onChange: (e) => {
                                                            i({ thumbnailsize: e, titlesize: 100 - e });
                                                        },
                                                        help: (0, a.__)("Image width in percentage", "five"),
                                                        min: 1,
                                                        max: 100,
                                                    });
                                            })()
                                        )
                                    )
                                ),
                                (0, o.createElement)(
                                    "div",
                                    { class: t.oetblkFeaturedItemButtonDisplay ? "oet-shortcode oet_featured_item_block oetblk-" + t.blockid : "oet-shortcode oet_featured_item_block oetblk-" + t.blockid + " hidebutton" },
                                    (0, o.createElement)(
                                        "div",
                                        { class: "col-md-12 col-sm-12 col-xs-12 rght_sid_mtr lft_sid_mtr" },
                                        (0, o.createElement)(
                                            "h3",
                                            { class: "oet_featured_item_header" },
                                            (0, o.createElement)("input", {
                                                type: "text",
                                                class: "oet-featured-item-header-input",
                                                onChange: (e) => {
                                                    i({ oetblkFeaturedItemHeading: e.target.value });
                                                },
                                                placeholder: "Featured Item Heading",
                                                value: t.oetblkFeaturedItemHeading,
                                            })
                                        ),
                                        (0, o.createElement)(
                                            "div",
                                            {
                                                class: t.mediaURL ? "oet-featured-item-image-wrapper-float-left" : "oet-featured-item-image-wrapper-float-left minheight",
                                                style: void 0 !== t.thumbnailsize ? { width: t.thumbnailsize + "%" } : { width: "110px" },
                                            },
                                            (0, o.createElement)("img", { src: t.mediaURL, class: t.mediaURL ? "featured_item_image oet-featured-item-image" : "hidden", alt: "featured_item_image" }),
                                            t.mediaURL
                                                ? (0, o.createElement)(
                                                      l.Button,
                                                      {
                                                          onClick: (t) => {
                                                              e.setAttributes({ mediaID: void 0, mediaURL: void 0, thumbnail: void 0, thumbnailsize: void 0 });
                                                          },
                                                          className: "button button-large oet-featured-item-delete-image-button noimage",
                                                      },
                                                      (0, o.createElement)("span", { class: "dashicons dashicons-trash" })
                                                  )
                                                : (0, o.createElement)(n, {
                                                      mediaID: t.mediaID,
                                                      onSelect: (e) => {
                                                          i({ mediaID: e.id, mediaURL: e.url, thumbnail: e.sizes.thumbnail.url, thumbnailsize: 50 });
                                                      },
                                                  })
                                        ),
                                        (() => {
                                    	if (void 0 !== t.oeseblkFeaturedItemURL) {
	                                        if ("h1" == t.oetblkTitleTag)
	                                            return (0, o.createElement)(
	                                                "h1",
	                                                { class: "oet-featured-item-title" },
	                                                (0, o.createElement)("input", {
	                                                    type: "text",
	                                                    onChange: (e) => {
                                                            i({ oetblkFeaturedItemTitle: e.target.value });
                                                        },
	                                                    value: t.oetblkFeaturedItemTitle,
	                                                    class: "oet-color-pallete-orange-color oet-featured-item-title nolink",
	                                                    placeholder: "Featured Item Title",
	                                                    style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
	                                                })
	                                            );
	                                        if ("h2" == t.oetblkTitleTag)
	                                            return (0, o.createElement)(
	                                                "h2",
	                                                { class: "oet-featured-item-title" },
	                                                (0, o.createElement)("input", {
	                                                    type: "text",
	                                                    onChange: (e) => {
                                                            i({ oetblkFeaturedItemTitle: e.target.value });
                                                        },
	                                                    value: t.oetblkFeaturedItemTitle,
	                                                    class: "oet-color-pallete-orange-color oet-featured-item-title nolink",
	                                                    placeholder: "Featured Item Title",
	                                                    style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
	                                                })
	                                            );
	                                        if ("h3" == t.oetblkTitleTag)
	                                            return (0, o.createElement)(
	                                                "h3",
	                                                { class: "oet-featured-item-title" },
	                                                (0, o.createElement)("input", {
	                                                    type: "text",
	                                                    onChange: (e) => {
                                                            i({ oetblkFeaturedItemTitle: e.target.value });
                                                        },
	                                                    value: t.oetblkFeaturedItemTitle,
	                                                    class: "oet-color-pallete-orange-color oet-featured-item-title nolink",
	                                                    placeholder: "Featured Item Title",
	                                                    style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
	                                                })
	                                            );
	                                        if ("h4" == t.oetblkTitleTag)
	                                            return (0, o.createElement)(
	                                                "h4",
	                                                { class: "oet-featured-item-title" },
	                                                (0, o.createElement)("input", {
	                                                    type: "text",
	                                                    onChange: (e) => {
                                                            i({ oetblkFeaturedItemTitle: e.target.value });
                                                        },
	                                                    value: t.oetblkFeaturedItemTitle,
	                                                    class: "oet-color-pallete-orange-color oet-featured-item-title nolink",
	                                                    placeholder: "Featured Item Title",
	                                                    style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
	                                                })
	                                            );
	                                        if ("h5" == t.oetblkTitleTag)
	                                            return (0, o.createElement)(
	                                                "h5",
	                                                { class: "oet-featured-item-title" },
	                                                (0, o.createElement)("input", {
	                                                    type: "text",
	                                                    onChange: (e) => {
                                                            i({ oetblkFeaturedItemTitle: e.target.value });
                                                        },
	                                                    value: t.oetblkFeaturedItemTitle,
	                                                    class: "oet-color-pallete-orange-color oet-featured-item-title nolink",
	                                                    placeholder: "Featured Item Title",
	                                                    style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
	                                                })
	                                            );
	                                        if ("h6" == t.oetblkTitleTag)
	                                            return (0, o.createElement)(
	                                                "h6",
	                                                { class: "oet-featured-item-title" },
	                                                (0, o.createElement)("input", {
	                                                    type: "text",
	                                                    onChange: (e) => {
                                                            i({ oetblkFeaturedItemTitle: e.target.value });
                                                        },
	                                                    value: t.oetblkFeaturedItemTitle,
	                                                    class: "oet-color-pallete-orange-color oet-featured-item-title nolink",
	                                                    placeholder: "Featured Item Title",
	                                                    style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
	                                                })
	                                            );
	                                    } else {
	                                    	return (0, o.createElement)(
	                                                "h3",
	                                                { class: "oet-featured-item-title" },
	                                                (0, o.createElement)("input", {
	                                                    type: "text",
	                                                    onChange: (e) => {
                                                            i({ oetblkFeaturedItemTitle: e.target.value });
                                                        },
	                                                    value: t.oetblkFeaturedItemTitle,
	                                                    class: "oet-color-pallete-orange-color oet-featured-item-title nolink",
	                                                    placeholder: "Featured Item Title",
	                                                    style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
	                                                })
	                                            );
	                                    }
                                        })(),
                                        "h1" == t.oetblkDateTag
                                        ? (0, o.createElement)(
                                              "h1",
                                              { class: "oet-featured-item-date" },
                                              (0, o.createElement)("input", {
                                                  type: "text",
                                                   onChange: (e) => {
                                                        i({ oetblkFeaturedItemDate: e.target.value });
                                                    },
                                                  value: t.oetblkFeaturedItemDate,
                                                  class: "oet-featured-item-date-input nolink",
                                                  placeholder: "Publishing Date",
                                                  style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
                                              })
                                          )
                                        : "h2" == t.oetblkDateTag
                                        ? (0, o.createElement)(
                                              "h2",
                                              { class: "oet-featured-item-date" },
                                              (0, o.createElement)("input", {
                                                  type: "text",
                                                  onChange: (e) => {
                                                        i({ oetblkFeaturedItemDate: e.target.value });
                                                    },
                                                  value: t.oetblkFeaturedItemDate,
                                                  class: "oet-featured-item-date-input nolink",
                                                  placeholder: "Publishing Date",
                                                  style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
                                              })
                                          )
                                        : "h3" == t.oetblkDateTag
                                        ? (0, o.createElement)(
                                              "h3",
                                              { class: "oet-featured-item-date" },
                                              (0, o.createElement)("input", {
                                                  type: "text",
                                                  onChange: (e) => {
                                                        i({ oetblkFeaturedItemDate: e.target.value });
                                                    },
                                                  value: t.oetblkFeaturedItemDate,
                                                  class: "oet-featured-item-date-input nolink",
                                                  placeholder: "Publishing Date",
                                                  style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
                                              })
                                          )
                                        : "h4" == t.oetblkDateTag
                                        ? (0, o.createElement)(
                                              "h4",
                                              { class: "oet-featured-item-date" },
                                              (0, o.createElement)("input", {
                                                  type: "text",
                                                  onChange: (e) => {
                                                        i({ oetblkFeaturedItemDate: e.target.value });
                                                    },
                                                  value: t.oetblkFeaturedItemDate,
                                                  class: "oet-featured-item-date-input nolink",
                                                  placeholder: "Publishing Date",
                                                  style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
                                              })
                                          )
                                        : "h5" == t.oetblkDateTag
                                        ? (0, o.createElement)(
                                              "h5",
                                              { class: "oet-featured-item-date" },
                                              (0, o.createElement)("input", {
                                                  type: "text",
                                                  onChange: (e) => {
                                                        i({ oetblkFeaturedItemDate: e.target.value });
                                                    },
                                                  value: t.oetblkFeaturedItemDate,
                                                  class: "oet-featured-item-date-input nolink",
                                                  placeholder: "Publishing Date",
                                                  style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
                                              })
                                          )
                                        : "h6" == t.oetblkDateTag
                                        ? (0, o.createElement)(
                                              "h6",
                                              { class: "oet-featured-item-date" },
                                              (0, o.createElement)("input", {
                                                  type: "text",
                                                  onChange: (e) => {
                                                        i({ oetblkFeaturedItemDate: e.target.value });
                                                    },
                                                  value: t.oetblkFeaturedItemDate,
                                                  class: "oet-featured-item-date-input nolink",
                                                  placeholder: "Publishing Date",
                                                  style: t.titlesize > 10 ? { width: t.titlesize + "%", resize: "none" } : { width: "100%", resize: "none" },
                                              })
                                          )
                                        : void 0,
                                        (0, o.createElement)(r.InnerBlocks, { allowedBlocks: ["core/paragraph"], templateInsertUpdatesSelection: !1, template: m, templateLock: "all" })
                                    )
                                )
                            )
                        )
                    );
                }
                function d(e) {
                    const t = e.attributes;
                    return (0, o.createElement)(
                        "div",
                        null,
                        (0, o.createElement)(
                            "div",
                            { className: "oet_featured_item_block_wrapper" },
                            (0, o.createElement)(
                                "div",
                                { class: t.oetblkFeaturedItemButtonDisplay ? "oet-shortcode oet_featured_item_block oetblk-" + t.blockid : "oet-shortcode oet_featured_item_block oetblk-" + t.blockid + " hidebutton" },
                                (0, o.createElement)(
                                    "div",
                                    { class: "col-md-12 col-sm-12 col-xs-12 rght_sid_mtr lft_sid_mtr" },
                                    (0, o.createElement)(t.oetblkHeadingTag, { class: "oet_featured_item_header" }, t.oetblkFeaturedItemHeading),
                                    (0, o.createElement)(
                                        "div",
                                        { class: "oet-featured-item-image-wrapper-float-left", style: void 0 !== t.thumbnailsize ? { width: t.thumbnailsize + "%" } : { margin: "0" } },
                                        t.mediaURL && (0, o.createElement)("img", { src: t.mediaURL, class: "featured_item_image oet-featured-item-image", alt: "" })
                                    ),
                                    (0, o.createElement)(t.oetblkTitleTag, { class: "oet-featured-item-title oet-featured-item-title-ytr85g9wer has-oet-color-pallete-orange-color has-text-color" }, t.oetblkFeaturedItemTitle),
                                    (0, o.createElement)(t.oetblkDateTag, { class: "oet-featured-item-date oet-featured-item-date-ytr85g9wer has-oet-color-pallete-black-color has-text-color" }, t.oetblkFeaturedItemDate),
                                    (0, o.createElement)(r.InnerBlocks.Content, null)
                                )
                            )
                        )
                    );
                }
                const { __: __ } = wp.i18n;
                (window.oercurrBlocksJson = "undefined" == typeof oet_featured_item_legacy_marker),
                    window.oercurrBlocksJson
                        ? (0, e.registerBlockType)("oet-block/oet-featured-item-block", { edit: c, save: d, example: () => {} })
                        : (0, e.registerBlockType)("oet-block/oet-featured-item-block", {
                              title: __(t.TN),
                              icon: t.qv,
                              description: __(t.WL),
                              category: t.W3,
                              keywords: [__("oet"), __("featured"), __("item"), __("block")],
                              attributes: t.Y4,
                              edit: c,
                              save: d,
                              example: () => {},
                          });
            },
        },
        o = {};
    function a(e) {
        var r = o[e];
        if (void 0 !== r) return r.exports;
        var l = (o[e] = { exports: {} });
        return t[e](l, l.exports, a), l.exports;
    }
    (a.m = t),
        (e = []),
        (a.O = function (t, o, r, l) {
            if (!o) {
                var i = 1 / 0;
                for (u = 0; u < e.length; u++) {
                    (o = e[u][0]), (r = e[u][1]), (l = e[u][2]);
                    for (var n = !0, c = 0; c < o.length; c++)
                        (!1 & l || i >= l) &&
                        Object.keys(a.O).every(function (e) {
                            return a.O[e](o[c]);
                        })
                            ? o.splice(c--, 1)
                            : ((n = !1), l < i && (i = l));
                    if (n) {
                        e.splice(u--, 1);
                        var d = r();
                        void 0 !== d && (t = d);
                    }
                }
                return t;
            }
            l = l || 0;
            for (var u = e.length; u > 0 && e[u - 1][2] > l; u--) e[u] = e[u - 1];
            e[u] = [o, r, l];
        }),
        (a.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (function () {
            var e = { 826: 0, 46: 0 };
            a.O.j = function (t) {
                return 0 === e[t];
            };
            var t = function (t, o) {
                    var r,
                        l,
                        i = o[0],
                        n = o[1],
                        c = o[2],
                        d = 0;
                    if (
                        i.some(function (t) {
                            return 0 !== e[t];
                        })
                    ) {
                        for (r in n) a.o(n, r) && (a.m[r] = n[r]);
                        if (c) var u = c(a);
                    }
                    for (t && t(o); d < i.length; d++) (l = i[d]), a.o(e, l) && e[l] && e[l][0](), (e[i[d]] = 0);
                    return a.O(u);
                },
                o = (self.webpackChunkoese_featured_item_block = self.webpackChunkoese_featured_item_block || []);
            o.forEach(t.bind(null, 0)), (o.push = t.bind(null, o.push.bind(o)));
        })();
    var r = a.O(void 0, [46], function () {
        return a(502);
    });
    r = a.O(r);
})();
