## minno-css

This is a super simple clone of some of the functionality of `jQuery.css`.
It exposes a single function that applies style to a dom element.

```javascript
const el = document.getElementById('header');

// the following are equivalent
css(el, {color:'red', fontFamily:'sans-serif'});
css(el, {color:'red', 'font-family':'sans-serif'});
```
