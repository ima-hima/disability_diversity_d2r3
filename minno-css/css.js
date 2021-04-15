module.exports = css;

/**
 * @arg el DOMElement any dom element
 * @arg obj Object a hash of styleName:value, where the style name may be either css-style or jsStyle (camelCase)
 * @returns void
 *
 * The function applies the styles set in obj to the el
 **/

function css(el, obj){
    var style = el.style;

    if (!obj) return;

    for (var key in obj) style[camelCase(key)] = obj[key];

    function camelCase(str){ 
        return  str.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase(); }); 
    }
}
