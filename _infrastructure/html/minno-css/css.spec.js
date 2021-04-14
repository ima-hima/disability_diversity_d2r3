var JSDOM = require('jsdom').JSDOM;
var css = require('./css');

describe('css', function(){
    it('should apply styles ', function(){
        var dom = new JSDOM('<!DOCTYPE html>');
        var el = dom.window.document.createElement('div');
        css(el, {fontFamily:'sans-serif'});
        expect(el.style.fontFamily).toBe('sans-serif');
    });

    it('should camel case when needed', function(){
        var dom = new JSDOM('<!DOCTYPE html>');
        var el = dom.window.document.createElement('div');
        css(el, {'font-family':'sans-serif'});
        expect(el.style.fontFamily).toBe('sans-serif');
    });
});
